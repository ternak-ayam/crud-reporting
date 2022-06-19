<?php
session_start();
include '../model/Wip.php';
$db = new WIP();

$action = $_GET['action'];
if($action == 'add') {
    $db->insertWIP($_POST['name'],$_POST['qty']);
    header("location:index.php?message=add-success");
}elseif ($action == 'add-bom') {
    $db->insertWIPDetail($_POST['id'],$_POST['material_id'], $_POST['qty']);
    header("location:detail.php?id=".$_POST['id']."&message=add-success");
}elseif ($action == 'edit-bom') {
    $db->editWIPDetail($_POST['id'],$_POST['qty']);
    header("location:detail.php?id=".$_POST['wip_id']."&message=add-success");
} elseif ($action == 'edit') {
    $db->insertWIP($_POST['id'],$_POST['name'],$_POST['qty']);
    header("location:index.php?message=edit-success");
} elseif ($action == 'delete') {
    $db->deleteWIP($_GET['id']);
    header("location:index.php?message=delete-success");
} elseif ($action == 'delete-bom') {
    $db->deleteWIPDetail($_GET['id']);
    header("location:detail.php?id=".$_GET['wip']."&message=delete-success");
} else {
    header("location:index.php");
}
