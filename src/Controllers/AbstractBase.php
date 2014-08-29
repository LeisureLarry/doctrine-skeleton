<?php

namespace Controllers;

use Doctrine\ORM\EntityManager;

abstract class AbstractBase
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

    public function run($action)
    {
        $methodName = $action . 'Action';
        $this->setTemplate($methodName);
        $this->addContext('action', $action);

        if (method_exists($this, $methodName)) {
            $this->$methodName();
        } else {
            $this->error404();
        }

        extract($this->context); // Add array content as local variables

        $message = $this->getMessage(); // Get flash message
        $template = $this->getTemplate();

        require_once $this->basePath . '/templates/layout.tpl.php';
    }

    public function error404()
    {
        header('HTTP/1.0 404 Not Found');
        die('Error 404');
    }

    protected function getControllerShortName()
    {
        $className = get_class($this); // i.e. Controllers\IndexController

        return preg_replace('/^Controllers\\\/', '', $className); // i.e. IndexController
    }

    protected function getEntityManager()
    {
        return $this->em;
    }

    protected function setTemplate($template, $controller = null)
    {
        if (empty($controller)) {
            $controller = $this->getControllerShortName();
        }

        $this->template = $controller . '/' . $template . '.tpl.php';
    }

    protected function getTemplate()
    {
        return $this->template;
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

    protected function redirect($to = null)
    {
        if (!empty($to)) {
            $to = '?' . $to;
        }

        header('Location: index.php' . $to);
        exit;
    }
}
