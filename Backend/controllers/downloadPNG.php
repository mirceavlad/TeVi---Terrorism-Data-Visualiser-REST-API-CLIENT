<?php
class downloadPNG{
    public function download($filtersArray){
        $withFilterMap=FilterConfigurator::mapFilters($filtersArray);
             if(empty($withFilterMap)) {
                header('Content-Disposition: attachment; filename="googleMap.png"');
                header("Content-Type: text/png");
                 echo(file_get_contents("http://localhost/attacks/all/png"));
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
    header('Content-Disposition: attachment; filename="googleMap.png"');
    header("Content-Type: image/png");
                 echo(file_get_contents("http://localhost/attacks/filtered/png", false, $context ));
             }
        }
}

?>
