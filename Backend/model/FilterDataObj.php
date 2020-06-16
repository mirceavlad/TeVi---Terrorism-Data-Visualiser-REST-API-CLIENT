<?php
    class FilterDataObj {
        public $otherIntervalId;
        public $isInterval;
        public $id;
        public $currentSelectedValue;
        public $allPossibleValues;
        public $pointingToCategory;

        function __construct($isInterval, $id, $otherIntervalId, $currentSelectedValue, $pointingToCategory) {
            $this -> isInterval = $isInterval;
            $this -> id = $id;
            $this -> otherIntervalId = $otherIntervalId;
            $this -> currentSelectedValue = $currentSelectedValue;
            $this -> pointingToCategory = $pointingToCategory;
        }

        function isNumeric() {
            return preg_match('/^[0-9]+$/', $str);
        }
    }
?>