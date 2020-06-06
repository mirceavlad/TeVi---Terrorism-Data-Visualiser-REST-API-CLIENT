<!DOCTYPE html>
<html>  
   <head>
   </head>
   <body>
      <div id="barGraph" style="width: 100%; height:100%;">
      </div>
      
      
      <script>
      //maria 
         function draw() {
         /* Accepting and seperating comma seperated values */
         
         <?php
         
            $year = "Any";
            $weapon = "Any";

            $country = array();
            $value = array();
            $jsonString = file_get_contents("http://localhost/WebTechnologiesProj/attacksDataServiceProvider.php/?flag=3");
            //deserialization to array
            $resultsArray = json_decode($jsonString, true);
            //getting the array size
            $responseSize = $resultsArray["dataSz"];
            

           
            for($i = 0; $i < $responseSize ; $i ++) {
            $country[$i] = $resultsArray[$i]["country_txt"];
            }
            

            //remove duplicates
            $country = array_unique($country);
            //sort alphabetically
            sort($country);
            //put the option in the select
            
            
            for($i = 0; $i < sizeof($country) ; $i ++) {
             
                $curCountry = str_replace(' ', '%20', $country[$i]);
                $jsonStringAttacksNo = 
                file_get_contents("http://localhost/WebTechnologiesProj/attacksDataServiceProvider.php/?flag=4&country=$curCountry&year=$year&weapon=$weapon");
                $resultsArrayAttacksNo = json_decode($jsonStringAttacksNo, true);
                $nr = $resultsArrayAttacksNo[0]["NR"];
                $value[$i] = $nr;
             
               
            }
            
            
         echo "
        
         var canvas = document.getElementById('myCanvas');
         var ctx = canvas.getContext('2d');
         
         var width = 40; //bar width
         var X = 50; // first bar position 
         var base = 200;
         ";
         for ($i = 0; $i < sizeof($country); $i ++) {
             echo "ctx.fillStyle = '#008080'; 
             var h = ".$value[$i].";
             ctx.fillRect(X, canvas.height - h, width, h);
              
             X +=  width+15;

             ctx.fillStyle = '#4da6ff';

             var currentCountry = \"".$country[$i]."\";
             ctx.fillText(currentCountry, X - 50 , canvas.height - h - 10);";
             
         }

            
             echo "ctx.fillStyle = '#000000';
             ctx.fillText('Scale X : '
         +canvas.width+' Y : '+canvas.height,7800,10500);";
         ?>
         }

         function drawWeaponStats() {
         /* Accepting and seperating comma seperated values */
         
         <?php
         
            $year = "Any";
            $country = "Any";

            $weapon= array();
            $value = array();
            $jsonString = file_get_contents("http://localhost/WebTechnologiesProj/attacksDataServiceProvider.php/?flag=3");
            //deserialization to array
            $resultsArray = json_decode($jsonString, true);
            //getting the array size
            $responseSize = $resultsArray["dataSz"];
            

           
            for($i = 0; $i < $responseSize ; $i ++) {
            $weapon[$i] = $resultsArray[$i]["weaptype1_txt"];
            }
            

            //remove duplicates
            $weapon = array_unique($weapon);
            //sort alphabetically
            sort($weapon);
            //put the option in the select
            
            
            for($i = 0; $i < sizeof($weapon) ; $i ++) {
             
                $curweapon = str_replace(' ', '%20', $weapon[$i]);
                $jsonStringAttacksNo = 
                file_get_contents("http://localhost/WebTechnologiesProj/attacksDataServiceProvider.php/?flag=4&country=$country&year=$year&weapon=$curweapon");
                $resultsArrayAttacksNo = json_decode($jsonStringAttacksNo, true);
                $nr = $resultsArrayAttacksNo[0]["NR"];
                $value[$i] = $nr;
             
               
            }
            
            
         echo "
        
         var canvas = document.getElementById('myCanvas');
         var ctx = canvas.getContext('2d');
         
         var width = 40; //bar width
         var X = 50; // first bar position 
         var base = 200;
         ";
         for ($i = 0; $i < sizeof($weapon); $i ++) {
             echo "ctx.fillStyle = '#008080'; 
             var h = ".$value[$i].";
             ctx.fillRect(X, canvas.height - h, width, h);
              
             X +=  width+15;

             ctx.fillStyle = '#4da6ff';

             var currentweapon = \"".$weapon[$i]."\";
             ctx.fillText(currentweapon, X - 50 , canvas.height - h - 10);";
             
         }

            
             echo "ctx.fillStyle = '#000000';
             ctx.fillText('Scale X : '
         +canvas.width+' Y : '+canvas.height,7800,10500);";
         ?>
         }

         function drawYearStats() {
         /* Accepting and seperating comma seperated values */
         
         <?php
         
            $weapon = "Any";
            $country = "Any";

            $year = array();
            $value = array();
            $jsonString = file_get_contents("http://localhost/WebTechnologiesProj/attacksDataServiceProvider.php/?flag=3");
            //deserialization to array
            $resultsArray = json_decode($jsonString, true);
            //getting the array size
            $responseSize = $resultsArray["dataSz"];
            

           
            for($i = 0; $i < $responseSize ; $i ++) {
            $year[$i] = $resultsArray[$i]["iyear"];
            }
            

            //remove duplicates
            $year = array_unique($year);
            //sort alphabetically
            sort($year);
            //put the option in the select
            
            
            for($i = 0; $i < sizeof($year) ; $i ++) {
             
                $curyear = str_replace(' ', '%20', $year[$i]);
                $jsonStringAttacksNo = 
                file_get_contents("http://localhost/WebTechnologiesProj/attacksDataServiceProvider.php/?flag=4&country=$country&year=$curyear&weapon=$weapon");
                $resultsArrayAttacksNo = json_decode($jsonStringAttacksNo, true);
                $nr = $resultsArrayAttacksNo[0]["NR"];
                $value[$i] = $nr;
             
               
            }
            
            
         echo "
        
         var canvas = document.getElementById('myCanvas');
         var ctx = canvas.getContext('2d');
         
         var width = 40; //bar width
         var X = 50; // first bar position 
         var base = 200;
         ";
         for ($i = 0; $i < sizeof($year); $i ++) {
             echo "ctx.fillStyle = '#008080'; 
             var h = ".$value[$i].";
             ctx.fillRect(X, canvas.height - h, width, h);
              
             X +=  width+15;

             ctx.fillStyle = '#4da6ff';

             var currentyear = \"".$year[$i]."\";
             ctx.fillText(currentyear, X - 50 , canvas.height - h - 10);";
             
         }

            
             echo "ctx.fillStyle = '#000000';
             ctx.fillText('Scale X : '
         +canvas.width+' Y : '+canvas.height,7800,10500);";
         ?>
         }
         function reset(){
          var canvas = document.getElementById('myCanvas');
          var ctx = canvas.getContext('2d');
         ctx.clearRect(0, 0, canvas.width, canvas.height);
    }
      
      </script>
     
    
    <input type="button" value="Country Stats" name="submit" onclick="draw()">
    <input type="button" value="Weapon Stats" name="submit" onclick="drawWeaponStats()">
    <input type="button" value="Year Stats" name="submit" onclick="drawYearStats()">
    <input type="button" value="Clear" name="Clear" onclick="reset()">
      <canvas id="myCanvas" width="7800" height="10500"
 style=" border:1px="" solid="" #c3c3c3;"="">
    </canvas>
</html>