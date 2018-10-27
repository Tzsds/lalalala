<?php
    require_once 'config.php';
    require_once '../ipaddress.php';
    include_once '../PHPMailer/mailer.php';
    
    $msg = "";

    if(isset($_POST['email']) && isset($_POST['verify'])) {
        if(empty($_POST['email'])) {
            $msg = "Please enter your email.";
        }
        else {
            $Email = $_POST['email'];
            
            $Token = "qwertyuiopASDFGHJKLzxcvbnm[]\;',./";
            $Token = str_shuffle($Token);
            $Token = substr($Token, 0, 10);
            
            $conn = mysqli_connect(HOST, USER, PASS, DB) or die('Unable to Connect...');
            
            $count = 0;
            $search_sql = "SELECT Email FROM admin WHERE Email = '$Email'";
            $search_result = mysqli_query($conn, $search_sql);

            if (!$search_result || mysqli_num_rows($search_result) == 0){
                $count++;
            }
            else {
                $msg = "Email existed already.";
            }
            
            mysqli_close($conn);
            
            if($count != 0) {
                
                /* ============================= 把PHPMialer放在远程服务器 ==================================== */
                $url = "https://$ipaddress/EventDat/PHPMailer/mailer.php";

                $bodys = array(
                    'Email' => "$Email",
                    'Token' => "$Token"
                );
                
                $res = request_post($url, $bodys);
                $msg = $res;
                /* ========================================================================================= */
                
                $conn = mysqli_connect(HOST, USER, PASS, DB) or die('Unable to Connect...');
                $insert_sql = "INSERT INTO admin (Email, IsEmailConfirmed, Token) VALUES ('$Email', 0, '$Token')";
                $insert_result = mysqli_query($conn, $insert_sql);
                mysqli_close($conn);
            }
        }
    }

    function request_post($url = '', $param = '') {
        if (empty($url) || empty($param)) {
            return false;
        }

        $postUrl = $url;
        $curlPost = $param;
        // 初始化curl
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $postUrl);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        // 要求结果为字符串且输出到屏幕上
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        // post提交方式
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
        // 运行curl
        $data = curl_exec($curl);
        curl_close($curl);
        
        return $data;
    }
?>



<!DOCTYLE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>EventDat</title>
        <link rel='stylesheet' href='css/registration.css' type='text/css' />
    </head>
    <body>
        <h1 class="title">Registration</h1>
        <div class="registrationContainer">
            <form method="post" action="registration.php">
                <label class="label">Email:</label>
                <input type="email" name="email" value="<?php 
                    if(isset($_POST['email']) && isset($_POST['verify'])){
                        echo $_POST['email'];
                    } ?>" required/>
                <input type="hidden" name="verify" />
                <div class="formBTN">
                    <input type="submit" value="Send" />
                    <a href="login.php"><button type="button">Login</button></a>
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