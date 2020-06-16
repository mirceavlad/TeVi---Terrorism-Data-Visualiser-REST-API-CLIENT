<!DOCTYPE HTML>
<html lang="en">
<head>
<link rel="stylesheet" href="../views/pag.css">
<title>
Lista
</title>
</head>
<body>
<form method="post" action="../controllers/cont.php">
<select id="filter" name="filter">
<option value="Country">Country</option>
<option value="Year">Year</option>
</select>
<input type="Submit" value="Submit"/>
</form>
<form id="filtere">
<input type="submit" value="Search"/>
</form>
<form action="../controllers/cont1.php">
<input type="submit" value="RESET"/> 
</form>
</body>
</html>