<?php
    require_once 'config.php';

    date_default_timezone_set("Asia/Singapore");
    $timestamp = date('y-m-d H:i:s',time());

    $msg = "";

    if (isset($_GET['Id'])) {
        $Id = $_GET['Id'];
        
        $SheetName = "";
        $SheetSubject = "";
        
        $conn = mysqli_connect(HOST, USER, PASS, DB) or die('Unable to Connect...');
        
        $search_all_sql = "SELECT * FROM spreadsheetcolumn WHERE Id = $Id";
        $search_all_result = mysqli_query($conn, $search_all_sql);
        
        if (!$search_all_result || mysqli_num_rows($search_all_result) == 0){
            
        }
        else {
            $one_search_all_result = mysqli_fetch_assoc($search_all_result);
            $SheetName = $one_search_all_result['SheetName'];
            $SheetSubject = $one_search_all_result['SheetSubject'];
            $InformationName1 = $one_search_all_result['InformationName1'];
        }
        mysqli_close($conn);
        
        // 表单提交
        if (isset($_POST['Information1'])) {
            $Information1 = $_POST['Information1'];
            $conn = mysqli_connect(HOST, USER, PASS, DB) or die('Unable to Connect...');
            $search_contentId_sql = "SELECT * FROM spreadsheetcontent WHERE SpreadSheetColumnId = $Id && Information1 = '$Information1'";
            $search_contentId_result = mysqli_query($conn, $search_contentId_sql);
            
            if (!$search_contentId_result || mysqli_num_rows($search_contentId_result) == 0){
                $msg = "ID does not exist";
                mysqli_close($conn);
            }
            else {
                $one_search_contentId_result = mysqli_fetch_assoc($search_contentId_result);
                $SpreadSheetContentId = $one_search_contentId_result['Id'];
                $VerificationCode = $one_search_contentId_result['VerificationCode'];
                
                $search_columnId_sql = "SELECT * FROM spreadsheetcolumn WHERE Id = $Id";
                $search_columnId_result = mysqli_query($conn, $search_columnId_sql);
                
                if (!$search_columnId_result || mysqli_num_rows($search_columnId_result) == 0){
                    
                }
                else {
                    $one_search_columnId_result = mysqli_fetch_assoc($search_columnId_result);
                    $Feedback = $one_spreadsheetcolumn_result['Feedback'];
                    $IsEmailNotification = $one_spreadsheetcolumn_result['IsEmailNotification'];
                    $isOtherInformation = $one_search_columnId_result['isOtherInformation'];
                    
                    if($VerificationCode == "") {
                        // 生成三位不重复的验证码
                        // 获取当前SpreadSheetColumnId下的所有验证码
                        $VerificationCodeArray = array();

                        $select_verificationCode_sql = "SELECT * FROM spreadsheetcontent WHERE SpreadSheetColumnId = $Id";
                        $select_verificationCode_result = mysqli_query($conn, $select_verificationCode_sql);

                        if (!$select_verificationCode_result || mysqli_num_rows($select_verificationCode_result) == 0){

                        }
                        else {
                            while ($one_verificationCode_result = mysqli_fetch_assoc($select_verificationCode_result)) {
                                $VerificationCode = $one_verificationCode_result['VerificationCode'];
                                array_push($VerificationCodeArray, $VerificationCode);
                            }
                        }

                        $NewVerificationCode = generateVerificationCode($VerificationCodeArray);
                        $update_verification_code_sql = "UPDATE spreadsheetcontent SET VerificationCode = $NewVerificationCode, TimeStamp = '$timestamp' WHERE Id = $SpreadSheetContentId";
                        $update_verification_code_result = mysqli_query($conn, $update_verification_code_sql);
                        
                        if($IsEmailNotification == 1) {
                            $Feedback = str_replace("_@informationBTN1@_", "$Information1", $Feedback);
                            $Feedback = str_replace("_@informationBTN2@_", "$Information2", $Feedback);
                            $Feedback = str_replace("_@informationBTN3@_", "$Information3", $Feedback);
                            $Feedback = str_replace("_@informationBTN4@_", "$Information4", $Feedback);
                            $Feedback = str_replace("_@informationBTN5@_", "$Information5", $Feedback);
                            $Feedback = str_replace("_@informationBTN6@_", "$Information6", $Feedback);
                            $Feedback = str_replace("_@informationBTN7@_", "$Information7", $Feedback);
                            $Feedback = str_replace("_@informationBTN8@_", "$Information8", $Feedback);
                            $Feedback = str_replace("_@informationBTN9@_", "$Information9", $Feedback);
                            $Feedback = str_replace("_@informationBTN10@_", "$Information10", $Feedback);

                            /* ========================= 把PHPMialer放在远程服务器 ========================== */
                            $url = "https://$ipaddress/EventDat/PHPMailer/mailer.php";

                            $bodys = array(
                                'Email' => "$Information1",
                                'Feedback' => "$Feedback"
                            );

                            $res = request_post($url, $bodys);
                            $msg = $res;
                            /* =========================================================================== */
                        }
                    }
                    
                    $url = "result.php?SpreadSheetContentId=$SpreadSheetContentId&&SpreadSheetColumnId=$Id&&isOtherInformation=$isOtherInformation";
                    header("Location:$url");
                }
                
                mysqli_close($conn);
            }
        }
    }
    else {
        header("Location:404.php");
    }

    // 生成验证码
    function generateVerificationCode($VerificationCodeArray) {
        // 生成三位数
        $RandomNumber = mt_rand(100, 999);
        // 不可重复
        if(count($VerificationCodeArray) > 0) {
            $DuplicatedCode = 0;
            for($j=0; $j<count($VerificationCodeArray); $j++) {
                if($VerificationCodeArray[$j] == $RandomNumber) {
                    $DuplicatedCode++;
                    break;
                }
            }
            if($DuplicatedCode != 0) {
                generateVerificationCode();
            }
            else {
                return $RandomNumber;
            }
        }
        else {
            return $RandomNumber;
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
        <meta name="viewport" content="initial-scale=1, maximum-scale=3, minimum-scale=1, user-scalable=yes">
        <title>EventDat</title>
        <link rel='stylesheet' href='css/signIn.css' type='text/css' />
        <script type="text/javascript" src="../js/jquery.min.js"></script>
    </head>
    <body>
        <h1 class="title">Sign In</h1>
        <h2 class="subtitle"><?php echo $SheetName; ?></h2>
        <p class="subject"><?php echo $SheetSubject; ?></p>
        <div class="signInContainer">
            <form method="post" action="signIn.php?Id=<?php echo $Id; ?>">
                <input type="hidden" name="SpreadSheetColumnId" value="<?php echo $Id; ?>" />
                <div class="Information1Container">
                    <label class="label" for="chooseInformation1"><?php echo $InformationName1; ?> <label style="color:red;">(ID):</label></label><br>
                    <input type="text" name="Information1" />
                </div>
                <div class="formBTN">
                    <input type="submit" value="Submit"/><br>
                    <a href="registration.php?Id=<?php echo $Id; ?>">Register</a>
                </div>
            </form>
        </div>
        <?php
            if($msg != "") {
                echo "<p class='msg'>".$msg."</p>";
            }
        ?>
    </body>
</html>