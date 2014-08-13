<?php

namespace Controllers;

use Doctrine\ORM\EntityManager;

abstract class BaseController
{
    protected $basePath;
    protected $context = array();
    protected $em;
    protected $template;

    public function __construct($basePath, EntityManager $em)
    {
        $this->basePath = $basePath;
        $this->em = $em;
    }

    protected function getControllerShortName()
    {
        $className = get_class($this); // i.e. Controllers\IndexController
        $controllerName = preg_replace('/^Controllers\\\/', '', $className);
        return strtolower($controllerName); // i.e. IndexController
    }

    protected function setTemplate($template)
    {
        $this->template = $template;
    }

    protected function getTemplate()
    {
        return $this->template . '.tpl.php';
    }

    public function run($action)
    {
        $this->addContext('action', $action);

        $shortName = $this->getControllerShortName();
        $this->setTemplate($shortName . '/' . $action);

        $methodName = $action . 'Action';
        if (method_exists($this, $methodName)) {
            $this->$methodName();
        } else {
            $this->error404();
        }

        extract($this->context); // Add array content as local variables

        $message = get_message(); // Get flash message
        $template = $this->getTemplate();

        require_once $this->basePath . '/templates/layout.tpl.php';
    }

    protected function getEntityManager()
    {
        return $this->em;
    }

    protected function addContext($key, $value)
    {
        $this->context[$key] = $value;
    }

    protected function setMessage($message)
    {
        $_SESSION['message'] = $message; // Set flash message
    }

    protected function getMessage()
    {
        $message = false;
        if (isset($_SESSION['message'])) {
            // Read and delete flash message from session
            $message = $_SESSION['message'];
            unset($_SESSION['message']);
        }
        return $message;
    }

    protected function redirect($to)
    {
        header('Location:' . $to);
        exit;
    }

    public function error404()
    {
        header('HTTP/1.0 404 Not Found');
        die('Error 404');
    }
}
