<?php
//remove when doe or before marking
//  ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
    session_start();
    include_once('validation.php');
    include_once('cam_sticker_merge.php');
    include('nev1.php');
    if (!$_SESSION['userid'])
        header('Location: login.php');
    $bar = new validation;
    $id = $bar->get_user($_SESSION['userid']);
    $uid = $id[0]['userid'];
    if ($_POST['ims'])
    {
        include('savimg.php');
        $ar = new saveimg();
        $ar->saveimg($_POST['ims'], $uid);
        $s = shell_exec('rm merge.png');
        $s = shell_exec('rm canvas.jpeg');
        header("Location: gallery.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Edit</title>
 
</head>
<body>
    <div style="float: left; margin-left: 500px;">
        <form action="cam.php" method="post">
            <div class="video-wrap" >
                <video id="video" playsinline autoplay></video>
            </div>

                <input type="hidden" value="" id="image" name="image">
            <div>
                <button id="snap" type="submit">Capture</button>
                eyes<input type="radio" id="rad" name="rad" value="eyes">
                shit<input type="radio" id="rad" name="rad" value="shit">
                lol<input type="radio" id="rad" name="rad" value="lol">
            </div><div id="footer"><center><h1><font color="red">camagru &copy</font></h1></center></div>

            <canvas id="canvas" width="450" height="450" style="float:left;"></canvas>
        </form>
    </div>
    <div style="float: right; width: 400px; hight: auto;">
        <form action="cam.php" method="post">
        <?php
            include_once('pictures_functions.php');
            $arr = new picdb();
            $display = $arr->getsave();
            $i = 0;
            while($i < count($display))
            {
                echo '<button id="s" name="ims" value="'.$display[$i]['images'].'"><img src="'.$display[$i]['images'].'" style="width: 100px; hight: 100px;" ></button>';
                $i++;
            } 
        ?>
        </form>
        <button id="save" style="display: none;">Save</button>
    </div>
    <div id="imagediv">
         <img src="" id="saveimage" style="float: left; border: 1px solid black; margin-left: 10px;">
    </div>
    <script>
            'use strict';
            const video = document.getElementById('video');
            const canvas = document.getElementById('canvas');
            const snap = document.getElementById('snap');
            const image = document.getElementById("image");
            const errorMsgElement = document.getElementById('span#ErrorMsg');
            const constraints = {
                video:{
                    width: 450, height: 450
                }
            };
            async function init()
            {
                try {
                    const stream = await navigator.mediaDevices.getUserMedia(constraints);
                    handleSuccess(stream);
                } catch (e) {
                    errorMsgElement.innerHTML = 'navigator.getUserMedia.error:${e.toString()}';
                }
            }
            function handleSuccess(stream){
                window.stream = stream;
                video.srcObject = stream;
            }
            init();
            var context = canvas.getContext('2d');
            snap.addEventListener("click", function(){
                context.drawImage(video, 0, 0, 450, 450);
                const dataURI = canvas.toDataURL();
                image.setAttribute('value', dataURI);

            });

        </script>
        

</body>
</html>