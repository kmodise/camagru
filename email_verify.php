<?php
    include("connection.php");
    include("usermngt.php");
    include("validation.php");
    $vkey2 = $_GET['vkey'];
    $val = new validation();
    if ($val->updatekey($vkey2))
        header("location: login.php");
?>