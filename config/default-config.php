<?php

// MySQL database configuration
$connectionOptions = array(
    'driver' => 'pdo_mysql',
    'host' => 'localhost',
    'user' => 'root',
    'password' => '',
    'dbname' => '',
);

// Application/Doctrine configuration
$applicationOptions = array(
    'debug_mode' => true, // in production environment false
    'entity_dir' => dirname(__DIR__) . '/src/Entities',
);
