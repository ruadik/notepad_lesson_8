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


    public function tasks(){
        // Create new Plates instance
        // Render a template
        $All_tasks = $this->queryBilder->tasks();
        echo $this->views->render('tasks', ['tasks' => $All_tasks]);
    }

    public function task($id){
        $Show_task = $this->queryBilder->task($id);
        echo $this->views->render('task', ['task' => $Show_task]);
    }

    public function createTask(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $this->queryBilder->crateTask($_POST);
            header('Location: /tasks');
        }else {
            echo $createTask = $this->views->render('createTask');
        }
    }

    public function editTask($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $this->queryBilder->updateTask($id);
            header('Location: /tasks');
        }else {
            $editTask = $this->queryBilder->task($id);
            echo $this->views->render('editTask', ['task' => $editTask]);
        }
    }

    public function deleteTask($id){
        $delete_task = $this->queryBilder->deleteTask($id);
        header('Location: /tasks');
    }
}