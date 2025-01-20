<?php include 'header.php';
include '/laragon/mohirdev/db_helper.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
}

if(isset($_GET['confirm']) && $_GET['confirm'] === 'yes'){
    deleteAll('tag',$id);
    header("Location: /admin/tag.php");
}
elseif(isset($_GET['confirm']) && $_GET['confirm'] === 'no'){
    header('Location: /admin/tag.php');
}




echo "Xaqiqatdan ham o'chirmoqchimisiz ?";?>
<a href="/admin/delete_Tag.php?id=<?=$id;?>&confirm=yes" class="btn btn-danger">Ha</a>
<a href="/admin/delete_Tag.php?id=<?=$id;?>&confirm=no" class="btn btn-success">Yoq</a>