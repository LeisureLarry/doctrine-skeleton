<?php

// Use Composer autoloading
$loader = require_once __DIR__ . '/../vendor/autoload.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

// Use Doctrine entity manager
$config = Setup::createAnnotationMetadataConfiguration(
    array($applicationOptions['entity_dir']),
    $applicationOptions['debug_mode']
);

$em = EntityManager::create($connectionOptions, $config);
