<?php
namespace Core;

class View
{
    public function render($view, $data = [])
    {
        extract($data);
        ob_start();
        require_once "../app/Views/$view.php";
        return ob_get_clean();
        
    }
}
