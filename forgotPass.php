<?php
error_reporting(0);
ini_set('display_errors', 0);
    include("password_email_reset.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <div class="box_form">
        <div>
            <p>enter email</p>
            <form action="password_email_reset.php" method="POST">
            <p><input type="email" name="email" id="email" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Invalid email format" required></p>
            <input type="submit" value="send link" name="submit">
            </form>
        </div>
    </div>
</body>
</html>