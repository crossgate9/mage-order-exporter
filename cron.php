    <?php

error_reporting(E_ALL | E_STRICT);
define('MAGENTO_ROOT', '../');
$_mage_file = MAGENTO_ROOT . '/app/Mage.php';
require_once $_mage_file;
Mage::app();

date_default_timezone_set('Asia/Hong_Kong');

require_once './vendor/autoload.php';
require_once './lib/Autoload.php';

$_tasks = Mage::getModel('orderexporter/task')->getCollection()->getItems();

foreach ($_tasks as $_task) {
    $_status = $_task->getData('status');
    switch ($_status) {
        case EcomInfinity_OrderExporter_Model_Task::STATUS_NOT_START:
            $_id = $_task->getData('entity_id');
            $_cmd = $_task->getData('cmd');

            $_exec = "%s > %s 2>&1 & echo $! > %s";
            $_outputfile = sprintf('task/output.%s', $_id);
            $_pidfile = sprintf('task/pid.%s', $_id);

            exec(sprintf($_exec, $_cmd, $_outputfile, $_pidfile));

            $_task->setData('status', EcomInfinity_OrderExporter_Model_Task::STATUS_RUNNING);
            $_task->save();

            break;
        case EcomInfinity_OrderExporter_Model_Task::STATUS_RUNNING:
            $_id = $_task->getData('entity_id');
            $_pid = $_task->getData('pid');
            if (strlen($_pid) === 0) {
                $_pidfile = sprintf('task/pid.%s', $_id);
                $_pid = file_get_contents($_pidfile);
                $_task->setData('pid', $_pid);        
            }

            if (Crossgate9_Utility::isRunning($_pid) === false) {
                $_task->setData('status', EcomInfinity_OrderExporter_Model_Task::STATUS_FINISHED);
            } 

            $_outputfile = sprintf('task/output.%s', $_id);
            $_outputfile = file_get_contents($_outputfile);
            $_task->setData('log', $_outputfile);
            $_task->save();

            break;
        case EcomInfinity_OrderExporter_Model_Task::STATUS_FINISHED:
            break;
        default:
            break;
    }
}