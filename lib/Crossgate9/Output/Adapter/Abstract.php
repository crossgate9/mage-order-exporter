<?php

abstract class Crossgate9_Output_Adapter_Abstract {
    public $filename = null;
    protected $_data = null;

    function __construct() {
        $_data = array();
    }

    public function setFilename($_filename) {
        $this->filename = $_filename;
    }

    private function _alignment($r, $c) {
        $_new_data = array();
        for ($i = 1; $i <= $r; $i++) {
            $_new_data[$i] = array();
            if (isset($this->_data[$i]) === true) {
                for ($j = 1; $j <= $c; $j++) {
                    $_new_data[$i][$j] = (isset($this->_data[$i][$j]) === false) ? '' : $this->_data[$i][$j];
                }
            } else {
                for ($j = 1; $j <= $c; $j++) {
                    $_new_data[$i][$j] = '';
                }
            }
        }
        $this->_data = $_new_data;
    }

    public function getDimension() {
        // get dimension
        $_row = max(array_keys($this->_data));
        $_column = 0;
        foreach ($this->_data as $_entry) {
            $_tmp = max(array_keys($_entry));
            if ($_tmp > $_column) { 
                $_column = $_tmp;
            }
        }

        // alignment
        $this->_alignment($_row, $_column);

        return array($_row, $_column);
    }

    abstract public function setCellValue($_cell, $_value);
    abstract public function save();
}