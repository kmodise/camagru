<?php
include("connect.php");
    $sql = "CREATE TABLE IF NOT EXISTS users (id INT(10) AUTO_INCREMENT PRIMARY KEY,
    usename VARCHAR(10) NOT NULL,
    fullname VARCHAR(15) NOT NULL,
    email VARCHAR(15) NOT NULL,
    passwd VARCHAR(10) NOT NULL,
    vkey VARCHAR(50) NOT NULL,
    verified INT(1) DEFAULT(0) NOT NULL)";
    $conn->exec($sql);
?>