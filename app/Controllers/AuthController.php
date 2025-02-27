<?php
namespace App\Controllers;

use App\Models\User;
use App\Utils\FileUploader;
use Core\Controller;
use Core\Request;

class AuthController extends Controller
{

    private $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new User();
    }

    public function login()
    {
        $email    = $this->request->input('email');
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

    public function register()
    {
        $name       = htmlspecialchars($this->request->input('name'));
        $email      = filter_var($this->request->input('email'), FILTER_SANITIZE_EMAIL);
        $password   = password_hash($this->request->input('password'), PASSWORD_BCRYPT);
        $avatar     = FileUploader::upload('avatar');
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');
        $data       = [
            'name'       => $name,
            'email'      => $email,
            'password'   => $password,
            'avatar'     => $avatar,
            'created_at' => $created_at,
            'updated_at' => $updated_at,
        ];

        $checkUser = $this->userModel->findBy('email', $email);
        if ($checkUser) {
            echo "User with email $email already exists";
            return;
        } else {
            $user = $this->userModel->create($data);
            if ($user) {
                // Ensure session is started
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }

                $_SESSION['user'] = [
                    'name'   => $name,
                    'email'  => $email,
                    'avatar' => $avatar,
                ];
                echo "User registered successfully";
            } else {
                echo "User registration failed";
            }
        }

    }

    public function loginForm()
    {
        echo $this->view->render('auth/login');
    }
}
