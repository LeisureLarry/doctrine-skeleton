<?php

require_once 'inc/functions.inc.php';
require_once 'inc/helper.inc.php';

require_once 'inc/bootstrap.inc.php';

// Session needed for flash messages
session_start();

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;
$view = $action;

switch ($action) {
    default:
        $view = 'index';
        break;
}

// Get flash message
$message = get_message();

require_once 'views/layout.tpl.php';
