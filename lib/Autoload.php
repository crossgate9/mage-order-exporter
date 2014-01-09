<?php
define('LIB_PATH', __DIR__);

// auto load lib
spl_autoload_register(function($_class_name) {
    $_path = LIB_PATH . '/' . implode('/', explode('_', $_class_name)) . '.php';
    include $_path;
});