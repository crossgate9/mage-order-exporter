<?php

class Crossgate9_Order_Address_Country extends Crossgate9_Order_Abstract {
    
    public function __construct() {
        $this->_column_name = 'Country';
    }
    
    private function _get_full_name($_code) {
        $_country = Mage::getModel('directory/country')->loadByCode($_code);
        return $_country->getName(); 
    }

    public function getValue($_options=array()) {
        $_type = isset($_options['type']) ? $_options['type'] : 'billing';
        $_is_full_name = isset($_options['full-name']) ? $_options['full-name'] : false;
        $_order = $this->_entities['order'];
        $_address = $this->getOrderAddress($_order, $_type);
        $this->_values = $_address['country_id'];
        if ($_is_full_name)
            $this->_values = $this->_values . '/' . $this->_get_full_name($this->_values); 
        $this->_values = ucwords($this->_values);
        return $this->_values;
    }
}