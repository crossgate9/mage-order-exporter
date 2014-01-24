<?php

class EcomInfinity_OrderExporter_Model_Mysql4_Task extends Mage_Core_Model_Mysql4_Abstract {
    public function _construct() {    
        $this->_init('orderexporter/task', 'entity_id');
    }
}