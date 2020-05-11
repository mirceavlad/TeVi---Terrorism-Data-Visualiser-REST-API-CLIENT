
<?php
//octavian
    include 'DBAcess.php';
    $index = 0;
    $headers = array();
    $values = array();
    $headersCount = 0;
    //opening the csv
    if (($handle = fopen("terror.csv", "r")) !== FALSE) {
    //reading line by line from the csv
      while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
          //echo "START";
           $headersCount = 0;
          //iterating through current line columns
          foreach($data as $value) {
              //if index == 0. generate table columns names
            //  echo $headersCount." \n";
              if ($index == 0) {
                  $headers[$headersCount] = $value;
              } else if($headersCount <= 134) {
                  //generate data to be added to the database
                  $indexInHead = $headers[$headersCount];
                  $values[$indexInHead] = $value;
              }
              $headersCount = $headersCount + 1;
          }
          if($index == 0) {
              //create table
              DBAcess::getInstance()::createTerrorTable($headers);
          }
          if(!($index == 0)) {
              // add a row
              DBAcess::getInstance()::addAttack($values);
              $values = array();
          }
          $index += 1;
      }
        fclose($handle);
    }
?>
