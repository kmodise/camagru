<?php
    include("connection.php");
    include("usermngt.php");
    $vkey2 = $_GET['vkey'];
    if ((strcmp($vkey2, $vkey))){
        header("location: login.php");
    }
    else{
        echo "something went wrong\n";
        echo "<a href=register.php>try again</a>";
    }
?>