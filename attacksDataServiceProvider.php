<?php
    include 'DBAcess.php';
    if(isset($_GET["initialPath"])) {
        if($_GET["initialPath"] == "attacks") {
            $filter_options_json = file_get_contents('php://input');
            $filters_map = json_decode($filter_options_json, true);
            if($_GET["option"] == "all") {
                if(!isset($_GET["csv"])) {
                    if(isset($_GET["pag"])) {
                        $res = DBAcess::getInstance()::selectAllAsJson($_GET["pag"]);
                        echo $res;
                    } else {
                        $res = DBAcess::getInstance()::selectAllAsJson();
                        echo $res;
                    }
                } else {
                    if(isset($_GET["pag"])) {
                        $res = DBAcess::getInstance()::selectAll($_GET["pag"]);
                        DBAcess::getInstance()::generateAndSendCsv($res);
                    } else {
                        $res = DBAcess::getInstance()::selectAll();
                        DBAcess::getInstance()::generateAndSendCsv($res);
                    }
                }
            } else if($_GET["option"] == "filtered") {
                if($filters_map == null) {
                    echo "status 400 bad request";
                } else if(!isset($_GET["csv"])) {
                    if(isset($_GET["pag"])) {
                        echo DBAcess::getInstance()::getAttacksByFiltersAsJson($filters_map, $_GET["pag"]);
                    } else {
                        echo DBAcess::getInstance()::getAttacksByFiltersAsJson($filters_map);
                    }
                } else {
                    if(isset($_GET["pag"])) {
                         $res = DBAcess::getInstance()::getAttacksByFilters($filters_map, $_GET["pag"]);
                         DBAcess::getInstance()::generateAndSendCsv($res);
                    } else {
                        $res = DBAcess::getInstance()::getAttacksByFilters($filters_map);
                        DBAcess::getInstance()::generateAndSendCsv($res);
                    }
                }
            } else if($_GET["option"] == "availablefilters") {
                if(isset($_GET["all"])) {
                    $res = DBAcess::getInstance()::getAllAvailableFilters();
                    echo $res;
                } else {
                    if($filters_map == null) {
                        echo "status 400 bad request";
                    } else {
                        echo DBAcess::getInstance()::getAvailableFilterValuesAsJson($filters_map);
                    }
                }
            }
        }   
    } else if($_GET["verb"] == "PUT"){
            $filter_options_json = file_get_contents('php://input');
            $filters_map =  json_decode($filter_options_json, true);
            if($filters_map == null) {
                echo "status 400: bad request";
                return;
            }
            if(!isset($filters_map["admin_token"]) || $filters_map["admin_token"] != "some_key") {
                echo "status 401: Bad access token";
                return;
            }

            if(!isset($filters_map["for_attacks_matching"])) {
                echo "status 400: bad request -> no filters indicating which attacks to update";
            } else {
                DBAcess::getInstance()::updateAttacks($filters_map);
            }

    } else if($_GET["verb"] == "POST") {
        $valuesToAdd = file_get_contents('php://input');
        $valuesToInsert = json_decode($valuesToAdd, true);
        if($valuesToInsert == null) {
            echo"{\"status\": 400, \"description\": \"Bad request\"}";
            return;
        } else if(!isset($valuesToInsert["eventid"])) {
            echo"{\"status\": 400, \"description\": \"Bad request, no eventid specified in json body\"}";
            return;
        } else if(!isset($valuesToInsert["admin_token"])) {
            echo"{\"status\": 400, \"description\": \"Bad request, no admin_token provided\"}";
            return;
        } else if($valuesToInsert["admin_token"] != "some_key") {
            echo"{\"status\": 400, \"description\": \"Bad request, admin_token not valid\"}";
            return;
        } else {
            unset($valuesToInsert["admin_token"]);
            DBAcess::getInstance()::addAttack($valuesToInsert,true);
        } 
    } else if($_GET["verb"] == "DELETE") {
        $filter_options_json = file_get_contents('php://input');
        $filters_map =  json_decode($filter_options_json, true);
        if($filters_map == null) {
            echo "status 400: bad request";
            return;
        }
        if(!isset($filters_map["admin_token"]) || $filters_map["admin_token"] != "some_key") {
            echo "status 401: Bad access token";
            return;
        }

        if(!isset($filters_map["for_attacks_matching"])) {
            echo "status 400: bad request -> no filters indicating which attacks to delete";
        } else {
            DBAcess::getInstance()::deleteAttacks($filters_map);
        }
    }
    //    $key = "some_key";
    //    if(isset($_GET["flag"]))
    //    $flag=$_GET["flag"];
    //    else $flag=1;
    //    if(isset($_GET["country"]))
    //    {$country  = $_GET["country"];
    //    }
    //    else $country="Any";
    //    if(isset($_GET["year"]))
    //    {$year  = $_GET["year"];
    //    }
    //    else $year="Any";
    //    if(isset($_GET["weapon"]))
    //    {$weapon  = $_GET["weapon"];
    //    }
    //    else $weapon="Any";
    //    if(isset($_GET["pages"]))
    //    {$nr  = $_GET["pages"];
    //    }
    //    else $nr=1;
    //    if(!isset($_GET["csv"]) && !isset($_POST["key"])) {
    //        switch ($flag) {
    //            case 1:
    //                $rez=DBAcess::getInstance()::selectByCoordJson($country, $year, $weapon);
    //                echo $rez;
    //                break;
    //            case 2:
    //                $rez=DBAcess::getInstance()::selectBetweenJson($nr*3500-3500,$country,$year,$weapon);
    //                echo $rez;
    //                break;
    //            case 3:
    //                $rez=DBAcess::getInstance()::selectAllAsJson();
    //                echo $rez;
    //                break;
    //            case 4:
    //                $rez=DBAcess::getInstance()::totalNrJson($country,$year,$weapon);
    //                echo $rez;
    //                break;
    //            default:
    //                $rez=DBAcess::getInstance()::selectByCoordJson($country, $year, $weapon);
    //                echo $rez;
    //        }
    //    } else if(!isset($_POST["key"]) && isset($_GET["csv"])) {
    //        $rez = null;
    //        switch ($flag) {
    //            case 1:
    //                $rez=DBAcess::getInstance()::selectByCoord($country, $year, $weapon);
    //                break;
    //            case 2:
    //                $rez=DBAcess::getInstance()::selectBetween($nr*3500-3500,$country,$year,$weapon);
    //                break;
    //            case 3:
    //                $rez=DBAcess::getInstance()::selectAll();
    //                break;
    //            case 4:
    //                $rez=DBAcess::getInstance()::totalNr($country,$year,$weapon);
    //                break;
    //            default:
    //                $rez=DBAcess::getInstance()::selectByCoord($country, $year, $weapon);
    //        }
    //        $filename = uniqid().".csv";
    //        $filePointer = fopen($filename, "w+");
    //        $writeHeaders = 1;
    //        while($attack = $rez -> fetch_assoc()) {
    //            if($writeHeaders == 1) {
    //                fputcsv($filePointer, array_keys($attack));
    //                $writeHeaders = 0;
    //            }
    //            fputcsv($filePointer, $attack);
    //        }
    //
    //        fclose($filePointer);
    //        if (file_exists($filename)) {
    //            header('Content-Description: File Transfer');
    //            header('Content-Type: application/octet-stream');
    //            header('Content-Disposition: attachment; filename="'.basename($filename).'"');
    //            header('Expires: 0');
    //            header('Cache-Control: must-revalidate');
    //            header('Pragma: public');
    //            header('Content-Length: ' . filesize($filename));
    //            readfile($filename);
    //        }
    //        unlink($filename);
    //    } else if(isset($_POST["key"])) {
    //        if($_POST["key"] == $key) {
    //            $valuesToInsert = $_POST;
    //            unset($valuesToInsert["key"]);
    //            DBAcess::getInstance()::addAttack($valuesToInsert);
    //        } else {
    //            echo "status 400 bad request";
    //        }
    //    }
    ?>
