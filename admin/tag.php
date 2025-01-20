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

    <a href="/admin/add_tag.php" class="btn btn-success m-2">ADD</a>

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#id</th>
            <th scope="col">name</th>
            <th scope="col">#</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach(selectedTag($page) as $it){
            echo '<tr>';
            echo '<td>'.$it['id'].'</td>';
            echo '<td>'.$it['name'].'</td>';
            echo "<td><a class='btn btn-danger m-1' href='delete_tag.php?id=".$it['id']."'>Delete</a><a class='btn btn-primary' href='update_tag.php?id=".$it['id']."'>UPDATE</a></td>";
            echo '</tr>';
        }?>
        </tbody>
    </table>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="/admin/tag.php?page=<?= $page-1 > 0? $page-1 : 1 ?>">Previous</a></li>
            <?php for($i = 1; $i <= pagination('tag'); $i++) {?>
                <li class="page-item"><a class="page-link" href="/admin/tag.php?page=<?= $i ?>"><?= $i ?></a></li>
            <?php }?>
            <li class="page-item"><a class="page-link" href="/admin/tag.php?page=<?= $page+1 <= pagination('tag') ? $page+1: $page ?>">Next</a></li>
        </ul>
    </nav>


</div>

