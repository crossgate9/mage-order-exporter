<?php

class Crossgate9_Order_Address_City extends Crossgate9_Order_Abstract {
    public function __construct() {
        $this->_column_name = 'City';
    }

    public function getValue($_options=array()) {
        $_type = isset($_options['type']) ? $_options['type'] : 'billing';
        $_order = $this->_entities['order'];
        $_address = $this->getOrderAddress($_order, $_type);
        $this->_values = ucwords($_address['city']);
        return $this->_values;
    }
}