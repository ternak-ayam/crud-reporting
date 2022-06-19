<?php
include('../config/database.php');
class Workstation extends Database
{
    function __construct()
    {
        $this->connection = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        if (mysqli_connect_errno()) {
            echo "connection to database failed : " . mysqli_connect_error();
        }
    }

    
}
