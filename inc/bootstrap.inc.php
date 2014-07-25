<?php

// Use Composer autoloading
require_once __DIR__ . '/../vendor/autoload.php';

// Get Doctrine entity manager
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$config = Setup::createAnnotationMetadataConfiguration(
    array($applicationOptions['entity_dir']),
    $applicationOptions['debug_mode']
);

$em = EntityManager::create($connectionOptions, $config);
