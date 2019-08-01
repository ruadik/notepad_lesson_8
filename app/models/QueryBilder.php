<?php
namespace App\models;

use Aura\SqlQuery\QueryFactory;
use PDO;

Class QueryBilder{

    private $queryFactory;
    private $pdo;

    public function __construct(QueryFactory $queryFactory, PDO $pdo)
    {
        $this->queryFactory = $queryFactory;
        $this->pdo = $pdo;
    }

    public function selectTasks(){
        $select = $this->queryFactory->newSelect();
        $select->cols(['*'])->from('tasks');
        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function selectTask($id){
        $select = $this->queryFactory->newSelect()->cols(['*'])->from('tasks')->where('id = :id')->bindValue('id', $id);
        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function updateTask($id){
        $cols = array_keys($_POST);
        $update = $this->queryFactory->newUpdate()->table('tasks')->cols($cols)->bindValues($_POST)->where('id = :id')->bindValue('id', $id);
        $sth = $this->pdo->prepare($update->getStatement());
        $sth->execute($update->getBindValues());
    }

    public function addTask(){
        $cols = array_keys($_POST);
        $insert = $this->queryFactory->newInsert()->into('tasks')->cols($cols)->bindValues($_POST);
        $sth = $this->pdo->prepare($insert->getStatement());
        $sth->execute($insert->getBindValues());
    }

    public function deleteTask($id){
        $delete = $this->queryFactory->newDelete()->from('tasks')->where('id = :id')->bindValue('id', $id);
        $sth = $this->pdo->prepare($delete->getStatement());
        $sth->execute($delete->getBindValues());
    }
}