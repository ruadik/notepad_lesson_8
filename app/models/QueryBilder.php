<?php
namespace App\models;
use Aura\SqlQuery\QueryFactory;
use PDO;

class QueryBilder{

    public $pdo;

    public function __construct()
    {
        // a PDO connection
        $this->pdo = new PDO('mysql:host=192.168.10.10; dbname=notepad_lesson_8; charset=utf8','homestead', 'secret');

    }


    public function tasks(){
        $queryFactory = new QueryFactory('mysql');
        $select = $queryFactory->newSelect();
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
}