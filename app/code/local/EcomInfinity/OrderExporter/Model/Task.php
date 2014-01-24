<?php

class EcomInfinity_OrderExporter_Model_Task extends Mage_Core_Model_Abstract {

    const STATUS_NOT_START = 0;
    const STATUS_RUNNING = 1;
    const STATUS_FINISHED = 2;

    public function _construct() {
        parent::_construct();
        $this->_init('orderexporter/task');
    }
}