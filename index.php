<?php
if(!isset($_SESSION['status'])){
    header("location:home/index.php");
}else{
    header("location:auth/index.php");
}