<?php
session_start();

if(isset($_SESSION['loggedIn'])){
    unset($_SESSION['loggedIn']);
    unset($_SESSION['success']);
    header('Location: /admin/index.php');
    exit;
}