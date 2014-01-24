<?php

error_reporting(E_ALL | E_STRICT);
define('MAGENTO_ROOT', '../');
$_mage_file = MAGENTO_ROOT . '/app/Mage.php';
require_once $_mage_file;
Mage::app();

date_default_timezone_set('Asia/Hong_Kong');

require_once './vendor/autoload.php';
require_once './lib/Autoload.php';

// Start to parse conditions from arguments
$_filters = array();

use Ulrichsg\Getopt;

$getopt = new Getopt(array(
    array(null, 'start-date', Getopt::OPTIONAL_ARGUMENT, 'Start Date: yyyy-mm-dd'),
    array(null, 'end-date', Getopt::OPTIONAL_ARGUMENT, 'End Date: yyyy-mm-dd'),
    array(null, 'type', Getopt::REQUIRED_ARGUMENT, 'Type: sales-summary (REQUIRED)'),
    array(null, 'status', Getopt::OPTIONAL_ARGUMENT, 'Status: ["complete"] (NOTICE: lower case)'),
    array(null, 'store', Getopt::OPTIONAL_ARGUMENT, 'Store: [1,2] (The number is store view id)'),
    array(null, 'html-output', Getopt::OPTIONAL_ARGUMENT, 'HTML Output: true/ false. (Output the log with HTML tag)')
));

$getopt->parse();

// parse the required arguments
$_type = $getopt->getOption('type');
if (! isset($_type)) {
    $getopt->showHelp();
    die();
}

$_date = new DateTime();

// end_date
$_end_date = $getopt->getOption('end-date');
if (isset($_end_date) === false) {
    $_end_date = $_date->format('Y-m-d');
}
array_push($_filters, 
    array('field'=>'created_at', 'condition'=>array('date'=>true, 'to'=>$_end_date))
);

// start_date
$_start_date = $getopt->getOption('start-date');
if (isset($_start_date) === false) {
    date_sub($_date, date_interval_create_from_date_string('1 days'));
    $_start_date = $_date->format('Y-m-d');
}
array_push($_filters, 
    array('field'=>'created_at', 'condition'=>array('date'=>true, 'from'=>$_start_date))
);
unset($_date);

// status
$_status = $getopt->getOption('status');
if (isset($_status) !== false) {
    $_status = json_decode($_status);
    array_push($_filters,
        array('field' => 'status', 'condition' => array('in', $_status))
    );
}

// store
$_store = $getopt->getOption('store');
if (isset($_store) !== false) {
    $_store = json_decode($_store);
    array_push($_filters,
        array('field' => 'store_id', 'condition' => array('in', $_store))
    );
}

// html output
$_is_html_format = $getopt->getOption('html-output') === 'true';

// get orders
$_order_collection = Mage::getResourceModel('sales/order_collection');
$_order_filter = new Crossgate9_Filter_Order();
$_order_filter->setCollection($_order_collection);
foreach($_filters as $_filter) {
    $_order_filter->addCondition($_filter['field'], $_filter['condition']);
}

if ($_is_html_format) {
    echo "<p>Total Record Number: " . $_order_filter->count() . "</p>":
} else {
    echo "Total Record Number: " . $_order_filter->count() . "\n";
}

$_filename = Crossgate9_Utility_File::generateFilename('./tmp/', 8, '.csv');
$_output = new Crossgate9_Output_Adapter_CSV();
$_output->setFilename($_filename);
include 'template/' . $_type . '.php';
$_output->save();

if ($_is_html_format) {
    echo '<p><a href="'.$_filename.'">Download</a></p>';
} else {
    echo 'Filename: ' . $_filename . "\n";
}