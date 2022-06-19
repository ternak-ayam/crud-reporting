<?php
session_start();
include '../model/Product.php';
include '../model/RawMaterial.php';
$product = new Product();
$rawMaterial = new RawMaterial();

$action = $_GET['action'];
if ($action == 'raw-material-arrival') {
    $rawMaterial->addRawMaterial($_POST['id'], $_POST['qty']);
    $rawMaterial->insertRawMaterialLog($_POST['id'], $_POST['qty'], $_SESSION['name'], 'Warehouse', 'Production', 'arrival');
    header("location:raw-material-arrival.php?message=success");

} elseif ($action == 'raw-material-departure') {

    $rawMaterial->sendRawMaterial($_POST['id'], $_POST['qty']);
    $rawMaterial->insertRawMaterialLog($_POST['id'], $_POST['qty'], $SESSION['name'], 'Production',$_POST['destination'],'departure');

    header("location:raw-material-departure.php?message=success");
} elseif ($action == 'arrival') {

    $product->insertProductLog($_POST['id'], $_POST['qty'], 'Workstation 3', 'Production', 'arrival',$_SESSION['name']);
    
    header("location:arrival.php?message=success");
} elseif ($action == 'departure') {

    $product->addProduct($_POST['id'], $_POST['qty']);
    $product->insertProductLog($_POST['id'], $_POST['qty'],'Production','Warehouse','departure', $_SESSION['name']);

    header("location:departure.php?message=succsess");
} else {

    header("location:../home/index.php");

}