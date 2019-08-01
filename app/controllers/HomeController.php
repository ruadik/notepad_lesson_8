<?php
namespace App\controllers;

use App\models\QueryBilder;
use http\Env\Url;
use http\Header;
use League\Plates\Engine;

class HomeController
{
    private $view;
    private $queryBilder;

    public function __construct(Engine $view, QueryBilder $queryBilder)
    {
        $this->view = $view;
        $this->queryBilder = $queryBilder;
    }


    public function selectTasks()
    {
        $tasksTemplate = $this->queryBilder->selectTasks();
        echo $this->view->render('tasks', ['tasks' => $tasksTemplate]);
    }

    public function selectTask($id){
        $task = $this->queryBilder->selectTask($id);
        echo $this->view->render('task', ['task'=> $task]);
    }

    public function editTask($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->queryBilder->updateTask($id);
            HEADER ("Location: /tasks");
        }else{
            $task = $this->queryBilder->selectTask($id);
            echo $this->view->render('editTask', ['task' => $task]);
        }
    }

    public function addTask(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $this->queryBilder->addTask();
            Header("Location: /tasks");
        }else {
            echo $addTask = $this->view->render('addTask');
        }
    }

    public function deleteTask($id){
        $this->queryBilder->deleteTask($id);
        Header("location: /tasks");
    }
}