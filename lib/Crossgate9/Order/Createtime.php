<?php
class Crossgate9_Order_Createtime extends Crossgate9_Order_Abstract {
    public function __construct() {
        $this->_column_name = 'Create Time';
    }

    public function getValue($_options=array()) {
        $_order = $this->_entities['order'];
        $_date = $_order->getData('created_at');
        $_format = (isset($_options['format']) ? $_options['format'] : 'H:m:s');
        $this->_values = date($_format, strtotime($_date));
        return $this->_values;
    }
}