
<?php
    $row = 1;
    if (($handle = fopen("terror.csv", "r")) !== FALSE) {
      while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $row++;
          echo "year: " .$data[1]. "   location: " .$data[7]. "\n";
      }
      fclose($handle);
    }
?>
