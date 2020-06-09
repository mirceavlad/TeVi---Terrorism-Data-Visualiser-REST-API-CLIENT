<?php
//mircea
//script takes select values and makes hidden inputs 
//in order for the values to be seen by the form action
if(isset($_POST["country"]))
{$country  = $_POST["country"];
}
else $country="Any";
if(isset($_POST["year"]))
{$year  = $_POST["year"];
}
else $year="Any";
if(isset($_POST["weapon"]))
{$weapon  = $_POST["weapon"];
}
else $weapon="Any"; 
$country= str_replace(' ', '%20', $country);
$weapon= str_replace(' ', '%20', $weapon);

echo "<input type='hidden' name='country' value=".$country.">";
echo "<input type='hidden' name='year' value=".$year.">";
echo "<input type='hidden' name='weapon' value=".$weapon.">";
?>