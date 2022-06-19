<?php
require_once('../config/database.php');
class Auth extends Database
{
    function __construct()
    {
        $this->connection = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        if (mysqli_connect_errno()) {
            echo "connection to database failed : " . mysqli_connect_error();
        }
    }

    function checkLogin($user, $pass)
    {
        $data = mysqli_query($this->connection, "SELECT * FROM user WHERE username='$user' AND password='$pass'");
        return mysqli_num_rows($data);
    }

    function findUser($user, $pass)
    {
        $query = "SELECT * FROM user WHERE username='$user' AND password='$pass'";
        $data = mysqli_query($this->connection, $query);
        if (!$this->connection->query($query)) {
            echo ("Error description: " . $this->connection->error);
        }
        return mysqli_fetch_assoc($data);
    }
}
