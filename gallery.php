<?php
    session_start();
    error_reporting(0);
ini_set('display_errors', 0);
    include("nev.php");
    include("validation.php");
    include("usermngt.php");
    if (!$_SESSION['userid'])
        header('location:login.php');
    $va = new validation();
    $id = $va->get_user($_SESSION['userid']);
    if(isset($_POST['submitdelete']))
    {
        $var = new images();
        $uid = $id[0]['userid'];
        $pid = $_POST['submitdelete'];
        $var->deletepost($uid ,$pid);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Profile</title>
</head>
<body>
    <div id='all'>
        <?php
            $var = new validation;
            $id = $var->get_user($_SESSION['userid']);
            $uid = $id[0]['userid'];
           
            include_once('pictures_functions.php');
            $arr = new picdb();
            $display = $arr->getalluser($uid);
            $i = 0;
            while($i < count($display))
            {
                echo '<div><img src="'.$display[$i]['images'].'" style="width: 450px; hight: 450px; margin-left: 450px;" ><div>';
                echo " <form action='gallery.php' method= 'POST'>
                <button class='button' type='submit' name='submitdelete' value='".$display[$i]['num']."'>Delete</button>
            </form>";             
            echo "</div>";
                $i++;
            }
            
        ?>
    </div>
    </div><div id="footer"><center><h1><font color="red">camagru &copy</font></h1></center></div>
</body>
</html>