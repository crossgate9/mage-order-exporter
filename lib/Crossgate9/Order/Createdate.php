<?php
class Crossgate9_Order_Createdate extends Crossgate9_Order_Abstract {
    
    public function __construct() {
        $this->_column_name = 'Created at';
    }

    public function getValue($_options=array()) {
        $_order = $this->_entities['order'];
        $this->_values = date('Y-m-d', strtotime($_order->getData('created_at')));
        return $this->_values;
    }
}