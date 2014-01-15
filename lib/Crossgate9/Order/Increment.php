<?php
class Crossgate9_Order_Increment extends Crossgate9_Order_Abstract {
    public function __construct() {
        $this->_column_name = 'Increment Id';
    }

    public function getValue($_options=array())
    {
        $_order = $this->_entities['order'];
        $this->_values = '#'.$_order->getData('increment_id');
        return $this->_values;
    }
}