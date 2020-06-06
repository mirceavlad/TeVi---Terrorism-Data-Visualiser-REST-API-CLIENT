<?php
    //octavian+mircea
    include 'DBAcess.php';
    if(isset($_GET["flag"]))
    $flag=$_GET["flag"];
    else $flag=1;
    if(isset($_GET["country"]))
    {$country  = $_GET["country"];
    }
    else $country="Any";
    if(isset($_GET["year"]))
    {$year  = $_GET["year"];
    }
    else $year="Any";
    if(isset($_GET["weapon"]))
    {$weapon  = $_GET["weapon"];
    }
    else $weapon="Any";
    if(isset($_GET["pages"]))
    {$nr  = $_GET["pages"];
    }
    else $nr=1;
    if(!isset($_GET["csv"])) {
        switch ($flag) {
            case 1:
                $rez=DBAcess::getInstance()::selectByCoordJson($country, $year, $weapon);
                echo $rez;
                break;
            case 2:
                $rez=DBAcess::getInstance()::selectBetweenJson($nr*3500-3500,$country,$year,$weapon);
                echo $rez;
                break;
            case 3:
                $rez=DBAcess::getInstance()::selectAllAsJson();
                echo $rez;
                break;
            case 4:
                $rez=DBAcess::getInstance()::totalNrJson($country,$year,$weapon);
                echo $rez;
                break;
            default:
                $rez=DBAcess::getInstance()::selectByCoordJson($country, $year, $weapon);
                echo $rez;
        }
    } else {
        $rez = null;
        switch ($flag) {
            case 1:
                $rez=DBAcess::getInstance()::selectByCoord($country, $year, $weapon);
                break;
            case 2:
                $rez=DBAcess::getInstance()::selectBetween($nr*3500-3500,$country,$year,$weapon);
                break;
            case 3:
                $rez=DBAcess::getInstance()::selectAll();
                break;
            case 4:
                $rez=DBAcess::getInstance()::totalNr($country,$year,$weapon);
                break;
            default:
                $rez=DBAcess::getInstance()::selectByCoord($country, $year, $weapon);
        }
        $filename = uniqid().".csv";
        $filePointer = fopen($filename, "w+");
        $writeHeaders = 1;
        while($attack = $rez -> fetch_assoc()) {
            if($writeHeaders == 1) {
                fputcsv($filePointer, array_keys($attack));
                $writeHeaders = 0;
            }
            fputcsv($filePointer, $attack);
        }
        
        fclose($filePointer);
        if (file_exists($filename)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($filename).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filename));
            readfile($filename);
        }
        unlink($filename);
    }
    ?>
