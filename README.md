# doctrine-skeleton

## Webmasters Doctrine Skeleton

A sample application skeleton using Doctrine 2

### config/default-config.php

```php
<?php

// MySQL database configuration
$connectionOptions = [
    'driver' => 'pdo_mysql',
    'host' => 'localhost',
    'user' => 'root',
    'password' => '',
    'dbname' => '',
];

// Application/Doctrine configuration
$applicationOptions = [
    'debug_mode' => true, // in production environment false
    'entity_dir' => dirname(__DIR__) . '/src/Entities',
];

```

Change user, password and dbname to your needs.

### Idea
[Jan Teriete](https://plus.google.com/106660436858103395374?rel=author)