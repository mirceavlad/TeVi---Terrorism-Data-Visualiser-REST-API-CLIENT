<!DOCTYPE HTML>
<html lang="en">

<head>
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
<form action="../controllers/resetController.php">
<input type="submit" value="RESET"/> 
</form>
</body>

   
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
>>>>>>> parent of 2fd3679... Used twig to make MVC and made map
</html>