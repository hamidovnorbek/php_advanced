<?php include 'header.php';
include '/laragon/mohirdev/db_helper.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
}

if(isset($_GET['confirm']) && $_GET['confirm'] === 'yes'){
    deleteAll('category', $id);
    header("Location: /admin/category.php");
}
elseif(isset($_GET['confirm']) && $_GET['confirm'] === 'no'){
    header('Location: /admin/category.php');
}




echo "Xaqiqatdan ham o'chirmoqchimisiz ?";?>
<a href="/admin/delete_Cat.php?id=<?=$id;?>&confirm=yes" class="btn btn-danger">Ha</a>
<a href="/admin/delete_Cat.php?id=<?=$id;?>&confirm=no" class="btn btn-success">Yoq</a>