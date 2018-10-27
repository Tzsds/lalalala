<?php
    require_once 'config.php';
    require_once '../ipaddress.php';

    session_start();

    date_default_timezone_set("Asia/Singapore");
    $timestamp = date('y-m-d H:i:s',time());

    $msg = "";

    if (isset($_GET['SpreadSheetContentId']) && isset($_GET['SpreadSheetColumnId']) && isset($_GET['CategoryName']) && isset($_GET['OtherInformationName']) && isset($_GET['OtherInformationType']) && isset($_GET['Username']) && isset($_GET['Password'])) {
        $SpreadSheetContentId = $_GET['SpreadSheetContentId'];
        $SpreadSheetColumnId = $_GET['SpreadSheetColumnId'];
        $CategoryName = $_GET['CategoryName'];
        $CategoryNameText = $_GET['CategoryNameText'];
        $OtherInformationNameText = $_GET['OtherInformationNameText'];
        $OtherInformationName = $_GET['OtherInformationName'];
        $OtherInformationType = $_GET['OtherInformationType'];
        $Username = $_GET['Username'];
        $Password = $_GET['Password'];
        $Number = substr($OtherInformationName, 20, strlen($OtherInformationName) - 20);
        $OtherInformation = "OtherInformation".$Number;
        
        $conn = mysqli_connect(HOST, USER, PASS, DB) or die('Unable to Connect...');
        $search_sql = "SELECT * FROM spreadsheetcolumn WHERE Id = $SpreadSheetColumnId && Username = '$Username' && Password = '$Password'";
        $search_result = mysqli_query($conn, $search_sql);
        $result_found = mysqli_num_rows($search_result);

        if($result_found >= 1) {
            
            $Post = false;
            $one_search_result = mysqli_fetch_assoc($search_result);
            $$CategoryName = $one_search_result["$CategoryName"];
            $$OtherInformationName = $one_search_result["$OtherInformationName"];
            $$OtherInformationType = $one_search_result["$OtherInformationType"];
            
            // 表单提交 TODO
            if(isset($_POST['OtherInformation1']) && !empty($_POST['OtherInformation1'])) {
                $Post = true;
                $OtherInformation1 = $_POST['OtherInformation1'];

                if(gettype($OtherInformation1) == "array") {
                    $OtherInformation1 = implode(",", $OtherInformation1);
                }
                
                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);

                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation1 = $one_search_content_result["OtherInformation1"];

                    if(empty($OldOtherInformation1)) {
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation1 = '".$OtherInformation1."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                }
            }
            else if(isset($_POST['OtherInformation2']) && !empty($_POST['OtherInformation2'])) {
                $Post = true;
                $OtherInformation2 = $_POST['OtherInformation2'];

                if(gettype($OtherInformation2) == "array") {
                    $OtherInformation2 = implode(",", $OtherInformation2);
                }
                
                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);

                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation2 = $one_search_content_result["OtherInformation2"];

                    if(empty($OldOtherInformation2)) {
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation2 = '".$OtherInformation2."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                }
            }
            else if(isset($_POST['OtherInformation3']) && !empty($_POST['OtherInformation3'])) {
                $Post = true;
                $OtherInformation3 = $_POST['OtherInformation3'];

                if(gettype($OtherInformation3) == "array") {
                    $OtherInformation3 = implode(",", $OtherInformation3);
                }
                
                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);
                
                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation3 = $one_search_content_result["OtherInformation3"];

                    if(empty($OldOtherInformation3)) {
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation3 = '".$OtherInformation3."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                }
            }
            else if(isset($_POST['OtherInformation4']) && !empty($_POST['OtherInformation4'])) {
                $Post = true;
                $OtherInformation4 = $_POST['OtherInformation4'];

                if(gettype($OtherInformation4) == "array") {
                    $OtherInformation4 = implode(",", $OtherInformation4);
                }

                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);
                
                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation4 = $one_search_content_result["OtherInformation4"];

                    if(empty($OldOtherInformation4)) {
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation4 = '".$OtherInformation4."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                }
            }
            else if(isset($_POST['OtherInformation5']) && !empty($_POST['OtherInformation5'])) {
                $Post = true;
                $OtherInformation5 = $_POST['OtherInformation5'];

                if(gettype($OtherInformation5) == "array") {
                    $OtherInformation5 = implode(",", $OtherInformation5);
                }

                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);
                
                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation5 = $one_search_content_result["OtherInformation5"];

                    if(empty($OldOtherInformation5)) {
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation5 = '".$OtherInformation5."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                }
            }
            else if(isset($_POST['OtherInformation6']) && !empty($_POST['OtherInformation6'])) {
                $Post = true;
                $OtherInformation6 = $_POST['OtherInformation6'];

                if(gettype($OtherInformation6) == "array") {
                    $OtherInformation6 = implode(",", $OtherInformation6);
                }

                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);
                
                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation6 = $one_search_content_result["OtherInformation6"];

                    if(empty($OldOtherInformation6)) {
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation6 = '".$OtherInformation6."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                }
            }
            else if(isset($_POST['OtherInformation7']) && !empty($_POST['OtherInformation7'])) {
                $Post = true;
                $OtherInformation7 = $_POST['OtherInformation7'];

                if(gettype($OtherInformation7) == "array") {
                    $OtherInformation7 = implode(",", $OtherInformation7);
                }

                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);
                
                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation7 = $one_search_content_result["OtherInformation7"];

                    if(empty($OldOtherInformation7)) {
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation7 = '".$OtherInformation7."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                }
            }
            else if(isset($_POST['OtherInformation8']) && !empty($_POST['OtherInformation8'])) {
                $Post = true;
                $OtherInformation8 = $_POST['OtherInformation8'];

                if(gettype($OtherInformation8) == "array") {
                    $OtherInformation8 = implode(",", $OtherInformation8);
                }

                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);
                
                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation8 = $one_search_content_result["OtherInformation8"];

                    if(empty($OldOtherInformation8)) {
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation8 = '".$OtherInformation8."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                }
            }
            else if(isset($_POST['OtherInformation9']) && !empty($_POST['OtherInformation9'])) {
                $Post = true;
                $OtherInformation9 = $_POST['OtherInformation9'];

                if(gettype($OtherInformation9) == "array") {
                    $OtherInformation9 = implode(",", $OtherInformation9);
                }
                
                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);
                
                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation9 = $one_search_content_result["OtherInformation9"];

                    if(empty($OldOtherInformation9)) {
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation9 = '".$OtherInformation9."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                }
            }
            else if(isset($_POST['OtherInformation10']) && !empty($_POST['OtherInformation10'])) {
                $Post = true;
                $OtherInformation10 = $_POST['OtherInformation10'];

                if(gettype($OtherInformation10) == "array") {
                    $OtherInformation10 = implode(",", $OtherInformation10);
                }

                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);
                
                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation10 = $one_search_content_result["OtherInformation10"];

                    if(empty($OldOtherInformation10)) {
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation10 = '".$OtherInformation10."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                }
            }
            else if(isset($_POST['OtherInformation11']) && !empty($_POST['OtherInformation11'])) {
                $Post = true;
                $OtherInformation11 = $_POST['OtherInformation11'];

                if(gettype($OtherInformation11) == "array") {
                    $OtherInformation11 = implode(",", $OtherInformation11);
                }

                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);
                
                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation11 = $one_search_content_result["OtherInformation11"];

                    if(empty($OldOtherInformation11)) {
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation11 = '".$OtherInformation11."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                }
            }
            else if(isset($_POST['OtherInformation12']) && !empty($_POST['OtherInformation12'])) {
                $Post = true;
                $OtherInformation12 = $_POST['OtherInformation12'];

                if(gettype($OtherInformation12) == "array") {
                    $OtherInformation12 = implode(",", $OtherInformation12);
                }
                
                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);
                
                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation12 = $one_search_content_result["OtherInformation12"];

                    if(empty($OldOtherInformation12)) {
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation12 = '".$OtherInformation12."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                }
            }
            else if(isset($_POST['OtherInformation13']) && !empty($_POST['OtherInformation13'])) {
                $Post = true;
                $OtherInformation13 = $_POST['OtherInformation13'];

                if(gettype($OtherInformation13) == "array") {
                    $OtherInformation13 = implode(",", $OtherInformation13);
                }

                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);
                
                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation13 = $one_search_content_result["OtherInformation13"];

                    if(empty($OldOtherInformation13)) {
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation13 = '".$OtherInformation13."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                }
            }
            else if(isset($_POST['OtherInformation14']) && !empty($_POST['OtherInformation14'])) {
                $Post = true;
                $OtherInformation14 = $_POST['OtherInformation14'];

                if(gettype($OtherInformation14) == "array") {
                    $OtherInformation14 = implode(",", $OtherInformation14);
                }

                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);
                
                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation14 = $one_search_content_result["OtherInformation14"];

                    if(empty($OldOtherInformation14)) { 
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation14 = '".$OtherInformation14."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                }
            }
            else if(isset($_POST['OtherInformation15']) && !empty($_POST['OtherInformation15'])) {
                $Post = true;
                $OtherInformation15 = $_POST['OtherInformation15'];

                if(gettype($OtherInformation15) == "array") {
                    $OtherInformation15 = implode(",", $OtherInformation15);
                }

                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);
                
                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation15 = $one_search_content_result["OtherInformation15"];

                    if(empty($OldOtherInformation15)) { 
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation15 = '".$OtherInformation15."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                }
            }
            else if(isset($_POST['OtherInformation16']) && !empty($_POST['OtherInformation16'])) {
                $Post = true;
                $OtherInformation16 = $_POST['OtherInformation16'];

                if(gettype($OtherInformation16) == "array") {
                    $OtherInformation16 = implode(",", $OtherInformation16);
                }

                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);
                
                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation16 = $one_search_content_result["OtherInformation16"];

                    if(empty($OldOtherInformation16)) { 
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation16 = '".$OtherInformation16."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                }
            }
            else if(isset($_POST['OtherInformation17']) && !empty($_POST['OtherInformation17'])) {
                $Post = true;
                $OtherInformation17 = $_POST['OtherInformation17'];

                if(gettype($OtherInformation17) == "array") {
                    $OtherInformation17 = implode(",", $OtherInformation17);
                }

                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);
                
                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation17 = $one_search_content_result["OtherInformation17"];

                    if(empty($OldOtherInformation17)) { 
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation17 = '".$OtherInformation17."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                }
            }
            else if(isset($_POST['OtherInformation18']) && !empty($_POST['OtherInformation18'])) {
                $Post = true;
                $OtherInformation18 = $_POST['OtherInformation18'];

                if(gettype($OtherInformation18) == "array") {
                    $OtherInformation18 = implode(",", $OtherInformation18);
                }
                
                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);
                
                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation18 = $one_search_content_result["OtherInformation18"];

                    if(empty($OldOtherInformation18)) { 
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation18 = '".$OtherInformation18."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                }
            }
            else if(isset($_POST['OtherInformation19']) && !empty($_POST['OtherInformation19'])) {
                $Post = true;
                $OtherInformation19 = $_POST['OtherInformation19'];

                if(gettype($OtherInformation19) == "array") {
                    $OtherInformation19 = implode(",", $OtherInformation19);
                }

                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);
                
                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation19 = $one_search_content_result["OtherInformation19"];

                    if(empty($OldOtherInformation19)) { 
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation19 = '".$OtherInformation19."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                }
            }
            else if(isset($_POST['OtherInformation20']) && !empty($_POST['OtherInformation20'])) {
                $Post = true;
                $OtherInformation20 = $_POST['OtherInformation20'];

                if(gettype($OtherInformation20) == "array") {
                    $OtherInformation20 = implode(",", $OtherInformation20);
                }

                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);
                
                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation20 = $one_search_content_result["OtherInformation20"];

                    if(empty($OldOtherInformation20)) { 
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation20 = '".$OtherInformation20."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                }
            }
            else if(isset($_POST['OtherInformation21']) && !empty($_POST['OtherInformation21'])) {
                $Post = true;
                $OtherInformation21 = $_POST['OtherInformation21'];

                if(gettype($OtherInformation21) == "array") {
                    $OtherInformation21 = implode(",", $OtherInformation21);
                }

                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);
                
                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation21 = $one_search_content_result["OtherInformation21"];

                    if(empty($OldOtherInformation21)) { 
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation21 = '".$OtherInformation21."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                }
            }
            else if(isset($_POST['OtherInformation22']) && !empty($_POST['OtherInformation22'])) {
                $Post = true;
                $OtherInformation22 = $_POST['OtherInformation22'];

                if(gettype($OtherInformation22) == "array") {
                    $OtherInformation22 = implode(",", $OtherInformation22);
                }
                
                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);
                
                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation22 = $one_search_content_result["OtherInformation22"];

                    if(empty($OldOtherInformation22)) { 
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation22 = '".$OtherInformation22."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                }
            }
            else if(isset($_POST['OtherInformation23']) && !empty($_POST['OtherInformation23'])) {
                $Post = true;
                $OtherInformation23 = $_POST['OtherInformation23'];

                if(gettype($OtherInformation23) == "array") {
                    $OtherInformation23 = implode(",", $OtherInformation23);
                }

                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);
                
                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation23 = $one_search_content_result["OtherInformation23"];

                    if(empty($OldOtherInformation23)) { 
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation23 = '".$OtherInformation23."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                }
            }
            else if(isset($_POST['OtherInformation24']) && !empty($_POST['OtherInformation24'])) {
                $Post = true;
                $OtherInformation24 = $_POST['OtherInformation24'];

                if(gettype($OtherInformation24) == "array") {
                    $OtherInformation24 = implode(",", $OtherInformation24);
                }
                
                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);
                
                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation24 = $one_search_content_result["OtherInformation24"];

                    if(empty($OldOtherInformation24)) { 
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation24 = '".$OtherInformation24."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                }
            }
            else if(isset($_POST['OtherInformation25']) && !empty($_POST['OtherInformation25'])) {
                $Post = true;
                $OtherInformation25 = $_POST['OtherInformation25'];

                if(gettype($OtherInformation25) == "array") {
                    $OtherInformation25 = implode(",", $OtherInformation25);
                }
                
                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);
                
                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation25 = $one_search_content_result["OtherInformation25"];

                    if(empty($OldOtherInformation25)) { 
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation25 = '".$OtherInformation25."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                }
            }
            else if(isset($_POST['OtherInformation26']) && !empty($_POST['OtherInformation26'])) {
                $Post = true;
                $OtherInformation26 = $_POST['OtherInformation26'];

                if(gettype($OtherInformation26) == "array") {
                    $OtherInformation26 = implode(",", $OtherInformation26);
                }
                
                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);
                
                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation26 = $one_search_content_result["OtherInformation26"];

                    if(empty($OldOtherInformation26)) { 
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation26 = '".$OtherInformation26."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                }
            }
            else if(isset($_POST['OtherInformation27']) && !empty($_POST['OtherInformation27'])) {
                $Post = true;
                $OtherInformation27 = $_POST['OtherInformation27'];

                if(gettype($OtherInformation27) == "array") {
                    $OtherInformation27 = implode(",", $OtherInformation27);
                }
                
                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);
                
                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation27 = $one_search_content_result["OtherInformation27"];

                    if(empty($OldOtherInformation27)) { 
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation27 = '".$OtherInformation27."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                }
            }
            else if(isset($_POST['OtherInformation28']) && !empty($_POST['OtherInformation28'])) {
                $Post = true;
                $OtherInformation28 = $_POST['OtherInformation28'];

                if(gettype($OtherInformation28) == "array") {
                    $OtherInformation28 = implode(",", $OtherInformation28);
                }
                
                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);
                
                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation28 = $one_search_content_result["OtherInformation28"];

                    if(empty($OldOtherInformation28)) { 
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation28 = '".$OtherInformation28."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                }
            }
            else if(isset($_POST['OtherInformation29']) && !empty($_POST['OtherInformation29'])) {
                $Post = true;
                $OtherInformation29 = $_POST['OtherInformation29'];

                if(gettype($OtherInformation29) == "array") {
                    $OtherInformation29 = implode(",", $OtherInformation29);
                }
                
                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);
                
                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation29 = $one_search_content_result["OtherInformation29"];

                    if(empty($OldOtherInformation29)) { 
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation29 = '".$OtherInformation29."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                }
            }
            else if(isset($_POST['OtherInformation30']) && !empty($_POST['OtherInformation30'])) {
                $Post = true;
                $OtherInformation30 = $_POST['OtherInformation30'];

                if(gettype($OtherInformation30) == "array") {
                    $OtherInformation30 = implode(",", $OtherInformation30);
                }
                
                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);
                
                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation30 = $one_search_content_result["OtherInformation30"];

                    if(empty($OldOtherInformation30)) { 
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation30 = '".$OtherInformation30."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                }
            }   
            else if(isset($_POST['OtherInformation31']) && !empty($_POST['OtherInformation31'])) {
                $Post = true;
                $OtherInformation31 = $_POST['OtherInformation31'];

                if(gettype($OtherInformation31) == "array") {
                    $OtherInformation31 = implode(",", $OtherInformation31);
                }

                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);
                
                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation31 = $one_search_content_result["OtherInformation31"];

                    if(empty($OldOtherInformation31)) { 
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation31 = '".$OtherInformation31."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                }
            }
            else if(isset($_POST['OtherInformation32']) && !empty($_POST['OtherInformation32'])) {
                $Post = true;
                $OtherInformation32 = $_POST['OtherInformation32'];

                if(gettype($OtherInformation32) == "array") {
                    $OtherInformation32 = implode(",", $OtherInformation32);
                }

                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);
                
                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation32 = $one_search_content_result["OtherInformation32"];

                    if(empty($OldOtherInformation32)) { 
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation32 = '".$OtherInformation32."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                }
            }
            else if(isset($_POST['OtherInformation33']) && !empty($_POST['OtherInformation33'])) {
                $Post = true;
                $OtherInformation33 = $_POST['OtherInformation33'];

                if(gettype($OtherInformation33) == "array") {
                    $OtherInformation33 = implode(",", $OtherInformation33);
                }

                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);
                
                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation33 = $one_search_content_result["OtherInformation33"];

                    if(empty($OldOtherInformation33)) { 
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation33 = '".$OtherInformation33."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                }
            }
            else if(isset($_POST['OtherInformation34']) && !empty($_POST['OtherInformation34'])) {
                $Post = true;
                $OtherInformation34 = $_POST['OtherInformation34'];

                if(gettype($OtherInformation34) == "array") {
                    $OtherInformation34 = implode(",", $OtherInformation34);
                }

                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);
                
                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation34 = $one_search_content_result["OtherInformation34"];

                    if(empty($OldOtherInformation34)) { 
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation34 = '".$OtherInformation34."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                }
            }
            else if(isset($_POST['OtherInformation35']) && !empty($_POST['OtherInformation35'])) {
                $Post = true;
                $OtherInformation35 = $_POST['OtherInformation35'];

                if(gettype($OtherInformation35) == "array") {
                    $OtherInformation35 = implode(",", $OtherInformation35);
                }

                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);
                
                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation35 = $one_search_content_result["OtherInformation35"];

                    if(empty($OldOtherInformation35)) { 
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation35 = '".$OtherInformation35."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                };
            }
            else if(isset($_POST['OtherInformation36']) && !empty($_POST['OtherInformation36'])) {
                $Post = true;
                $OtherInformation36 = $_POST['OtherInformation36'];

                if(gettype($OtherInformation36) == "array") {
                    $OtherInformation36 = implode(",", $OtherInformation36);
                }

                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);
                
                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation36 = $one_search_content_result["OtherInformation36"];

                    if(empty($OldOtherInformation36)) { 
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation36 = '".$OtherInformation36."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                }
            }
            else if(isset($_POST['OtherInformation37']) && !empty($_POST['OtherInformation37'])) {
                $Post = true;
                $OtherInformation37 = $_POST['OtherInformation37'];

                if(gettype($OtherInformation37) == "array") {
                    $OtherInformation37 = implode(",", $OtherInformation37);
                }

                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);
                
                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation37 = $one_search_content_result["OtherInformation37"];

                    if(empty($OldOtherInformation37)) { 
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation37 = '".$OtherInformation37."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                }
            }
            else if(isset($_POST['OtherInformation38']) && !empty($_POST['OtherInformation38'])) {
                $Post = true;
                $OtherInformation38 = $_POST['OtherInformation38'];

                if(gettype($OtherInformation38) == "array") {
                    $OtherInformation38 = implode(",", $OtherInformation38);
                }
                
                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);
                
                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation38 = $one_search_content_result["OtherInformation38"];

                    if(empty($OldOtherInformation38)) {
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation38 = '".$OtherInformation38."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                }
            }
            else if(isset($_POST['OtherInformation39']) && !empty($_POST['OtherInformation39'])) {
                $Post = true;
                $OtherInformation39 = $_POST['OtherInformation39'];

                if(gettype($OtherInformation39) == "array") {
                    $OtherInformation39 = implode(",", $OtherInformation39);
                }

                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);
                
                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation39 = $one_search_content_result["OtherInformation39"];

                    if(empty($OldOtherInformation39)) { 
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation39 = '".$OtherInformation39."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                }
            }
            else if(isset($_POST['OtherInformation40']) && !empty($_POST['OtherInformation40'])) {
                $Post = true;
                $OtherInformation40 = $_POST['OtherInformation40'];

                if(gettype($OtherInformation40) == "array") {
                    $OtherInformation40 = implode(",", $OtherInformation40);
                }

                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);
                
                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation40 = $one_search_content_result["OtherInformation40"];

                    if(empty($OldOtherInformation40)) { 
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation40 = '".$OtherInformation40."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                }
            }
            else if(isset($_POST['OtherInformation41']) && !empty($_POST['OtherInformation41'])) {
                $Post = true;
                $OtherInformation41 = $_POST['OtherInformation41'];

                if(gettype($OtherInformation41) == "array") {
                    $OtherInformation41 = implode(",", $OtherInformation41);
                }

                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);
                
                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation41 = $one_search_content_result["OtherInformation41"];

                    if(empty($OldOtherInformation41)) { 
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation41 = '".$OtherInformation41."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                }
            }
            else if(isset($_POST['OtherInformation42']) && !empty($_POST['OtherInformation42'])) {
                $Post = true;
                $OtherInformation42 = $_POST['OtherInformation42'];

                if(gettype($OtherInformation42) == "array") {
                    $OtherInformation42 = implode(",", $OtherInformation42);
                }

                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);
                
                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation42 = $one_search_content_result["OtherInformation42"];

                    if(empty($OldOtherInformation42)) { 
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation42 = '".$OtherInformation42."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                }
            }
            else if(isset($_POST['OtherInformation43']) && !empty($_POST['OtherInformation43'])) {
                $Post = true;
                $OtherInformation43 = $_POST['OtherInformation43'];

                if(gettype($OtherInformation43) == "array") {
                    $OtherInformation43 = implode(",", $OtherInformation43);
                }

                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);
                
                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation43 = $one_search_content_result["OtherInformation43"];

                    if(empty($OldOtherInformation43)) { 
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation43 = '".$OtherInformation43."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                }
            }
            else if(isset($_POST['OtherInformation44']) && !empty($_POST['OtherInformation44'])) {
                $Post = true;
                $OtherInformation44 = $_POST['OtherInformation44'];

                if(gettype($OtherInformation44) == "array") {
                    $OtherInformation44 = implode(",", $OtherInformation44);
                }

                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);
                
                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation44 = $one_search_content_result["OtherInformation44"];

                    if(empty($OldOtherInformation44)) { 
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation44 = '".$OtherInformation44."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                }
            }
            else if(isset($_POST['OtherInformation45']) && !empty($_POST['OtherInformation45'])) {
                $Post = true;
                $OtherInformation45 = $_POST['OtherInformation45'];

                if(gettype($OtherInformation45) == "array") {
                    $OtherInformation45 = implode(",", $OtherInformation45);
                }

                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);
                
                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation45 = $one_search_content_result["OtherInformation45"];

                    if(empty($OldOtherInformation45)) { 
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation45 = '".$OtherInformation45."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                }
            }
            else if(isset($_POST['OtherInformation46']) && !empty($_POST['OtherInformation46'])) {
                $Post = true;
                $OtherInformation46 = $_POST['OtherInformation46'];

                if(gettype($OtherInformation46) == "array") {
                    $OtherInformation46 = implode(",", $OtherInformation46);
                }

                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);
                
                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation46 = $one_search_content_result["OtherInformation46"];

                    if(empty($OldOtherInformation46)) { 
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation46 = '".$OtherInformation46."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                }
            }
            else if(isset($_POST['OtherInformation47']) && !empty($_POST['OtherInformation47'])) {
                $Post = true;
                $OtherInformation47 = $_POST['OtherInformation47'];

                if(gettype($OtherInformation47) == "array") {
                    $OtherInformation47 = implode(",", $OtherInformation47);
                }

                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);
                
                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation47 = $one_search_content_result["OtherInformation47"];

                    if(empty($OldOtherInformation47)) { 
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation47 = '".$OtherInformation47."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                }
            }
            else if(isset($_POST['OtherInformation48']) && !empty($_POST['OtherInformation48'])) {
                $Post = true;
                $OtherInformation48 = $_POST['OtherInformation48'];

                if(gettype($OtherInformation48) == "array") {
                    $OtherInformation48 = implode(",", $OtherInformation48);
                }

                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);
                
                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation48 = $one_search_content_result["OtherInformation48"];

                    if(empty($OldOtherInformation48)) { 
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation48 = '".$OtherInformation48."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                }
            }
            else if(isset($_POST['OtherInformation49']) && !empty($_POST['OtherInformation49'])) {
                $Post = true;
                $OtherInformation49 = $_POST['OtherInformation49'];

                if(gettype($OtherInformation49) == "array") {
                    $OtherInformation49 = implode(",", $OtherInformation49);
                }

                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);
                
                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation49 = $one_search_content_result["OtherInformation49"];

                    if(empty($OldOtherInformation49)) { 
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation49 = '".$OtherInformation49."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                }
            }
            else if(isset($_POST['OtherInformation50']) && !empty($_POST['OtherInformation50'])) {
                $Post = true;
                $OtherInformation50 = $_POST['OtherInformation50'];

                if(gettype($OtherInformation50) == "array") {
                    $OtherInformation50 = implode(",", $OtherInformation50);
                }

                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                $search_content_result = mysqli_query($conn, $search_content_sql);
                
                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                    mysqli_close($conn);
                    header("Location:../404.php");
                }
                else {
                    $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                    $OldOtherInformation50 = $one_search_content_result["OtherInformation50"];

                    if(empty($OldOtherInformation50)) { 
                        $update_sql = "UPDATE spreadsheetcontent SET OtherInformation50 = '".$OtherInformation50."' WHERE Id = $SpreadSheetContentId";
                        $update_result = mysqli_query($conn, $update_sql);
                        $msg = "Succeeded!";
                    }
                    else {
                        $msg = "Checked-In already!";
                    }
                    mysqli_close($conn);
                }
            }
            // 没有提交表单，即通常情况，判断OtherInformationType
            else {
                if($$OtherInformationType == "Text") {
                    $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE Id = $SpreadSheetContentId";
                    $search_content_result = mysqli_query($conn, $search_content_sql);

                    if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){
                        mysqli_close($conn);
                        header("Location:../404.php");
                    }
                    else {
                        $one_search_content_result = mysqli_fetch_assoc($search_content_result);
                        $$OtherInformation = $one_search_content_result["$OtherInformation"];

                        if(empty($$OtherInformation)) {
                            $update_sql = "UPDATE spreadsheetcontent SET ".$OtherInformation." = 1 WHERE Id = $SpreadSheetContentId";
                            $update_result = mysqli_query($conn, $update_sql);
                            $msg = "Succeeded!";
                        }
                        else {
                            $msg = "Checked-In already!";
                        }
                        mysqli_close($conn);
                    }
                }
                else {
                    mysqli_close($conn);
                }
            }
        }
        else {
            mysqli_close($conn);
            header("Location:../404.php");
        }
    }
    else {
        header("Location:../404.php");
    }
?>



<!DOCTYLE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1, maximum-scale=3, minimum-scale=1, user-scalable=no">
        <link rel='stylesheet' href='css/scanResult.css' type='text/css' />
        <title>EventDat</title>
        <script src="../js/jquery.min.js"></script>
    </head> 
    <body>
        <h1 class="title">Thanks to join <br><?php echo $$CategoryName; ?> - <?php echo $$OtherInformationName; ?></h1>
        <?php
            // $$OtherInformationType == "" 代表提交了表单的情况
            if($msg == "Succeeded!") {
            ?>
                <div class="imgContainer">
                    <img src="../image/tick.png" />
                </div>
            <?php
            }
            else if($msg == "Checked-In already!"){
            ?>
                <div class="imgContainer">
                    <img src="../image/exclamation.png" />
                </div>
            <?php
            }
            else {
            ?>
                <div class="otherInformationContainer">
                    <form method="post" action="scanResult.php?SpreadSheetContentId=<?php echo $SpreadSheetContentId; ?>&&SpreadSheetColumnId=<?php echo $SpreadSheetColumnId; ?>&&CategoryName=<?php echo $CategoryName; ?>&&OtherInformationName=<?php echo $OtherInformationName; ?>&&OtherInformationType=<?php echo $OtherInformationType; ?>&&Username=<?php echo $Username; ?>&&Password=<?php echo $Password; ?>">
                        <label class="label"><?php echo $$OtherInformationName; ?></label>
                        <?php
                            if($$OtherInformationType == "DorpdownList") {
                                $conn = mysqli_connect(HOST, USER, PASS, DB) or die('Unable to Connect...');
                                $search_otherinformation_sql = "SELECT * FROM otherinformation".$Number." WHERE SpreadSheetColumnId = $SpreadSheetColumnId";
                                $search_otherinformation_result = mysqli_query($conn, $search_otherinformation_sql);
                                if (!$search_otherinformation_result || mysqli_num_rows($search_otherinformation_result) == 0){

                                }
                                else {
                                ?>
                                    <select name="OtherInformation<?php echo $Number; ?>" > 
                                    <?php
                                    while ($one_search_otherinformation_result = mysqli_fetch_assoc($search_otherinformation_result)) {
                                        $Content = $one_search_otherinformation_result['Content'];
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
                            else if($$OtherInformationType == "Radio") {
                                $conn = mysqli_connect(HOST, USER, PASS, DB) or die('Unable to Connect...');
                                $search_otherinformation_sql = "SELECT * FROM otherinformation".$Number." WHERE SpreadSheetColumnId = $SpreadSheetColumnId";
                                $search_otherinformation_result = mysqli_query($conn, $search_otherinformation_sql);
                                if (!$search_otherinformation_result || mysqli_num_rows($search_otherinformation_result) == 0){

                                }
                                else {
                                ?>
                                    <div class="radioContainer">
                                    <?php
                                        $j = 0;
                                        while ($one_search_otherinformation_result = mysqli_fetch_assoc($search_otherinformation_result)) {
                                            $Content = $one_search_otherinformation_result['Content'];
                                            ?>
                                            <div class="radioItemContainer">
                                                <input type="radio" name="OtherInformation<?php echo $Number; ?>" value='<?php echo $Content; ?>' <?php if($j==0){echo "checked";} ?>/><label><?php echo $Content; ?></label>
                                            </div><br>
                                            <?php
                                            $j++;
                                        }
                                    ?>
                                    </div>
                                <?php
                                }
                                mysqli_close($conn);
                            }
                            else if($$OtherInformationType == "CheckBox") {
                                $conn = mysqli_connect(HOST, USER, PASS, DB) or die('Unable to Connect...');
                                $search_otherinformation_sql = "SELECT * FROM otherinformation".$Number." WHERE SpreadSheetColumnId = $SpreadSheetColumnId";
                                $search_otherinformation_result = mysqli_query($conn, $search_otherinformation_sql);
                                if (!$search_otherinformation_result || mysqli_num_rows($search_otherinformation_result) == 0){

                                }
                                else {
                                ?>
                                    <div class="checkBoxContainer">
                                    <?php
                                        while ($one_search_otherinformation_result = mysqli_fetch_assoc($search_otherinformation_result)) {
                                            $Content = $one_search_otherinformation_result['Content'];
                                            ?>
                                            <div class="checkBoxItemContainer">
                                                <input type="checkbox" name="OtherInformation<?php echo $Number; ?>[]" value='<?php echo $Content; ?>' /><label><?php echo $Content; ?></label>
                                            </div><br>
                                            <?php
                                        }
                                    ?>
                                    </div>
                                <?php
                                }
                                mysqli_close($conn);
                            }
                        ?>
                        <div class="formBTN">
                            <input type="submit" value="Submit"/>
                        </div>
                    </form>
                </div>
            <?php
            }
            if($msg != "") {
                echo "<p class='msg'>$msg</p>";
            }
        ?>
        <div class="backBTNContainer">
            <input type="button" class="backToScannerBTN" onclick="backToScanner()" value="Back to Scanner">
        </div>
    </body>
</html>

<script>
    function backToScanner() {
        window.location.href = "https://<?php echo $ipaddress; ?>/EventDat/QRCodeScanner/index.html?Id=<?php echo $SpreadSheetColumnId; ?>&&CategoryName=<?php echo $CategoryName; ?>&&CategoryNameText=<?php echo $CategoryNameText; ?>&&OtherInformationName=<?php echo $OtherInformationName; ?>&&OtherInformationNameText=<?php echo $OtherInformationNameText; ?>&&OtherInformationType=<?php echo $OtherInformationType; ?>&&Username=<?php echo $Username; ?>&&Password=<?php echo $Password; ?>";
    }
</script>