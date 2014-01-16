<?php

class Crossgate9_Order_Address_State extends Crossgate9_Order_Abstract {
    public function __construct() {
        $this->_column_name = 'State';
    }

    public function getValue($_options=array()) {
        $_type = isset($_options['type']) ? $_options['type'] : 'billing';
        $_order = $this->_entities['order'];
        $_address = $this->getOrderAddress($_order, $_type);
        $this->_values = $_address['region'];
        return $this->_values;
    }
}