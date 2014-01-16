<?php

class Crossgate9_Order_Address_Line extends Crossgate9_Order_Abstract {
    public function __construct() {
        $this->_column_name = 'Address Line';
    }

    public function getValue($_options=array()) {
        // section -64--88-1-100--f4b1739:139292fa44a:-8000:0000000000000874 begin
        // section -64--88-1-100--f4b1739:139292fa44a:-8000:0000000000000874 end
        $_type = isset($_options['type']) ? $_options['type'] : 'billing';
        $_col_span = isset($_options['col-span']) ? $_options['col-span'] : 2;
         
        $_order = $this->_entities['order'];
        $_address = $this->getOrderAddress($_order, $_type);
        
        $_street = $_address['street'];
        if (strstr($_street, "\n") !== false) {
            $_street = explode("\n", $_street);
        } else {
            $_street = array(0 => $_street, 1 => '');
        }
        
        // padding to the col span
        if (count($_street) < $_col_span) {
            for ($i = count($_street); $i < $_col_span; $i++) {
                $_street[] = '';
            }
        }
        
        foreach ($_street as $_idx => $_val) {
            $_street[$_idx] = ucwords($_val);
        }
        
        $this->_values = $_street;
        return $this->_values;
    }
}