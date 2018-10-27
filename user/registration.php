<?php
    require_once 'config.php';
    require_once '../ipaddress.php';
    include_once '../PHPMailer/mailer.php';

    date_default_timezone_set("Asia/Singapore");
    $timestamp = date('y-m-d H:i:s',time());

    $msg = "";

    if (isset($_GET['Id'])) {
        $Id = $_GET['Id'];
        
        $SheetName = "";
        $SheetSubject = "";
        $InformationName1 = "";
        $InformationType1 = "";
        $InformationName2 = "";
        $InformationType2 = "";
        $InformationName3 = "";
        $InformationType3 = "";
        $InformationName4 = "";
        $InformationType4 = "";
        $InformationName5 = "";
        $InformationType5 = "";
        $InformationName6 = "";
        $InformationType6 = "";
        $InformationName7 = "";
        $InformationType7 = "";
        $InformationName8 = "";
        $InformationType8 = "";
        $InformationName9 = "";
        $InformationType9 = "";
        $InformationName10 = "";
        $InformationType10 = "";
        
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
            $InformationType1 = $one_search_all_result['InformationType1'];
            $InformationName2 = $one_search_all_result['InformationName2'];
            $InformationType2 = $one_search_all_result['InformationType2'];
            $InformationName3 = $one_search_all_result['InformationName3'];
            $InformationType3 = $one_search_all_result['InformationType3'];
            $InformationName4 = $one_search_all_result['InformationName4'];
            $InformationType4 = $one_search_all_result['InformationType4'];
            $InformationName5 = $one_search_all_result['InformationName5'];
            $InformationType5 = $one_search_all_result['InformationType5'];
            $InformationName6 = $one_search_all_result['InformationName6'];
            $InformationType6 = $one_search_all_result['InformationType6'];
            $InformationName7 = $one_search_all_result['InformationName7'];
            $InformationType7 = $one_search_all_result['InformationType7'];
            $InformationName8 = $one_search_all_result['InformationName8'];
            $InformationType8 = $one_search_all_result['InformationType8'];
            $InformationName9 = $one_search_all_result['InformationName9'];
            $InformationType9 = $one_search_all_result['InformationType9'];
            $InformationName10 = $one_search_all_result['InformationName10'];
            $InformationType10 = $one_search_all_result['InformationType10'];
        }
        mysqli_close($conn);
        
        // 表单提交
        if (isset($_POST['SpreadSheetColumnId']) && isset($_POST['Information1'])) {
            $SpreadSheetColumnId = $_POST['SpreadSheetColumnId'];
            $Information1 = $_POST['Information1'];

            $conn = mysqli_connect(HOST, USER, PASS, DB) or die('Unable to Connect...');

            // 生成三位不重复的验证码
            // 获取当前SpreadSheetColumnId下的所有验证码
            $VerificationCodeArray = array();

            $select_verificationCode_sql = "SELECT * FROM spreadsheetcontent WHERE SpreadSheetColumnId = $SpreadSheetColumnId";
            $select_verificationCode_result = mysqli_query($conn, $select_verificationCode_sql);

            if (!$select_verificationCode_result || mysqli_num_rows($select_verificationCode_result) == 0){

            }
            else {
                while ($one_verificationCode_result = mysqli_fetch_assoc($select_verificationCode_result)) {
                    $VerificationCode = $one_verificationCode_result['VerificationCode'];
                    array_push($VerificationCodeArray, $VerificationCode);
                }
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

            $NewVerificationCode = generateVerificationCode($VerificationCodeArray);

            // 注册记录不可重复
            $count = 0;
            $select_duplicate_sql = "SELECT * FROM spreadsheetcontent WHERE SpreadSheetColumnId = $SpreadSheetColumnId && Information1 = '$Information1'";
            $select_duplicate_result = mysqli_query($conn, $select_duplicate_sql);
            $duplicate_result_found = mysqli_num_rows($select_duplicate_result);

            if($duplicate_result_found >= 1) {
                $count++;
                $msg = "This ID is registered.";
                mysqli_close($conn);
            }

            if($count == 0) {
                $insert_sql_first_half = "INSERT INTO spreadsheetcontent (SpreadSheetColumnId, VerificationCode, Information1";
                $insert_sql_second_half = ", TimeStamp) VALUES ($SpreadSheetColumnId, $NewVerificationCode, '$Information1'";
                
                $Information2 = "";
                $Information3 = "";
                $Information4 = "";
                $Information5 = "";
                $Information6 = "";
                $Information7 = "";
                $Information8 = "";
                $Information9 = "";
                $Information10 = "";

                if(isset($_POST['Information2']) && !empty($_POST['Information2'])) {
                    $Information2 = $_POST['Information2'];

                    if(gettype($Information2) == "array") {
                        $Information2 = implode(",", $Information2);
                    }

                    $insert_sql_first_half = $insert_sql_first_half.", Information2";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$Information2'";
                }
                if(isset($_POST['Information3']) && !empty($_POST['Information3'])) {
                    $Information3 = $_POST['Information3'];

                    if(gettype($Information3) == "array") {
                        $Information3 = implode(",", $Information3);
                    }

                    $insert_sql_first_half = $insert_sql_first_half.", Information3";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$Information3'";
                }
                if(isset($_POST['Information4']) && !empty($_POST['Information4'])) {
                    $Information4 = $_POST['Information4'];

                    if(gettype($Information4) == "array") {
                        $Information4 = implode(",", $Information4);
                    }

                    $insert_sql_first_half = $insert_sql_first_half.", Information4";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$Information4'";
                }
                if(isset($_POST['Information5']) && !empty($_POST['Information5'])) {
                    $Information5 = $_POST['Information5'];

                    if(gettype($Information5) == "array") {
                        $Information5 = implode(",", $Information5);
                    }

                    $insert_sql_first_half = $insert_sql_first_half.", Information5";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$Information5'";
                }
                if(isset($_POST['Information6']) && !empty($_POST['Information6'])) {
                    $Information6 = $_POST['Information6'];

                    if(gettype($Information6) == "array") {
                        $Information6 = implode(",", $Information6);
                    }

                    $insert_sql_first_half = $insert_sql_first_half.", Information6";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$Information6'";
                }
                if(isset($_POST['Information7']) && !empty($_POST['Information7'])) {
                    $Information7 = $_POST['Information7'];

                    if(gettype($Information7) == "array") {
                        $Information7 = implode(",", $Information7);
                    }

                    $insert_sql_first_half = $insert_sql_first_half.", Information7";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$Information7'";
                }
                if(isset($_POST['Information8']) && !empty($_POST['Information8'])) {
                    $Information8 = $_POST['Information8'];

                    if(gettype($Information8) == "array") {
                        $Information8 = implode(",", $Information8);
                    }

                    $insert_sql_first_half = $insert_sql_first_half.", Information8";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$Information8'";
                }
                if(isset($_POST['Information9']) && !empty($_POST['Information9'])) {
                    $Information9 = $_POST['Information9'];

                    if(gettype($Information9) == "array") {
                        $Information9 = implode(",", $Information9);
                    }

                    $insert_sql_first_half = $insert_sql_first_half.", Information9";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$Information9'";
                }
                if(isset($_POST['Information10']) && !empty($_POST['Information10'])) {
                    $Information10 = $_POST['Information10'];

                    if(gettype($Information10) == "array") {
                        $Information10 = implode(",", $Information10);
                    }

                    $insert_sql_first_half = $insert_sql_first_half.", Information10";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$Information10'";
                }

                // 插入新的记录
                $insert_sql = $insert_sql_first_half.$insert_sql_second_half.", '$timestamp')";
                $insert_result = mysqli_query($conn, $insert_sql);

                // 获取这条新记录的ID
                $search_content_sql = "SELECT Id FROM spreadsheetcontent ORDER BY Id DESC LIMIT 1";
                $search_content_result = mysqli_query($conn, $search_content_sql);
                $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                $SpreadSheetContentId = $one_search_content_result['Id'];

                // 是否有其它信息
                $spreadsheetcolumn_sql = "SELECT * FROM spreadsheetcolumn WHERE Id = $SpreadSheetColumnId";
                $spreadsheetcolumn_result = mysqli_query($conn, $spreadsheetcolumn_sql);
                $one_spreadsheetcolumn_result = mysqli_fetch_assoc($spreadsheetcolumn_result);
                $SheetName = $one_spreadsheetcolumn_result['SheetName'];
                $Feedback = $one_spreadsheetcolumn_result['Feedback'];
                $IsEmailNotification = $one_spreadsheetcolumn_result['IsEmailNotification'];
                $isOtherInformation = $one_spreadsheetcolumn_result['isOtherInformation'];
                
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
                    
                    /* ========================= 把PHPMialer放在远程服务器 ============================== */
                    $url = "https://$ipaddress/EventDat/PHPMailer/mailer.php";

                    $bodys = array(
                        'Subject' => "$SheetName",
                        'Email' => "$Information1",
                        'Feedback' => "$Feedback"
                    );

                    $res = request_post($url, $bodys);
                    $msg = $res;
                    /* ================================================================================ */
                }

                mysqli_close($conn);

                if($isOtherInformation == 1) {
                    header("Location:result.php?SpreadSheetContentId=$SpreadSheetContentId&&SpreadSheetColumnId=$SpreadSheetColumnId&&isOtherInformation=1");
                }
                else {
                    header("Location:result.php?SpreadSheetContentId=$SpreadSheetContentId&&SpreadSheetColumnId=$SpreadSheetColumnId&&isOtherInformation=0");
                }
            }
        }
    }
    else {
        header("Location:404.php");
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
        <link rel='stylesheet' href='css/registration.css' type='text/css' />
    </head>
    <body>
        <h1 class="title">Registration</h1>
        <h2 class="subtitle"><?php echo $SheetName; ?></h2>
        <p class="subject"><?php echo $SheetSubject; ?></p>
        <div class="registrationContainer">
            <form method="post" action="registration.php?Id=<?php echo $Id; ?>">
                <input type="hidden" name="SpreadSheetColumnId" value="<?php echo $Id; ?>" />
                <?php
                    if(!empty($InformationName1)) {
                    ?>
                        <div class="Information">
                            <label class="label"><?php echo $InformationName1; ?> <label style="color:red;">(ID)</label>:</label><br>
                            <input type="text" name="Information1" required/><br>
                        </div>
                    <?php
                    }
                    for($i=2; $i<=10; $i++) {
                        $InformationName = "InformationName".$i;
                        $InformationType = "InformationType".$i;
                        
                        if(!empty($$InformationName)) {
                        ?>
                            <div class="Information">
                                <label class="label"><?php echo $$InformationName; ?>:</label><br>
                                <?php
                                if($$InformationType == "DorpdownList") {
                                    $conn = mysqli_connect(HOST, USER, PASS, DB) or die('Unable to Connect...');
                                    $select_sql = "SELECT * FROM information".$i." WHERE SpreadSheetColumnId = $Id";
                                    $select_result = mysqli_query($conn, $select_sql);
                                    if (!$select_result || mysqli_num_rows($select_result) == 0){
                                        
                                    }
                                    else {
                                    ?>
                                        <select name="Information<?php echo $i; ?>" > 
                                        <?php
                                        while ($one_select_result = mysqli_fetch_assoc($select_result)) {
                                            $Content = $one_select_result['Content'];
                                            ?>
                                                <option value="<?php echo $Content; ?>"><?php echo $Content; ?></option>
                                            <?php
                                        }
                                        ?>
                                        </select><br>
                                    <?php
                                    }
                                    mysqli_close($conn);
                                }
                                else if($$InformationType == "Radio") {
                                    $conn = mysqli_connect(HOST, USER, PASS, DB) or die('Unable to Connect...');
                                    $select_sql = "SELECT * FROM information".$i." WHERE SpreadSheetColumnId = $Id";
                                    $select_result = mysqli_query($conn, $select_sql);
                                    if (!$select_result || mysqli_num_rows($select_result) == 0){
                                        
                                    }
                                    else {
                                    ?>
                                        <div class="radioContainer">
                                        <?php
                                            $j = 0;
                                            while ($one_select_result = mysqli_fetch_assoc($select_result)) {
                                                $Content = $one_select_result['Content'];
                                                ?>
                                                <div class="radioItemContainer">
                                                    <input type="radio" name="Information<?php echo $i; ?>" value='<?php echo $Content; ?>' <?php if($j==0){echo "checked";} ?>/><label><?php echo $Content; ?></label>
                                                </div>
                                                <?php
                                                $j++;
                                            }
                                        ?>
                                        </div>
                                    <?php
                                    }
                                    mysqli_close($conn);
                                }
                                else if($$InformationType == "CheckBox") {
                                    $conn = mysqli_connect(HOST, USER, PASS, DB) or die('Unable to Connect...');
                                    $select_sql = "SELECT * FROM information".$i." WHERE SpreadSheetColumnId = $Id";
                                    $select_result = mysqli_query($conn, $select_sql);
                                    if (!$select_result || mysqli_num_rows($select_result) == 0){
                                        
                                    }
                                    else {
                                    ?>
                                        <div class="checkBoxContainer">
                                        <?php
                                            while ($one_select_result = mysqli_fetch_assoc($select_result)) {
                                                $Content = $one_select_result['Content'];
                                                ?>
                                                <div class="checkBoxItemContainer">
                                                    <input type="checkbox" name="Information<?php echo $i; ?>[]" value='<?php echo $Content; ?>' /><label><?php echo $Content; ?></label>
                                                </div>
                                                <?php
                                            }
                                        ?>
                                        </div>
                                    <?php
                                    }
                                    mysqli_close($conn);
                                }
                                else {
                                ?>
                                    <input type="text" name="Information<?php echo $i; ?>" /><br>
                                <?php
                                }
                                ?>
                            </div>
                        <?php
                        }
                    }
                ?>
                <div class="formBTN">
                    <input type="submit" value="Sign In"/><br>
                    <a href="signIn.php?Id=<?php echo $Id; ?>">Forget?</a>
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

<script>
    function signIn() {
        window.location.href = "signIn.php?Id=<?php echo $Id; ?>";
    }
</script>