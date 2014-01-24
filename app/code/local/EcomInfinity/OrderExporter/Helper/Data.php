<?php

class EcomInfinity_OrderExporter_Helper_Data extends Mage_Core_Helper_Abstract {
    public function getStatusText($_status) {
        switch ($_status) {
            case EcomInfinity_OrderExporter_Model_Task::STATUS_NOT_START:
                return 'WAITING';
            case EcomInfinity_OrderExporter_Model_Task::STATUS_RUNNING:
                return 'RUNNING';
            case EcomInfinity_OrderExporter_Model_Task::STATUS_FINISHED:
                return 'FINISHED';
            default:
                return 'UNKNOWN';
        }
    }

    public function parseCmd($_cmd, $_is_array=false) {
        $_result = array();
        $_params = explode(' ', $_cmd);
        foreach($_params as $_param) {
            if (substr($_param, 0, 2) === '--') {
                list($_key, $_val) = explode('=', substr($_param, 2, -1));
                $_result[$_key] = $_val;
            }
        }

        return ($_is_array) ? $_result : json_encode($_result);
    }
}