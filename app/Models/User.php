<?php
namespace App\Models;

use Core\Model;

class User extends Model{

    protected $table = 'users';

     public function __construct()
     {
        parent::__construct();
     }

}
