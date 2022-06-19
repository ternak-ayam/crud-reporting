<?php
session_start();
if (!isset($_SESSION["status"])) {
    header("Location: ../auth/index.php");
    exit();
}
