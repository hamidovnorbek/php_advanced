<?php

include 'db.php';
include 'constant.php';

function selectedCategory($page){
    include 'db.php';
    $offset = ($page-1)*LIMIT;
    $slc = "SELECT * FROM category limit $offset, 5";
    $stm = $conn->prepare($slc);
    $stm->execute();
    $res = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $res;
}

function addCategory($cat_name){
    include 'db.php';
    $cmd = "INSERT INTO category(title) VALUES('$cat_name')";
    $stm = $conn->prepare($cmd);
    $stm->execute();
}

function pagination($table){
    include 'db.php';
    $slc = "SELECT * FROM $table";
    $stm = $conn->prepare($slc);
    $stm->execute();
    $res = $stm->rowCount();
    return ceil($res/LIMIT);
}

function getCatById($id){
    include 'db.php';
    $slc = "SELECT * FROM category WHERE id = '$id'";
    $stm = $conn->prepare($slc);
    $stm->execute();
    return $stm->fetch(PDO::FETCH_ASSOC);
}

function updateCat($id, $title){
    include 'db.php';
    $sql = "UPDATE category SET title = :title WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':title', $title);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}

function deleteAll($table, $id){
    include 'db.php';
    $sql = "DELETE FROM $table WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

}


/*---------------------             POST              --------------------*/

function selectedPost($page){
    include 'db.php';
    $offset = ($page-1)*LIMIT;
    $slc = "SELECT * FROM post limit $offset, 5";
    $stm = $conn->prepare($slc);
    $stm->execute();
    $res = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $res;
}

function select($table)
{
    include 'db.php';
    $slc = "SELECT * FROM $table";
    $stm = $conn->prepare($slc);
    $stm->execute();
    return $stm->fetchAll(PDO::FETCH_ASSOC);
}

function addPost($title, $categoryId, $authorId, $content, $tags = null)
{
    include "db.php";
    $cmd = "INSERT INTO post(title, content, category_id, author_id, created_at, visited) VALUES(:title, :content, :category_id, :author_id, :created_at, :visited)";
    $stm = $conn->prepare($cmd);
    $stm->bindValue(':title', $title);
    $stm->bindValue(':content', $content);
    $stm->bindValue(':category_id', $categoryId);
    $stm->bindValue(':author_id', $authorId);
    $stm->bindValue(':created_at', date("Y-m-d H:i:s"));
    $stm->bindValue(':visited', 0);
    $stm->execute();

    $post_id = $conn->lastInsertId();
    $cmd1 = "INSERT INTO post_tag(tag_id, post_id) VALUES(:tag_id, :post_id)";
    if($tags != null){
        foreach ($tags as $tag){
            $stm1 = $conn->prepare($cmd1);
            $stm1->bindValue(':tag_id', $tag, PDO::PARAM_INT);
            $stm1->bindValue(':post_id', $post_id, PDO::PARAM_INT);
            $stm1->execute();
        }
    }


}

function  getAuthorbyId($id)
{
    include 'db.php';
    $slc = "SELECT * FROM user WHERE id = '$id'";
    $stm = $conn->prepare($slc);
    $stm->execute();
    return $stm->fetch(PDO::FETCH_ASSOC);

}



/*  -------------     TEGLAR UCHUN       ----------------*/

function selectedTag($page){
    include 'db.php';
    $offset = ($page-1)*LIMIT;
    $slc = "SELECT * FROM tag limit $offset, 5";
    $stm = $conn->prepare($slc);
    $stm->execute();
    $res = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $res;
}
function addTag($val){
    include 'db.php';
    $cmd = "INSERT INTO tag(name) VALUES('$val')";
    $stm = $conn->prepare($cmd);
    $stm->execute();
}


/*--------  SEARCH qilish     -------------*/


function searchPosts($key) {
    include 'db.php';
    $keyword = mysqli_real_escape_string($conn, $key);

    $query = "SELECT * FROM post WHERE title LIKE '%$key%' OR content LIKE '%$key%'";

    $result = mysqli_query($conn, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

