<?php
    session_start();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    echo $_SESSION['userid'];
    include("connection.php");
    if (isset($_POST['yes'])){
        try{
        $name = $_SESSION['userid'];
        $sql = "UPDATE users SET notify = 1 WHERE username = :username";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":username", $_SESSION['userid']);
        $stmt->execute();
        }
        catch (PDOException $e){
            echo "Selection failed: " . $e->getMessage();
        }
        header("location: index.php");
    }
    if (isset($_POST['no'])){
        try{
        $sql = "UPDATE users SET notify = 0 WHERE username = :username";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":username", $_SESSION['userid']);
        $stmt->execute();
        }
        catch (PDOException $e){
            echo "Selection failed: " . $e->getMessage();
        }
        header("location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form method="POST" action="">
    <p>Receive email Notification?</p>
    <br>
    <input type="submit" name="yes" value="yes">
    <br>
    <input type="submit" name="no" value="no">
</form>
    
</body>
</html>