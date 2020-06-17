<?php
    class FilterDataObj {
        public $otherIntervalId;
        public $isInterval;
        public $id;
        public $currentSelectedValue;
        public $allPossibleValues;
        public $pointingToCategory;
        public $isNumeric;

        function __construct($isInterval, $id, $otherIntervalId, $currentSelectedValue, $pointingToCategory, $isNumeric) {
            $this -> isInterval = $isInterval;
            $this -> id = $id;
            $this -> otherIntervalId = $otherIntervalId;
            $this -> currentSelectedValue = $currentSelectedValue;
            $this -> pointingToCategory = $pointingToCategory;
            $this -> isNumeric = $isNumeric;
            if($this->currentSelectedValue == null) {
                $this -> currentSelectedValue = "any";
            }
        }

        function isNumeric() {
            return preg_match('/^[0-9]+$/', $str);
        }
    }
?>