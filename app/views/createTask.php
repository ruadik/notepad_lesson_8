<?php $this->layout('layout') ?>
<title>Create task</title>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Create Task</h1>
            <form action="/createTask" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" name="title">
                </div>

                <div class="form-group">
                    <textarea name="content" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <button class="btn btn-success" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
