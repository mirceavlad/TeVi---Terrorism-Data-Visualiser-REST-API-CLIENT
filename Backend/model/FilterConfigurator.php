<?php
    class FilterConfigurator {
        private static $instance = null;
        
        private function __construct() {

        }

        public static function getInstance() {
            if(self::$instance == null) {
                self::$instance = new FilterConfigurator();
            }
            return self::$instance;
        }

        public function configureFilters($filtersArray) {
            $filtersMap = self::mapFilters($filtersArray);
            $availableFiltersMap = self::makeQueryForAvailableFiltersData($filtersMap);
            foreach($filtersArray as $filterObj) {
                if($filterObj -> id != null) {
                    $filterObj -> allPossibleValues = $availableFiltersMap[$filterObj -> pointingToCategory];
                }
            }
            return $filtersArray;
        }

        public function mapFilters($filtersArray) {
            $filtersOptions = array();
                foreach($filtersArray as $filterId => $filterObj) {
                    if($filterObj -> currentSelectedValue != "any" && $filterObj -> id != null) {
                        if($filterObj -> isInterval && $filterObj -> otherIntervalId != null) {
                            if(!isset($filtersOptions["intervals"])) {
                                $filtersOptions["intervals"] = array();
                            }
                            
                            if(!isset($filtersOptions["intervals"][$filterObj -> pointingToCategory])) {
                                $filtersOptions["intervals"][$filterObj -> pointingToCategory] = array();
                            }
                            array_push($filtersOptions["intervals"][$filterObj -> pointingToCategory], $filterObj -> currentSelectedValue);
                            array_push($filtersOptions["intervals"][$filterObj -> pointingToCategory], $filtersArray[$filterObj -> otherIntervalId] -> currentSelectedValue);
                        } else if(!$filterObj -> isInterval) {
                                if(!isset($filtersOptions[$filterObj -> pointingToCategory])) {
                                    $filtersOptions[$filterObj -> pointingToCategory] = array();
                                }
                                array_push($filtersOptions[$filterObj -> pointingToCategory],$filterObj -> currentSelectedValue);
                        }
                }
            }
            return $filtersOptions;
        }


        public function makeQueryForAvailableFiltersData($withFilterMap) {
            $availableFiltersValues = null;
            $availableFiltersMapByCategories = array();
            if(empty($withFilterMap)) {
                echo "enters here";
                $jsonString = file_get_contents("http://192.168.64.2/attacks/availablefilters/all");
                urldecode($jsonString);
                $availableFiltersValues = json_decode($jsonString,true);
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
                $jsonString = file_get_contents( "http://192.168.64.2/attacks/availablefilters", false, $context );
                $availableFiltersValues = json_decode( $jsonString, true );
            }
            foreach($availableFiltersValues as $data => $specificCategory) {
                if(!isset($availableFiltersMapByCategories[$specificCategory])) {
                    $availableFiltersMapByCategories[$specificCategory] = array();
                }
                array_push($availableFiltersMapByCategories[$specificCategory], $data);
            }
            return $availableFiltersMapByCategories;
        } 
     }
?>