<?php
session_start();
include '../model/Auth.php';

$action = $_GET['action'];

if ($action == 'login') {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $db = new Auth();
    $login = $db->checkLogin($username, $password);
    
    if ($login > 0) {
        $user = $db->findUser($username, $password);
        $_SESSION['name'] = $user['name'];
        $_SESSION['username'] = $username;
        $_SESSION['status'] = "login";
        $_SESSION['role'] = $user['role'];
        $_SESSION['ws'] = $user['workstation'];
        header("location:../index.php");
    } else {
        header("location:index.php?message=failed");
    }
} elseif ($action == 'logout') {
    session_start();
    session_destroy();
    header("location:../index.php?message=logout");
} else {
    header("location:index.php?message=failed");
}
