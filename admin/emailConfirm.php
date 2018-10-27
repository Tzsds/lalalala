<?php
    require_once 'config.php';
    require_once '../ipaddress.php';

    $msg = "";
    $IsEmailConfirmed = false;

    if(isset($_GET['email']) && isset($_GET['token'])) {
        $Email = $_GET['email'];
        $Token = $_GET['token'];
        
        $conn = mysqli_connect(HOST, USER, PASS, DB) or die('Unable to Connect...');
        
        $search_sql = "SELECT * FROM admin WHERE Email = '$Email' && Token = '$Token'";
        $search_result = mysqli_query($conn, $search_sql);
        $result_found = mysqli_num_rows($search_result);
        
        if($result_found >= 1) {
            $update_sql = "UPDATE admin SET IsEmailConfirmed = 1 WHERE Email = '$Email'";
            $update_result = mysqli_query($conn, $update_sql);
            $IsEmailConfirmed = true;
            $msg = "Email verified successfully!";
        }
        else {
            $msg = "Email or Token is not correct. Please verify again.";
        }
        
        mysqli_close($conn);
    }
    else {
        $msg = "Something wrong happened!";
    }
?>



<!DOCTYLE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Email Confirm</title>
        <link rel='stylesheet' href='css/emailConfirm.css' type='text/css' />
    </head>
    <body>
        <h1 class="title">Email Confirm</h1>
        <?php
            if($IsEmailConfirmed) {
                echo "<p class='login'><a href='http://$ipaddress/EventDat/admin/login.php'>Login</a></p>";
            }
            if($msg != "") {
                echo "<p class='msg'>".$msg."</p>";
            }
        ?>
    </body>
</html>