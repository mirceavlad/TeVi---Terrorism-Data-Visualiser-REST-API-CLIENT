<?php
class downloadCSV{
    public function download($filtersArray){
        $withFilterMap=FilterConfigurator::mapFilters($filtersArray);
             if(empty($withFilterMap)) {
                $outputName="terrorData.csv";
                header('Content-Disposition: attachment; filename="terrorData.csv"');
                header("Content-Type: text/csv");
                 readfile("http://localhost/attacks/all/csv");
             } else {
                 $filtersJson = json_encode($withFilterMap);
                 $post_options = array(
                     'http' => array(
                         'method' => 'POST',
                         'content' => $filtersJson,
                         'header'=>  "Content-Type: application/json\r\n"
                     )
                     );
                 $context  = stream_context_create( $post_options );
                 $outputName="terrorData.csv";
    header('Content-Disposition: attachment; filename="terrorData.csv"');
    header("Content-Type: text/csv");
                 readfile("http://localhost/attacks/filtered/csv", false, $context );
             }
        }
}

?>
