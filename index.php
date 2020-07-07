<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Hire Me</title>
      <?php // All Links  ?>
        <?php // IDEA: no clue what this link is for https://uploads-ssl.webflow.com/5a0265c028f39d0001493977/js/webflow.6d29d4b2f.js ?>


        <?php // Linked Stylesheets  ?>

          <?php //Local Style  ?>
          <link rel="stylesheet" href="master.css">

          <?php //Online Style  ?>
            <!-- SideNote: LessCss.org  -->
            <link rel="stylesheet/less" type="text/css" href="master.less" />
            <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.11.1/less.min.js" ></script>

            <!-- Latest compiled Bootsrap and minified CSS -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

            <?php // Fonts ?>
                  <!-- Roboto Font-->
                  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">


          <?php // ERROR: The Css File Won't load correctly unless inside document... why? no clue... ?>
        <?php // Javascripts  ?>
          <!-- Ajax jQuery library -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

          <!-- Popper JS -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>


          <!-- Latest compiled Bootstrap & JavaScript -->
          <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

       <?php // Style  ?>
          <style>
          /*
          How CSS code gets Read
          - First Thing Override Everything
          - Second Thing Ignored but accounted
          */
          *{
          font-family: 'Roboto', sans-serif;
          }
          span {
          display: inline-block;
          width: auto;
          height: auto;
          margin: 6px;
          background-color: #fff;
          }
          body{
          background-color: #fff;
          color: #202124;
          }
          .container{
          background-color: #fff;
          }
          .nav-link.active{
          background-color: #E8F0FE;
          color:#7081E8;
          }
          .nav-link:hover {
          background-color: #E8F0FE;
          color:#7081E8;
          }
          .nav-link {
          color:#70757a;
          }
          ::selection {
            /* WebKit/Blink Browsers */
            /* red */
            /*
           color: #FF0000;
           background: #ffb7b7;
           */
           /* blue */
          color: #7081E8;
          background: #E8F0FE;

          }
          ::-moz-selection {
           background: #ffb7b7; /* Gecko Browsers */
          }

          :root {
           --shift-bg-color: #fff;
          }
          /* Shadow Animation */
           #boxy::after {
           content: "";
           border-radius: 5px; /*Corner Edges*/
           position: absolute;
           z-index: -1; /* Position */
           top: 0;
           left: 0;
           width: 100%;
           height: 100%;
           box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
           opacity: 0; /* No clue */
           -webkit-transition: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1); /* Shadow Growth Rate*/
           transition: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1); /* Shadow Decrease Rate*/
           }
           /* Growth Animation */
           #boxy:hover {
           -webkit-transform: scale(1.05, 1.05);
           transform: scale(1.05, 1.05);
           }

           #boxy:hover::after {
             opacity: 1;
           }
           #myBtn {
             display: none;
             position: fixed;
             bottom: 20px;
             right: 30px;
             z-index: 99;
             font-size: 18px;
             border: none;
             outline: none;
             background-color: red;
             color: white;
             cursor: pointer;
             padding: 15px;
             border-radius: 4px;
           }

           #myBtn:hover {
             background-color: #555;
           }
           .NTP{
             top-padding: 0px;
           }
           </style>

   </head>
   <body>
      <div class=".container-fluid">
      <div class=".container-sm">
      <nav class="container p-3 my-3">
         <!-- nav bar -->
         <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
               <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Home</a>
            </li>
            <li class="nav-item">
               <a class="nav-link disabled" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"></a>
            </li>
            <li class="nav-item">
               <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Contact</a>
            </li>
            <li class="nav-item">
               <a class="nav-link disabled" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"></a>
            </li>
            <li class="nav-item">
               <a class="nav-link" id="pills-gallery-tab" data-toggle="pill" href="#pills-gallery" role="tab" aria-controls="pills-gallery" aria-selected="false">Portfolio</a>
            </li>
         </ul>
         <?php // go to top function ?>
         <div class="fixed-bottom" style="left:90%;bottom:5%;"><button onclick="topFunction()" id="myBtn" title="Go to top">Top</button></div>
           <script>
                //Get the button
                var mybutton = document.getElementById("myBtn");

                // When the user scrolls down 20px from the top of the document, show the button
                window.onscroll = function() {scrollFunction()};

                function scrollFunction() {
                  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                    mybutton.style.display = "block";
                  } else {
                    mybutton.style.display = "none";
                  }
                }

                // When the user clicks on the button, scroll to the top of the document
                function topFunction() {
                  document.body.scrollTop = 0;
                  document.documentElement.scrollTop = 0;
                }
                </script>
      </nav>
      <div class="tab-content" id="pills-tabContent">
         <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="container p-3 my-3">
               <!-- Name and Title -->
               <h1>Sten Asker Bergman</h1>
               <!-- Main Title -->
               <h2>UXD by day / DEV by Night</h2>
               <!-- Sub Title -->

               <!-- text font-weight: 300 thinn , 500 normal, 700 thicc, 900 thiccc -->
               <p style="font-size: 30px; font-weight: 300;">
                  User Experience Designer and Ex-Programmer interested in coding prototypes and creating awesome products. I work from a lifelong love for design + tech, and a resolute desire to help others.
               </p>
            </div>
            <!-- Introduction --> <!-- Options --> <!-- First -->

      <?php // First Page - Post Content ?>
            <div class="container" style="background-color: var(--shift-bg-color);">
               <!-- content -->
               <div class="albums" id="NTP" style="background-color: var(--shift-bg-color);">
                  <div class="container">
                    <?php // Post Row 1 ?>
                    <div class="card" id="GameRed">
                      <div  id="boxy">
                        <div class="card mb-12 shadow-sm" style="cursor: pointer;" onclick="window.location.href='/home/Pages/A1.php'">
                          <img src="img\TN1.png" class="card-img-top" alt="test2" fill="#303030">

                          <div class="card-body" >
                            <h4 class="card-text">My Process!</h4>
                            <div class="d-flex justify-content-between align-items-center">
                              <div class="btn-group">
                                <button type="button" class="btn btn-md btn-outline-secondary" onclick="window.location.href='/home/Pages/A1.php'">View</button>
                              <!--  <button type="button" class="btn btn-sm btn-outline-secondary" >Edit</button>-->
                              </div>
                              <small class="text-muted">9 mins</small>
                            </div>
                          </div>
                        </div>

                      </div>
                    </div> <br>
                    <div class="row" style="background-color: var(--shift-bg-color);">

                      <div class="col-md-6" id="GameRed">
                        <div id="boxy">
                        <div class="card mb-4 shadow-sm" style="cursor: pointer;" onclick="window.location.href='/home/Pages/A2.php'">
                          <img src="img\TN2.png" class="card-img-top" alt="test2" fill="#303030" height="225">

                          <div class="card-body">
                            <p class="card-text">Prototyping, Testing & Ideration.</p>
                            <div class="d-flex justify-content-between align-items-center">
                              <div class="btn-group">
                                <button type="button" class="btn btn-md btn-outline-secondary" onclick="window.location.href='/home/Pages/A2.php'">View</button>
                              <!--  <button type="button" class="btn btn-sm btn-outline-secondary" >Edit</button>-->
                              </div>
                              <small class="text-muted">9 mins</small>
                            </div>
                          </div>
                        </div>
                      </div>
                      </div>
                    <div class="col-md-6">
                      <div id="boxy">
                        <div class="card mb-4 shadow-sm" id="Boxy" style="cursor: pointer;" onclick="window.location.href='/home/Pages/A3.php'">
                          <img src="img\TN3.png" class="card-img-top" alt="test2" fill="#303030" height="225">
                            <div class="card-body">
                              <p class="card-text">Research, Exploration and Mapping.</p>
                                <div class="d-flex justify-content-between align-items-center">
                                  <div class="btn-group">
                                    <button type="button" class="btn btn-md btn-outline-secondary" onclick="window.location.href='/home/Pages/A3.php'">View</button>
                                  </div>
                                <small class="text-muted">9 mins</small>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>

                      <div class="col-md-4">
                          <div id="boxy">
                            <div class="card mb-4 shadow-sm" style="cursor: pointer;" onclick="window.location.href='/home/Pages/A4.php'">
                              <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail">
                                <title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect>
                                <text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
                                <div class="card-body">
                                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                  <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                      <button type="button" class="btn btn-md btn-outline-secondary" onclick="window.location.href='/home/Pages/A4.php'">View</button>
                                      <!--  <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>-->
                                    </div>
                                    <small class="text-muted">9 mins</small>
                                  </div>
                                </div>
                              </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
         </div>
      <?php // Second page - Contact ?>
         <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="container p-3 my-3">
               <!-- content -->
               <div class="row">
                  <div class="col">
                    <div style="padding-top:1em;">
                      <h3>Hi, I don't think we have met!</h1><h4> <br>
                      Do you have time for a virtual coffee? ☕<br><br>
                      I would love to get to know you better! 😊<br><br>
                    </h4>
                  </div>
                  </div>
                  <div class="col">
                  <h2>Here Are My Socials!</h2>
                  <ul style="list-style-type: none;">
                    <style media="screen">
                      li{
                        padding: 0.5em;
                      }
                    </style>
                    <li><a href="https://www.linkedin.com/in/stenaskerbergman/"><button type="button" class="btn btn-sm btn-outline-secondary">Linkedin</button></a></li>
                    <li><a href="https://dribbble.com/"><button type="button" class="btn btn-sm btn-outline-secondary">Dribbble</button></a></li>
                    <li><a href="https://www.facebook.com/profile.php?id=100012699664738&sk=archive"><button type="button" class="btn btn-sm btn-outline-secondary">Facebook</button></a></li>
                    <li><a href="stenaskerbergman@gmail.com"><button type="button" class="btn btn-sm btn-outline-secondary">Linkedin</button></a></li>
                  </ul>
                  </div>
               </div>
            </div>
         </div>
      <?php // Third page - Portfolio ?>
         <div class="tab-pane fade" id="pills-gallery" role="tabpanel" aria-labelledby="pills-gallery-tab">
           <div class="container p-3 my-3">
             <nav id="navbar-example2" class="navbar navbar-light bg-light"  style="background-color: #9b9b9b; border-radius: 15px 15px 15px 15px;">
               <a class="navbar-brand" href="#">Applications</a>
               <ul class="nav nav-pills">
                 <li class="nav-item">
                   <a class="nav-link" href="#fat">@fat</a>
                 </li>
                 <li class="nav-item">
                   <a class="nav-link" href="#mdo">@mdo</a>
                 </li>
                 <li class="nav-item dropdown">
                   <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                   <div class="dropdown-menu">
                     <a class="dropdown-item" href="#one">one</a>
                     <a class="dropdown-item" href="#two">two</a>
                     <div role="separator" class="dropdown-divider"></div>
                     <a class="dropdown-item" href="#three">three</a>
                   </div>
                 </li>
               </ul>
             </nav>
             <div data-spy="scroll" data-target="#navbar-example2" data-offset="0">
               <h4 id="fat"></h4>
               <div class="my-3 p-3">
                 <h2 class="display-5">Another headline</h2>
                 <p class="lead">And an even wittier subheading.</p>
               </div>
               <div class="bg-dark shadow-sm mx-auto" src="\img\CafeConcept.png" style="width: 100%; height: 300px; border-radius: 21px 21px 21px 21px; background:;" ></div>
               <h4 id="mdo"></h4>
               <div class="col-md-12">
                 <p>
                   Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
                   magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                   consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                   Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                 </p>
               </div>
               <div class="my-3 p-3">
                 <h2 class="display-5">Another headline</h2>
                 <p class="lead">And an even wittier subheading.</p>
               </div>
               <div class="bg-dark shadow-sm mx-auto" href="img\CafeConcept.png" style="width: 100%; height: 300px; border-radius: 21px 21px 21px 21px; background:;" ></div>
               <h4 id="one"></h4>
               <div class="my-3 p-3">
                 <h2 class="display-5">Another headline</h2>
                 <p class="lead">And an even wittier subheading.</p>
               </div>
               <div class="bg-dark shadow-sm mx-auto" href="img\CafeConcept.png" style="width: 100%; height: 300px; border-radius: 21px 21px 21px 21px; background:;" ></div>
               <h4 id="two"></h4>
               <div class="my-3 p-3">
                 <h2 class="display-5">Another headline</h2>
                 <p class="lead">And an even wittier subheading.</p>
               </div>
               <div class="bg-dark shadow-sm mx-auto" href="img\CafeConcept.png" style="width: 100%; height: 300px; border-radius: 21px 21px 21px 21px; background:;" ></div>
               <h4 id="three"></h4>

             </div>
                 <div class="my-3 p-3">
                   <h2 class="display-5">Another headline</h2>
                   <p class="lead">And an even wittier subheading.</p>
                 </div>
                   <br>
                 <div class="bg-dark shadow-sm mx-auto" style="width: 100%; height: 300px; border-radius: 21px 21px 21px 21px;"></div>
                 <div class="my-3 p-3">
                   <h2 class="display-5">Another headline</h2>
                   <p class="lead">And an even wittier subheading.</p>
                 </div>
           </div>
         </div>
      </div>
   </body>
</html>
