<?php
session_start();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    include "../db.php";
    $stm = $conn->prepare("SELECT * FROM user WHERE username = :username");
    $stm->execute([":username" => $username]);
    if ($stm->rowCount() > 0){
        $user = $stm->fetch(PDO::FETCH_ASSOC);
        if (password_verify($password, $user['password'])){
            $_SESSION['success'] = 'ok';
            $_SESSION['loggedIn'] = '1';
            header("Location: index.php");exit;
        }
        else{
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['error'] = 'Parol xato!';
        }
    }
    else{
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['error'] = 'Bunday foydalanuvchi mavjud emas !';
    }
}
header("Location: login.php");