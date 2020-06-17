<?php
    class FilterDataObj {
        public $otherIntervalId;
        public $isInterval;
        public $id;
        public $currentSelectedValue;
        public $allPossibleValues;
        public $pointingToCategory;
        public $isNumeric;
        public $isValid;
        function __construct($isInterval, $id, $otherIntervalId, $currentSelectedValue, $pointingToCategory, $isNumeric, $isValid = true) {
            $this -> isInterval = $isInterval;
            $this -> id = $id;
            $this -> otherIntervalId = $otherIntervalId;
            $this -> currentSelectedValue = $currentSelectedValue;
            $this -> pointingToCategory = $pointingToCategory;
            $this -> isNumeric = $isNumeric;
            $this -> isValid = $isValid;
            if($this->currentSelectedValue == null) {
                $this -> currentSelectedValue = "any";
            }
        }

        function isNumeric() {
            return preg_match('/^[0-9]+$/', $str);
        }
    }
?>