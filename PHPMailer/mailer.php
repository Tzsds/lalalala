<?php
    // Include PHPMailerAutoload.php
    require_once 'phpmailer/PHPMailerAutoload.php';
    require_once '../ipaddress.php';

    if(isset($_POST['Email']) && isset($_POST['Token'])) {
        
        $getIpaddress = $ipaddress;
        $Recipient = $_POST['Email'];
        $Token = $_POST['Token'];
        
        $msg = phpMailerToken($getIpaddress, $Recipient, $Token);
        echo "Email Sent!";
    }

    if(isset($_POST['Subject']) && isset($_POST['Email']) && isset($_POST['Feedback'])) {
        
        $Subject = $_POST['Subject'];
        $Recipient = $_POST['Email'];
        $Feedback = $_POST['Feedback'];
        
        $msg = phpMailerAutoFeedback($Subject, $Recipient, $Feedback);
        echo "Email Sent!";
    }

    if(isset($_POST['Id']) && isset($_POST['SpreadSheetContentIds']) && isset($_POST['Feedback'])) {
        
        require_once 'config.php';
        
        $Id = $_POST['Id'];
        $SpreadSheetContentIds = $_POST['SpreadSheetContentIds'];
        $Feedback = $_POST['Feedback'];
        $select_sql_second_half = "";
        
        $SpreadSheetContentIdArray = explode(",", $SpreadSheetContentIds);
        
        $conn = mysqli_connect(HOST, USER, PASS, DB) or die('Unable to Connect...');
        
        $SheetName = "";
        
        $spreadsheetcolumn_sql = "SELECT * FROM spreadsheetcolumn WHERE Id = $Id";
        $spreadsheetcolumn_result = mysqli_query($conn, $spreadsheetcolumn_sql);
        
        if (!$spreadsheetcolumn_result || mysqli_num_rows($spreadsheetcolumn_result) == 0){

        }
        else {
            $one_spreadsheetcolumn_result = mysqli_fetch_assoc($spreadsheetcolumn_result);
            $SheetName = $one_spreadsheetcolumn_result['SheetName'];
        }
        
        $qqq = ",";
        
        for($i=0; $i<count($SpreadSheetContentIdArray); $i++) {
            
            $initFeedback = $Feedback;
            $select_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentIdArray[$i]";
            $select_sql_result = mysqli_query($conn, $select_sql);

            if (!$select_sql_result || mysqli_num_rows($select_sql_result) == 0){

            }
            else {
                $one_select_sql_result = mysqli_fetch_assoc($select_sql_result);
                $Information1 = $one_select_sql_result['Information1'];
                if(strpos($initFeedback, 'informationBTN1') !== false){
                    $initFeedback = str_replace("_@informationBTN1@_", "$Information1", $initFeedback);
                }
                if(strpos($initFeedback, 'informationBTN2') !== false){
                    $Information2 = $one_select_sql_result['Information2'];
                    $initFeedback = str_replace("_@informationBTN2@_", "$Information2", $initFeedback);
                }
                if(strpos($initFeedback, 'informationBTN3') !== false){
                    $Information3 = $one_select_sql_result['Information3'];
                    $initFeedback = str_replace("_@informationBTN3@_", "$Information3", $initFeedback);
                }
                if(strpos($initFeedback, 'informationBTN4') !== false){
                    $Information4 = $one_select_sql_result['Information4'];
                    $initFeedback = str_replace("_@informationBTN4@_", "$Information4", $initFeedback);
                }
                if(strpos($initFeedback, 'informationBTN5') !== false){
                    $Information5 = $one_select_sql_result['Information5'];
                    $initFeedback = str_replace("_@informationBTN5@_", "$Information5", $initFeedback);
                }
                if(strpos($initFeedback, 'informationBTN6') !== false){
                    $Information6 = $one_select_sql_result['Information6'];
                    $initFeedback = str_replace("_@informationBTN6@_", "$Information6", $initFeedback);
                }
                if(strpos($initFeedback, 'informationBTN7') !== false){
                    $Information7 = $one_select_sql_result['Information7'];
                    $initFeedback = str_replace("_@informationBTN7@_", "$Information7", $initFeedback);
                }
                if(strpos($initFeedback, 'informationBTN8') !== false){
                    $Information8 = $one_select_sql_result['Information8'];
                    $initFeedback = str_replace("_@informationBTN8@_", "$Information8", $initFeedback);
                }
                if(strpos($initFeedback, 'informationBTN9') !== false){
                    $Information9 = $one_select_sql_result['Information9'];
                    $initFeedback = str_replace("_@informationBTN9@_", "$Information9", $initFeedback);
                }
                if(strpos($Feedback, 'informationBTN10') !== false){
                    $Information10 = $one_select_sql_result['$Information10'];
                    $initFeedback = str_replace("_@informationBTN10@_", "$Information10", $initFeedback);
                }
                $msg = phpMailerManualFeedback($SheetName, $Information1, $initFeedback);
            }  
        }
        mysqli_close($conn);
        echo "Email Sent!";
    }

    function phpMailerToken($getIpaddress, $Recipient, $Token) {
        
        // Create an instance of PHPMailer
        $mail = new PHPMailer();
        
        // Enable SMTP
        $mail->isSMTP();
        
        // Set a host
        $mail->Host = "smtp.gmail.com";
        
        // Set type of protection
        $mail->SMTPSecure = "ssl";
        
        // Set a port
        $mail->Port = 465;
        
        // Set Authentication to true
        $mail->SMTPAuth = true;
        
        // Set login details for gmail account
        $mail->Username = 'lsjs945743958@gmail.com';
        $mail->Password = '199610240as';

        // Set who is sending an email
        $mail->setFrom('lsjs945743958@gmail.com', 'EventDat');
        
        // Set where we are sending email (recipient)
        $mail->addAddress($Recipient);
        
        // Set a subject
        $mail->Subject = 'Email Verification';
        
        // Set HTML to true
        $mail->isHTML(true);
        
        // Set body
        $mail->Body = "Please click the link below to verify:<br><br>
        <a href='http://$getIpaddress/EventDat/admin/emailConfirm.php?email=$Recipient&token=$Token'>Click here</a>";

        // Send an email
        if ($mail->send()) {
            return "Mail sent!";
        }
        else {
            return "Something wrong happened!";
        }
    }

    function phpMailerAutoFeedback($Subject, $Recipient, $Feedback) {
        
        // Create an instance of PHPMailer
        $mail = new PHPMailer();
        
        // Enable SMTP
        $mail->isSMTP();
        
        // Set a host
        $mail->Host = "smtp.gmail.com";
        
        // Set type of protection
        $mail->SMTPSecure = "ssl";
        
        // Set a port
        $mail->Port = 465;
        
        // Set Authentication to true
        $mail->SMTPAuth = true;
        
        // Set login details for gmail account
        $mail->Username = 'lsjs945743958@gmail.com';
        $mail->Password = '199610240as';

        // Set who is sending an email
        $mail->setFrom('lsjs945743958@gmail.com', 'EventDat');
        
        // Set where we are sending email (recipient)
        $mail->addAddress($Recipient);
        
        // Set a subject
        $mail->Subject = 'Registration Feedback';
        
        // Set HTML to true
        $mail->isHTML(true);
        
        // Set body
        $mail->Body = $Feedback;

        // Send an email
        if ($mail->send()) {
            return "Mail sent!";
        }
        else {
            return "Something wrong happened!";
        }
    }

    function phpMailerManualFeedback($Subject, $Recipient, $Feedback) {
        
        // Create an instance of PHPMailer
        $mail = new PHPMailer();
        
        // Enable SMTP
        $mail->isSMTP();
        
        // Set a host
        $mail->Host = "smtp.gmail.com";
        
        // Set type of protection
        $mail->SMTPSecure = "ssl";
        
        // Set a port
        $mail->Port = 465;
        
        // Set Authentication to true
        $mail->SMTPAuth = true;
        
        // Set login details for gmail account
        $mail->Username = 'lsjs945743958@gmail.com';
        $mail->Password = '199610240as';

        // Set who is sending an email
        $mail->setFrom('lsjs945743958@gmail.com', 'EventDat');
        
        // Set where we are sending email (recipient)
        $mail->addAddress($Recipient);
        
        // Set a subject
        $mail->Subject = $Subject;
        
        // Set HTML to true
        $mail->isHTML(true);
        
        // Set body
        $mail->Body = $Feedback;

        // Send an email
        if ($mail->send()) {
            return "Mail sent!";
        }
        else {
            return "Something wrong happened!";
        }
    }
?>