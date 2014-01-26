<?php

error_reporting(E_ALL | E_STRICT);
define('MAGENTO_ROOT', '../');
$_mage_file = MAGENTO_ROOT . '/app/Mage.php';
require_once $_mage_file;
Mage::app();

date_default_timezone_set('Asia/Hong_Kong');

require_once './vendor/autoload.php';
require_once './lib/Autoload.php';


// POST the request to this script
$_command = array();
if (isset($_POST['type'])) {
    $_command['type'] = $_POST['type'];
}
if (isset($_POST['date'])) {
    if (isset($_POST['date']['start'])) {
        $_command['start-date'] = $_POST['date']['start'];
    }
    if (isset($_POST['date']['end'])) {
        $_command['end-date'] = $_POST['date']['end'];
    }
}
if (isset($_POST['status'])) {
    $_status = $_POST['status'];
    if (is_array($_status) === false) $_status = array($_status);
    $_command['status'] = $_status;
}
if (isset($_POST['store'])) {
    $_store = $_POST['store'];
    if (is_array($_store) === false) $_store = array($_store);
    $_command['store'] = $_store;
}

$_command_format = "php cli.php %s";
$_argv = '';
foreach ($_command as $_key=>$_val) {
    if ($_val === null) continue;
    if (is_array($_val) === true) $_val = json_encode($_val);
    $_argv .= sprintf(" --%s='%s' ", $_key, $_val);
}
$_cmd = sprintf($_command_format, $_argv);

$_task = Mage::getModel('orderexporter/task');
$_task->setData('cmd', $_cmd);
$_task->setData('status', EcomInfinity_OrderExporter_Model_Task::STATUS_NOT_START);
$_task->setData('created_time', date('Y-m-d H:i:s', time()));
$_task->setData('update_time', date('Y-m-d H:i:s', time()));
$_task->save();

header('Location: status.php');