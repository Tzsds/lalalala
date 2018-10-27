<?php
    require_once 'config.php';
    
    $msg = "";

    if(isset($_POST['email'])) {
        if(empty($_POST['email'])) {
            $msg = "Please enter your email.";
        }
        else {
            $Email = $_POST['email'];
            
            $conn = mysqli_connect(HOST, USER, PASS, DB) or die('Unable to Connect...');
            
            $search_sql = "SELECT * FROM admin WHERE Email = '$Email' && IsEmailConfirmed = 1";
            $search_result = mysqli_query($conn, $search_sql);
            $result_found = mysqli_num_rows($search_result);
            
            mysqli_close($conn);
            
            if($result_found >= 1) {
                session_start();
                $_SESSION['Email'] = $Email;
                header("Location:sheet.php");
            }
            else {
                $msg = "Login failed.";
            }
        }
    }
?>



<!DOCTYLE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>EventDat</title>
        <link rel='stylesheet' href='css/login.css' type='text/css' />
    </head> 
    <body>
        <h1 class="title">Login</h1>
        <div class="loginContainer">
            <form method="post" action="login.php">
                <label class="label">Email:</label>
                <input type="email" name="email" required/>
                <div class="formBTN">
                    <input type="submit" value="Login" />
                    <a href="registration.php"><button type="button">Register</button></a>
                </div>
            </form>
            <?php
                if($msg != "") {
                    echo "<p class='msg'>".$msg."</p>";
                }
            ?>
        </div>
    </body>
</html>