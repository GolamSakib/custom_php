<?php
namespace App\Controllers;

use Core\Controller;

class AuthController extends Controller{

    public function __construct()
    {
        parent::__construct();
    }

    public function loginForm(){
        echo $this->view->render('auth/login');
    }
}