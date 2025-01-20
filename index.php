<?php

include "db_helper.php";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yangiliklar Sahifasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">MyWebsite</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="btn btn-outline-primary me-2" href="/admin/login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary" href="/admin/register.php">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
<div class="container mt-5">
    <h1 class="text-center mb-4">Yangiliklar</h1>

    <!-- Search bar -->
    <div class="mb-4 d-flex justify-content-center">
        <input type="text" id="searchInput" class="form-control w-50" placeholder="Search">
        <button class="btn btn-primary ms-2" id="searchButton">Search</button>
    </div>

    <!-- Search results -->
    <div id="newsResults" class="row row-cols-1 row-cols-md-2 g-4">
        <!-- Qidiruv natijalari shu yerga joylashtiriladi -->
    </div>
    <!-- News cards -->
        <div class="row row-cols-1 row-cols-md-2 g-4">
        <?php $result = select('post');
            foreach ($result as $row) { ?>
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"> <?= htmlspecialchars($row['title']) ?> </h5>
                            <p class="card-text"> <?= htmlspecialchars($row['content']) ?> </p>
                        </div>
                        <div class="card-footer text-muted">
                            <small>Date: <?= htmlspecialchars($row['created_at']) ?> <br> Author: <?= getAuthorbyId($row['author_id'])['firstname'] ?> <?= getAuthorbyId($row['author_id'])['lastname'] ?></small>
                            <a href="#" class="btn btn-link float-end">Batafsil</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        ?>
    </div>
</div>


<script>
    function disableDiv($k = 'row') {
        const div = document.getElementById($k);
        div.style.pointerEvents = "none"; // Disable interaction
        div.style.opacity = "0.5"; // Optional, make it look disabled
    }
    document.getElementById("searchButton").addEventListener("click", function () {
        const keyword = document.getElementById("searchInput").value;

        fetch(`search.php?query=${keyword}`)
            .then(response => response.json())
            .then(data => {
                const resultsDiv = document.getElementById("newsResults");
                resultsDiv.innerHTML = ""; // Oldingi natijalarni tozalash

                if (data.length > 0) {
                    data.forEach(item => {
                        resultsDiv.innerHTML += `
                        <div class="col">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">${item.title}</h5>
                                    <p class="card-text">${item.content}</p>
                                </div>
                                <div class="card-footer text-muted">
                                    <small>Date: ${item.created_at} <br> Author: ${item.author}</small>
                                    <a href="#" class="btn btn-link float-end">Batafsil</a>
                                </div>
                            </div>
                        </div>
                    `;
                    });
                    
                    disableDiv();
                } else {
                    resultsDiv.innerHTML = "<p>Hech narsa topilmadi.</p>";
                }
            })
            .catch(error => console.error("Error:", error));
    });
    
    
    
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
