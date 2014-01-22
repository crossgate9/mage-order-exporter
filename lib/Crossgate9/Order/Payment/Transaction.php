<?php
class Crossgate9_Order_Payment_Transaction extends Crossgate9_Order_Abstract {
    public function __construct() {
        $this->_column_name = 'Transaction ID';
    }

    public function getValue($_options=array())
    {
        $_order = $this->_entities['order'];
        $this->_values = $_order->getPayment()->getLastTransId();
        return $this->_values;
    }
}