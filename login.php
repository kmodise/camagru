<?php
session_start();
include('validation.php');
    $retrive = array();
    $not_val = "";
    foreach($_POST as $key => $value)
        $retrive[$key] = $value;
    if ($retrive["username"] && $retrive["password"] && $retrive["submit"]) {
        $va = new validation();
        if ($va->valid_login($retrive['username'], $retrive['password'])){
            if ($va->email_verified($retrive['username'])){
                $_SESSION['userid'] = $retrive["username"];
                $_SESSION['pwd'] = $retrive['password'];
                $_SESSION['email'] = $retrive['email'];
                $_SESSION['name'] = $retrive['fullname'];
                header("location: index.php");
            }      
            else
                echo "confirm account first";
        }
        else{
            $not_val = "incorect username or password";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="box_form">
        <div>
            <div>
                <p>
                    <h1>CAMAGRU</h1>
                </p>
            </div>
            <div> 
                <div><?php echo $not_val;?></div>

                <form method="POST">
                    <p><input type="text" name="username" placeholder="Username" id="username" required></p>
                    <p><input type="password" name="password" id="password" placeholder="Password" required></p>
                    <p> <input type="submit" value="Login" name="submit" id="submit"></p>
                </form>
            </div>
            <div>
                <p> <a href="forgotPass.php"> <font color="purple" >forgot password</font></a></p>
            </div>
        </div>
        <div>
            <p>Don't have an account? <a href="Register.php">Sign up</a></p>
        </div>
    </div>

</body>

</html>