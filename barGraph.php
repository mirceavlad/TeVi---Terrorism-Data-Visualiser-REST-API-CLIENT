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
            

            //making an array with all the country names
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
         +canvas.width+' Y : '+canvas.height,7800,2600);";
         ?>
         }

     
      
      </script>
     
    
    <input type="button" value="submit" name="submit" onclick="draw()">
    <input type="button" value="Clear" name="Clear" onclick="reset()">
      <canvas id="myCanvas" width="7800" height="2600"
 style=" border:1px="" solid="" #c3c3c3;"="">
    </canvas>
</html>