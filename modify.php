<?php
  session_start();
  error_reporting(0);
ini_set('display_errors', 0);
  include("connection.php");
  include("validation.php");
  include("email_notify.php");
  include('nev1.php');
  $username = $_SESSION['userid'];
  if(isset($_POST['submit_name']))
  {  
      $valid = new validation();
      if($valid->test_user($_POST['username'])){
          try{
              $sql = "UPDATE users SET username = :uname WHERE username = :usern";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":uname", $_POST['username']);
            $stmt->bindParam(":usern", $username);
            $stmt->execute();
            if (notification($username) || notification($_POST['username'])){
                $data = $valid->get_user($username);
                $data2 = $valid->get_user($_POST['username']);
                if ($data){
                   mail($data[0]['email'],"data update", "you changed youre username", "From: camagru@camagru.com");
                }
                else if ($data2){
                  mail($data2[0]['email'],"data update", "you changed youre username", "From: camagru@camagru.com");
                }
                else{
                  echo "something went wrong";
                }
                echo "usename updated you are required to <a href=login.php>login</a> again\n";
             }
          }
          catch(PDOexception $e){
              echo "failed: ".$e->getMessage();
          }
      }
      else{
          echo "usename already taken\n";
      }
  }
  if(isset($_POST['submit_email']))
  {
    $valid = new validation();
    if($valid->test_email($_POST['email'])){
        try{
            $sql = "UPDATE users SET email = :email WHERE username = :usern";
          $stmt = $conn->prepare($sql);
          $stmt->bindParam(":email", $_POST['email']);
          $stmt->bindParam(":usern", $username);
          $stmt->execute();
          if (notification($username)){
             mail($_POST['email'],"data update", "you changed youre email", "From: camagru@camagru.com");
          }
          echo "email updated you are required to <a href=login.php>login</a> again\n";
        }
        catch(PDOexception $e){
            echo "failed: ".$e->getMessage();
        }
        
    }
    else{
        echo "email already taken\n";
    }
  }
  if(isset($_POST['submit_passwd']))
  {
    $valid = new validation();
    if($valid->test_password($_POST['password'])){

        try{
            $passwd = md5($_POST['password']);
            $sql = "UPDATE users SET passwd = :passwd WHERE username = :usern";
          $stmt = $conn->prepare($sql);
          $stmt->bindParam(":passwd", $passwd);
          $stmt->bindParam(":usern", $username);
          $stmt->execute();
          if (notification($username)){
            $data = $valid->get_user($username);
            mail($data[0]['email'],"data update", "you changed youre password", "From: camagru@camagru.com");
         }
          echo "password updated you are required to <a href=login.php>login</a> again\n";
        }
        catch(PDOexception $e){
            echo "failed: ".$e->getMessage();
        }
    }
    else{
        echo "email already taken\n";
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="style.css">
  <title>Profile</title>
</head>
<body>
  <div class="box_form">
       <div>
           <h1>update info</h1>
       </div>
       <form action="" method="post">
           <div>
            <input type="text" name="username" placeholder="Edit Username" pattern="[A-Za-z0-9]{6,}">
            <input type="submit" value="Update"  name="submit_name">
           </div>
           <div>
            <input type="email" name="email" id="email" placeholder="Edit Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Invalid email format">
            <input type="submit" value="Update"  name="submit_email">
       </div>
       <div>
            <input type="password" name="password" id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder=" Enter Password">
            <input type="submit" value="Update"  name="submit_passwd">
       </div>
   </form>
   </div>
</div>
</body>
</html>