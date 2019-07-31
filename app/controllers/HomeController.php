<?php
namespace App\controllers;

use League\Plates\Engine;
use App\models\QueryBilder;


class HomeController{

    public $views;
    public $queryBilder;

    public function __construct(Engine $views, QueryBilder $queryBilder)
    {
        $this->views=$views;
        $this->queryBilder = $queryBilder;
    }


    public function index(){
        // Create new Plates instance
        // Render a template
        $tasks = $this->queryBilder->tasks();

        echo $this->views->render('tasks', ['tasks' => $tasks]);
//        echo $views->render('tasks', ['tasks' => $tasks]);
    }

    public function about(){
        echo "qqqqqqqqqq";
    }
}