<?php
include 'header.php';
require('/laragon/mohirdev/db_helper.php');

if(isset($_GET['page'])){
    $page = $_GET['page'];
}
else{
    $page  = 1;
}
?>


<div class="container">

    <a href="/admin/add_post.php" class="btn btn-success m-2">ADD</a>

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#id</th>
            <th scope="col">title</th>
            <th scope="col">content</th>
            <th scope="col">category</th>
            <th scope="col">author</th>
            <th scope="col">visited_count</th>
            <th scope="col">created_at</th>
            <th scope="col">#</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach(selectedPost($page) as $it){
            $category = getCatById($it['category_id']);
            $authorN = getAuthorbyId($it['author_id']);
            echo '<tr>';
            echo '<td>'.$it['id'].'</td>';
            echo '<td>'.$it['title'].'</td>';
            echo '<td>'.$it['content'].'</td>';
            echo '<td>'.$category['title'].'</td>';
            echo '<td>'.$authorN['firstname'].'</td>';
            echo '<td>'.$it['visited'].'</td>';
            echo '<td>'.$it['created_at'].'</td>';
            echo "<td><a class='btn btn-danger m-1' href='delete_Post.php?id=".$it['id']."'>Delete</a><a class='btn btn-primary' href='update_Post.php?id=".$it['id']."'>UPDATE</a></td>";
            echo '</tr>';
        }?>
        </tbody>
    </table>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="/admin/category.php?page=<?= $page-1 > 0? $page-1 : 1 ?>">Previous</a></li>
            <?php for($i = 1; $i <= pagination('post'); $i++) {?>
                <li class="page-item"><a class="page-link" href="/admin/news.php?page=<?= $i ?>"><?= $i ?></a></li>
            <?php }?>
            <li class="page-item"><a class="page-link" href="/admin/news.php?page=<?= $page+1 <= pagination('post') ? $page+1: $page ?>">Next</a></li>
        </ul>
    </nav>


</div>


