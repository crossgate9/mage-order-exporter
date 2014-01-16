<?php
class Crossgate9_Order_Address_Zip extends Crossgate9_Order_Abstract {
    public function __construct() {
        $this->_column_name = 'Zip';
    }

    public function getValue($_options=array()) {
        $_type = isset($_options['type']) ? $_options['type'] : 'billing';
        $_order = $this->_entities['order'];
        $_address = $this->getOrderAddress($_order, $_type);
        $this->_values = $_address['postcode'];
        return $this->_values;
    }
}