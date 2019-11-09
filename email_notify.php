<?php
    include("connection.php");
    function notification($username){
        try{
            $sql = 'SELECT * FROM users WHERE username = :username && verify = 1';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":username", $username);
            $stmt->execute();
            $rot = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return ($stmt->fetchAll());
        }catch (PDOException $e)
        {
            echo "Selection failed: " . $e->getMessage();
        }
    }
?>