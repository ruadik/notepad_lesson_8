<?php
namespace App\models;
use Aura\SqlQuery\QueryFactory;
use PDO;

class QueryBilder{

    public $pdo;
    public $queryFactory;

    public function __construct(PDO $pdo, QueryFactory $queryFactory)
    {
        // a PDO connection
        $this->pdo = $pdo;

        $this->queryFactory = $queryFactory;
    }


    public function tasks(){
//        $queryFactory = new QueryFactory('mysql');
        $select = $this->queryFactory->newSelect();
        $select->cols(['*'])
                            ->from('tasks');

        // prepare the statment
        $sth = $this->pdo->prepare($select->getStatement());

        // bind the values and execute
        $sth->execute($select->getBindValues());

        // get the results back as an associative array
        $tasks = $sth->fetchAll(PDO::FETCH_ASSOC);
//        var_dump($tasks); exit();
        return $tasks;
    }

    public function task($id){
        $select = $this->queryFactory->newSelect();
        $select->cols(['*'])->from('tasks')->where('id = :id')->bindValue('id', $id);
        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        $task = $sth->fetch(PDO::FETCH_ASSOC);
//        var_dump($task); exit();
        return $task;
    }

    public function crateTask(){
        $cols = ['title', 'content'];
        $insert = $this->queryFactory->newInsert()->into('tasks')->cols($cols)->bindValues($_POST);
        $sth = $this->pdo->prepare($insert->getStatement());
        $sth->execute($insert->getBindValues());
    }

    public function updateTask($id){
//        var_dump($_POST);exit();
        $cols = ['title', 'content'];
        $update = $this->queryFactory->newUpdate()
            ->table('tasks')
            ->cols($cols)
            ->bindValues($_POST)
            ->where('id = :id')
            ->bindValue('id', $id);
        // prepare the statement
        $sth = $this->pdo->prepare($update->getStatement());

        // execute with bound values
        $sth->execute($update->getBindValues());
//        echo $id;
    }

    public function deleteTask($id){
        $delete = $this->queryFactory->newDelete()->from('tasks')->where('id = :id')->bindValue('id', $id);
        $sth = $this->pdo->prepare($delete->getStatement());
        $sth->execute($delete->getBindValues());
    }

}