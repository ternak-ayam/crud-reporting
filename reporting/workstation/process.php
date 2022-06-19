<?php
session_start();
include '../model/RawMaterial.php';
include '../model/Wip.php';
include '../model/Product.php';
$rawMaterial = new RawMaterial();
$wip = new WIP();
$product = new Product();

$action = $_GET['action'];
if ($action == 'raw-material-arrival') {

    $rawMaterial->insertRawMaterialLog($_POST['id'], $_POST['qty'], $_SESSION['name'], $_POST['origin'], $_SESSION['ws'], 'arrival');

    header("location:raw-material-arrival.php?message=success");
} elseif ($action == 'wip-arrival') {

    $wip->sendWIP($_POST['id'], $_POST['qty']);
    $wip->insertWIPLog($_POST['id'], $_POST['qty'], $_SESSION['name'], $_POST['origin'], $_SESSION['ws'], 'arrival');

    header("location:wip-arrival.php?message=success");
} elseif ($action == 'wip-finished') {
    $wip->addWIP($_POST['id'], $_POST['qty']);
    $wip->insertWIPLog($_POST['id'], $_POST['qty'], $_SESSION['name'], $_SESSION['ws'], '', 'finished');

    header("location:wip-finished.php?message=success");
} elseif ($action == 'product-finished') {

    $product->insertProductLog($_POST['id'], $_POST['qty'], $_SESSION['ws'],'','finished', $_SESSION['name']);

    header("location:product-finished.php?message=success");
} else {

    header("location:../home/index.php");
}
