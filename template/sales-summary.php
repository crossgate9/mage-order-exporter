<?php

define('HEADER_LINE_NUM', 1);

function outputHeader($_output, $_columns) {
    $_col_idx = 'A';
    foreach ($_columns as $_column) {
        $i = 0;
        if (is_string($_column['label'])) {
            $_output->setCellValue($_col_idx.'1', $_column['label']);
        } else {
            foreach ($_column['label'] as $_str) {
                $_output->setCellValue($_col_idx.'1', $_str);
                $_col_idx ++;
                $i ++;
            }
        }
        for (; $i < $_column['options']['col-span']; $i++)
            $_col_idx ++;
        
    }
}

function process($_argv) {
    set_time_limit(20);
    $_order = $_argv['row'];
    $_output = $_argv['arg2'];
    $_columns = $_argv['arg3'];
    global $_line_num;
    $_order = Mage::getModel('sales/order')->load($_order['entity_id']);

    // generate information of the order
    $_line = array();
    $_line_option = array();
    $_col_idx = 'A';
    $_multi_line = false;
    foreach ($_columns as $_column) {
        $_column_object = new $_column['class'];
        $_column_object->setEntities(array('order'=>$_order));
        $_values = $_column_object->getValue($_column['options']);
        $_dimension = $_column_object->getDimension();
        
        switch ($_dimension) {
            case 2:
                $_start_line = $_line_num;
                $_start_idx = 0;
                foreach ($_values as $_item) {
                    $_start_idx = $_col_idx;
                    foreach ($_item as $_value) {
                        $_output->setCellValue($_start_idx.$_start_line, $_value);
                        $_start_idx ++;
                    }
                    $_start_line ++;
                }
                $_col_idx = $_start_idx;
                $_multi_line = $_start_line;
                break;
            case 1:
                foreach ($_values as $_value) {
                    $_output->setCellValue($_col_idx.$_line_num, $_value);
                    $_line[$_col_idx] = $_value;
                    $_line_option[$_col_idx] = $_column['options'];
                    $_col_idx ++;
                }
                break;
            default:
                $_output->setCellValue($_col_idx.$_line_num, $_values);
                if (! (isset($_column['options']['show-once']) && $_column['options']['show-once'])) {
                    $_line[$_col_idx] = $_values;
                    $_line_option[$_col_idx] = $_column['options'];
                }
                $_col_idx++;
        }
    }
    if ($_multi_line !== false) {
        for ($i = $_line_num; $i < $_multi_line; $i++) {
            foreach ($_line as $_idx => $_value) {
                $_output->setCellValue($_idx.$i, $_value);
            }
        }
        $_line_num = $_multi_line;
    }
    $_line_num ++;
    unset($_line);
}

include __DIR__ . "/config/Accounting.php";
outputHeader($_output, $_columns);
$_line_num = HEADER_LINE_NUM + 1;
$_order_filter->walk(
    'process',
    array(
        'arg1' => '====',
        'arg2' => $_output,
        'arg3' => $_columns
    )
);