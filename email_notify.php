<?php
    function notification($user){
        include("connection.php");
        $sql = "SELECT * FROM users WHERE notify = 1 AND username = ? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $user);
        if ($stmt->execute())
        {
            $row = $stmt->fetch();
            if ($stmt->rowCount() > 0)
            {
                return true;
            }
        }
        return false;
    }
    function notification_id($userid){
        include("connection.php");
        $sql = "SELECT * FROM users WHERE notify = 1 AND userid = ? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $userid);
        if ($stmt->execute())
        {
            $row = $stmt->fetch();
            if ($stmt->rowCount() > 0)
            {
                return true;
            }
        }
        return false;
    }
?>