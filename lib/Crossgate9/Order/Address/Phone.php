<?php

class Crossgate9_Order_Address_Phone extends Crossgate9_Order_Abstract {
    public function __construct() {
        $this->_column_name = 'Phone';
    }

    public function getValue($_options=array())
    {
        // section -64--88-1-100--f4b1739:139292fa44a:-8000:0000000000000874 begin
        // section -64--88-1-100--f4b1739:139292fa44a:-8000:0000000000000874 end
        $_type = isset($_options['type']) ? $_options['type'] : 'billing';
        $_order = $this->_entities['order'];
        $_address = $this->getOrderAddress($_order, $_type);
        $this->_values = $_address['telephone'];
        return $this->_values;
    }
}