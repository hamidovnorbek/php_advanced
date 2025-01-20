<?php include 'header.php';
include '/laragon/mohirdev/db_helper.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
}

if(isset($_GET['confirm']) && $_GET['confirm'] === 'yes'){
    deleteAll('post',$id);
    header("Location: /admin/news.php");
}
elseif(isset($_GET['confirm']) && $_GET['confirm'] === 'no'){
    header('Location: /admin/news.php');
}




echo "Xaqiqatdan ham o'chirmoqchimisiz ?";?>
<a href="/admin/delete_Post.php?id=<?=$id;?>&confirm=yes" class="btn btn-danger">Ha</a>
<a href="/admin/delete_Post.php?id=<?=$id;?>&confirm=no" class="btn btn-success">Yoq</a>