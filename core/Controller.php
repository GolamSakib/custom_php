<?php
namespace Core;

use Core\View;
use Core\Database;
use Core\Request;

class Controller
{
    protected $view;
    protected $db;

    protected $request;

    public function __construct()
    {
        $this->view = new View();
        $this->db   = Database::getInstance();
        $this->request =new Request();;
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
