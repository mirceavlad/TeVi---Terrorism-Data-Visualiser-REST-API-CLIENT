<?php
class FilterMapper{
    public function mapFilters($filtersArray){
        $withFilterMap=FilterConfigurator::mapFilters($filtersArray);
        $availableFiltersValues = null;
            $availableFiltersMapByCategories = array();
            if(empty($withFilterMap)) {
                echo "enters here";
                $jsonString = file_get_contents("http://localhost/attacks/all");
                urldecode($jsonString);
                $availableFiltersValues = json_decode($jsonString,true);
            } else {
                echo "AAAAAAAA";
                $filtersJson = json_encode($withFilterMap);
                $post_options = array(
                    'http' => array(
                        'method' => 'POST',
                        'content' => $filtersJson,
                        'header'=>  "Content-Type: application/json\r\n"
                    )
                    );
                $context  = stream_context_create( $post_options );
                $jsonString = file_get_contents( "http://localhost/attacks/filtered", false, $context );
                $availableFiltersValues = json_decode( $jsonString, true );
            }
            return $availableFiltersValues;
    }
}

?>