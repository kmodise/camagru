<?php
        
        echo "<div id='boxNavigation'>";
         echo "<div id='buttons'>";
            if ($_SESSION["userid"])
            {
                echo '<a href="gallery.php"><h1><font color="red"</font>Profile</h1></a> ';
                echo '<a href="logout.php"><h1><font color="red"</font>logout</h1></a> ';
                echo '<a href="settings.php"><h1><font color="red"</font>settings</h1></a>';
            }else
            {
                echo '<a href="login.php"><h1><font color="red"</font>login</h1></a> ';
                echo '<a href="register.php"><h1><font color="red"</font>Register</h1></a>';
            }
        echo "</div>";
        echo "</div>";
?>