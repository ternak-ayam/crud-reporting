<?php
if($_SESSION['role'] == "rl_workstation"){
    include('workstation.php');
}else{
    include('default.php');
}