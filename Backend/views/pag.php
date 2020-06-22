<!DOCTYPE HTML>
<html lang="en">
   <head>
      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <link rel="stylesheet" href="../views/pag.css">
      <meta name="viewport" content="width=device-width,initial-scale=1">
      <title>
         Lista
      </title>
   </head>
   <body>
      <div id="param">
      <form method="post" id="filtere">
         <input name="Search" type="submit" value="Search"/>
      </form>
      <form method="post" id="charts">
        <input name="Chart" type="submit" value="Chart"/>
    </form>
      <form action="../controllers/resetController.php">
         <input type="submit" value="RESET"/> 
         <div class="map" id = "map">
      </form>
      </div>
   </body>
</html>