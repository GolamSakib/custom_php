<?php
namespace Core;

use Core\View;
use Core\Database;

class Controller
{
    protected $view;
    protected $db;

    public function __construct()
    {
        $this->view = new View();
        $this->db   = Database::getInstance();
    }

    protected function render($view, $data = [])
    {
        return $this->view->render($view, $data);
    }

    protected function redirect($url)
    {
        header("Location: $url");
        exit;
    }
}
