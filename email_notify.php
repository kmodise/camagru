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
?>
<!-- 
function ft_unique_email($email)
{
   require("inc.connect.php");
   $sql_query = "SELECT * FROM users WHERE email = ? LIMIT 1";
   $stmt = $conn->prepare($sql_query);
   $stmt->bindParam(1, $email);
   if ($stmt->execute())
   {
       $user = $stmt->fetch();
       if (!($stmt->rowCount() > 0))
       {
           $stmt = null;
           $conn = null;
           return true;
       }
   }
   return false;
} -->