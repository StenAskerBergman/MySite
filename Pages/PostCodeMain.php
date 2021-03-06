<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Hire Me</title>
      <?php // All Links  ?>
        <?php // IDEA: no clue what this link is for https://uploads-ssl.webflow.com/5a0265c028f39d0001493977/js/webflow.6d29d4b2f.js ?>

         <?php // Fonts ?>
              <!-- Roboto Font-->
              <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

        <?php // Linked Stylesheets  ?>

          <?php //Online Style  ?>
            <!-- SideNote: LessCss.org  -->
            <link rel="stylesheet/less" type="text/css" href="master.less" />
            <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.11.1/less.min.js" ></script>

            <!-- Latest compiled Bootsrap and minified CSS -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
          <?php //Local Style  <link rel="stylesheet" href="home/Alpha/css/master.css">?>
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
          ::selection {  /* WebKit/Blink Browsers */
            /*red
           color: #FF0000;
           background: #ffb7b7;
           */
           /*blue*/
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
         </style>

   </head>
   <body>
      <div class=".container-fluid">
      <div class=".container-sm">
      <nav class="container p-3 my-3">
         <!-- nav bar -->
         <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
               <a style="background-color: red;"class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true" onclick="window.location.href='/home/'">< Back</a>
            </li>

            <!--
              <li>
                <button type="button" class="btn btn-sm btn-toggle active" data-toggle="button" aria-pressed="true" autocomplete="off">
                <div class="handle"></div>
                </button>
              </li>
            -->
         </ul>

         <div class="fixed-bottom" style="left:90%;bottom:5%;"><button onclick="topFunction()" id="myBtn" title="Go to top">Go Top</button></div>
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
            <div class="container p-3 my-3">
               <!-- Name and Title -->
               <h1>Sten Asker Bergman</h1>
               <!-- Main Title -->
               <h2>UX Designer by day / Developer by Night</h2>
               <!-- Sub Title -->
            </div>
            <div class="container p-3 my-3">
               <!-- text -->
               <p !-- Information 1 -->
               Lorem ipsum dolor sit amet, consectetur adipisicing elit,
               sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
               Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
               nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
               reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
               pariatur.
               </p>
               <p>
                  <!-- Information 2 -->
                  Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                  officia deserunt mollit anim id est laborum.
               </p>
            </div>

   </body>
</html>
