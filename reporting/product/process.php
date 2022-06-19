<?php
session_start();
include '../model/Product.php';
$db = new Product();

$action = $_GET['action'];
if($action=='add'){
    $db->insertProduct($_POST['name'],$_POST['qty'],$_POST['cogs'],$_POST['sp']);
    header("location:index.php?message=add-success");

}elseif($action=='edit'){
    $db->editProduct($_POST['id'],$_POST['name'],$_POST['qty'],$_POST['cogs'],$_POST['sp']);
    header("location:index.php?message=edit-success");
}elseif($action=='delete'){
    $db->deleteProduct($_GET['id']);
    header("location:index.php?message=delete-success");
}else{
    header("location:index.php");
}
