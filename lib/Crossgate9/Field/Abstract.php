<?php

abstract class Crossgate9_Field_Abstract {

    protected $_column_name = '';
    protected $_entities = array();
    protected $_values = array();
    
    abstract public function getValue($_options);
    
    public function setEntities($_entities) {
        $this->_entities = $_entities;
    }

    public function getEntities() {
        return $this->_entities;
    }
     
    private function _getDimension($_arr) {
        if (is_array($_arr)) {
            return $this->_getDimension(reset($_arr)) + 1;
        } else {
            return 0;
        }
    }
    
    public function getDimension() {
        return $this->_getDimension($this->_values);
    }

    public function getName() {
        return $this->_column_name;
    }
}