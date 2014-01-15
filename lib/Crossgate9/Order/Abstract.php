<?php

abstract class Crossgate9_Order_Abstract extends Crossgate9_Field_Abstract {
    public function getOrderAddress($_order, $_type) {
        switch ($_type) {
            case "shipping":
                $_address = $_order->getShippingAddress();
                if (get_class($_address) === false) {
                    $this->_values = '';
                    return $this->_values;
                }
                $_address = $_address->getData();
                break;
            case "billing":
            default:
                $_address = $_order->getBillingAddress();
                if (get_class($_address) === false) {
                    $this->_values = '';
                    return $this->_values;
                }
                $_address = $_address->getData();
        }
        return $_address;
    }
}