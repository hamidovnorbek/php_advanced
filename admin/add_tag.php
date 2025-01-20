<?php
require('/laragon/mohirdev/db_helper.php');
include 'header.php';

if(isset($_POST['submit'])){
    addTag($_POST['add_tag']);
    header('Location: /admin/tag.php');
}

?>


<div class="container">
    <div class="row">
        <h1>Adding a new tag</h1>
        <form method="post">
            <label for="add_tag" class="form-label"> The name of Tag</label>
            <input type="text" class="form-control" id="add_tag" name="add_tag" required>
            <button class="btn btn-success mt-2" name="submit">submit</button>
        </form>
    </div>
</div>