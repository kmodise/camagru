<?php
    include("connection.php");
    include("usermngt.php");
    $vkey2 = $_GET['vkey'];
    if ((strcmp($vkey2, $vkey))){
        $sql = "UPDATE users SET verified='1' WHERE userid=1";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        header("location: login.php");
    }
    else{
        echo "something went wrong\n";
        echo "<a href=register.php>try again</a>";
    }
?>