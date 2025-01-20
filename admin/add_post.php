<?php
require('/laragon/mohirdev/db_helper.php');
include 'header.php';

if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $authorId = $_POST['author_id'];
    $categoryId = $_POST['category_id'];
    $content = $_POST['content'];
    if (isset($_POST['add_tags'])){
        $tags = $_POST['add_tags'];
    }
    addPost($title, $categoryId, $authorId, $content, $tags);

    header('Location: /admin/news.php');
}

$resCat = select('category');
$resAuth = select('user');
$resTag = select('tag');

?>


<div class="container">
    <div class="row">
        <h1>Adding a new Post</h1>
        <form method="post">
            <div class="mb-3">
                <label for="title" class="form-label"> Title </label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label"> Content </label>
                <textarea class="form-control" id="content" name="content" required></textarea>

            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label"> Category </label>
                <select name="category_id" class="form-select" aria-label="Default select example">
                    <?php foreach ($resCat as $it){?>
                        <option value="<?= $it['id']?>"><?= $it['title'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="author_id" class="form-label"> Author </label>
                <select name="author_id" class="form-select" aria-label="Default select example">
                    <?php foreach ($resAuth as $it){?>
                        <option value="<?= $it['id']?>"><?= $it['firstname'] ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <select class="form-select" multiple aria-label="multiple select example" name="add_tags[]">
                    <?php foreach ($resTag as $it){?>
                        <option value="<?= $it['id']?>"><?= $it['name'] ?></option>
                    <?php } ?>
                </select>
            </div>

            <button class="btn btn-success mt-2" name="submit">submit</button>
        </form>
    </div>
</div>
