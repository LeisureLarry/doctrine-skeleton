<?php

function redirect($to)
{
    header('Location:' . $to);
    exit;
}

function error404()
{
    header('HTTP/1.0 404 Not Found');
    die('Error 404');
}

function set_message($message)
{
    $_SESSION['message'] = $message;
}

function get_message()
{
    $message = false;
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
        unset($_SESSION['message']);
    }
    return $message;
}
