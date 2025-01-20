<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>

<div class="container mt-5">
    <!-- Error and Success Messages -->
    <?php
    if (isset($_SESSION["error"])) {
        echo "<div class='alert alert-danger' role='alert'>" . $_SESSION["error"] . "</div>";
        unset($_SESSION["error"]);
    }
    if (isset($_SESSION["success"])) {
        echo "<div class='alert alert-success' role='alert'>" . $_SESSION["success"] . "</div>";
        unset($_SESSION["success"]);
    }
    ?>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Register</div>
                <div class="card-body">

                    <!-- Registration Form -->
                    <form method="POST" action="registration.php">
                        <div class="form-group mb-3">
                            <label for="firstname" class="form-label">First Name</label>
                            <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Enter your Firstname" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="lastname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Enter your Lastname" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Enter your Username" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter your Password" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="confirm-password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" name="confirm-password" id="confirm-password" placeholder="Confirm your Password" required>
                        </div>




                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" name="register">Register</button>
                        </div>
                        <div class="login-register">
                            <a href="login.php">Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
