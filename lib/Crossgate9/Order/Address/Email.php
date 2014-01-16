<?php

class Crossgate9_Order_Address_Email extends Crossgate9_Order_Abstract {
    public function __construct() {
        $this->_column_name = 'Email';
    }

    public function getValue($_options=array()) {
        $_type = isset($_options['type']) ? $_options['type'] : 'billing';
        $_order = $this->_entities['order'];
        if ($_customer_id === NULL) {
            $this->_values = $_order->getData('customer_email');
        } else {
            $_customer_id = $_order->getData('customer_id');
            $_customer = Mage::getModel('customer/customer')->load($_customer_id);
            $this->_values = $_customer->getData('email');
        }
        return $this->_values;
    }
}