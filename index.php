<?php
error_reporting(0);
ini_set('display_errors', 0);
    session_start();
    include("connection.php");
    include('validation.php');
    include("email_notify.php");
    include('nev1.php');
    $bar = new validation;
    $id = $bar->get_user($_SESSION['userid']);
    $uid = $id[0]['userid'];
    $retrive = array();
    $not_val = "";
    foreach($_POST as $key => $value)
        $retrive[$key] = $value;
    if ($_SESSION["userid"]  && isset($_POST["submit"]))
    {
        if($retrive['comment'] && $retrive['userid'] && $_SESSION['userid'] && $retrive['imagenu'])
        {
            include_once('commentnlike.php');
            $ad = new commentnlike();
            $ad->addcomment($retrive['comment'], $uid, $retrive['userid'], $retrive['imagenu']);
            if (notification_id($retrive['userid'])){
                $ad->emailcomment($retrive['userid'], 'comment');
            }
            
            unset($ad);
            header('location: index.php');
        }
    }elseif ($_SESSION["userid"] && isset($_POST['like']))
    {
        if($retrive['like'] && $_SESSION['userid'])
        {
            include_once('commentnlike.php');
            $ad = new commentnlike();
            $ad->addlike($uid, $retrive['like'], $retrive['imagenu']);
            $ad->emailcomment($retrive['userid'], 'like');
            unset($ad);
            header('location: index.php');
        }
    }
    $numperpage = 5;
    // $page = 0;
        $sql1 = "SELECT * FROM userimage ORDER BY timess DESC";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->execute();
        $re = $stmt1->setFetchMode(PDO::FETCH_ASSOC);
        $rows = $stmt1->fetchAll();

        $numrecords = count($rows);
        $numlinks = ceil($numrecords/$numperpage);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style.css">
    <title>Gallery</title>

</head>
<body>
    <div id='all'>
        <?php
            include_once('pictures_functions.php');
            include_once('commentnlike.php');
            $hold = new commentnlike();
            $arr = new picdb();
            $display = $arr->getall();
            $i = 0;
            while($i < count($display))
            {
                echo '<div style="width: 450px; hight: 450px; margin-left: 450px; margin-bottom: 30px;"><div><img src="'.$display[$i]['images'].'" style="width: 450px; hight: 450px;"></div>';
                if($_SESSION['userid'])
                {
                    $lik = count($hold->getlikes($display[$i]['num']));
                    
                    $holds = $hold->getcomments($display[$i]['num']);
                    echo '<div id="'.$display[$i]['timess'].'"><button hidden id="'.$display[$i]['timess'].'" onclick="displays('.$display[$i]['num'].','.$display[$i]['timess'].')">comment '.count($holds).'</button>';
                    echo '<form action="index.php" method="post"><button id="'.$display[$i]['timess'].'" type="submit" name="like" value="'.$display[$i]['userid'].'">like '.$lik.'</button>';
                    echo '<input type="hidden" name="imagenu" value="'.$display[$i]['num'].'"></form></div><br/>';

                    // echo '<div id="'.$display[$i]['num'].'" style="display:none;">';
                    echo '<div id="'.$display[$i]['num'].'" >';
                    $j = 0;
                    while($j < count($holds))
                    {
                       echo '<textarea rows="4" cols="50" disabled>'.$holds[$j]['comment'].'</textarea>';
                       $j++;
                    }
                    echo '<form action="index.php" method="post"><textarea name="comment"  id="'.$display[$i]['num'].'" rows="4" cols="50"></textarea>';
                    echo '<input type="hidden" name="userid" value="'.$display[$i]['userid'].'">';
                    echo '<input type="hidden" name="imagenu" value="'.$display[$i]['num'].'">';
                    echo '<button type="submit" value="comment" id="'.$display[$i]['num'].'" name="submit">comment</button></form></div>';
                    unset($holds);
                }
                echo '</div>';
                $i++;
            }
            unset($hold); 
        ?>
    </div>
    <script>
        function displays($val, $datess)
        {
            document.getElementById($val).style.display = "initial";
            document.getElementById($datess).style.display = "none";
        }
    </script>
        <form action="" method="POST">
            <?php
                for ($i = 1; $i <= $numlinks; $i++){
                    ?>
                    <input type="submit" value= "<?php echo $i;?>" name = "page">
                    <?php
                }?>
        </form>
        <div id="footer"><center><h1>camagru &copy</h1></center></div>
</body>
</html>