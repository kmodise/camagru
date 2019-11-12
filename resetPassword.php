<?php
error_reporting(0);
ini_set('display_errors', 0);
include("validation.php");
include("connection.php");
$key = $reponse = null;
if (isset($_GET['vkey']))
{
    $key = $_GET['vkey'];
}
if (isset($_POST['reset_password_submit']))
{
    $password = $_POST['password'];
    $password_retype = $_POST['password_retype'];
    if (empty($password) || empty($password_retype))
    {
        $reponse = "missing input";
    }
    else if ($password !== $password_retype)
    {
        $reponse = "password don't match";
    }
    else{
        $valid = new validation();
        if($valid->test_password($password)){
            $password = md5($password);
            $sql = "UPDATE users SET passwd = ? WHERE vkey = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $password);
            $stmt->bindParam(2, $key);
            $stmt->execute();
            header("location: login.php");
        }
        else
            echo "make it stronger";  
    }
}

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
<div id="boxNavigation"><center><h1>camagru account password resset</h1></center></div>
<div class="box_form">
    <p><?php echo $reponse; ?></p>
    <form action="?vkey=<?php echo $key; ?>" method="POST">
        <label>new password</label><br>
        <input type="password" name="password" placeholder="new password"><br>
        <label>retype password</label><br>
        <input type="password" name="password_retype" placeholder="retype password"><br>
        <input type="submit" name="reset_password_submit" value="reset password">
    </form>
    </div>
    
    </div><div id="footer"><center><h1><font color="red">camagru &copy</font></h1></center></div>
</body>
</html>
