<?php
    require_once 'config.php';
    require_once '../ipaddress.php';

    session_start();

    if (isset($_SESSION['Email']) && isset($_GET['Id'])) {
        $Email = $_SESSION['Email'];
        $Id = $_GET['Id'];
        
        $msg = "";
        
        // 表单提交
        if(isset($_POST['feedback'])) {
            $feedback = $_POST['feedback'];
            if(isset($_POST["emailNotification"])) {
                $spreadSheetContentIds = "";
                $emailNotification = $_POST["emailNotification"];
                for($i=0; $i<count($emailNotification); $i++) {
                    $spreadSheetContentIds = $spreadSheetContentIds.$emailNotification[$i].",";
                }
                $spreadSheetContentIds = substr($spreadSheetContentIds, 0, strlen($spreadSheetContentIds)-1);

                $feedback = $_POST['feedback'];

                for($i=1; $i<=10; $i++) {
                    $feedback = str_replace("<img src=\"../image/informationBTN$i.png\" style=\"height:16px;\">", "_@informationBTN$i@_", $feedback);
                }
                
                $feedback = str_replace("<div><br></div>", "<br>", $feedback);
                $feedback = str_replace("<div>", "<br>", $feedback);
                $feedback = str_replace("</div>", "", $feedback);
                
                /* ============================= 把PHPMialer放在远程服务器 ==================================== */
                $url = "https://$ipaddress/EventDat/PHPMailer/mailer.php";

                $bodys = array(
                    'Id' => "$Id",
                    'SpreadSheetContentIds' => "$spreadSheetContentIds",
                    'Feedback' => "$feedback"
                );
                
                $res = request_post($url, $bodys);
                $msg = $res;
                /* ========================================================================================= */
            }
        }
    }
    else {
        header("Location:login.php");
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
        <link rel='stylesheet' href='css/emailNotification.css' type='text/css' />
    </head>
    <body>
        <h1 class="title">Email Notification</h1>
        <?php
            if (isset($_SESSION['Email'])) {
                $Email = $_SESSION['Email'];
                echo "<p class='email'>Hello, $Email</p>";
            }
        ?>
        
        <form method="post" action="emailNotification.php?Id=<?php echo $Id;?>" onsubmit="return checkSubmit()">
            <div class="emailFieldsetContainer">
                <fieldset class="emailFieldset">
                    <legend>Emails</legend>
                    <p class="Introduction">Emails from user details</p>
                    <?php
                        $conn = mysqli_connect(HOST, USER, PASS, DB) or die('Unable to Connect...');
                    
                        $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE SpreadSheetColumnId = $Id";
                        $search_content_result = mysqli_query($conn, $search_content_sql);

                        if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){

                        }
                        else {
                            while ($one_search_content_result = mysqli_fetch_assoc($search_content_result)) {
                                $spreadSheetContentId = $one_search_content_result["Id"];
                                $Information1 = $one_search_content_result["Information1"];
                                ?>
                                    <div class="emailNotificationContainer">
                                        <input type="checkbox" id="<?php echo $spreadSheetContentId; ?>" class="emailNotification" name="emailNotification[]" value="<?php echo $spreadSheetContentId; ?>" checked><label for="<?php echo $spreadSheetContentId; ?>"><?php echo $Information1; ?></label>
                                    </div>
                                <?php
                            }
                        }
                        mysqli_close($conn);
                    ?>
                </fieldset>
            </div>
            <div class="feedbackFieldsetContainer">
                <fieldset class="feedbackFieldset">
                    <legend>Feedback</legend>
                    <p class="Introduction">Feedback will be shown in the email</p>
                    <p class="Introduction2">You can click the button below to insert the information into your feedback</p>
                    <div id="feedback" class='feedback' contenteditable="true"></div>
                    <input type="hidden" id="feedbackHidden" name="feedback" />
                    <div class="feedbackBTN">
                    <?php
                        $conn = mysqli_connect(HOST, USER, PASS, DB) or die('Unable to Connect...');
                    
                        $search_column_sql = "SELECT * FROM SpreadSheetColumn WHERE Id = $Id";
                        $search_column_result = mysqli_query($conn, $search_column_sql);

                        if (!$search_column_result || mysqli_num_rows($search_column_result) == 0){

                        }
                        else {
                            while ($one_search_column_result = mysqli_fetch_assoc($search_column_result)) {
                                for($column=1; $column<=10; $column++) {
                                    $InformationName = "InformationName".$column;
                                    $$InformationName = $one_search_column_result["InformationName$column"];
                                    if(!empty($$InformationName)) {
                                    ?>    
                                        <button class="FBbutton" type="button" onclick="insertinformation('informationBTN<?php echo $column?>')">Information <?php echo $column?>: <br><?php echo $$InformationName?></button>
                                    <?php 
                                    }  
                                }
                            }
                        }
                        mysqli_close($conn);
                    ?>
                    </div>
                </fieldset>
            </div>
            <!--================================= Submit ==============================================-->
            <div class="formBTN">
                <input type="submit" value="Send" />
                <a href="sheet.php"><input type="button" value="Back" /></a>
                <?php
                    if($msg != "") {
                        echo "<label class='msg'>$msg</label>";
                    }
                ?>
            </div>
        </form>
    </body>
</html>

<!--================================= Feedback =======================================-->
<script>
    // 清除复制黏贴的样式
    document.querySelector('div[contenteditable="true"]').addEventListener("paste", function(e) {
        e.preventDefault();
        var text = e.clipboardData.getData("text/plain");
        document.execCommand("insertHTML", false, text);
    });
    
    // 插入信息
    function insertinformation(id) {
        var content = document.getElementById("feedback").innerHTML;
        // 判断结尾是否为</div>
        if(content.substring(content.length-6,content.length) == "</div>") {
            content = content.substring(0,content.length-6);
            document.getElementById("feedback").innerHTML = content + "<img src='../image/" + id + ".png' style='height:16px;'/>" + "</div>";
        }
        else {
            document.getElementById("feedback").innerHTML = content + "<img src='../image/" + id + ".png' style='height:16px;'/>";
        }
    }
</script>

<!--================================= Check Submit =======================================-->
<script>
    function checkSubmit() {
        var temp = document.getElementById("feedback").innerHTML;
        if(temp == "") {
            alert("Please fill in the feedback field");
            return false;
        }
        else {
            temp = escapeToHtml(temp);
            document.getElementById("feedbackHidden").value = temp;
            return true;
        }
    }
    
    function escapeToHtml(str) {
        var arrEntities={'lt':'<','gt':'>','nbsp':' ','amp':'&','quot':'"'};
        return str.replace(/&(lt|gt|nbsp|amp|quot);/ig,function(all,t){return arrEntities[t];});
    }
</script>