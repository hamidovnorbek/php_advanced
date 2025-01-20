<?php 
require('/laragon/mohirdev/db_helper.php');
include 'header.php';

if(isset($_POST['submit'])){
    $cat_name = $_POST['add_cat'];
    addCategory($cat_name);
    header('Location: /admin/category.php');
}

?>


<div class="container">
    <div class="row">
        <h1>Adding a new Category</h1>
        <form method="post">
            <label for="add_cat" class="form-label"> The name of Category</label>
            <input type="text" class="form-control" id="add_cat" name="add_cat" required>
            <button class="btn btn-success mt-2" name="submit">submit</button>
        </form>
    </div>
</div>