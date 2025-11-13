using System;
using System.Collections.Generic;
using System.Linq;
using UnityEngine;

public sealed class FloorGenerator
{
    // --- Config (from BuildingCreator) ---
    private readonly Material floorMat;
    private readonly Vector2 corridorWallHeightRange;
    private readonly Vector2 roomWallHeightRange;
    private readonly Vector2 doorHeightRange;
    private readonly bool roofTopfloor;
    private readonly bool roofCorridors;
    private readonly bool roofRooms;
    private readonly BuildingCreator buildingCreator;

    // --- Build-time hooks (delegates from BuildingCreator) ---
    private readonly Func<int, Vector2, Vector2, IEnumerable<RectInt>> getHolesForArea;
    private readonly Action<Vector2, Vector2, Transform> createFloorMesh;                 // mesh emitter (owner-provided)
    private readonly Action<Vector2, Vector2, float, Transform> createRoofPiece;          // roof emitter (owner-provided)
    private readonly Func<int> getCurrentFloorIndex;                                      // if you need dynamic yKey
    private readonly FloorEdgeContext ctx;                                                // per-floor edge state

    public FloorGenerator(
        BuildingCreator bc,
        Material floorMaterial,
        Vector2 corridorWallHeightRange,
        Vector2 roomWallHeightRange,
        Vector2 doorHeightRange,
        bool roofTopfloor,
        bool roofCorridors,
        bool roofRooms,
        Func<int, Vector2, Vector2, IEnumerable<RectInt>> getHolesForArea,
        Action<Vector2, Vector2, Transform> createFloorMesh,
        Action<Vector2, Vector2, float, Transform> createRoofPiece,
        Func<int> getCurrentFloorIndex,
        FloorEdgeContext context)
    {
        buildingCreator = bc;
        floorMat = floorMaterial;
        this.corridorWallHeightRange = corridorWallHeightRange;
        this.roomWallHeightRange = roomWallHeightRange;
        this.doorHeightRange = doorHeightRange;
        this.roofTopfloor = roofTopfloor;
        this.roofCorridors = roofCorridors;
        this.roofRooms = roofRooms;
        this.getHolesForArea = getHolesForArea;
        this.createFloorMesh = createFloorMesh;
        this.createRoofPiece = createRoofPiece;
        this.getCurrentFloorIndex = getCurrentFloorIndex;
        ctx = context ?? throw new ArgumentNullException(nameof(context));
    }

    // -------------------------------------------------------------------------
    // Public API (used by BuildingCreator)
    // -------------------------------------------------------------------------

    // Instance wrapper so BuildingCreator can call floorGen.CreateFloorMesh(...)
    public void CreateFloorMesh(Vector2 bl, Vector2 tr, Transform parent)
    {
        createFloorMesh?.Invoke(bl, tr, parent);
    }

    // Emits multiple pieces so [bl,tr] is carved by 'holes' (instance path; uses delegate)
    public void CarveRoomFloorAndEmit(Vector2 bl, Vector2 tr, IEnumerable<RectInt> holes, Transform parent)
    {
        var remain = new List<RectInt>
        {
            RectFromMinMax(
                Mathf.FloorToInt(bl.x), Mathf.FloorToInt(bl.y),
                Mathf.CeilToInt(tr.x),  Mathf.CeilToInt(tr.y))
        };

        foreach (var h in holes)
        {
            var next = new List<RectInt>();
            foreach (var r in remain) SplitRectByHole(r, h, next);
            remain = next;
            if (remain.Count == 0) break;
        }

        const float eps = 0.0005f; // avoid z-fighting on borders
        foreach (var r in remain)
        {
            if (r.width <= 0 || r.height <= 0) continue;

            var pbl = new Vector2(r.xMin + eps, r.yMin + eps);
            var ptr = new Vector2(r.xMax - eps, r.yMax - eps);
            if (ptr.x > pbl.x && ptr.y > pbl.y)
                createFloorMesh?.Invoke(pbl, ptr, parent);
        }
    }

    public void BuildFloorIfNeeded(Node space, int floorIndex, Transform parent)
    {
        if (!space.BuildFloor) return;

        var bl = space.BottomLeftAreaCorner;
        var tr = space.TopRightAreaCorner;
        var holes = getHolesForArea(floorIndex, bl, tr).ToList();

        if (holes.Count == 0)
        {
            EmitSlabWithEdges(floorMat, bl, tr, parent, floorIndex);
        }
        else
        {
            CarveAndEmitFloor(bl, tr, holes, parent, floorIndex);
        }
    }

    public void AssignHeight(Node space, System.Random _ = null)
    {
        float h = (space is CorridorNode)
            ? UnityEngine.Random.Range(corridorWallHeightRange.x, corridorWallHeightRange.y)
            : UnityEngine.Random.Range(roomWallHeightRange.x, roomWallHeightRange.y);

        if (space is RoomNode rn) rn.Height = h;
        else space.Height = h;
    }

    public void BuildRoofIfNeeded(Node space, int floorIndex, Transform parent)
    {
        bool wantsRoof =
            ((((space is RoomNode) || (space is ShaftNode)) && roofRooms) ||
             (space is CorridorNode && roofCorridors) ||
             roofTopfloor)
            && space.BuildRoof;

        if (!wantsRoof) return;

        float roofY = (space is CorridorNode && roofCorridors) ? doorHeightRange.x : space.Height;

        var bl = space.BottomLeftAreaCorner;
        var tr = space.TopRightAreaCorner;
        var holes = getHolesForArea(floorIndex, bl, tr).ToList();

        if (holes.Count == 0)
        {
            createRoofPiece?.Invoke(bl, tr, roofY, parent);
            return;
        }

        // Carve roof pieces (no edge tracking needed for roofs)
        const float eps = 0.0005f;

        var remain = new List<RectInt>
        {
            RectFromMinMax(
                Mathf.FloorToInt(bl.x), Mathf.FloorToInt(bl.y),
                Mathf.CeilToInt(tr.x),  Mathf.CeilToInt(tr.y))
        };

        foreach (var hrect in holes)
        {
            var next = new List<RectInt>();
            foreach (var r in remain) SplitRectByHole(r, hrect, next);
            remain = next;
            if (remain.Count == 0) break;
        }

        foreach (var r in remain)
        {
            if (r.width <= 0 || r.height <= 0) continue;

            var pbl = new Vector2(r.xMin + eps, r.yMin + eps);
            var ptr = new Vector2(r.xMax - eps, r.yMax - eps);
            if (ptr.x > pbl.x && ptr.y > pbl.y)
                createRoofPiece?.Invoke(pbl, ptr, roofY, parent);
        }
    }

    // -------------------------------------------------------------------------
    // Internal carving/helpers (instance path with edge bookkeeping)
    // -------------------------------------------------------------------------

    private static RectInt RectFromMinMax(int xMin, int yMin, int xMax, int yMax)
        => new RectInt(xMin, yMin, Mathf.Max(0, xMax - xMin), Mathf.Max(0, yMax - yMin));

    private static void SplitRectByHole(RectInt r, RectInt h, List<RectInt> outRects)
    {
        int ox0 = Mathf.Max(r.xMin, h.xMin);
        int oz0 = Mathf.Max(r.yMin, h.yMin);
        int ox1 = Mathf.Min(r.xMax, h.xMax);
        int oz1 = Mathf.Min(r.yMax, h.yMax);

        // No overlap → keep original
        if (ox1 <= ox0 || oz1 <= oz0)
        {
            outRects.Add(r);
            return;
        }

        // West / East strips
        if (h.xMin > r.xMin) outRects.Add(RectFromMinMax(r.xMin, r.yMin, h.xMin, r.yMax)); // West
        if (h.xMax < r.xMax) outRects.Add(RectFromMinMax(h.xMax, r.yMin, r.xMax, r.yMax)); // East

        // North / South caps within the overlap span
        int mx0 = Mathf.Max(r.xMin, h.xMin), mx1 = Mathf.Min(r.xMax, h.xMax);
        if (h.yMin > r.yMin && mx1 > mx0) outRects.Add(RectFromMinMax(mx0, r.yMin, mx1, h.yMin)); // South
        if (h.yMax < r.yMax && mx1 > mx0) outRects.Add(RectFromMinMax(mx0, h.yMax, mx1, r.yMax)); // North
    }

    private void CarveAndEmitFloor(
        Vector2 roomBL,
        Vector2 roomTR,
        IEnumerable<RectInt> holes,
        Transform parent,
        int yKey)
    {
        var remain = new List<RectInt>
        {
            RectFromMinMax(
                Mathf.FloorToInt(roomBL.x), Mathf.FloorToInt(roomBL.y),
                Mathf.CeilToInt(roomTR.x),  Mathf.CeilToInt(roomTR.y))
        };

        foreach (var h in holes)
        {
            var next = new List<RectInt>();
            foreach (var r in remain) SplitRectByHole(r, h, next);
            remain = next;
            if (remain.Count == 0) break;
        }

        const float eps = 0.0005f;

        foreach (var r in remain)
        {
            if (r.width <= 0 || r.height <= 0) continue;

            var bl = new Vector2(r.xMin + eps, r.yMin + eps);
            var tr = new Vector2(r.xMax - eps, r.yMax - eps);
            if (tr.x > bl.x && tr.y > bl.y)
                EmitSlabWithEdges(floorMat, bl, tr, parent, yKey);
        }
    }

    private void AddEdge(Vector3Int key, bool horizontal)
    {
        var walls = horizontal ? ctx.WallH : ctx.WallV;
        var doors = horizontal ? ctx.DoorH : ctx.DoorV;

        // toggle-to-door policy
        if (walls.Contains(key))
        {
            walls.Remove(key);
            if (!doors.Contains(key)) doors.Add(key);
        }
        else if (!doors.Contains(key))
        {
            walls.Add(key);
        }
    }

    private void EmitSlabWithEdges(Material mat, Vector2 bl, Vector2 tr, Transform parent, int yKey)
    {
        int x0 = Mathf.FloorToInt(bl.x), x1 = Mathf.CeilToInt(tr.x);
        int z0 = Mathf.FloorToInt(bl.y), z1 = Mathf.CeilToInt(tr.y);

        for (int x = x0; x < x1; x++)
        {
            AddEdge(new Vector3Int(x, yKey, z0), true);
            AddEdge(new Vector3Int(x, yKey, z1), true);
        }

        for (int z = z0; z < z1; z++)
        {
            AddEdge(new Vector3Int(x0, yKey, z), false);
            AddEdge(new Vector3Int(x1, yKey, z), false);
        }

        // Emit via delegate (no yKey needed for mesh)
        createFloorMesh?.Invoke(bl, tr, parent);
    }

    // -------------------------------------------------------------------------
    // Static utilities (used by FloorGeneratorExtras and other legacy callers)
    // These DO NOT do edge bookkeeping; they only emit meshes.
    // -------------------------------------------------------------------------

    // 5-arg shim kept for backward compatibility; forwards to 4-arg
    public static void CreateFloorMesh(Material mat, Vector2 bl, Vector2 tr, Transform parent, int yKey)
        => CreateFloorMesh(mat, bl, tr, parent);

    // 4-arg mesh emitter expected by FloorGeneratorExtras
    public static void CreateFloorMesh(Material mat, Vector2 bl, Vector2 tr, Transform parent)
    {
        float y = 0f;

        Vector3 tl  = new(bl.x, y, tr.y);
        Vector3 trv = new(tr.x, y, tr.y);
        Vector3 blv = new(bl.x, y, bl.y);
        Vector3 brv = new(tr.x, y, bl.y);

        var verts = new[] { tl, trv, blv, brv };
        var uvs = new[]
        {
            new Vector2(bl.x, tr.y),
            new Vector2(tr.x, tr.y),
            new Vector2(bl.x, bl.y),
            new Vector2(tr.x, bl.y)
        };
        var tris = new[] { 0, 2, 1, 1, 2, 3 };

        var mesh = new Mesh { vertices = verts, uv = uvs, triangles = tris };
        mesh.RecalculateNormals();

        var go = new GameObject("FloorPiece", typeof(MeshFilter), typeof(MeshRenderer), typeof(MeshCollider));
        go.transform.SetParent(parent, false);

        go.GetComponent<MeshFilter>().sharedMesh = mesh;

        var mr = go.GetComponent<MeshRenderer>();
        mr.sharedMaterial = mat;
        mr.shadowCastingMode = UnityEngine.Rendering.ShadowCastingMode.Off;

        go.GetComponent<MeshCollider>().sharedMesh = mesh;
    }

    // 5-arg carver expected by FloorGeneratorExtras
    public static void CarveRoomFloorAndEmit(Material mat, Vector2 bl, Vector2 tr, IEnumerable<RectInt> holes, Transform parent)
    {
        var remain = new List<RectInt>
        {
            RectFromMinMax(
                Mathf.FloorToInt(bl.x), Mathf.FloorToInt(bl.y),
                Mathf.CeilToInt(tr.x),  Mathf.CeilToInt(tr.y))
        };

        foreach (var h in holes)
        {
            var next = new List<RectInt>();
            foreach (var r in remain) SplitRectByHole(r, h, next);
            remain = next;
            if (remain.Count == 0) break;
        }

        const float eps = 0.0005f;

        foreach (var r in remain)
        {
            if (r.width <= 0 || r.height <= 0) continue;

            var pbl = new Vector2(r.xMin + eps, r.yMin + eps);
            var ptr = new Vector2(r.xMax - eps, r.yMax + -eps);
            if (ptr.x > pbl.x && ptr.y > pbl.y)
                CreateFloorMesh(mat, pbl, ptr, parent);
        }
    }

    // Optional: single-slab with bands around holes (kept as a utility)
    public static void CreateFloorWithHoles(
        Material mat,
        Vector2 bl,
        Vector2 tr,
        Transform floorRoot,
        IEnumerable<RectInt> holes,
        bool addCollider = false)
    {
        EmitQuad(
            floorRoot, "Floor_Outer",
            new Vector3(bl.x, 0, bl.y),
            new Vector3(tr.x, 0, bl.y),
            new Vector3(bl.x, 0, tr.y),
            new Vector3(tr.x, 0, tr.y),
            mat,
            addCollider: addCollider);

        foreach (var h in holes)
        {
            float x0 = h.xMin, x1 = h.xMax;
            float z0 = h.yMin, z1 = h.yMax;

            if (x0 > bl.x)
                EmitQuad(
                    floorRoot, "FloorBand_W",
                    new Vector3(bl.x, 0, z0), new Vector3(x0, 0, z0),
                    new Vector3(bl.x, 0, z1), new Vector3(x0, 0, z1),
                    mat, false);

            if (x1 < tr.x)
                EmitQuad(
                    floorRoot, "FloorBand_E",
                    new Vector3(x1, 0, z0), new Vector3(tr.x, 0, z0),
                    new Vector3(x1, 0, z1), new Vector3(tr.x, 0, z1),
                    mat, false);

            if (z0 > bl.y)
                EmitQuad(
                    floorRoot, "FloorBand_S",
                    new Vector3(x0, 0, bl.y), new Vector3(x1, 0, bl.y),
                    new Vector3(x0, 0, z0), new Vector3(x1, 0, z0),
                    mat, false);

            if (z1 < tr.y)
                EmitQuad(
                    floorRoot, "FloorBand_N",
                    new Vector3(x0, 0, z1), new Vector3(x1, 0, z1),
                    new Vector3(x0, 0, tr.y), new Vector3(x1, 0, tr.y),
                    mat, false);
        }
    }

    private static void EmitQuad(
        Transform parent,
        string name,
        Vector3 bl,
        Vector3 br,
        Vector3 tl,
        Vector3 tr,
        Material mat,
        bool addCollider)
    {
        var verts = new[] { tl, tr, bl, br };
        var tris = new[] { 0, 1, 2, 2, 1, 3 };

        var mesh = new Mesh { vertices = verts, triangles = tris };
        mesh.RecalculateNormals();

        var go = new GameObject(name, typeof(MeshFilter), typeof(MeshRenderer));
        go.transform.SetParent(parent, false);
        go.GetComponent<MeshFilter>().sharedMesh = mesh;
        go.GetComponent<MeshRenderer>().sharedMaterial = mat;

        if (addCollider)
        {
            var col = go.AddComponent<MeshCollider>();
            col.sharedMesh = mesh;
        }
    }
}
