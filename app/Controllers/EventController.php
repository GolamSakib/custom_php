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
public function index($page = 1){
    $perPage = 10; // Number of items per page
    $total = $this->eventModel->count(); // Total number of events
    $events = $this->eventModel->paginate($page, $perPage);
    $totalPages = ceil($total / $perPage);

    return $this->render('events/index',[
        'events' => $events,
        'currentPage' => $page,
        'totalPages' => $totalPages
    ]);
}
public function show(){
    
}
}
