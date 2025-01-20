<?php
session_start();

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confpass = $_POST['confirm-password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];


    if (empty($username) || empty($password) || empty($confpass) || empty($firstname) || empty($lastname)) {
        $_SESSION['error'] = "Barcha maydonlarni to'ldiring";
        header("Location: /admin/register.php");
        exit();
    }

    if ($password !== $confpass) {
        $_SESSION['error'] = "Password va Confirm Password bir xil emas";
        header("Location: /admin/register.php");
        exit();
    }

    include "../db.php";

    try {
        // Foydalanuvchini tekshirish
        $state = $conn->prepare("SELECT * FROM user WHERE username = :username");
        $state->bindValue(":username", $username);
        $state->execute();

        if ($state->rowCount() > 0) {
            $_SESSION['error'] = "Bunday username bilan allaqachon ro'yxatdan o'tilgan";
            header("Location: /admin/register.php");
            exit();
        }

        // Foydalanuvchini ro'yxatdan o'tkazish
        $role = "author";
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $insert = $conn->prepare("INSERT INTO user (username, password, firstname, lastname, role) 
                                   VALUES (:username, :password, :firstname, :lastname, :role)");
        $insert->execute([
            ":username" => $username,
            ":password" => $hashedPassword,
            ":firstname" => $firstname,
            ":lastname" => $lastname,
            ":role" => $role
        ]);

        $_SESSION['success'] = "Ro'yxatdan o'tdingiz. Endi login qilishingiz mumkin!";
        header("Location: /admin/register.php");
        exit();
    } catch (PDOException $e) {
        $_SESSION['error'] = "Xatolik yuz berdi: " . $e->getMessage();
        header("Location: /admin/register.php");
        exit();
    }
} else {
    $_SESSION['error'] = "Maydonlarni to'ldiring";
    header("Location: /admin/register.php");
    exit();
}
?>
