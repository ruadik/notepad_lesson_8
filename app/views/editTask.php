<?php $this->layout('layout') ?>
<title>Edit task</title>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Edit Task</h1>
            <form action="/editTask/<?= $task['id'];?>" method="post">

                <div class="form-group">
                    <input type="text" name="title" class="form-control" value="<?= $task['title'];?>">
                </div>

                <div class="form-group">
                    <textarea name="content" class="form-control"><?= $task['content'];?></textarea>
                </div>

                <div class="form-group">
                    <button class="btn btn-warning" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
