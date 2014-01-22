<?php
class Crossgate9_Order_Currency extends Crossgate9_Order_Abstract {
    public function __construct() {
        $this->_column_name = 'Order Currency';
    }

    public function getValue($_options=array()) {
        $_order = $this->_entities['order'];
        $this->_values = $_order->getData('order_currency_code');
        return $this->_values;
    }
}