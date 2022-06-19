<?php

if ($_SESSION["role"] != 'rl_workstation' and $_SESSION["role"] != 'rl_admin') {
    session_start();
    header("Location: ../home/index.php?message=unauthorized");
    exit();
}
