<?php

class Crossgate9_Order_Payment_Method extends Crossgate9_Order_Abstract {    
    public function __construct() {
        $this->_column_name = 'Payment Method';
    }

    public function getValue($_options=array())
    {
        $_order = $this->_entities['order'];
        $this->_values = $_order->getPayment()->getMethodInstance()->getTitle();
        return $this->_values;
    }
}