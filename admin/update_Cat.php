<?php 
require('/laragon/mohirdev/db_helper.php');
include 'header.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $cat_value = getCatById($id);
}

if(isset($_POST['cat_update'])){
    $cat_title = $_POST['update'];
    updateCat($id, $cat_title);
    header('Location: /admin/category.php');
}

?>


<div class="container">
    <div class="row">
        <form method="post">
            <label for="update" class="form-label"> Adding a new category</label>
            <input type="text" class="form-control" id="update" name="update" value="<?= $cat_value['title']?>" required>
            <button class="btn btn-success mt-2" name="cat_update">update</button>
        </form>
    </div>
</div>