<?php

class Crossgate9_Order_Status extends Crossgate9_Order_Abstract {
    public function __construct() {
        $this->_column_name = 'Status';
    }

    public function getValue($_options=array()) {
        $_order = $this->_entities['order'];
        $this->_values = $_order->getData('status');
        return $this->_values;
    }
}