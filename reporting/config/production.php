<?php

if ($_SESSION["role"] != 'rl_productionstaff' and $_SESSION["role"] != 'rl_productionspv' and $_SESSION["role"]!='rl_admin') {
    session_start();
    header("Location: ../home/index.php?message=unauthorized");
    exit();
}
