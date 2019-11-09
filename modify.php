<?php
  session_start();
  include("connection.php");
  include("validation.php");
  include("email_notify.php");
//    echo $_SESSION['username'];
  $old_username = $_SESSION['userid'];
  if(isset($_POST['submit_name']))
  {  
      $valid = new validation();
      if($valid->test_user($_POST['username'])){
          
      }
     echo "usename updated";
  }
  if(isset($_POST['submit_email']))
  {
      echo "email updated";
  }
  if(isset($_POST['submit_passwd']))
  {
      echo "password updated";
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="profile.css">
  <title>Profile</title>
</head>
<body>
       <div class="information">
           <h1>update</h1>
       </div>
       <form action="" method="post">
           <div>
            <input type="text" name="username" placeholder="Edit Username" pattern="[A-Za-z0-9]{6,}">
            <input type="submit" value="Update_username"  name="submit_name">
           </div>
           <div>
            <input type="email" name="email" id="email" placeholder="Edit Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Invalid email format">
            <input type="submit" value="Update_email"  name="submit_email">
       </div>
       <div>
            <input type="password" name="curentpassword" id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder=" Enter current Password" required>
            <input type="submit" value="Update_password"  name="submit_passwd">
       </div>
   </form>
   </div>
</body>
</html>

<!-- <?php
    session_start();   
    include("validation.php");
    include("usermngt.php");
    include("email_notify.php");
    $retrive = array();
    $play = array();
    foreach($_POST as $key => $value)
        $retrive[$key] = $value;
    $va = new validation();
    $id = $va->get_user($_SESSION['userid']);
    $uname = $retrive['username'];
    $name = $retrive['name'];
    $email = $retrive['email'];
    $password = $retrive['password'];
    $curentpassword = $retrive['curentpassword'];
    $pwd = $_SESSION['pwd'];
    $pref = $retrive['email_preference'];
    if (!$_SESSION['userid'])
        header('Location: login.php');
    if ($retrive['submit'])
    {
        if ($pwd === $curentpassword )
        {
            if(!$email && !$name && !$uname && !$password){
                $error_msg = "Nothing changed";
                echo $error_msg;
            }  
            else{
                if (!$email)
                    $email = $id[0]['email'];
                if (!$password)
                    $password = $pwd;
                if (!$name)
                    $name = $id[0]['fullname'];
                if (!$uname)
                    $uname = $id[0]['username'];
                if ($email || $name || $uname || $password){
                    $va = new validation();
                    if ($va->test_email($retrive['email']) || $va->test_password($retrive['password']) || $va->test_user($retrive['username'])){

                        $var = new createuser($email, $name, $uname, $password);
                        $var->update_profile($id[0]['userid']);
                        if (notification($uname)){
                            if ($_POST['name'])
                                mail($id[0]['email'], "CAMAGRU account updated", "Hi " .$id[0]['username'].",\n\nYou have changed your fullname.\n\nRegards\nCAMAGRU", "FROM:(CAMAGRU)camagruca@gmail.com");
                            if ($_POST['email'])
                                mail($id[0]['email'], "CAMAGRU account updated", "Hi " .$id[0]['username'].",\n\nYou have changed your Email.\n\nRegards\nCAMAGRU", "FROM:(CAMAGRU)camagruca@gmail.com");
                            if ($_POST['username'])
                                mail($id[0]['email'], "CAMAGRU account updated", "Hi " .$id[0]['username'].",\n\nYou have changed your username.\n\nRegards\nCAMAGRU", "FROM:(CAMAGRU)camagruca@gmail.com");
                            if ($_POST['password'])
                                mail($id[0]['email'], "CAMAGRU account updated", "Hi " .$id[0]['username'].",\n\nYou have changed your password.\n\nRegards\nCAMAGRU", "FROM:(CAMAGRU)camagruca@gmail.com");
                        }
                    }
                    else {
                        if ($_POST['email'])
                            echo "Email already exist!";
                        if ($_POST['username'])
                            echo "Username already exist!";
                    }
                }
            }    
             
        }

    }
?> -->

<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Account</title>
</head>

<body>
    <div class="Container">
        <div class="box-1">
            <div>
                <p>
                    <h1>EDIT ACCOUNT</h1>
                </p>
            </div>
            <div class="form_reg">
                <form action="" method="post">
                    <p><input type="email" name="email" id="email" placeholder="Edit Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Invalid email format"></p>
                    <p><input type="text" name="name" placeholder="Edit Full Name" id="name"></p>
                    <p> <input type="text" name="username" placeholder="Edit Username" id="username" pattern="[A-Za-z0-9]{6,}"></p>
                    <p><input type="password" name="password" id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder=" Change Password" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"></p>
                    <p><input type="password" name="curentpassword" id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder=" Enter current Password" required></p>
                    <p><input type="submit" value="Update" name="submit" id="submit"></p>
                </form>
            </div>
    </div>

</body>

</html> -->

