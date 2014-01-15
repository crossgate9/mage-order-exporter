<?php

class Crossgate9_Order_Storeview extends Crossgate9_Order_Abstract {
    
    public function __construct() {
        $this->_column_name = 'Storeview';
    }

    public function getValue($_options=array()) {
        $_entities = $this->getEntities();
        $_order = $_entities['order'];
        $_store_id = $_order->getData('store_id');
        $_store = Mage::getModel('core/store')->load($_store_id);
        $this->_values = $_store->getName();
        return $this->_values;
    }

}