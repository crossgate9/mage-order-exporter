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

$_max_thread = Mage::helper('orderexporter')->maxThread();
$_run_quota = 100;
if ($_max_thread !== '0') {
    $_running_tasks = Mage::getModel('orderexporter/task')
                    ->getCollection()
                    ->addFieldToFilter('status', EcomInfinity_OrderExporter_Model_Task::STATUS_RUNNING);
    $_run_quota = $_max_thread - $_running_tasks->count();
}


foreach ($_tasks as $_task) {
    $_status = $_task->getData('status');
    switch ($_status) {
        case EcomInfinity_OrderExporter_Model_Task::STATUS_NOT_START:
            if ($_run_quota > 0) {
                $_id = $_task->getData('entity_id');
                $_cmd = $_task->getData('cmd');

                $_exec = "%s > %s 2>&1 & echo $! > %s";
                $_outputfile = sprintf('task/output.%s', $_id);
                $_pidfile = sprintf('task/pid.%s', $_id);

                exec(sprintf($_exec, $_cmd, $_outputfile, $_pidfile));

                $_task->setData('status', EcomInfinity_OrderExporter_Model_Task::STATUS_RUNNING);
                $_task->save();
                $_run_quota --;
            }
            break;
        case EcomInfinity_OrderExporter_Model_Task::STATUS_RUNNING:
            $_id = $_task->getData('entity_id');
            $_pid = $_task->getData('pid');
            if (strlen($_pid) === 0) {
                $_pidfile = sprintf('task/pid.%s', $_id);
                $_pid = file_get_contents($_pidfile);
                $_task->setData('pid', $_pid);        
            }

            $_outputfile = sprintf('task/output.%s', $_id);
            $_outputfile = file_get_contents($_outputfile);
            $_task->setData('log', $_outputfile);

            if (Crossgate9_Utility::isRunning($_pid) === false) {
                if (Mage::helper('orderexporter')->isSentMail()) {
                    $_receipts = explode(',', Mage::helper('orderexporter')->mailReceipt());
                    $_from_email = Mage::helper('orderexporter')->fromEmail();
                    $_from_name = Mage::helper('orderexporter')->fromName();
                    foreach ($_receipts as $_mail) {
                        $_mail = trim($_mail);
                        Mage::getModel('core/email')
                            ->setFromEmail($_from_email)
                            ->setFromName($_from_name)
                            ->setToEmail($_mail)
                            ->setType('html')
                            ->setBody($_outputfile)
                            ->setSubject('EcomInfifity Order Exporter')
                            ->send();
                    }
                }

                $_task->setData('status', EcomInfinity_OrderExporter_Model_Task::STATUS_FINISHED);
            } 

            $_task->save();

            break;
        case EcomInfinity_OrderExporter_Model_Task::STATUS_FINISHED:
            break;
        default:
            break;
    }
}