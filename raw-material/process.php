<?php
session_start();
include '../model/RawMaterial.php';
$db = new RawMaterial();

$action = $_GET['action'];
if($action == 'add') {
    $db->insertRawMaterial($_POST['name'],$_POST['qty'],$_POST['sp']);
    header("location:index.php?message=add-success");
} elseif ($action == 'edit') {
    $db->insertRawMaterial($_POST['id'],$_POST['name'],$_POST['qty'],$_POST['sp']);
    header("location:index.php?message=edit-success");
} elseif ($action == 'delete') {
    $db->deleteRawMaterial($_GET['id']);
    header("location:index.php?message=delete-success");
} else {
    header("location:index.php");
}
