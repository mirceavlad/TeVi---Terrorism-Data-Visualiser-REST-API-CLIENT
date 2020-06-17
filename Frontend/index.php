<!doctype html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>T E V I</title>
      <!--Font awesome CDN-->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
      <!--Scroll reveal CDN-->
      <script src="https://unpkg.com/scrollreveal"></script>
      <link rel="stylesheet" href="styles.css">
   </head>
   <body>
      <header>
         <div class="container">
            <nav class="nav">
               <div class="menu-toggle">
                  <i class="fas fa-bars"></i>
                  <i class="fas fa-times"></i>
               </div>
               <a href="index.html" class="logo"><img src="./assets/logo.png" alt=""</a>
               <ul class="nav-list">
                  <li class="nav-item">
                     <a href="index.html" class="nav-link active">Home</a>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">List</a>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">Map</a>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">Statistics</a>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">Contact</a>
                  </li>
               </ul>
            </nav>
         </div>
      </header>
      <!--Header ends-->
      <section class="hero" id="hero">
         <div class="container">
            <h2 class="sub-headline">
               <span class="first-letter">W</span>elcome
            </h2>
            <h1 class="headline">The TeVi</h1>
            <div class="headline-description">
               <div class="separator">
                  <div class="line line-left"></div>
                  <div class="asterisk"><i class="fas fa-asterisk"></i></div>
                  <div class="line line-right"></div>
               </div>
               <div class="single-animation">
                  <h5>Global Terrorism Visualizer</h5>
                  <a href="#" class="btn cta-btn">Explore</a>
               </div>
            </div>
         </div>
      </section>
      <!--Hero ends-->
      <section class="section_2">
         <div class="container">
            <div class="statistics-headline">
            </div>
         </div>
      </section>
      <section class="section_3">
         <div class="container">
            <div class="statistics-headline">
            </div>
         </div>
      </section>
      <section class="section_4">
         <div class="container">
         <div class="statistics-headline">
         </div>
      </section>
      <section class="section_5">
         <div class="container">
            <div id="map">
            </div>
            <script>
               function initMap() {
                var mapInitPos = { lat: 25.344, lng: 131.036 };
                 map = new google.maps.Map(document.getElementById("map"), {
                   center: { lat: -34.397, lng: 150.644 },
                   zoom: 8
                 });
               
                       var map = new google.maps.Map(
                       document.getElementById('map'), { zoom: 4, center: mapInitPos });
                     }
                   
            </script>
            <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDtKxEnjmFmud3qf7EQAxdvUyDGrbxhXeo&callback=initMap"></script>
         </div>
      </section>
      <script src="main.js"></script>
      
   </body>
</html>