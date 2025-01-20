<?php
include "db_helper.php";

header('Content-Type: application/json'); // JSON formatini belgilash

if (isset($_GET['query'])) {
    $keyword = $_GET['query'];
    $results = [];

    if (!empty($keyword)) {
        // PDO bilan tayyorlangan so'rovdan foydalanamiz
        $query = "SELECT * FROM post WHERE title LIKE :keyword OR content LIKE :keyword";
        $stmt = $conn->prepare($query);
        $stmt->execute(['keyword' => '%' . $keyword . '%']); // Placeholderga qiymat beriladi

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $author = getAuthorbyId($row['author_id']);
            $row['author'] = $author['firstname'] . ' ' . $author['lastname'];
            $results[] = $row;
        }
    }

    echo json_encode($results);
    exit;
}
?>
