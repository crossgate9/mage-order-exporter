<?php

error_reporting(E_ALL | E_STRICT);
define('MAGENTO_ROOT', '../');
$_mage_file = MAGENTO_ROOT . '/app/Mage.php';
require_once $_mage_file;
Mage::app();

date_default_timezone_set('Asia/Hong_Kong');

require_once './vendor/autoload.php';
require_once './lib/Autoload.php';

$_tasks = Mage::getModel('orderexporter/task')
            ->getCollection()
            ->setOrder('entity_id', 'DESC')
            ->getItems();
$_helper = Mage::helper('orderexporter');
$_number = $_helper->dashboardNumber();
?>

<html>
    <head>
        <title>EcomInfinity Order Exporter Dashboard</title>
        <link rel="stylesheet" href="styles/status.css">
    </head>
    <body>
        <header></header>
        <main>
            <div class="wrapper">
                <div class="notices">
                    Please refresh to check the status of generating. 
                </div>
                <div class="links">
                    <a href="./index.html">Return</a>
                    <a href="javascript: window.location.reload();">Refresh</a>
                </div>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Command</th>
                            <th>Status</th>
                            <!-- <th>PID</th> -->
                            <th>Log</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $_count = 0; ?>
                        <?php foreach ($_tasks as $_task): ?>
                        <?php $_count ++; ?>
                        <?php if ($_count > $_number) break; ?>
                        <tr>
                            <td><?php echo $_task->getData('entity_id'); ?></td>
                            <td style="width:350px;">
                                <?php $_params = $_helper->parseCmd($_task->getData('cmd'), true); ?>
                                <?php foreach ($_params as $_key=>$_val): ?>
                                <p><?php echo $_key?>: <?php echo $_val; ?></p>
                                <?php endforeach; ?>
                            </td>
                            <td><?php echo $_helper->getStatusText($_task->getData('status')); ?></td>
                            <!-- <td><?php echo $_task->getData('pid');?></td> -->
                            <td><?php echo $_task->getData('log');?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="links">
                    <a href="./index.html">Return</a>
                    <a href="javascript: window.location.reload();">Refresh</a>
                </div>
            </div>
        </main>
        <footer></footer>
    </body>
</html>
