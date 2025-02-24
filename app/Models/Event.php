<?php
namespace App\Models;

use Core\Model;

class Event extends Model{

    protected $table = 'events';

     public function __construct()
     {
        parent::__construct();
     }

}
