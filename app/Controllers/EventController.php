<?php
namespace App\Controllers;

use App\Models\Event;
use Core\Controller;

class EventController extends Controller{

    private $eventModel;

public function __construct()
{
    parent::__construct();
    $this->eventModel = new Event();

}
public function index(){
    $events = $this->eventModel->all();
    return $this->render('events/index',[
        'events' => $events
    ]);
}
public function show(){
    
}
}
