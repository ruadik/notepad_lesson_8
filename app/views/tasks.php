<?php $this->layout('layout') ?>
<title>My tasks</title>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>All Tasks</h1>
            <a href="/createTask" class="btn btn-success">Add Task</a>
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Actions</th>
                </tr>
                </thead>

                <tbody>
                <?php foreach($tasks as $task):?>
                    <tr>
                        <td><?= $task['id'];?></td>
                        <td><?= $task['title'];?></td>
                        <td>
                            <a href="/task/<?= $task['id'];?>" class="btn btn-info">
                                Show
                            </a>
                            <a href="/editTask/<?= $task['id'];?>" class="btn btn-warning">
                                Edit
                            </a>
                            <a onclick="return confirm('Are you sure?');" href="/deleteTask/<?= $task['id'];?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endforeach;?>

                </tbody>
            </table>
        </div>
    </div>
</div>
