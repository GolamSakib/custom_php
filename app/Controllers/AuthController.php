<?php
namespace App\Controllers;

use Core\Controller;
use Core\Request;

class AuthController extends Controller{

    protected $request;

    public function __construct(Request $request)
    {
        parent::__construct();
        $this->request = $request;
    }

    public function login()
    {
        $email = $this->request->input('email');
        $password = $this->request->input('password');

        // Implement your authentication logic here
        // For example, you can check the email and password against the database

        if ($email === 'test@example.com' && $password === 'password') {
            // Authentication successful
            echo 'Login successful';
        } else {
            // Authentication failed
            echo 'Invalid email or password';
        }
    }


    public function loginForm(){
        echo $this->view->render('auth/login');
    }
}
