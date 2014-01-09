<?php

error_reporting(E_ALL | E_STRICT);
define('MAGENTO_ROOT', '../');
$_mage_file = MAGENTO_ROOT . '/app/Mage.php';
require_once $_mage_file;

date_default_timezone_set('Asia/Hong_Kong');

require_once './vendor/autoload.php';
require_once './lib/Autoload.php';

use Ulrichsg\Getopt;

$getopt = new Getopt(array(
    array(null, 'start-date', Getopt::REQUIRED_ARGUMENT),
    array(null, 'end-date', Getopt::REQUIRED_ARGUMENT),
));

$getopt->parse();

$_date = new DateTime();

// end_date
$_end_date = $getopt->getOption('end-date');
if (isset($_end_date) === false) {
    $_end_date = $_date->format('Y-m-d');
}

// start_date
$_start_date = $getopt->getOption('start-date');
if (isset($_start_date) === false) {
    date_sub($_date, date_interval_create_from_date_string('1 days'));
    $_start_date = $_date->format('Y-m-d');
}
unset($_date);


