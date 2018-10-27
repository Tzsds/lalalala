<?php
    require_once 'config.php';
    require 'phpexcel/autoload.php';

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\IOFactory;

    session_start();

    date_default_timezone_set("Asia/Singapore");
    $timestamp = date('y-m-d H:i:s',time());

    if (isset($_SESSION['Email'])) {
        $Email = $_SESSION['Email'];
        
        /*======================== 获取这个邮箱下的已经存在的用户名 ====================================*/
        $UsernameArray = array();
        
        $conn = mysqli_connect(HOST, USER, PASS, DB) or die('Unable to Connect...');
        $search_sql = "SELECT Username FROM spreadsheetcolumn WHERE Email = '$Email'";
        $search_result = mysqli_query($conn, $search_sql);
        
        if (!$search_result || mysqli_num_rows($search_result) == 0){
            
        }
        else {
            while ($one_search_result = mysqli_fetch_assoc($search_result)) {
                $Username = $one_search_result['Username'];
                array_push($UsernameArray, $Username);
            }
        }
        
        mysqli_close($conn);
        
        /*======================================== 表单提交 ==========================================*/
        if(isset($_POST['sheetName']) && isset($_POST['sheetSubject'])) {
            
            $sheetName = $_POST['sheetName'];
            $userDetails = $_POST['userDetails'];
            $emailNotification = 0;
            if(isset($_POST['emailNotification'])) {
                $emailNotification = 1;
            }
            $InformationName1 = $_POST['InformationName1'];
            $IsUserDetails = 0;
            if($userDetails == "Yes") {
                $IsUserDetails = 1;
            }
            
            $insert_sql_first_half = "";
            $insert_sql_second_half = "";
            
            if(!empty($_POST['sheetSubject'])) {
                $sheetSubject = $_POST['sheetSubject'];
                $insert_sql_first_half = "INSERT INTO spreadsheetcolumn (Email, SheetName, SheetSubject, IsUserDetails, IsEmailNotification, InformationName1";
                $insert_sql_second_half = ", TimeStamp) VALUES ('$Email', '$sheetName', '$sheetSubject', $IsUserDetails, $emailNotification, '$InformationName1'";
            }
            else {
                $insert_sql_first_half = "INSERT INTO spreadsheetcolumn (Email, SheetName, IsUserDetails, IsEmailNotification, InformationName1";
                $insert_sql_second_half = ", TimeStamp) VALUES ('$Email', '$sheetName', $IsUserDetails, $emailNotification, '$InformationName1'";
            }
            
            $InformationArray = array();
            $OtherInformationArray = array();
            
            // 主要信息
            if(!empty($_POST['InformationName2']) && !empty($_POST['InformationType2'])) {
                $InformationName2 = $_POST['InformationName2'];
                $InformationType2 = $_POST['InformationType2'];

                $insert_sql_first_half = $insert_sql_first_half.", InformationName2, InformationType2";
                $insert_sql_second_half = $insert_sql_second_half. ", '$InformationName2', '$InformationType2'";
                
                if($InformationType2 != "Text") {
                    array_push($InformationArray, "Information2");
                }
            }
            if(!empty($_POST['InformationName3']) && !empty($_POST['InformationType3'])) {
                $InformationName3 = $_POST['InformationName3'];
                $InformationType3 = $_POST['InformationType3'];

                $insert_sql_first_half = $insert_sql_first_half.", InformationName3, InformationType3";
                $insert_sql_second_half = $insert_sql_second_half. ", '$InformationName3', '$InformationType3'";
                
                if($InformationType3 != "Text") {
                    array_push($InformationArray, "Information3");
                }
            }
            if(!empty($_POST['InformationName4']) && !empty($_POST['InformationType4'])) {
                $InformationName4 = $_POST['InformationName4'];
                $InformationType4 = $_POST['InformationType4'];

                $insert_sql_first_half = $insert_sql_first_half.", InformationName4, InformationType4";
                $insert_sql_second_half = $insert_sql_second_half. ", '$InformationName4', '$InformationType4'";
                
                if($InformationType4 != "Text") {
                    array_push($InformationArray, "Information4");
                }
            }
            if(!empty($_POST['InformationName5']) && !empty($_POST['InformationType5'])) {
                $InformationName5 = $_POST['InformationName5'];
                $InformationType5 = $_POST['InformationType5'];

                $insert_sql_first_half = $insert_sql_first_half.", InformationName5, InformationType5";
                $insert_sql_second_half = $insert_sql_second_half. ", '$InformationName5', '$InformationType5'";
                
                if($InformationType5 != "Text") {
                    array_push($InformationArray, "Information5");
                }
            }
            if(!empty($_POST['InformationName6']) && !empty($_POST['InformationType6'])) {
                $InformationName6 = $_POST['InformationName6'];
                $InformationType6 = $_POST['InformationType6'];

                $insert_sql_first_half = $insert_sql_first_half.", InformationName6, InformationType6";
                $insert_sql_second_half = $insert_sql_second_half. ", '$InformationName6', '$InformationType6'";
                
                if($InformationType6 != "Text") {
                    array_push($InformationArray, "Information6");
                }
            }
            if(!empty($_POST['InformationName7']) && !empty($_POST['InformationType7'])) {
                $InformationName7 = $_POST['InformationName7'];
                $InformationType7 = $_POST['InformationType7'];

                $insert_sql_first_half = $insert_sql_first_half.", InformationName7, InformationType7";
                $insert_sql_second_half = $insert_sql_second_half. ", '$InformationName7', '$InformationType7'";
                
                if($InformationType7 != "Text") {
                    array_push($InformationArray, "Information7");
                }
            }
            if(!empty($_POST['InformationName8']) && !empty($_POST['InformationType8'])) {
                $InformationName8 = $_POST['InformationName8'];
                $InformationType8 = $_POST['InformationType8'];

                $insert_sql_first_half = $insert_sql_first_half.", InformationName8, InformationType8";
                $insert_sql_second_half = $insert_sql_second_half. ", '$InformationName8', '$InformationType8'";
                
                if($InformationType8 != "Text") {
                    array_push($InformationArray, "Information8");
                }
            }
            if(!empty($_POST['InformationName9']) && !empty($_POST['InformationType9'])) {
                $InformationName9 = $_POST['InformationName9'];
                $InformationType9 = $_POST['InformationType9'];

                $insert_sql_first_half = $insert_sql_first_half.", InformationName9, InformationType9";
                $insert_sql_second_half = $insert_sql_second_half. ", '$InformationName9', '$InformationType9'";
                
                if($InformationType9 != "Text") {
                    array_push($InformationArray, "Information9");
                }
            }
            if(!empty($_POST['InformationName10']) && !empty($_POST['InformationType10'])) {
                $InformationName10 = $_POST['InformationName10'];
                $InformationType10 = $_POST['InformationType10'];

                $insert_sql_first_half = $insert_sql_first_half.", InformationName10, InformationType10";
                $insert_sql_second_half = $insert_sql_second_half. ", '$InformationName10', '$InformationType10'";
                
                if($InformationType10 != "Text") {
                    array_push($InformationArray, "Information10");
                }
            }
            
            // 是否存在其它信息
            if(isset($_POST['isOtherInformation'])) {
                $insert_sql_first_half = $insert_sql_first_half.", isOtherInformation";
                $insert_sql_second_half = $insert_sql_second_half. ", 1";
                
                if(isset($_POST['Category1Name'])) {
                    $Category1Name = $_POST['Category1Name'];
                    
                    $insert_sql_first_half = $insert_sql_first_half.", Category1Name";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$Category1Name'";
                }
                if(isset($_POST['Category2Name'])) {
                    $Category2Name = $_POST['Category2Name'];
                    
                    $insert_sql_first_half = $insert_sql_first_half.", Category2Name";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$Category2Name'";
                }
                if(isset($_POST['Category3Name'])) {
                    $Category3Name = $_POST['Category3Name'];
                    
                    $insert_sql_first_half = $insert_sql_first_half.", Category3Name";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$Category3Name'";
                }
                if(isset($_POST['Category4Name'])) {
                    $Category4Name = $_POST['Category4Name'];
                    
                    $insert_sql_first_half = $insert_sql_first_half.", Category4Name";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$Category4Name'";
                }
                if(isset($_POST['Category5Name'])) {
                    $Category5Name = $_POST['Category5Name'];
                    
                    $insert_sql_first_half = $insert_sql_first_half.", Category5Name";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$Category5Name'";
                }
                
                if(isset($_POST['CountCategory1Item'])) {
                    $CountCategory1Item = $_POST['CountCategory1Item'];
                    
                    $insert_sql_first_half = $insert_sql_first_half.", CountCategory1Item";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$CountCategory1Item'";
                }
                if(isset($_POST['CountCategory2Item'])) {
                    $CountCategory2Item = $_POST['CountCategory2Item'];
                    
                    $insert_sql_first_half = $insert_sql_first_half.", CountCategory2Item";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$CountCategory2Item'";
                }
                if(isset($_POST['CountCategory3Item'])) {
                    $CountCategory3Item = $_POST['CountCategory3Item'];
                    
                    $insert_sql_first_half = $insert_sql_first_half.", CountCategory3Item";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$CountCategory3Item'";
                }
                if(isset($_POST['CountCategory4Item'])) {
                    $CountCategory4Item = $_POST['CountCategory4Item'];
                    
                    $insert_sql_first_half = $insert_sql_first_half.", CountCategory4Item";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$CountCategory4Item'";
                }
                if(isset($_POST['CountCategory5Item'])) {
                    $CountCategory5Item = $_POST['CountCategory5Item'];
                    
                    $insert_sql_first_half = $insert_sql_first_half.", CountCategory5Item";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$CountCategory5Item'";
                }
                
                if(!empty($_POST['OtherInformationName1']) && !empty($_POST['OtherInformationType1'])) {
                    $OtherInformationName1 = $_POST['OtherInformationName1'];
                    $OtherInformationType1 = $_POST['OtherInformationType1'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName1, OtherInformationType1";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName1', '$OtherInformationType1'";

                    if($OtherInformationType1 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation1");
                    }
                }
                if(!empty($_POST['OtherInformationName2']) && !empty($_POST['OtherInformationType2'])) {
                    $OtherInformationName2 = $_POST['OtherInformationName2'];
                    $OtherInformationType2 = $_POST['OtherInformationType2'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName2, OtherInformationType2";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName2', '$OtherInformationType2'";
                    
                    if($OtherInformationType2 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation2");
                    }
                }
                if(!empty($_POST['OtherInformationName3']) && !empty($_POST['OtherInformationType3'])) {
                    $OtherInformationName3 = $_POST['OtherInformationName3'];
                    $OtherInformationType3 = $_POST['OtherInformationType3'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName3, OtherInformationType3";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName3', '$OtherInformationType3'";
                    
                    if($OtherInformationType3 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation3");
                    }
                }
                if(!empty($_POST['OtherInformationName4']) && !empty($_POST['OtherInformationType4'])) {
                    $OtherInformationName4 = $_POST['OtherInformationName4'];
                    $OtherInformationType4 = $_POST['OtherInformationType4'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName4, OtherInformationType4";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName4', '$OtherInformationType4'";
                    
                    if($OtherInformationType4 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation4");
                    }
                }
                if(!empty($_POST['OtherInformationName5']) && !empty($_POST['OtherInformationType5'])) {
                    $OtherInformationName5 = $_POST['OtherInformationName5'];
                    $OtherInformationType5 = $_POST['OtherInformationType5'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName5, OtherInformationType5";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName5', '$OtherInformationType5'";
                    
                    if($OtherInformationType5 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation5");
                    }
                }
                if(!empty($_POST['OtherInformationName6']) && !empty($_POST['OtherInformationType6'])) {
                    $OtherInformationName6 = $_POST['OtherInformationName6'];
                    $OtherInformationType6 = $_POST['OtherInformationType6'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName6, OtherInformationType6";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName6', '$OtherInformationType6'";
                    
                    if($OtherInformationType6 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation6");
                    }
                }
                if(!empty($_POST['OtherInformationName7']) && !empty($_POST['OtherInformationType7'])) {
                    $OtherInformationName7 = $_POST['OtherInformationName7'];
                    $OtherInformationType7 = $_POST['OtherInformationType7'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName7, OtherInformationType7";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName7', '$OtherInformationType7'";
                    
                    if($OtherInformationType7 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation7");
                    }
                }
                if(!empty($_POST['OtherInformationName8']) && !empty($_POST['OtherInformationType8'])) {
                    $OtherInformationName8 = $_POST['OtherInformationName8'];
                    $OtherInformationType8 = $_POST['OtherInformationType8'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName8, OtherInformationType8";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName8', '$OtherInformationType8'";
                    
                    if($OtherInformationType8 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation8");
                    }
                }
                if(!empty($_POST['OtherInformationName9']) && !empty($_POST['OtherInformationType9'])) {
                    $OtherInformationName9 = $_POST['OtherInformationName9'];
                    $OtherInformationType9 = $_POST['OtherInformationType9'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName9, OtherInformationType9";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName9', '$OtherInformationType9'";
                    
                    if($OtherInformationType9 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation9");
                    }
                }
                if(!empty($_POST['OtherInformationName10']) && !empty($_POST['OtherInformationType10'])) {
                    $OtherInformationName10 = $_POST['OtherInformationName10'];
                    $OtherInformationType10 = $_POST['OtherInformationType10'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName10, OtherInformationType10";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName10', '$OtherInformationType10'";
                    
                    if($OtherInformationType10 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation10");
                    }
                }
                if(!empty($_POST['OtherInformationName11']) && !empty($_POST['OtherInformationType11'])) {
                    $OtherInformationName11 = $_POST['OtherInformationName11'];
                    $OtherInformationType11 = $_POST['OtherInformationType11'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName11, OtherInformationType11";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName11', '$OtherInformationType11'";
                    
                    if($OtherInformationType11 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation11");
                    }
                }
                if(!empty($_POST['OtherInformationName12']) && !empty($_POST['OtherInformationType12'])) {
                    $OtherInformationName12 = $_POST['OtherInformationName12'];
                    $OtherInformationType12 = $_POST['OtherInformationType12'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName12, OtherInformationType12";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName12', '$OtherInformationType12'";
                    
                    if($OtherInformationType12 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation12");
                    }
                }
                if(!empty($_POST['OtherInformationName13']) && !empty($_POST['OtherInformationType13'])) {
                    $OtherInformationName13 = $_POST['OtherInformationName13'];
                    $OtherInformationType13 = $_POST['OtherInformationType13'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName13, OtherInformationType13";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName13', '$OtherInformationType13'";
                    
                    if($OtherInformationType13 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation13");
                    }
                }
                if(!empty($_POST['OtherInformationName14']) && !empty($_POST['OtherInformationType14'])) {
                    $OtherInformationName14 = $_POST['OtherInformationName14'];
                    $OtherInformationType14 = $_POST['OtherInformationType14'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName14, OtherInformationType14";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName14', '$OtherInformationType14'";
                    
                    if($OtherInformationType14 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation14");
                    }
                }
                if(!empty($_POST['OtherInformationName15']) && !empty($_POST['OtherInformationType15'])) {
                    $OtherInformationName15 = $_POST['OtherInformationName15'];
                    $OtherInformationType15 = $_POST['OtherInformationType15'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName15, OtherInformationType15";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName15', '$OtherInformationType15'";
                    
                    if($OtherInformationType15 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation15");
                    }
                }
                if(!empty($_POST['OtherInformationName16']) && !empty($_POST['OtherInformationType16'])) {
                    $OtherInformationName16 = $_POST['OtherInformationName16'];
                    $OtherInformationType16 = $_POST['OtherInformationType16'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName16, OtherInformationType16";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName16', '$OtherInformationType16'";
                    
                    if($OtherInformationType16 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation16");
                    }
                }
                if(!empty($_POST['OtherInformationName17']) && !empty($_POST['OtherInformationType17'])) {
                    $OtherInformationName17 = $_POST['OtherInformationName17'];
                    $OtherInformationType17 = $_POST['OtherInformationType17'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName17, OtherInformationType17";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName17', '$OtherInformationType17'";
                    
                    if($OtherInformationType17 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation17");
                    }
                }
                if(!empty($_POST['OtherInformationName18']) && !empty($_POST['OtherInformationType18'])) {
                    $OtherInformationName18 = $_POST['OtherInformationName18'];
                    $OtherInformationType18 = $_POST['OtherInformationType18'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName18, OtherInformationType18";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName18', '$OtherInformationType18'";
                    
                    if($OtherInformationType18 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation18");
                    }
                }
                if(!empty($_POST['OtherInformationName19']) && !empty($_POST['OtherInformationType19'])) {
                    $OtherInformationName19 = $_POST['OtherInformationName19'];
                    $OtherInformationType19 = $_POST['OtherInformationType19'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName19, OtherInformationType19";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName19', '$OtherInformationType19'";
                    
                    if($OtherInformationType19 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation19");
                    }
                }
                if(!empty($_POST['OtherInformationName20']) && !empty($_POST['OtherInformationType20'])) {
                    $OtherInformationName20 = $_POST['OtherInformationName20'];
                    $OtherInformationType20 = $_POST['OtherInformationType20'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName20, OtherInformationType20";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName20', '$OtherInformationType20'";
                    
                    if($OtherInformationType20 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation20");
                    }
                }
                if(!empty($_POST['OtherInformationName21']) && !empty($_POST['OtherInformationType21'])) {
                    $OtherInformationName21 = $_POST['OtherInformationName21'];
                    $OtherInformationType21 = $_POST['OtherInformationType21'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName21, OtherInformationType21";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName21', '$OtherInformationType21'";
                    
                    if($OtherInformationType21 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation21");
                    }
                }
                if(!empty($_POST['OtherInformationName22']) && !empty($_POST['OtherInformationType22'])) {
                    $OtherInformationName22 = $_POST['OtherInformationName22'];
                    $OtherInformationType22 = $_POST['OtherInformationType22'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName22, OtherInformationType22";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName22', '$OtherInformationType22'";
                    
                    if($OtherInformationType22 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation22");
                    }
                }
                if(!empty($_POST['OtherInformationName23']) && !empty($_POST['OtherInformationType23'])) {
                    $OtherInformationName23 = $_POST['OtherInformationName23'];
                    $OtherInformationType23 = $_POST['OtherInformationType23'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName23, OtherInformationType23";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName23', '$OtherInformationType23'";
                    
                    if($OtherInformationType23 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation23");
                    }
                }
                if(!empty($_POST['OtherInformationName24']) && !empty($_POST['OtherInformationType24'])) {
                    $OtherInformationName24 = $_POST['OtherInformationName24'];
                    $OtherInformationType24 = $_POST['OtherInformationType24'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName24, OtherInformationType24";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName24', '$OtherInformationType24'";
                    
                    if($OtherInformationType24 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation24");
                    }
                }
                if(!empty($_POST['OtherInformationName25']) && !empty($_POST['OtherInformationType25'])) {
                    $OtherInformationName25 = $_POST['OtherInformationName25'];
                    $OtherInformationType25 = $_POST['OtherInformationType25'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName25, OtherInformationType25";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName25', '$OtherInformationType25'";
                    
                    if($OtherInformationType25 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation25");
                    }
                }
                if(!empty($_POST['OtherInformationName26']) && !empty($_POST['OtherInformationType26'])) {
                    $OtherInformationName26 = $_POST['OtherInformationName26'];
                    $OtherInformationType26 = $_POST['OtherInformationType26'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName26, OtherInformationType26";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName26', '$OtherInformationType26'";
                    
                    if($OtherInformationType26 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation26");
                    }
                }
                if(!empty($_POST['OtherInformationName27']) && !empty($_POST['OtherInformationType27'])) {
                    $OtherInformationName27 = $_POST['OtherInformationName27'];
                    $OtherInformationType27 = $_POST['OtherInformationType27'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName27, OtherInformationType27";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName27', '$OtherInformationType27'";
                    
                    if($OtherInformationType27 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation27");
                    }
                }
                if(!empty($_POST['OtherInformationName28']) && !empty($_POST['OtherInformationType28'])) {
                    $OtherInformationName28 = $_POST['OtherInformationName28'];
                    $OtherInformationType28 = $_POST['OtherInformationType28'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName28, OtherInformationType28";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName28', '$OtherInformationType28'";
                    
                    if($OtherInformationType28 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation28");
                    }
                }
                if(!empty($_POST['OtherInformationName29']) && !empty($_POST['OtherInformationType29'])) {
                    $OtherInformationName29 = $_POST['OtherInformationName29'];
                    $OtherInformationType29 = $_POST['OtherInformationType29'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName29, OtherInformationType29";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName29', '$OtherInformationType29'";
                    
                    if($OtherInformationType29 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation29");
                    }
                }
                if(!empty($_POST['OtherInformationName30']) && !empty($_POST['OtherInformationType30'])) {
                    $OtherInformationName30 = $_POST['OtherInformationName30'];
                    $OtherInformationType30 = $_POST['OtherInformationType30'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName30, OtherInformationType30";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName30', '$OtherInformationType30'";
                    
                    if($OtherInformationType30 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation30");
                    }
                }
                if(!empty($_POST['OtherInformationName31']) && !empty($_POST['OtherInformationType31'])) {
                    $OtherInformationName31 = $_POST['OtherInformationName31'];
                    $OtherInformationType31 = $_POST['OtherInformationType31'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName31, OtherInformationType31";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName31', '$OtherInformationType31'";
                    
                    if($OtherInformationType31 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation31");
                    }
                }
                if(!empty($_POST['OtherInformationName32']) && !empty($_POST['OtherInformationType32'])) {
                    $OtherInformationName32 = $_POST['OtherInformationName32'];
                    $OtherInformationType32 = $_POST['OtherInformationType32'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName32, OtherInformationType32";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName32', '$OtherInformationType32'";
                    
                    if($OtherInformationType32 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation32");
                    }
                }
                if(!empty($_POST['OtherInformationName33']) && !empty($_POST['OtherInformationType33'])) {
                    $OtherInformationName33 = $_POST['OtherInformationName33'];
                    $OtherInformationType33 = $_POST['OtherInformationType33'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName33, OtherInformationType33";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName33', '$OtherInformationType33'";
                    
                    if($OtherInformationType33 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation33");
                    }
                }
                if(!empty($_POST['OtherInformationName34']) && !empty($_POST['OtherInformationType34'])) {
                    $OtherInformationName34 = $_POST['OtherInformationName34'];
                    $OtherInformationType34 = $_POST['OtherInformationType34'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName34, OtherInformationType34";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName34', '$OtherInformationType34'";
                    
                    if($OtherInformationType34 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation34");
                    }
                }
                if(!empty($_POST['OtherInformationName35']) && !empty($_POST['OtherInformationType35'])) {
                    $OtherInformationName35 = $_POST['OtherInformationName35'];
                    $OtherInformationType35 = $_POST['OtherInformationType35'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName35, OtherInformationType35";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName35', '$OtherInformationType35'";
                    
                    if($OtherInformationType35 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation35");
                    }
                }
                if(!empty($_POST['OtherInformationName36']) && !empty($_POST['OtherInformationType36'])) {
                    $OtherInformationName36 = $_POST['OtherInformationName36'];
                    $OtherInformationType36 = $_POST['OtherInformationType36'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName36, OtherInformationType36";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName36', '$OtherInformationType36'";
                    
                    if($OtherInformationType36 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation36");
                    }
                }
                if(!empty($_POST['OtherInformationName37']) && !empty($_POST['OtherInformationType37'])) {
                    $OtherInformationName37 = $_POST['OtherInformationName37'];
                    $OtherInformationType37 = $_POST['OtherInformationType37'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName37, OtherInformationType37";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName37', '$OtherInformationType37'";
                    
                    if($OtherInformationType37 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation37");
                    }
                }
                if(!empty($_POST['OtherInformationName38']) && !empty($_POST['OtherInformationType38'])) {
                    $OtherInformationName38 = $_POST['OtherInformationName38'];
                    $OtherInformationType38 = $_POST['OtherInformationType38'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName38, OtherInformationType38";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName38', '$OtherInformationType38'";
                    
                    if($OtherInformationType38 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation38");
                    }
                }
                if(!empty($_POST['OtherInformationName39']) && !empty($_POST['OtherInformationType39'])) {
                    $OtherInformationName39 = $_POST['OtherInformationName39'];
                    $OtherInformationType39 = $_POST['OtherInformationType39'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName39, OtherInformationType39";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName39', '$OtherInformationType39'";
                    
                    if($OtherInformationType39 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation39");
                    }
                }
                if(!empty($_POST['OtherInformationName40']) && !empty($_POST['OtherInformationType40'])) {
                    $OtherInformationName40 = $_POST['OtherInformationName40'];
                    $OtherInformationType40 = $_POST['OtherInformationType40'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName40, OtherInformationType40";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName40', '$OtherInformationType40'";
                    
                    if($OtherInformationType40 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation40");
                    }
                }
                if(!empty($_POST['OtherInformationName41']) && !empty($_POST['OtherInformationType41'])) {
                    $OtherInformationName41 = $_POST['OtherInformationName41'];
                    $OtherInformationType41 = $_POST['OtherInformationType41'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName41, OtherInformationType41";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName41', '$OtherInformationType41'";
                    
                    if($OtherInformationType41 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation41");
                    }
                }
                if(!empty($_POST['OtherInformationName42']) && !empty($_POST['OtherInformationType42'])) {
                    $OtherInformationName42 = $_POST['OtherInformationName42'];
                    $OtherInformationType42 = $_POST['OtherInformationType42'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName42, OtherInformationType42";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName42', '$OtherInformationType42'";
                    
                    if($OtherInformationType42 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation42");
                    }
                }
                if(!empty($_POST['OtherInformationName43']) && !empty($_POST['OtherInformationType43'])) {
                    $OtherInformationName43 = $_POST['OtherInformationName43'];
                    $OtherInformationType43 = $_POST['OtherInformationType43'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName43, OtherInformationType43";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName43', '$OtherInformationType43'";
                    
                    if($OtherInformationType43 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation43");
                    }
                }
                if(!empty($_POST['OtherInformationName44']) && !empty($_POST['OtherInformationType44'])) {
                    $OtherInformationName44 = $_POST['OtherInformationName44'];
                    $OtherInformationType44 = $_POST['OtherInformationType44'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName44, OtherInformationType44";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName44', '$OtherInformationType44'";
                    
                    if($OtherInformationType44 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation44");
                    }
                }
                if(!empty($_POST['OtherInformationName45']) && !empty($_POST['OtherInformationType45'])) {
                    $OtherInformationName45 = $_POST['OtherInformationName45'];
                    $OtherInformationType45 = $_POST['OtherInformationType45'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName45, OtherInformationType45";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName45', '$OtherInformationType45'";
                    
                    if($OtherInformationType45 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation45");
                    }
                }
                if(!empty($_POST['OtherInformationName46']) && !empty($_POST['OtherInformationType46'])) {
                    $OtherInformationName46 = $_POST['OtherInformationName46'];
                    $OtherInformationType46 = $_POST['OtherInformationType46'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName46, OtherInformationType46";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName46', '$OtherInformationType46'";
                    
                    if($OtherInformationType46 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation46");
                    }
                }
                if(!empty($_POST['OtherInformationName47']) && !empty($_POST['OtherInformationType47'])) {
                    $OtherInformationName47 = $_POST['OtherInformationName47'];
                    $OtherInformationType47 = $_POST['OtherInformationType47'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName47, OtherInformationType47";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName47', '$OtherInformationType47'";
                    
                    if($OtherInformationType47 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation47");
                    }
                }
                if(!empty($_POST['OtherInformationName48']) && !empty($_POST['OtherInformationType48'])) {
                    $OtherInformationName48 = $_POST['OtherInformationName48'];
                    $OtherInformationType48 = $_POST['OtherInformationType48'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName48, OtherInformationType48";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName48', '$OtherInformationType48'";
                    
                    if($OtherInformationType48 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation48");
                    }
                }
                if(!empty($_POST['OtherInformationName49']) && !empty($_POST['OtherInformationType49'])) {
                    $OtherInformationName49 = $_POST['OtherInformationName49'];
                    $OtherInformationType49 = $_POST['OtherInformationType49'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName49, OtherInformationType49";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName49', '$OtherInformationType49'";
                    
                    if($OtherInformationType49 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation49");
                    }
                }
                if(!empty($_POST['OtherInformationName50']) && !empty($_POST['OtherInformationType50'])) {
                    $OtherInformationName50 = $_POST['OtherInformationName50'];
                    $OtherInformationType50 = $_POST['OtherInformationType50'];

                    $insert_sql_first_half = $insert_sql_first_half.", OtherInformationName50, OtherInformationType50";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$OtherInformationName50', '$OtherInformationType50'";
                    
                    if($OtherInformationType50 != "Text") {
                        array_push($OtherInformationArray, "OtherInformation50");
                    }
                }
                
                if(!empty($_POST['username'])) {
                    $username = $_POST['username'];
                    $insert_sql_first_half = $insert_sql_first_half.", username";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$username'";
                }
                if(!empty($_POST['password'])) {
                    $password = $_POST['password'];
                    $password = md5($password);
                    $insert_sql_first_half = $insert_sql_first_half.", password";
                    $insert_sql_second_half = $insert_sql_second_half. ", '$password'";
                }
            }
            
            // Feedback是否存在
            if(!empty($_POST['feedback'])) {
                $feedback = $_POST['feedback'];

                for($i=1; $i<=10; $i++) {
                    $feedback = str_replace("<img src=\"../image/informationBTN$i.png\" style=\"height:16px;\">", "_@informationBTN$i@_", $feedback);
                }
                
                $feedback = str_replace("<div><br></div>", "<br>", $feedback);
                $feedback = str_replace("<div>", "<br>", $feedback);
                $feedback = str_replace("</div>", "", $feedback);
                
                $insert_sql_first_half = $insert_sql_first_half.", feedback";
                $insert_sql_second_half = $insert_sql_second_half. ", '$feedback'";
            }
            
            if($IsUserDetails == 1) {
                $allowedType = array("application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
                if(!empty($_FILES['userDetailFile']['tmp_name']) && in_array($_FILES["userDetailFile"]["type"], $allowedType) && $_FILES["userDetailFile"]["size"] < 5000000) {
                    $target = "upload/".$Email.".xlsx";
                    $result = move_uploaded_file($_FILES["userDetailFile"]["tmp_name"], $target);
                    if($result) {
                        $conn = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect...');

                        /*========================= Add Transaction =========================*/
                        // 文件上传成功后
                        // 合并SQL
                        $insert_sql = $insert_sql_first_half.$insert_sql_second_half.", '$timestamp')";

                        $conn = mysqli_connect(HOST, USER, PASS, DB) or die('Unable to Connect...');
                        $insert_result = mysqli_query($conn, $insert_sql);

                        // 获取最后一条记录
                        $last_record_sql = "SELECT Id FROM spreadsheetcolumn ORDER BY Id DESC LIMIT 1";
                        $last_record_result = mysqli_query($conn, $last_record_sql);
                        $one_last_record_result = mysqli_fetch_assoc($last_record_result);
                        $SpreadSheetColumnId = $one_last_record_result['Id'];
                        
                        // 操作Excel
                        $inputFileType = 'Xlsx';
                        $inputFileName = "upload/".$Email.".xlsx";

                        $reader = IOFactory::createReader($inputFileType);
                        $reader->setReadDataOnly(true);
                        $spreadsheet = $reader->load($inputFileName);
                        
                        $highestColumn = $spreadsheet->getActiveSheet()->getHighestColumn();

                        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
                        
                        // 第一个单元格存在数据
                        if($sheetData[1]["A"] != "") {
                            // 插入的InformationName的数量
                            $InformationCount = 0;
                            for($i=1; $i<=10; $i++) {
                                if(strpos($insert_sql_first_half, "InformationName$i") !== false){
                                    $InformationCount++;
                                }
                            }
                            $InformationFlag = 0;
                            $ColumnArray = array("A","B","C","D","E","F","G","H","I","J");
                            // 插入的InformationName都有一个SheetColumn对应
                            // SheetColumn不可以超过10 ("A","B","C","D","E","F","G","H","I","J")
                            if(in_array($highestColumn, $ColumnArray)) {
                                $ColumnArrayElement = array_search($highestColumn, $ColumnArray) + 1;
                                // SheetColumn和InformationName一一对应
                                if($InformationCount == $ColumnArrayElement) {
                                    // 注册记录Column1不可重复
                                    $Column1Array = array();
                                    for($row=1; $row<=count($sheetData); $row++) {
                                        $Column1Array[$row-1] = $sheetData[$row]["A"];
                                    }
                                    if (count($Column1Array) != count(array_unique($Column1Array))) {
                                        $delete_sql = "DELETE FROM spreadsheetcolumn WHERE Id = $SpreadSheetColumnId;";
                                        $delete_result = mysqli_query($conn, $delete_sql);
                                        mysqli_close($conn);
                                        header("Location:addSheet.php?status=failed1");
                                    }
                                    else {
                                        for($row=1; $row<=count($sheetData); $row++) {
                                            
                                            $insert_sql_first_half = "INSERT INTO spreadsheetcontent (SpreadSheetColumnId";
                                            $insert_sql_second_half = ", TimeStamp) VALUES ($SpreadSheetColumnId";

                                            for($i=1; $i<=$InformationCount; $i++) {
                                                if(isset($sheetData[$row]["{$ColumnArray[$i-1]}"])) {
                                                    $SheetDetail = $sheetData[$row]["{$ColumnArray[$i-1]}"];
                                                    $insert_sql_first_half = $insert_sql_first_half.", Information$i";
                                                    $insert_sql_second_half = $insert_sql_second_half. ", '$SheetDetail'";
                                                }
                                            }

                                            $insert_sql = $insert_sql_first_half.$insert_sql_second_half.", '$timestamp')";
                                            $insert_result = mysqli_query($conn, $insert_sql); 
                                        }
                                    }
                                }
                                else {
                                    $delete_sql = "DELETE FROM spreadsheetcolumn WHERE Id = $SpreadSheetColumnId;";
                                    $delete_result = mysqli_query($conn, $delete_sql);
                                    mysqli_close($conn);
                                    header("Location:addSheet.php?status=failed2");
                                }
                            }
                            else {
                                $delete_sql = "DELETE FROM spreadsheetcolumn WHERE Id = $SpreadSheetColumnId;";
                                $delete_result = mysqli_query($conn, $delete_sql);
                                mysqli_close($conn);
                                header("Location:addSheet.php?status=failed3");
                            }
                        }
                    }
                }
                else {
                    header("Location:addSheet.php?status=failed");
                }
            }
            else {
                /*========================= Add Transaction =========================*/
                // 合并SQL
                $insert_sql = $insert_sql_first_half.$insert_sql_second_half.", '$timestamp')";

                $conn = mysqli_connect(HOST, USER, PASS, DB) or die('Unable to Connect...');
                $insert_result = mysqli_query($conn, $insert_sql);

                // 获取最后一条记录
                $last_record_sql = "SELECT Id FROM spreadsheetcolumn ORDER BY Id DESC LIMIT 1";
                $last_record_result = mysqli_query($conn, $last_record_sql);
                $one_last_record_result = mysqli_fetch_assoc($last_record_result);
                $SpreadSheetColumnId = $one_last_record_result['Id'];

                for($i=0; $i<count($InformationArray); $i++) {

                    $Number = substr($InformationArray[$i], 11, strlen($InformationArray[$i]) - 11);
                    $InformationType = 'InformationType' . $Number;

                    if($$InformationType == "DorpdownList") {
                        $InformationDorpdownListItem = 'Information'.$Number.'DorpdownListItem';
                        $$InformationDorpdownListItem = $_POST["$InformationDorpdownListItem"];

                        for($j=0; $j<count($$InformationDorpdownListItem); $j++) {
                            if(!empty(${$InformationDorpdownListItem}[$j])) {
                                $insert_information_sql = "INSERT INTO information".$Number." (SpreadSheetColumnId, Content) VALUES ($SpreadSheetColumnId, '".${$InformationDorpdownListItem}[$j]."')";
                                $insert_information_result = mysqli_query($conn, $insert_information_sql);
                            }
                        }
                    }
                    else if($$InformationType == "CheckBox") {
                        $InformationCheckBoxItem = 'Information'.$Number.'CheckBoxItem';
                        $$InformationCheckBoxItem = $_POST["$InformationCheckBoxItem"];

                        for($j=0; $j<count($$InformationCheckBoxItem); $j++) {
                            if(!empty(${$InformationCheckBoxItem}[$j])) {
                                $insert_information_sql = "INSERT INTO information".$Number." (SpreadSheetColumnId, Content) VALUES ($SpreadSheetColumnId, '".${$InformationCheckBoxItem}[$j]."')";
                                $insert_information_result = mysqli_query($conn, $insert_information_sql);
                            }
                        }
                    }
                    else if($$InformationType == "Radio") {
                        $InformationRadioItem = 'Information'.$Number.'RadioItem';
                        $$InformationRadioItem = $_POST["$InformationRadioItem"];
                        for($j=0; $j<count($$InformationRadioItem); $j++) {
                            if(!empty(${$InformationRadioItem}[$j])) {
                                $insert_information_sql = "INSERT INTO information".$Number." (SpreadSheetColumnId, Content) VALUES ($SpreadSheetColumnId, '".${$InformationRadioItem}[$j]."')";
                                $insert_information_result = mysqli_query($conn, $insert_information_sql);
                            }
                        }
                    }
                }
            }

            if(count($OtherInformationArray) > 0) {
                for($i=0; $i<count($OtherInformationArray); $i++) {

                    $Number = substr($OtherInformationArray[$i], 16, strlen($OtherInformationArray[$i]) - 16);
                    $OtherInformationType = 'OtherInformationType' . $Number;

                    if($$OtherInformationType == "DorpdownList") {
                        $OtherInformationDorpdownListItem = 'OtherInformation'.$Number.'DorpdownListItem';
                        $$OtherInformationDorpdownListItem = $_POST["$OtherInformationDorpdownListItem"];

                        for($j=0; $j<count($$OtherInformationDorpdownListItem); $j++) {
                            if(!empty(${$OtherInformationDorpdownListItem}[$j])) {
                                $insert_otherinformation_sql = "INSERT INTO otherinformation".$Number." (SpreadSheetColumnId, Content) VALUES ($SpreadSheetColumnId, '".${$OtherInformationDorpdownListItem}[$j]."')";
                                $insert_otherinformation_result = mysqli_query($conn, $insert_otherinformation_sql);
                            }
                        }
                    }
                    else if($$OtherInformationType == "CheckBox") {
                        $OtherInformationCheckBoxItem = 'OtherInformation'.$Number.'CheckBoxItem';
                        $$OtherInformationCheckBoxItem = $_POST["$OtherInformationCheckBoxItem"];

                        for($j=0; $j<count($$OtherInformationCheckBoxItem); $j++) {
                            if(!empty(${$OtherInformationCheckBoxItem}[$j])) {
                                $insert_otherinformation_sql = "INSERT INTO otherinformation".$Number." (SpreadSheetColumnId, Content) VALUES ($SpreadSheetColumnId, '".${$OtherInformationCheckBoxItem}[$j]."')";
                                $insert_otherinformation_result = mysqli_query($conn, $insert_otherinformation_sql);
                            }
                        }
                    }
                    else if($$OtherInformationType == "Radio") {
                        $OtherInformationRadioItem = 'OtherInformation'.$Number.'RadioItem';
                        $$OtherInformationRadioItem = $_POST["$OtherInformationRadioItem"];

                        for($j=0; $j<count($$OtherInformationRadioItem); $j++) {
                            if(!empty(${$OtherInformationRadioItem}[$j])) {
                                $insert_otherinformation_sql = "INSERT INTO otherinformation".$Number." (SpreadSheetColumnId, Content) VALUES ($SpreadSheetColumnId, '".${$OtherInformationRadioItem}[$j]."')";
                                $insert_otherinformation_sql = mysqli_query($conn, $insert_otherinformation_sql);
                            }
                        }
                    }
                }
            }

            mysqli_close($conn);
            header("Location:sheet.php");
        }
    }
    else {
        header("Location:login.php");
    }
?>



<!DOCTYLE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>EventDat</title>
        <link rel='stylesheet' href='css/addSheet.css' type='text/css' />
        <script src="../js/jquery.min.js"></script>
    </head>
    <body>
        <h1 class="title">Add Sheet</h1>
        <?php
            if (isset($_SESSION['Email'])) {
                $Email = $_SESSION['Email'];
                echo "<p class='subtitle'>Hello, $Email</p>";
            }
            if (isset($_GET['status'])) {
                if($_GET['status'] == "failed") {
                ?>
                    <p class="msg2">Add Sheet failed.</p>
                <?php
                }
                else if($_GET['status'] == "failed1") {
                ?>
                    <p class="msg2">Identification column have duplicate values.</p>
                <?php
                }
                else if($_GET['status'] == "failed2") {
                ?>
                    <p class="msg2">The number of sheet columns is different from the number of informations.</p>
                <?php
                }
                else if($_GET['status'] == "failed3") {
                ?>
                    <p class="msg2">The number of sheet columns can not be more than 10</p>
                <?php
                }
            }
        ?>
        
        <form method="post" action="addSheet.php" onsubmit="return checkSubmit()" enctype="multipart/form-data">
            <div class="attributeFieldsetContainer">
                <fieldset class="attributeFieldset">
                    <legend>Spread Sheet Attribute</legend>

                    <label class="label">Sheet Name<label style="color:red;">*</label>:</label>
                    <input type="text" name="sheetName" autocomplete="off" required/><br>
                    <label id="sheetSubject" class="label">Sheet Subject:</label>
                    <textarea name="sheetSubject" autocomplete="off"></textarea><br>
                    <label class="label">User Details?<label style="color:red;">*</label>:</label>
                    <label for="userDetailsYes">Yes&nbsp;</label><input type="radio" id="userDetailsYes" name="userDetails" autocomplete="off" value="Yes"/>&nbsp;&nbsp;&nbsp;
                    <label for="userDetailsNo">No&nbsp;</label><input type="radio" id="userDetailsNo" name="userDetails" autocomplete="off" value="No" checked/>&nbsp;&nbsp;&nbsp;
                    <input type="file" name="userDetailFile" disabled required/>
                    <div class="userDetailRequirement">
                        <p><label class="label"></label><label class="label">Note :</label>Please format the excel file follow the requirements below:</p>
                        <p><label class="label"></label><label class="label">1. Column A :</label>Identification Column</p>
                        <p><label class="label"></label><label class="label">2. Column B C D... :</label>Other Columns...</p>
                    </div>
                </fieldset>
            </div>
            <!--================================= Information category ================================-->
            <div class="sheetInfoFieldsetContainer">
                <fieldset class="sheetInfoFieldset">
                    <legend>Spread Sheet Information</legend>
                    <p class="Introduction">Information for user to register</p>
                    <label class="label" for="emailNotification">Email Notification:</label>
                    <input type="checkbox" id="emailNotification" name="emailNotification[]" value="Yes"/><br>

                    <!--=========================== Information 1: =======================================-->
                    <label class="label">Information 1<label style="color:red;">*</label>:</label>
                    <!-- 默认InformationType1是Text -->
                    <input type="text" class="Information" name="InformationName1" autocomplete="off" required placeholder="Name (Text)"/>
                    <label style="color:red; margin-left:15px;">Identification</label><br>
                    
                    <!--=========================== Information 2: =======================================-->
                    <label class="label">Information 2:</label>
                    <div class="sheetInfoText">
                        <input type="hidden" name="InformationType2" value="Text" />
                        <input type="text" class="Information" name="InformationName2" autocomplete="off" placeholder="Name (Text)"/>
                    </div>
                    <div class="sheetInfoDorpdownList">
                        <input type="hidden" name="InformationType2" value="DorpdownList" disabled/>
                        <input type="text" class="Information" name="InformationName2" autocomplete="off" placeholder="Name (Dorpdown List)" disabled/>
                    </div>
                    <div class="sheetInfoCheckBox">
                        <input type="hidden" name="InformationType2" value="CheckBox" disabled/>
                        <input type="text" class="Information" name="InformationName2" autocomplete="off" placeholder="Name (CheckBox)" disabled/>
                    </div>
                    <div class="sheetInfoRadio">
                        <input type="hidden" name="InformationType2" value="Radio" disabled/>
                        <input type="text" class="Information" name="InformationName2" autocomplete="off" placeholder="Name (Radio)" disabled/>
                    </div>
                    <div class="sheetInfoButtonContainer">
                        <button class="TextBTN" type="button" onclick="changeToText(0)">Text</button>
                        <button class="DorpdownListBTN" type="button" onclick="changeToDorpdownList(0)">Dorpdown List</button>
                        <button class="CheckBoxBTN" type="button" onclick="changeToCheckBox(0)">CheckBox</button>
                        <button class="RadioBTN" type="button" onclick="changeToRadio(0)">Radio</button>
                    </div><br>
                    <!-- Information 2每个类型的内容都在这里显示 -->
                    <div class="sheetInfoInput">
                        <label class="label"><img class="plusImg" src="../image/plus.png" width="14px;" onclick="addItem(0)"/><br><img class="minusImg" src="../image/minus.png" width="14px;" onclick="removeItem(0)"/></label>
                        <div class="sheetInfoDorpdownListContent">
                            <input type="text" name="Information2DorpdownListItem[]" autocomplete="off" placeholder="Item (Dorpdown List)" disabled/>
                            <input type="text" name="Information2DorpdownListItem[]" autocomplete="off" placeholder="Item (Dorpdown List)" disabled/>
                            <input type="text" name="Information2DorpdownListItem[]" autocomplete="off" placeholder="Item (Dorpdown List)" disabled/>
                        </div>
                        <div class="sheetInfoCheckBoxContent">
                            <input type="text" name="Information2CheckBoxItem[]" autocomplete="off" placeholder="Item (CheckBox)" disabled/>
                            <input type="text" name="Information2CheckBoxItem[]" autocomplete="off" placeholder="Item (CheckBox)" disabled/>
                            <input type="text" name="Information2CheckBoxItem[]" autocomplete="off" placeholder="Item (CheckBox)" disabled/>
                        </div>
                        <div class="sheetInfoRadioContent">
                            <input type="text" name="Information2RadioItem[]" autocomplete="off" placeholder="Item (Radio)" disabled/>
                            <input type="text" name="Information2RadioItem[]" autocomplete="off" placeholder="Item (Radio)" disabled/>
                            <input type="text" name="Information2RadioItem[]" autocomplete="off" placeholder="Item (Radio)" disabled/>
                        </div>
                    </div>
                    
                    <!--=========================== Information 3: =======================================-->
                    <label class="label">Information 3:</label>
                    <div class="sheetInfoText">
                        <input type="hidden" name="InformationType3" value="Text" />
                        <input type="text" class="Information" name="InformationName3" autocomplete="off" placeholder="Name (Text)"/>
                    </div>
                    <div class="sheetInfoDorpdownList">
                        <input type="hidden" name="InformationType3" value="DorpdownList" disabled/>
                        <input type="text" class="Information" name="InformationName3" autocomplete="off" placeholder="Name (Dorpdown List)" disabled/>
                    </div>
                    <div class="sheetInfoCheckBox">
                        <input type="hidden" name="InformationType3" value="CheckBox" disabled/>
                        <input type="text" class="Information" name="InformationName3" autocomplete="off" placeholder="Name (CheckBox)" disabled/>
                    </div>
                    <div class="sheetInfoRadio">
                        <input type="hidden" name="InformationType3" value="Radio" disabled/>
                        <input type="text" class="Information" name="InformationName3" autocomplete="off" placeholder="Name (Radio)" disabled/>
                    </div>
                    <div class="sheetInfoButtonContainer">
                        <button class="TextBTN" type="button" onclick="changeToText(1)">Text</button>
                        <button class="DorpdownListBTN" type="button" onclick="changeToDorpdownList(1)">Dorpdown List</button>
                        <button class="CheckBoxBTN" type="button" onclick="changeToCheckBox(1)">CheckBox</button>
                        <button class="RadioBTN" type="button" onclick="changeToRadio(1)">Radio</button>
                    </div><br>
                    <!-- Information 3每个类型的内容都在这里显示 -->
                    <div class="sheetInfoInput">
                        <label class="label"><img class="plusImg" src="../image/plus.png" width="14px;" onclick="addItem(1)"/><br><img class="minusImg" src="../image/minus.png" width="14px;" onclick="removeItem(1)"/></label>
                        <div class="sheetInfoDorpdownListContent">
                            <input type="text" name="Information3DorpdownListItem[]" autocomplete="off" placeholder="Item (Dorpdown List)" disabled/>
                            <input type="text" name="Information3DorpdownListItem[]" autocomplete="off" placeholder="Item (Dorpdown List)" disabled/>
                            <input type="text" name="Information3DorpdownListItem[]" autocomplete="off" placeholder="Item (Dorpdown List)" disabled/>
                        </div>
                        <div class="sheetInfoCheckBoxContent">
                            <input type="text" name="Information3CheckBoxItem[]" autocomplete="off" placeholder="Item (CheckBox)" disabled/>
                            <input type="text" name="Information3CheckBoxItem[]" autocomplete="off" placeholder="Item (CheckBox)" disabled/>
                            <input type="text" name="Information3CheckBoxItem[]" autocomplete="off" placeholder="Item (CheckBox)" disabled/>
                        </div>
                        <div class="sheetInfoRadioContent">
                            <input type="text" name="Information3RadioItem[]" autocomplete="off" placeholder="Item (Radio)" disabled/>
                            <input type="text" name="Information3RadioItem[]" autocomplete="off" placeholder="Item (Radio)" disabled/>
                            <input type="text" name="Information3RadioItem[]" autocomplete="off" placeholder="Item (Radio)" disabled/>
                        </div>
                    </div>
                    
                    <!--=========================== Information 4: =======================================-->
                    <label class="label">Information 4:</label>
                    <div class="sheetInfoText">
                        <input type="hidden" name="InformationType4" value="Text" />
                        <input type="text" class="Information" name="InformationName4" autocomplete="off" placeholder="Name (Text)"/>
                    </div>
                    <div class="sheetInfoDorpdownList">
                        <input type="hidden" name="InformationType4" value="DorpdownList" disabled/>
                        <input type="text" class="Information" name="InformationName4" autocomplete="off" placeholder="Name (Dorpdown List)" disabled/>
                    </div>
                    <div class="sheetInfoCheckBox">
                        <input type="hidden" name="InformationType4" value="CheckBox" disabled/>
                        <input type="text" class="Information" name="InformationName4" autocomplete="off" placeholder="Name (CheckBox)" disabled/>
                    </div>
                    <div class="sheetInfoRadio">
                        <input type="hidden" name="InformationType4" value="Radio" disabled/>
                        <input type="text" class="Information" name="InformationName4" autocomplete="off" placeholder="Name (Radio)" disabled/>
                    </div>
                    <div class="sheetInfoButtonContainer">
                        <button class="TextBTN" type="button" onclick="changeToText(2)">Text</button>
                        <button class="DorpdownListBTN" type="button" onclick="changeToDorpdownList(2)">Dorpdown List</button>
                        <button class="CheckBoxBTN" type="button" onclick="changeToCheckBox(2)">CheckBox</button>
                        <button class="RadioBTN" type="button" onclick="changeToRadio(2)">Radio</button>
                    </div><br>
                    <!-- Information 4每个类型的内容都在这里显示 -->
                    <div class="sheetInfoInput">
                        <label class="label"><img class="plusImg" src="../image/plus.png" width="14px;" onclick="addItem(2)"/><br><img class="minusImg" src="../image/minus.png" width="14px;" onclick="removeItem(2)"/></label>
                        <div class="sheetInfoDorpdownListContent">
                            <input type="text" name="Information4DorpdownListItem[]" autocomplete="off" placeholder="Item (Dorpdown List)" disabled/>
                            <input type="text" name="Information4DorpdownListItem[]" autocomplete="off" placeholder="Item (Dorpdown List)" disabled/>
                            <input type="text" name="Information4DorpdownListItem[]" autocomplete="off" placeholder="Item (Dorpdown List)" disabled/>
                        </div>
                        <div class="sheetInfoCheckBoxContent">
                            <input type="text" name="Information4CheckBoxItem[]" autocomplete="off" placeholder="Item (CheckBox)" disabled/>
                            <input type="text" name="Information4CheckBoxItem[]" autocomplete="off" placeholder="Item (CheckBox)" disabled/>
                            <input type="text" name="Information4CheckBoxItem[]" autocomplete="off" placeholder="Item (CheckBox)" disabled/>
                        </div>
                        <div class="sheetInfoRadioContent">
                            <input type="text" name="Information4RadioItem[]" autocomplete="off" placeholder="Item (Radio)" disabled/>
                            <input type="text" name="Information4RadioItem[]" autocomplete="off" placeholder="Item (Radio)" disabled/>
                            <input type="text" name="Information4RadioItem[]" autocomplete="off" placeholder="Item (Radio)" disabled/>
                        </div>
                    </div>
                    
                    <!--=========================== Information 5: =======================================-->
                    <label class="label">Information 5:</label>
                    <div class="sheetInfoText">
                        <input type="hidden" name="InformationType5" value="Text" />
                        <input type="text" class="Information" name="InformationName5" autocomplete="off" placeholder="Name (Text)"/>
                    </div>
                    <div class="sheetInfoDorpdownList">
                        <input type="hidden" name="InformationType5" value="DorpdownList" disabled/>
                        <input type="text" class="Information" name="InformationName5" autocomplete="off" placeholder="Name (Dorpdown List)" disabled/>
                    </div>
                    <div class="sheetInfoCheckBox">
                        <input type="hidden" name="InformationType5" value="CheckBox" disabled/>
                        <input type="text" class="Information" name="InformationName5" autocomplete="off" placeholder="Name (CheckBox)" disabled/>
                    </div>
                    <div class="sheetInfoRadio">
                        <input type="hidden" name="InformationType5" value="Radio" disabled/>
                        <input type="text" class="Information" name="InformationName5" autocomplete="off" placeholder="Name (Radio)" disabled/>
                    </div>
                    <div class="sheetInfoButtonContainer">
                        <button class="TextBTN" type="button" onclick="changeToText(3)">Text</button>
                        <button class="DorpdownListBTN" type="button" onclick="changeToDorpdownList(3)">Dorpdown List</button>
                        <button class="CheckBoxBTN" type="button" onclick="changeToCheckBox(3)">CheckBox</button>
                        <button class="RadioBTN" type="button" onclick="changeToRadio(3)">Radio</button>
                    </div><br>
                    <!-- Information 5每个类型的内容都在这里显示 -->
                    <div class="sheetInfoInput">
                        <label class="label"><img class="plusImg" src="../image/plus.png" width="14px;" onclick="addItem(3)"/><br><img class="minusImg" src="../image/minus.png" width="14px;" onclick="removeItem(3)"/></label>
                        <div class="sheetInfoDorpdownListContent">
                            <input type="text" name="Information5DorpdownListItem[]" autocomplete="off" placeholder="Item (Dorpdown List)" disabled/>
                            <input type="text" name="Information5DorpdownListItem[]" autocomplete="off" placeholder="Item (Dorpdown List)" disabled/>
                            <input type="text" name="Information5DorpdownListItem[]" autocomplete="off" placeholder="Item (Dorpdown List)" disabled/>
                        </div>
                        <div class="sheetInfoCheckBoxContent">
                            <input type="text" name="Information5CheckBoxItem[]" autocomplete="off" placeholder="Item (CheckBox)" disabled/>
                            <input type="text" name="Information5CheckBoxItem[]" autocomplete="off" placeholder="Item (CheckBox)" disabled/>
                            <input type="text" name="Information5CheckBoxItem[]" autocomplete="off" placeholder="Item (CheckBox)" disabled/>
                        </div>
                        <div class="sheetInfoRadioContent">
                            <input type="text" name="Information5RadioItem[]" autocomplete="off" placeholder="Item (Radio)" disabled/>
                            <input type="text" name="Information5RadioItem[]" autocomplete="off" placeholder="Item (Radio)" disabled/>
                            <input type="text" name="Information5RadioItem[]" autocomplete="off" placeholder="Item (Radio)" disabled/>
                        </div>
                    </div>
                    
                    <!--=========================== Information 6: =======================================-->
                    <label class="label">Information 6:</label>
                    <div class="sheetInfoText">
                        <input type="hidden" name="InformationType6" value="Text" />
                        <input type="text" class="Information" name="InformationName6" autocomplete="off" placeholder="Name (Text)"/>
                    </div>
                    <div class="sheetInfoDorpdownList">
                        <input type="hidden" name="InformationType6" value="DorpdownList" disabled/>
                        <input type="text" class="Information" name="InformationName6" autocomplete="off" placeholder="Name (Dorpdown List)" disabled/>
                    </div>
                    <div class="sheetInfoCheckBox">
                        <input type="hidden" name="InformationType6" value="CheckBox" disabled/>
                        <input type="text" class="Information" name="InformationName6" autocomplete="off" placeholder="Name (CheckBox)" disabled/>
                    </div>
                    <div class="sheetInfoRadio">
                        <input type="hidden" name="InformationType6" value="Radio" disabled/>
                        <input type="text" class="Information" name="InformationName6" autocomplete="off" placeholder="Name (Radio)" disabled/>
                    </div>
                    <div class="sheetInfoButtonContainer">
                        <button class="TextBTN" type="button" onclick="changeToText(4)">Text</button>
                        <button class="DorpdownListBTN" type="button" onclick="changeToDorpdownList(4)">Dorpdown List</button>
                        <button class="CheckBoxBTN" type="button" onclick="changeToCheckBox(4)">CheckBox</button>
                        <button class="RadioBTN" type="button" onclick="changeToRadio(4)">Radio</button>
                    </div><br>
                    <!-- Information 6每个类型的内容都在这里显示 -->
                    <div class="sheetInfoInput">
                        <label class="label"><img class="plusImg" src="../image/plus.png" width="14px;" onclick="addItem(4)"/><br><img class="minusImg" src="../image/minus.png" width="14px;" onclick="removeItem(4)"/></label>
                        <div class="sheetInfoDorpdownListContent">
                            <input type="text" name="Information6DorpdownListItem[]" autocomplete="off" placeholder="Item (Dorpdown List)" disabled/>
                            <input type="text" name="Information6DorpdownListItem[]" autocomplete="off" placeholder="Item (Dorpdown List)" disabled/>
                            <input type="text" name="Information6DorpdownListItem[]" autocomplete="off" placeholder="Item (Dorpdown List)" disabled/>
                        </div>
                        <div class="sheetInfoCheckBoxContent">
                            <input type="text" name="Information6CheckBoxItem[]" autocomplete="off" placeholder="Item (CheckBox)" disabled/>
                            <input type="text" name="Information6CheckBoxItem[]" autocomplete="off" placeholder="Item (CheckBox)" disabled/>
                            <input type="text" name="Information6CheckBoxItem[]" autocomplete="off" placeholder="Item (CheckBox)" disabled/>
                        </div>
                        <div class="sheetInfoRadioContent">
                            <input type="text" name="Information6RadioItem[]" autocomplete="off" placeholder="Item (Radio)" disabled/>
                            <input type="text" name="Information6RadioItem[]" autocomplete="off" placeholder="Item (Radio)" disabled/>
                            <input type="text" name="Information6RadioItem[]" autocomplete="off" placeholder="Item (Radio)" disabled/>
                        </div>
                    </div>
                    
                    <!--=========================== Information 7: =======================================-->
                    <label class="label">Information 7:</label>
                    <div class="sheetInfoText">
                        <input type="hidden" name="InformationType7" value="Text" />
                        <input type="text" class="Information" name="InformationName7" autocomplete="off" placeholder="Name (Text)"/>
                    </div>
                    <div class="sheetInfoDorpdownList">
                        <input type="hidden" name="InformationType7" value="DorpdownList" disabled/>
                        <input type="text" class="Information" name="InformationName6" autocomplete="off" placeholder="Name (Dorpdown List)" disabled/>
                    </div>
                    <div class="sheetInfoCheckBox">
                        <input type="hidden" name="InformationType7" value="CheckBox" disabled/>
                        <input type="text" class="Information" name="InformationName6" autocomplete="off" placeholder="Name (CheckBox)" disabled/>
                    </div>
                    <div class="sheetInfoRadio">
                        <input type="hidden" name="InformationType7" value="Radio" disabled/>
                        <input type="text" class="Information" name="InformationName7" autocomplete="off" placeholder="Name (Radio)" disabled/>
                    </div>
                    <div class="sheetInfoButtonContainer">
                        <button class="TextBTN" type="button" onclick="changeToText(5)">Text</button>
                        <button class="DorpdownListBTN" type="button" onclick="changeToDorpdownList(5)">Dorpdown List</button>
                        <button class="CheckBoxBTN" type="button" onclick="changeToCheckBox(5)">CheckBox</button>
                        <button class="RadioBTN" type="button" onclick="changeToRadio(5)">Radio</button>
                    </div><br>
                    <!-- Information 7每个类型的内容都在这里显示 -->
                    <div class="sheetInfoInput">
                        <label class="label"><img class="plusImg" src="../image/plus.png" width="14px;" onclick="addItem(5)"/><br><img class="minusImg" src="../image/minus.png" width="14px;" onclick="removeItem(5)"/></label>
                        <div class="sheetInfoDorpdownListContent">
                            <input type="text" name="Information7DorpdownListItem[]" autocomplete="off" placeholder="Item (Dorpdown List)" disabled/>
                            <input type="text" name="Information7DorpdownListItem[]" autocomplete="off" placeholder="Item (Dorpdown List)" disabled/>
                            <input type="text" name="Information7DorpdownListItem[]" autocomplete="off" placeholder="Item (Dorpdown List)" disabled/>
                        </div>
                        <div class="sheetInfoCheckBoxContent">
                            <input type="text" name="Information7CheckBoxItem[]" autocomplete="off" placeholder="Item (CheckBox)" disabled/>
                            <input type="text" name="Information7CheckBoxItem[]" autocomplete="off" placeholder="Item (CheckBox)" disabled/>
                            <input type="text" name="Information7CheckBoxItem[]" autocomplete="off" placeholder="Item (CheckBox)" disabled/>
                        </div>
                        <div class="sheetInfoRadioContent">
                            <input type="text" name="Information7RadioItem[]" autocomplete="off" placeholder="Item (Radio)" disabled/>
                            <input type="text" name="Information7RadioItem[]" autocomplete="off" placeholder="Item (Radio)" disabled/>
                            <input type="text" name="Information7RadioItem[]" autocomplete="off" placeholder="Item (Radio)" disabled/>
                        </div>
                    </div>
                    
                    <!--=========================== Information 8: =======================================-->
                    <label class="label">Information 8:</label>
                    <div class="sheetInfoText">
                        <input type="hidden" name="InformationType8" value="Text" />
                        <input type="text" class="Information" name="InformationName8" autocomplete="off" placeholder="Name (Text)"/>
                    </div>
                    <div class="sheetInfoDorpdownList">
                        <input type="hidden" name="InformationType8" value="DorpdownList" disabled/>
                        <input type="text" class="Information" name="InformationName8" autocomplete="off" placeholder="Name (Dorpdown List)" disabled/>
                    </div>
                    <div class="sheetInfoCheckBox">
                        <input type="hidden" name="InformationType8" value="CheckBox" disabled/>
                        <input type="text" class="Information" name="InformationName8" autocomplete="off" placeholder="Name (CheckBox)" disabled/>
                    </div>
                    <div class="sheetInfoRadio">
                        <input type="hidden" name="InformationType8" value="Radio" disabled/>
                        <input type="text" class="Information" name="InformationName8" autocomplete="off" placeholder="Name (Radio)" disabled/>
                    </div>
                    <div class="sheetInfoButtonContainer">
                        <button class="TextBTN" type="button" onclick="changeToText(6)">Text</button>
                        <button class="DorpdownListBTN" type="button" onclick="changeToDorpdownList(6)">Dorpdown List</button>
                        <button class="CheckBoxBTN" type="button" onclick="changeToCheckBox(6)">CheckBox</button>
                        <button class="RadioBTN" type="button" onclick="changeToRadio(6)">Radio</button>
                    </div><br>
                    <!-- Information 8每个类型的内容都在这里显示 -->
                    <div class="sheetInfoInput">
                        <label class="label"><img class="plusImg" src="../image/plus.png" width="14px;" onclick="addItem(6)"/><br><img class="minusImg" src="../image/minus.png" width="14px;" onclick="removeItem(6)"/></label>
                        <div class="sheetInfoDorpdownListContent">
                            <input type="text" name="Information8DorpdownListItem[]" autocomplete="off" placeholder="Item (Dorpdown List)" disabled/>
                            <input type="text" name="Information8DorpdownListItem[]" autocomplete="off" placeholder="Item (Dorpdown List)" disabled/>
                            <input type="text" name="Information8DorpdownListItem[]" autocomplete="off" placeholder="Item (Dorpdown List)" disabled/>
                        </div>
                        <div class="sheetInfoCheckBoxContent">
                            <input type="text" name="Information8CheckBoxItem[]" autocomplete="off" placeholder="Item (CheckBox)" disabled/>
                            <input type="text" name="Information8CheckBoxItem[]" autocomplete="off" placeholder="Item (CheckBox)" disabled/>
                            <input type="text" name="Information8CheckBoxItem[]" autocomplete="off" placeholder="Item (CheckBox)" disabled/>
                        </div>
                        <div class="sheetInfoRadioContent">
                            <input type="text" name="Information8RadioItem[]" autocomplete="off" placeholder="Item (Radio)" disabled/>
                            <input type="text" name="Information8RadioItem[]" autocomplete="off" placeholder="Item (Radio)" disabled/>
                            <input type="text" name="Information8RadioItem[]" autocomplete="off" placeholder="Item (Radio)" disabled/>
                        </div>
                    </div>
                    
                    <!--=========================== Information 9: =======================================-->
                    <label class="label">Information 9:</label>
                    <div class="sheetInfoText">
                        <input type="hidden" name="InformationType9" value="Text" />
                        <input type="text" class="Information" name="InformationName9" autocomplete="off" placeholder="Name (Text)"/>
                    </div>
                    <div class="sheetInfoDorpdownList">
                        <input type="hidden" name="InformationType9" value="DorpdownList" disabled/>
                        <input type="text" class="Information" name="InformationName9" autocomplete="off" placeholder="Name (Dorpdown List)" disabled/>
                    </div>
                    <div class="sheetInfoCheckBox">
                        <input type="hidden" name="InformationType9" value="CheckBox" disabled/>
                        <input type="text" class="Information" name="InformationName9" autocomplete="off" placeholder="Name (CheckBox)" disabled/>
                    </div>
                    <div class="sheetInfoRadio">
                        <input type="hidden" name="InformationType9" value="Radio" disabled/>
                        <input type="text" class="Information" name="InformationName9" autocomplete="off" placeholder="Name (Radio)" disabled/>
                    </div>
                    <div class="sheetInfoButtonContainer">
                        <button class="TextBTN" type="button" onclick="changeToText(7)">Text</button>
                        <button class="DorpdownListBTN" type="button" onclick="changeToDorpdownList(7)">Dorpdown List</button>
                        <button class="CheckBoxBTN" type="button" onclick="changeToCheckBox(7)">CheckBox</button>
                        <button class="RadioBTN" type="button" onclick="changeToRadio(7)">Radio</button>
                    </div><br>
                    <!-- Information 9每个类型的内容都在这里显示 -->
                    <div class="sheetInfoInput">
                        <label class="label"><img class="plusImg" src="../image/plus.png" width="14px;" onclick="addItem(7)"/><br><img class="minusImg" src="../image/minus.png" width="14px;" onclick="removeItem(7)"/></label>
                        <div class="sheetInfoDorpdownListContent">
                            <input type="text" name="Information9DorpdownListItem[]" autocomplete="off" placeholder="Item (Dorpdown List)" disabled/>
                            <input type="text" name="Information9DorpdownListItem[]" autocomplete="off" placeholder="Item (Dorpdown List)" disabled/>
                            <input type="text" name="Information9DorpdownListItem[]" autocomplete="off" placeholder="Item (Dorpdown List)" disabled/>
                        </div>
                        <div class="sheetInfoCheckBoxContent">
                            <input type="text" name="Information9CheckBoxItem[]" autocomplete="off" placeholder="Item (CheckBox)" disabled/>
                            <input type="text" name="Information9CheckBoxItem[]" autocomplete="off" placeholder="Item (CheckBox)" disabled/>
                            <input type="text" name="Information9CheckBoxItem[]" autocomplete="off" placeholder="Item (CheckBox)" disabled/>
                        </div>
                        <div class="sheetInfoRadioContent">
                            <input type="text" name="Information9RadioItem[]" autocomplete="off" placeholder="Item (Radio)" disabled/>
                            <input type="text" name="Information9RadioItem[]" autocomplete="off" placeholder="Item (Radio)" disabled/>
                            <input type="text" name="Information9RadioItem[]" autocomplete="off" placeholder="Item (Radio)" disabled/>
                        </div>
                    </div>
                    
                    <!--=========================== Information 10: =======================================-->
                    <label class="label">Information 10:</label>
                    <div class="sheetInfoText">
                        <input type="hidden" name="InformationType10" value="Text" />
                        <input type="text" class="Information" name="InformationName10" autocomplete="off" placeholder="Name (Text)"/>
                    </div>
                    <div class="sheetInfoDorpdownList">
                        <input type="hidden" name="InformationType10" value="DorpdownList" disabled/>
                        <input type="text" class="Information" name="InformationName10" autocomplete="off" placeholder="Name (Dorpdown List)" disabled/>
                    </div>
                    <div class="sheetInfoCheckBox">
                        <input type="hidden" name="InformationType10" value="CheckBox" disabled/>
                        <input type="text" class="Information" name="InformationName10" autocomplete="off" placeholder="Name (CheckBox)" disabled/>
                    </div>
                    <div class="sheetInfoRadio">
                        <input type="hidden" name="InformationType10" value="Radio" disabled/>
                        <input type="text" class="Information" name="InformationName10" autocomplete="off" placeholder="Name (Radio)" disabled/>
                    </div>
                    <div class="sheetInfoButtonContainer">
                        <button class="TextBTN" type="button" onclick="changeToText(8)">Text</button>
                        <button class="DorpdownListBTN" type="button" onclick="changeToDorpdownList(8)">Dorpdown List</button>
                        <button class="CheckBoxBTN" type="button" onclick="changeToCheckBox(8)">CheckBox</button>
                        <button class="RadioBTN" type="button" onclick="changeToRadio(8)">Radio</button>
                    </div><br>
                    <!-- Information 10每个类型的内容都在这里显示 -->
                    <div class="sheetInfoInput">
                        <label class="label"><img class="plusImg" src="../image/plus.png" width="14px;" onclick="addItem(8)"/><br><img class="minusImg" src="../image/minus.png" width="14px;" onclick="removeItem(8)"/></label>
                        <div class="sheetInfoDorpdownListContent">
                            <input type="text" name="Information10DorpdownListItem[]" autocomplete="off" placeholder="Item (Dorpdown List)" disabled/>
                            <input type="text" name="Information10DorpdownListItem[]" autocomplete="off" placeholder="Item (Dorpdown List)" disabled/>
                            <input type="text" name="Information10DorpdownListItem[]" autocomplete="off" placeholder="Item (Dorpdown List)" disabled/>
                        </div>
                        <div class="sheetInfoCheckBoxContent">
                            <input type="text" name="Information10CheckBoxItem[]" autocomplete="off" placeholder="Item (CheckBox)" disabled/>
                            <input type="text" name="Information10CheckBoxItem[]" autocomplete="off" placeholder="Item (CheckBox)" disabled/>
                            <input type="text" name="Information10CheckBoxItem[]" autocomplete="off" placeholder="Item (CheckBox)" disabled/>
                        </div>
                        <div class="sheetInfoRadioContent">
                            <input type="text" name="Information10RadioItem[]" autocomplete="off" placeholder="Item (Radio)" disabled/>
                            <input type="text" name="Information10RadioItem[]" autocomplete="off" placeholder="Item (Radio)" disabled/>
                            <input type="text" name="Information10RadioItem[]" autocomplete="off" placeholder="Item (Radio)" disabled/>
                        </div>
                    </div>

                </fieldset>
            </div>
            
            <!--============================= Feedback ================================================-->
            <div class="sheetFeedbackContainer">
                <fieldset class="sheetFeedbackFieldset">
                    <legend>Spread Sheet Feedback</legend>
                    <p class="Introduction">Feedback will be shown after user register</p>
                    <p class="Introduction2">You can click the button below to insert the information into your feedback</p>

                    <div id="feedback" class='feedback' contenteditable="true"></div>
                    <input type="hidden" id="feedbackHidden" name="feedback" />
                    <div class="feedbackBTN">
                        <button class="FBbutton" type="button" onclick="insertinformation('informationBTN1')" disabled="true">Information 1</button>
                        <button class="FBbutton" type="button" onclick="insertinformation('informationBTN2')" disabled="true">Information 2</button>
                        <button class="FBbutton" type="button" onclick="insertinformation('informationBTN3')" disabled="true">Information 3</button>
                        <button class="FBbutton" type="button" onclick="insertinformation('informationBTN4')" disabled="true">Information 4</button>
                        <button class="FBbutton" type="button" onclick="insertinformation('informationBTN5')" disabled="true">Information 5</button>
                        <button class="FBbutton" type="button" onclick="insertinformation('informationBTN6')" disabled="true">Information 6</button>
                        <button class="FBbutton" type="button" onclick="insertinformation('informationBTN7')" disabled="true">Information 7</button>
                        <button class="FBbutton" type="button" onclick="insertinformation('informationBTN8')" disabled="true">Information 8</button>
                        <button class="FBbutton" type="button" onclick="insertinformation('informationBTN9')" disabled="true">Information 9</button>
                        <button class="FBbutton" type="button" onclick="insertinformation('informationBTN10')" disabled="true">Information 10</button>
                    </div>

                </fieldset>
            </div>
            
            <!--============================= Check Box ===============================================-->
            <div class="otherInformationCheckBox">
                <label for="isOtherInformation">Add station information&nbsp;&nbsp;</label>
                <input type="checkbox" id="isOtherInformation" name="isOtherInformation[]" value="checked">
                <p>It will generate the identification QRCode for the each user, the user will be recorded down according to the information.</p>
            </div>
            
            <!--============================= Other Information Categories ==============================-->
            <div class="sheetOtherInformationCategoryFieldsetContainer">
                <fieldset class="sheetOtherInformationCategoryFieldset">
                    <legend>Spread Sheet Other Information Categories</legend>
                    
                    <label for="otherInformationCategory" >How many categories do you need?&nbsp;&nbsp;</label>
                    <select id="otherInformationCategory" name="otherInformationCategory">
                        <option value="1" selected>&nbsp;&nbsp;&nbsp;1</option>
                        <option value="2">&nbsp;&nbsp;&nbsp;2</option>
                        <option value="3">&nbsp;&nbsp;&nbsp;3</option>
                        <option value="4">&nbsp;&nbsp;&nbsp;4</option>
                        <option value="5">&nbsp;&nbsp;&nbsp;5</option>
                    </select>
                    <br><br>
                    <label class="categoryGap">How many items do you need for each category?&nbsp;&nbsp;</label>
                    <label class="categoryTitle">Cat 1</label>
                    <label class="categoryTitle" style="display: none;">Cat 2</label>
                    <label class="categoryTitle" style="display: none;">Cat 3</label>
                    <label class="categoryTitle" style="display: none;">Cat 4</label>
                    <label class="categoryTitle" style="display: none;">Cat 5</label>
                    <br><br>
                    <label>How many items do you need for each category?</label>
                    <select id="category1" name="category1">
                    </select>
                    <input type="hidden" id="countCategory1Item" name="CountCategory1Item" disabled/>
                    <select id="category2" name="category2">
                    </select>
                    <input type="hidden" id="countCategory2Item" name="CountCategory2Item" disabled/>
                    <select id="category3" name="category3">
                    </select>
                    <input type="hidden" id="countCategory3Item" name="CountCategory3Item" disabled/>
                    <select id="category4" name="category4">
                    </select>
                    <input type="hidden" id="countCategory4Item" name="CountCategory4Item" disabled/>
                    <select id="category5" name="category5">
                    </select>
                    <input type="hidden" id="countCategory5Item" name="CountCategory5Item" disabled/>
                    <br><br>
                </fieldset>
            </div>
            
            <!--========================= Other Information category ================================-->
            <div class="sheetOtherInformationFieldsetContainer">
                
                <!--======================= Other Information category1 =============================-->
                <fieldset id="sheetOtherInformationFieldset1" class="sheetOtherInformationFieldset">
                    <legend>Spread Sheet Other Information Category 1</legend>
                    
                    <!--=========================== Category Name: ============================-->
                    <label class="label">Category Name:</label>
                    <input type="text" class="CategoryName" name="Category1Name" autocomplete="off" placeholder="Category Name"/><br>
                    
                    <!--=========================== Other Information 1: ============================-->
                    <label class="label">Information 1:</label>
                    <div class="sheetOtherInfoText">
                        <input type="hidden" name="OtherInformationType1" value="Text" />
                        <input type="text" class="OtherInformation" name="OtherInformationName1" autocomplete="off" placeholder="Name (Text)"/>
                    </div>
                    <div class="sheetOtherInfoDorpdownList">
                        <input type="hidden" name="OtherInformationType1" value="DorpdownList" disabled/>
                        <input type="text" class="OtherInformation" name="OtherInformationName1" autocomplete="off" placeholder="Name (Dorpdown List)" disabled/>
                    </div>
                    <div class="sheetOtherInfoCheckBox">
                        <input type="hidden" name="OtherInformationType1" value="CheckBox" disabled/>
                        <input type="text" class="OtherInformation" name="OtherInformationName1" autocomplete="off" placeholder="Name (CheckBox)" disabled/>
                    </div>
                    <div class="sheetOtherInfoRadio">
                        <input type="hidden" name="OtherInformationType1" value="Radio" disabled/>
                        <input type="text" class="OtherInformation" name="OtherInformationName1" autocomplete="off" placeholder="Name (Radio)" disabled/>
                    </div>
                    <div class="sheetOtherInfoButtonContainer">
                        <button class="TextBTNOther" type="button" onclick="changeToTextOther(0)">Text</button>
                        <button class="DorpdownListBTNOther" type="button" onclick="changeToDorpdownListOther(0)">Dorpdown List</button>
                        <button class="CheckBoxBTNOther" type="button" onclick="changeToCheckBoxOther(0)">CheckBox</button>
                        <button class="RadioBTNOther" type="button" onclick="changeToRadioOther(0)">Radio</button>
                    </div><br>
                    <!-- Other Information 1每个类型的内容都在这里显示 -->
                    <div class="sheetOtherInfoInput">
                        <label class="label"><img class="plusImg" src="../image/plus.png" width="14px;" onclick="addItemOther(0)"/><br><img class="minusImg" src="../image/minus.png" width="14px;" onclick="removeItemOther(0)"/></label>
                        <div class="sheetOtherInfoDorpdownListContent">
                            <input type="text" name="OtherInformation1DorpdownListItem[]" autocomplete="off" placeholder="Item (Dorpdown List)" disabled/>
                            <input type="text" name="OtherInformation1DorpdownListItem[]" autocomplete="off" placeholder="Item (Dorpdown List)" disabled/>
                            <input type="text" name="OtherInformation1DorpdownListItem[]" autocomplete="off" placeholder="Item (Dorpdown List)" disabled/>
                        </div>
                        <div class="sheetOtherInfoCheckBoxContent">
                            <input type="text" name="OtherInformation1CheckBoxItem[]" autocomplete="off" placeholder="Item (CheckBox)" disabled/>
                            <input type="text" name="OtherInformation1CheckBoxItem[]" autocomplete="off" placeholder="Item (CheckBox)" disabled/>
                            <input type="text" name="OtherInformation1CheckBoxItem[]" autocomplete="off" placeholder="Item (CheckBox)" disabled/>
                        </div>
                        <div class="sheetOtherInfoRadioContent">
                            <input type="text" name="OtherInformation1RadioItem[]" autocomplete="off" placeholder="Item (Radio)" disabled/>
                            <input type="text" name="OtherInformation1RadioItem[]" autocomplete="off" placeholder="Item (Radio)" disabled/>
                            <input type="text" name="OtherInformation1RadioItem[]" autocomplete="off" placeholder="Item (Radio)" disabled/>
                        </div>
                    </div>
                </fieldset>
                
                <!--======================= Other Information category2 =============================-->
                <fieldset id="sheetOtherInformationFieldset2" class="sheetOtherInformationFieldset">
                </fieldset>
                
                <!--======================= Other Information category3 =============================-->
                <fieldset id="sheetOtherInformationFieldset3" class="sheetOtherInformationFieldset">
                </fieldset>
                
                <!--======================= Other Information category4 =============================-->
                <fieldset id="sheetOtherInformationFieldset4" class="sheetOtherInformationFieldset">
                </fieldset>
                
                <!--======================= Other Information category5 =============================-->
                <fieldset id="sheetOtherInformationFieldset5" class="sheetOtherInformationFieldset">
                </fieldset>
            </div>
            
            <!--=============================== Organizer =========================================-->
            <div class="sheetOrganizerFieldsetContainer">
                <fieldset class="sheetOrganizerFieldset">
                    <legend>Organizer Setting</legend>

                    <label class="label">Username:</label>
                    <input type="text" id="username" name="username" autocomplete="off"/>
                    <label id="usernameLabel" style="color:red">Username existed</label><br>
                    <label class="label">Password:</label>
                    <input type="password" id="password" name="password"/><br>
                    <label class="label">Confirm Password:</label>
                    <input type="password" id="cpassword" name="cpassword"/>

                </fieldset>
            </div>
            
            <!--================================= Submit ==============================================-->
            <div class="formBTN">
                <input type="submit" value="Submit" />
                <input type="reset" value="Reset" />
                <a href="sheet.php"><input type="button" value="Back" /></a>
            </div>
        </form>
    </body>
</html>

<!--======================================= 用户名 =============================================-->
<script>
    // 获取这个邮箱下的已经存在的用户名，并且把用户名保存在数组
    var UsernameArray = new Array();
    
    <?php
        if(count($UsernameArray) > 0) {
            for($i=0; $i<count($UsernameArray); $i++) {
    ?>
                UsernameArray.push("<?php echo $UsernameArray[$i]; ?>");
    <?php
            }
        }
    ?>
    
    $(document).ready(() => {
        // Information 1
        $('#username').on("change keyup paste", function(){
            var count = 0;
            if(UsernameArray.length > 0) {
                for(var i=0; i<UsernameArray.length; i++) {
                    if(UsernameArray[i] == document.getElementById("username").value && document.getElementById("username").value != "") {
                        count++;
                    }
                }
                if(count == 0) {
                    document.getElementById("usernameLabel").style.display = "none";
                }
                else {
                    document.getElementById("usernameLabel").style.display = "inline";
                }
            }
        });
    });
</script>

<!--================================= Spread Sheet Attribute ========================================-->
<script>
    $(document).ready(() => {
        $("input:radio[name='userDetails']").change(function (){
            if($("input:radio[name='userDetails']:checked").val() == "No") {
                $("input:file[name='userDetailFile']").css("display","none");
                $(".userDetailRequirement").css("display","none");
                $("input:file[name='userDetailFile']").prop('disabled', true);
                for(var i=0; i<=8; i++) {
                    $(".sheetInfoButtonContainer").eq(i).children("button").prop('disabled', false);
                }                
            }
            else {
                $("input:file[name='userDetailFile']").css("display","inline");
                $(".userDetailRequirement").css("display","block");
                $("input:file[name='userDetailFile']").prop('disabled', false);
                for(var i=0; i<=8; i++) {
                    $(".sheetInfoButtonContainer").eq(i).children("button").prop('disabled', true);
                }
            }
        });
    });
</script>

<!--================================= Sheet Information ========================================-->
<script>
    $(document).ready(() => {
        $("input:checkbox[name='emailNotification[]']").change(function (){
            if($("input:checkbox[name='emailNotification[]']:checked").val() == "Yes") {
                $(".Information").eq(0).val("Email");
                $(".Information").eq(0).attr("readonly", true);
                $('.FBbutton').eq(0).attr("disabled", false);
            }
            else {
                $(".Information").eq(0).attr("readonly", false);
            }
        });
    });
    
    // Text, Dropdown lIst, Checkbox, Radio 切换
    function changeToText(id) {
        document.getElementsByClassName("TextBTN")[id].style.display = "none";
        document.getElementsByClassName("DorpdownListBTN")[id].style.display = "inline";
        document.getElementsByClassName("CheckBoxBTN")[id].style.display = "inline";
        document.getElementsByClassName("RadioBTN")[id].style.display = "inline";

        document.getElementsByClassName("sheetInfoText")[id].style.display = "inline-block";
        document.getElementsByClassName("sheetInfoDorpdownList")[id].style.display = "none";
        document.getElementsByClassName("sheetInfoCheckBox")[id].style.display = "none";
        document.getElementsByClassName("sheetInfoRadio")[id].style.display = "none";

        $(document).ready(() => {
            var temp = "";
            if($(".sheetInfoDorpdownList").eq(id).children("input").eq(1).val() != "") {
                temp = $(".sheetInfoDorpdownList").eq(id).children("input").eq(1).val();
            }
            else if($(".sheetInfoCheckBox").eq(id).children("input").eq(1).val() != "") {
                temp = $(".sheetInfoCheckBox").eq(id).children("input").eq(1).val();
            }
            else if($(".sheetInfoRadio").eq(id).children("input").eq(1).val() != "") {
                temp = $(".sheetInfoRadio").eq(id).children("input").eq(1).val();
            }
            $(".sheetInfoText").eq(id).children("input").prop('disabled', false);
            $(".sheetInfoDorpdownList").eq(id).children("input").prop('disabled', true);
            $(".sheetInfoCheckBox").eq(id).children("input").prop('disabled', true);
            $(".sheetInfoRadio").eq(id).children("input").prop('disabled', true);
            $(".sheetInfoDorpdownList").eq(id).children("input").val("");
            $(".sheetInfoCheckBox").eq(id).children("input").val("");
            $(".sheetInfoRadio").eq(id).children("input").val("");
            $(".sheetInfoText").eq(id).children("input").eq(0).val("Text");
            $(".sheetInfoText").eq(id).children("input").eq(1).val(temp);
        });

        document.getElementsByClassName("sheetInfoInput")[id].style.display = "none";
        document.getElementsByClassName("sheetInfoDorpdownListContent")[id].style.display = "none";
        document.getElementsByClassName("sheetInfoCheckBoxContent")[id].style.display = "none";
        document.getElementsByClassName("sheetInfoRadioContent")[id].style.display = "none";
        
        $(document).ready(() => {
            $(".sheetInfoDorpdownListContent").eq(id).children("input").prop('disabled', true);
            $(".sheetInfoCheckBoxContent").eq(id).children("input").prop('disabled', true);
            $(".sheetInfoRadioContent").eq(id).children("input").prop('disabled', true);
            $(".sheetInfoDorpdownListContent").eq(id).children("input").val("");
            $(".sheetInfoCheckBoxContent").eq(id).children("input").val("");
            $(".sheetInfoRadioContent").eq(id).children("input").val("");
        });
        
        $('.FBbutton').eq(id+1).attr("disabled", true);
        // 清空当前的Information时，如果faceback中插入了当前的Information按钮，也要把该按钮删除
        var faceback = document.getElementById("feedback").innerHTML;
        var replacedContent = "<img src=\"../image/informationBTN"+(id+2)+".png\" style=\"height:16px;\">";
        var re = new RegExp(replacedContent, 'g');
        faceback = faceback.replace(re, "");
        document.getElementById("feedback").innerHTML = faceback;
    }
    
    function changeToDorpdownList(id) {
        document.getElementsByClassName("TextBTN")[id].style.display = "inline";
        document.getElementsByClassName("DorpdownListBTN")[id].style.display = "none";
        document.getElementsByClassName("CheckBoxBTN")[id].style.display = "inline";
        document.getElementsByClassName("RadioBTN")[id].style.display = "inline";
        
        document.getElementsByClassName("sheetInfoText")[id].style.display = "none";
        document.getElementsByClassName("sheetInfoDorpdownList")[id].style.display = "inline-block";
        document.getElementsByClassName("sheetInfoCheckBox")[id].style.display = "none";
        document.getElementsByClassName("sheetInfoRadio")[id].style.display = "none";
        
        $(document).ready(() => {
            var temp = "";
            if($(".sheetInfoText").eq(id).children("input").eq(1).val() != "") {
                temp = $(".sheetInfoText").eq(id).children("input").eq(1).val();
            }
            else if($(".sheetInfoCheckBox").eq(id).children("input").eq(1).val() != "") {
                temp = $(".sheetInfoCheckBox").eq(id).children("input").eq(1).val();
            }
            else if($(".sheetInfoRadio").eq(id).children("input").eq(1).val() != "") {
                temp = $(".sheetInfoRadio").eq(id).children("input").eq(1).val();
            }
            $(".sheetInfoText").eq(id).children("input").prop('disabled', true);
            $(".sheetInfoDorpdownList").eq(id).children("input").prop('disabled', false);
            $(".sheetInfoCheckBox").eq(id).children("input").prop('disabled', true);
            $(".sheetInfoRadio").eq(id).children("input").prop('disabled', true);
            $(".sheetInfoText").eq(id).children("input").val("");
            $(".sheetInfoCheckBox").eq(id).children("input").val("");
            $(".sheetInfoRadio").eq(id).children("input").val("");
            $(".sheetInfoDorpdownList").eq(id).children("input").eq(0).val("DorpdownList");
            $(".sheetInfoDorpdownList").eq(id).children("input").eq(1).val(temp);
        });
        
        document.getElementsByClassName("sheetInfoInput")[id].style.display = "block";
        document.getElementsByClassName("sheetInfoDorpdownListContent")[id].style.display = "inline-block";
        document.getElementsByClassName("sheetInfoCheckBoxContent")[id].style.display = "none";
        document.getElementsByClassName("sheetInfoRadioContent")[id].style.display = "none";
        
        $(document).ready(() => {
            $(".sheetInfoDorpdownListContent").eq(id).children("input").prop('disabled', false);
            $(".sheetInfoCheckBoxContent").eq(id).children("input").prop('disabled', true);
            $(".sheetInfoRadioContent").eq(id).children("input").prop('disabled', true);
            $(".sheetInfoCheckBoxContent").eq(id).children("input").val("");
            $(".sheetInfoRadioContent").eq(id).children("input").val("");
        });
        
        $('.FBbutton').eq(id+1).attr("disabled", true);
        // 清空当前的Information时，如果faceback中插入了当前的Information按钮，也要把该按钮删除
        var faceback = document.getElementById("feedback").innerHTML;
        var replacedContent = "<img src=\"../image/informationBTN"+(id+2)+".png\" style=\"height:16px;\">";
        var re = new RegExp(replacedContent, 'g');
        faceback = faceback.replace(re, "");
        document.getElementById("feedback").innerHTML = faceback;
    }
    
    function changeToCheckBox(id) {
        document.getElementsByClassName("TextBTN")[id].style.display = "inline";
        document.getElementsByClassName("DorpdownListBTN")[id].style.display = "inline";
        document.getElementsByClassName("CheckBoxBTN")[id].style.display = "none";
        document.getElementsByClassName("RadioBTN")[id].style.display = "inline";
        
        document.getElementsByClassName("sheetInfoText")[id].style.display = "none";
        document.getElementsByClassName("sheetInfoDorpdownList")[id].style.display = "none";
        document.getElementsByClassName("sheetInfoCheckBox")[id].style.display = "inline-block";
        document.getElementsByClassName("sheetInfoRadio")[id].style.display = "none";
        
        $(document).ready(() => {
            var temp = "";
            if($(".sheetInfoText").eq(id).children("input").eq(1).val() != "") {
                temp = $(".sheetInfoText").eq(id).children("input").eq(1).val();
            }
            else if($(".sheetInfoDorpdownList").eq(id).children("input").eq(1).val() != "") {
                temp = $(".sheetInfoDorpdownList").eq(id).children("input").eq(1).val();
            }
            else if($(".sheetInfoRadio").eq(id).children("input").eq(1).val() != "") {
                temp = $(".sheetInfoRadio").eq(id).children("input").eq(1).val();
            }
            $(".sheetInfoText").eq(id).children("input").prop('disabled', true);
            $(".sheetInfoDorpdownList").eq(id).children("input").prop('disabled', true);
            $(".sheetInfoCheckBox").eq(id).children("input").prop('disabled', false);
            $(".sheetInfoRadio").eq(id).children("input").prop('disabled', true);
            $(".sheetInfoText").eq(id).children("input").val("");
            $(".sheetInfoDorpdownList").eq(id).children("input").val("");
            $(".sheetInfoRadio").eq(id).children("input").val("");
            $(".sheetInfoCheckBox").eq(id).children("input").eq(0).val("CheckBox");
            $(".sheetInfoCheckBox").eq(id).children("input").eq(1).val(temp);
        });
        
        document.getElementsByClassName("sheetInfoInput")[id].style.display = "block";
        document.getElementsByClassName("sheetInfoDorpdownListContent")[id].style.display = "none";
        document.getElementsByClassName("sheetInfoCheckBoxContent")[id].style.display = "inline-block";
        document.getElementsByClassName("sheetInfoRadioContent")[id].style.display = "none";
        
        $(document).ready(() => {
            $(".sheetInfoDorpdownListContent").eq(id).children("input").prop('disabled', true);
            $(".sheetInfoCheckBoxContent").eq(id).children("input").prop('disabled', false);
            $(".sheetInfoRadioContent").eq(id).children("input").prop('disabled', true);
            $(".sheetInfoDorpdownListContent").eq(id).children("input").val("");
            $(".sheetInfoRadioContent").eq(id).children("input").val("");
        });
        
        $('.FBbutton').eq(id+1).attr("disabled", true);
        // 清空当前的Information时，如果faceback中插入了当前的Information按钮，也要把该按钮删除
        var faceback = document.getElementById("feedback").innerHTML;
        var replacedContent = "<img src=\"../image/informationBTN"+(id+2)+".png\" style=\"height:16px;\">";
        var re = new RegExp(replacedContent, 'g');
        faceback = faceback.replace(re, "");
        document.getElementById("feedback").innerHTML = faceback;
    }
    
    function changeToRadio(id) {
        document.getElementsByClassName("TextBTN")[id].style.display = "inline";
        document.getElementsByClassName("DorpdownListBTN")[id].style.display = "inline";
        document.getElementsByClassName("CheckBoxBTN")[id].style.display = "inline";
        document.getElementsByClassName("RadioBTN")[id].style.display = "none";
        
        document.getElementsByClassName("sheetInfoText")[id].style.display = "none";
        document.getElementsByClassName("sheetInfoDorpdownList")[id].style.display = "none";
        document.getElementsByClassName("sheetInfoCheckBox")[id].style.display = "none";
        document.getElementsByClassName("sheetInfoRadio")[id].style.display = "inline-block";
        
        $(document).ready(() => {
            var temp = "";
            if($(".sheetInfoText").eq(id).children("input").eq(1).val() != "") {
                temp = $(".sheetInfoText").eq(id).children("input").eq(1).val();
            }
            else if($(".sheetInfoDorpdownList").eq(id).children("input").eq(1).val() != "") {
                temp = $(".sheetInfoDorpdownList").eq(id).children("input").eq(1).val();
            }
            else if($(".sheetInfoCheckBox").eq(id).children("input").eq(1).val() != "") {
                temp = $(".sheetInfoCheckBox").eq(id).children("input").eq(1).val();
            }
            $(".sheetInfoText").eq(id).children("input").prop('disabled', true);
            $(".sheetInfoDorpdownList").eq(id).children("input").prop('disabled', true);
            $(".sheetInfoCheckBox").eq(id).children("input").prop('disabled', true);
            $(".sheetInfoRadio").eq(id).children("input").prop('disabled', false);
            $(".sheetInfoText").eq(id).children("input").val("");
            $(".sheetInfoDorpdownList").eq(id).children("input").val("");
            $(".sheetInfoCheckBox").eq(id).children("input").val("");
            $(".sheetInfoRadio").eq(id).children("input").eq(0).val("Radio");
            $(".sheetInfoRadio").eq(id).children("input").eq(1).val(temp);
        });
        
        document.getElementsByClassName("sheetInfoInput")[id].style.display = "block";
        document.getElementsByClassName("sheetInfoDorpdownListContent")[id].style.display = "none";
        document.getElementsByClassName("sheetInfoCheckBoxContent")[id].style.display = "none";
        document.getElementsByClassName("sheetInfoRadioContent")[id].style.display = "inline-block";
        
        $(document).ready(() => {
            $(".sheetInfoDorpdownListContent").eq(id).children("input").prop('disabled', true);
            $(".sheetInfoCheckBoxContent").eq(id).children("input").prop('disabled', true);
            $(".sheetInfoRadioContent").eq(id).children("input").prop('disabled', false);
            $(".sheetInfoDorpdownListContent").eq(id).children("input").val("");
            $(".sheetInfoCheckBoxContent").eq(id).children("input").val("");
        });
        
        $('.FBbutton').eq(id+1).attr("disabled", true);
        // 清空当前的Information时，如果faceback中插入了当前的Information按钮，也要把该按钮删除
        var faceback = document.getElementById("feedback").innerHTML;
        var replacedContent = "<img src=\"../image/informationBTN"+(id+2)+".png\" style=\"height:16px;\">";
        var re = new RegExp(replacedContent, 'g');
        faceback = faceback.replace(re, "");
        document.getElementById("feedback").innerHTML = faceback;
    }
    
    function addItem(id) {
        if(document.getElementsByClassName("sheetInfoDorpdownList")[id].style.display == "inline-block") {
            var content = document.getElementsByClassName("sheetInfoDorpdownListContent")[id].innerHTML;
            var n = (content.split("<input")).length - 1;
            var OldValuesArray = new Array();
            for(var i=0; i<n; i++) {
                var oldValue = document.getElementsByName("Information"+(id+2)+"DorpdownListItem[]")[i].value;
                OldValuesArray.push(oldValue);
            }
            var newContent = "<input type='text' name='Information"+(id+2)+"DorpdownListItem[]' autocomplete='off' placeholder='Item (Dorpdown List)' />"
            document.getElementsByClassName("sheetInfoDorpdownListContent")[id].innerHTML = content + newContent;
            for(var i=0; i<n; i++) {
                document.getElementsByName("Information"+(id+2)+"DorpdownListItem[]")[i].value = OldValuesArray[i];
            }
        }
        else if(document.getElementsByClassName("sheetInfoCheckBox")[id].style.display == "inline-block") {
            var content = document.getElementsByClassName("sheetInfoCheckBoxContent")[id].innerHTML;
            var n = (content.split("<input")).length - 1;
            var OldValuesArray = new Array();
            for(var i=0; i<n; i++) {
                var oldValue = document.getElementsByName("Information"+(id+2)+"CheckBoxItem[]")[i].value;
                OldValuesArray.push(oldValue);
            }
            var newContent = "<input type='text' name='Information"+(id+2)+"CheckBoxItem[]' autocomplete='off' placeholder='Item (CheckBox)' />"
            document.getElementsByClassName("sheetInfoCheckBoxContent")[id].innerHTML = content + newContent;
            for(var i=0; i<n; i++) {
                document.getElementsByName("Information"+(id+2)+"CheckBoxItem[]")[i].value = OldValuesArray[i];
            }
        }
        else if(document.getElementsByClassName("sheetInfoRadio")[id].style.display == "inline-block") {
            var content = document.getElementsByClassName("sheetInfoRadioContent")[id].innerHTML;
            var n = (content.split("<input")).length - 1;
            var OldValuesArray = new Array();
            for(var i=0; i<n; i++) {
                var oldValue = document.getElementsByName("Information"+(id+2)+"RadioItem[]")[i].value;
                OldValuesArray.push(oldValue);
            }
            var newContent = "<input type='text' name='Information"+(id+2)+"RadioItem[]' autocomplete='off' placeholder='Item (Radio)' />"
            document.getElementsByClassName("sheetInfoRadioContent")[id].innerHTML = content + newContent;
            for(var i=0; i<n; i++) {
                document.getElementsByName("Information"+(id+2)+"RadioItem[]")[i].value = OldValuesArray[i];
            }
        }
    }
    
    function removeItem(id) {
        if(document.getElementsByClassName("sheetInfoDorpdownList")[id].style.display == "inline-block") {
            var content = document.getElementsByClassName("sheetInfoDorpdownListContent")[id].innerHTML;
            var n = (content.split("<input")).length - 1;
            if(n > 1) {
                var OldValuesArray = new Array();
                for(var i=0; i<(n-1); i++) {
                    var oldValue = document.getElementsByName("Information"+(id+2)+"DorpdownListItem[]")[i].value;
                    OldValuesArray.push(oldValue);
                }
                var position = content.lastIndexOf("<input");
                var newContent = content.substring(0, position);
                document.getElementsByClassName("sheetInfoDorpdownListContent")[id].innerHTML = newContent;
                for(var i=0; i<(n-1); i++) {
                    document.getElementsByName("Information"+(id+2)+"DorpdownListItem[]")[i].value = OldValuesArray[i];
                }
            }
        }
        else if(document.getElementsByClassName("sheetInfoCheckBox")[id].style.display == "inline-block") {
            var content = document.getElementsByClassName("sheetInfoCheckBoxContent")[id].innerHTML;
            var n = (content.split("<input")).length - 1;
            if(n > 1) {
                var OldValuesArray = new Array();
                for(var i=0; i<(n-1); i++) {
                    var oldValue = document.getElementsByName("Information"+(id+2)+"CheckBoxItem[]")[i].value;
                    OldValuesArray.push(oldValue);
                }
                var position = content.lastIndexOf("<input");
                var newContent = content.substring(0, position);
                document.getElementsByClassName("sheetInfoCheckBoxContent")[id].innerHTML = newContent;
                for(var i=0; i<(n-1); i++) {
                    document.getElementsByName("Information"+(id+2)+"CheckBoxItem[]")[i].value = OldValuesArray[i];
                }
            }
        }
        else if(document.getElementsByClassName("sheetInfoRadio")[id].style.display == "inline-block") {
            var content = document.getElementsByClassName("sheetInfoRadioContent")[id].innerHTML;
            var n = (content.split("<input")).length - 1;
            if(n > 1) {
                var OldValuesArray = new Array();
                for(var i=0; i<(n-1); i++) {
                    var oldValue = document.getElementsByName("Information"+(id+2)+"RadioItem[]")[i].value;
                    OldValuesArray.push(oldValue);
                }
                var position = content.lastIndexOf("<input");
                var newContent = content.substring(0, position);
                document.getElementsByClassName("sheetInfoRadioContent")[id].innerHTML = newContent;
                for(var i=0; i<(n-1); i++) {
                    document.getElementsByName("Information"+(id+2)+"RadioItem[]")[i].value = OldValuesArray[i];
                }
            }
        }
    }
</script>

<!--====================================== Feedback ==========================================-->
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

    $(document).ready(() => {
        // Information 1
        $('.Information').eq(0).on("change keyup paste", function(){
            if($('.Information').eq(0).val() != "") {
                $('.FBbutton').eq(0).attr("disabled", false);
            }
            else {
                $('.FBbutton').eq(0).attr("disabled", true);
                // 清空当前的Information时，如果faceback中插入了当前的Information按钮，也要把该按钮删除
                var faceback = document.getElementById("feedback").innerHTML;
                var replacedContent = "<img src=\"../image/informationBTN1.png\" style=\"height:16px;\">";
                var re = new RegExp(replacedContent, 'g');
                faceback = faceback.replace(re, "");
                document.getElementById("feedback").innerHTML = faceback;
            }
        });
        // Information 2
        $('.Information').eq(1).on("change keyup paste", function(){
            if($('.Information').eq(1).val() != "") {
                $('.FBbutton').eq(1).attr("disabled", false);
            }
            else {
                $('.FBbutton').eq(1).attr("disabled", true);
                // 清空当前的Information时，如果faceback中插入了当前的Information按钮，也要把该按钮删除
                var faceback = document.getElementById("feedback").innerHTML;
                var replacedContent = "<img src=\"../image/informationBTN2.png\" style=\"height:16px;\">";
                var re = new RegExp(replacedContent, 'g');
                faceback = faceback.replace(re, "");
                document.getElementById("feedback").innerHTML = faceback;
            }
        });
        $('.Information').eq(2).on("change keyup paste", function(){
            if($('.Information').eq(2).val() != "") {
                $('.FBbutton').eq(1).attr("disabled", false);
            }
            else {
                $('.FBbutton').eq(1).attr("disabled", true);
                // 清空当前的Information时，如果faceback中插入了当前的Information按钮，也要把该按钮删除
                var faceback = document.getElementById("feedback").innerHTML;
                var replacedContent = "<img src=\"../image/informationBTN2.png\" style=\"height:16px;\">";
                var re = new RegExp(replacedContent, 'g');
                faceback = faceback.replace(re, "");
                document.getElementById("feedback").innerHTML = faceback;
            }
        });
        $('.Information').eq(3).on("change keyup paste", function(){
            if($('.Information').eq(3).val() != "") {
                $('.FBbutton').eq(1).attr("disabled", false);
            }
            else {
                $('.FBbutton').eq(1).attr("disabled", true);
                // 清空当前的Information时，如果faceback中插入了当前的Information按钮，也要把该按钮删除
                var faceback = document.getElementById("feedback").innerHTML;
                var replacedContent = "<img src=\"../image/informationBTN2.png\" style=\"height:16px;\">";
                var re = new RegExp(replacedContent, 'g');
                faceback = faceback.replace(re, "");
                document.getElementById("feedback").innerHTML = faceback;
            }
        });
        $('.Information').eq(4).on("change keyup paste", function(){
            if($('.Information').eq(4).val() != "") {
                $('.FBbutton').eq(1).attr("disabled", false);
            }
            else {
                $('.FBbutton').eq(1).attr("disabled", true);
                // 清空当前的Information时，如果faceback中插入了当前的Information按钮，也要把该按钮删除
                var faceback = document.getElementById("feedback").innerHTML;
                var replacedContent = "<img src=\"../image/informationBTN2.png\" style=\"height:16px;\">";
                var re = new RegExp(replacedContent, 'g');
                faceback = faceback.replace(re, "");
                document.getElementById("feedback").innerHTML = faceback;
            }
        });
        // Information 3
        $('.Information').eq(5).on("change keyup paste", function(){
            if($('.Information').eq(5).val() != "") {
                $('.FBbutton').eq(2).attr("disabled", false);
            }
            else {
                $('.FBbutton').eq(2).attr("disabled", true);
                // 清空当前的Information时，如果faceback中插入了当前的Information按钮，也要把该按钮删除
                var faceback = document.getElementById("feedback").innerHTML;
                var replacedContent = "<img src=\"../image/informationBTN3.png\" style=\"height:16px;\">";
                var re = new RegExp(replacedContent, 'g');
                faceback = faceback.replace(re, "");
                document.getElementById("feedback").innerHTML = faceback;
            }
        });
        $('.Information').eq(6).on("change keyup paste", function(){
            if($('.Information').eq(6).val() != "") {
                $('.FBbutton').eq(2).attr("disabled", false);
            }
            else {
                $('.FBbutton').eq(2).attr("disabled", true);
                // 清空当前的Information时，如果faceback中插入了当前的Information按钮，也要把该按钮删除
                var faceback = document.getElementById("feedback").innerHTML;
                var replacedContent = "<img src=\"../image/informationBTN3.png\" style=\"height:16px;\">";
                var re = new RegExp(replacedContent, 'g');
                faceback = faceback.replace(re, "");
                document.getElementById("feedback").innerHTML = faceback;
            }
        });
        $('.Information').eq(7).on("change keyup paste", function(){
            if($('.Information').eq(7).val() != "") {
                $('.FBbutton').eq(2).attr("disabled", false);
            }
            else {
                $('.FBbutton').eq(2).attr("disabled", true);
                // 清空当前的Information时，如果faceback中插入了当前的Information按钮，也要把该按钮删除
                var faceback = document.getElementById("feedback").innerHTML;
                var replacedContent = "<img src=\"../image/informationBTN3.png\" style=\"height:16px;\">";
                var re = new RegExp(replacedContent, 'g');
                faceback = faceback.replace(re, "");
                document.getElementById("feedback").innerHTML = faceback;
            }
        });
        $('.Information').eq(8).on("change keyup paste", function(){
            if($('.Information').eq(8).val() != "") {
                $('.FBbutton').eq(2).attr("disabled", false);
            }
            else {
                $('.FBbutton').eq(2).attr("disabled", true);
                // 清空当前的Information时，如果faceback中插入了当前的Information按钮，也要把该按钮删除
                var faceback = document.getElementById("feedback").innerHTML;
                var replacedContent = "<img src=\"../image/informationBTN3.png\" style=\"height:16px;\">";
                var re = new RegExp(replacedContent, 'g');
                faceback = faceback.replace(re, "");
                document.getElementById("feedback").innerHTML = faceback;
            }
        });
        // Information 4
        $('.Information').eq(9).on("change keyup paste", function(){
            if($('.Information').eq(9).val() != "") {
                $('.FBbutton').eq(3).attr("disabled", false);
            }
            else {
                $('.FBbutton').eq(3).attr("disabled", true);
                // 清空当前的Information时，如果faceback中插入了当前的Information按钮，也要把该按钮删除
                var faceback = document.getElementById("feedback").innerHTML;
                var replacedContent = "<img src=\"../image/informationBTN4.png\" style=\"height:16px;\">";
                var re = new RegExp(replacedContent, 'g');
                faceback = faceback.replace(re, "");
                document.getElementById("feedback").innerHTML = faceback;
            }
        });
        $('.Information').eq(10).on("change keyup paste", function(){
            if($('.Information').eq(10).val() != "") {
                $('.FBbutton').eq(3).attr("disabled", false);
            }
            else {
                $('.FBbutton').eq(3).attr("disabled", true);
                // 清空当前的Information时，如果faceback中插入了当前的Information按钮，也要把该按钮删除
                var faceback = document.getElementById("feedback").innerHTML;
                var replacedContent = "<img src=\"../image/informationBTN4.png\" style=\"height:16px;\">";
                var re = new RegExp(replacedContent, 'g');
                faceback = faceback.replace(re, "");
                document.getElementById("feedback").innerHTML = faceback;
            }
        });
        $('.Information').eq(11).on("change keyup paste", function(){
            if($('.Information').eq(11).val() != "") {
                $('.FBbutton').eq(3).attr("disabled", false);
            }
            else {
                $('.FBbutton').eq(3).attr("disabled", true);
                // 清空当前的Information时，如果faceback中插入了当前的Information按钮，也要把该按钮删除
                var faceback = document.getElementById("feedback").innerHTML;
                var replacedContent = "<img src=\"../image/informationBTN4.png\" style=\"height:16px;\">";
                var re = new RegExp(replacedContent, 'g');
                faceback = faceback.replace(re, "");
                document.getElementById("feedback").innerHTML = faceback;
            }
        });
        $('.Information').eq(12).on("change keyup paste", function(){
            if($('.Information').eq(12).val() != "") {
                $('.FBbutton').eq(3).attr("disabled", false);
            }
            else {
                $('.FBbutton').eq(3).attr("disabled", true);
                // 清空当前的Information时，如果faceback中插入了当前的Information按钮，也要把该按钮删除
                var faceback = document.getElementById("feedback").innerHTML;
                var replacedContent = "<img src=\"../image/informationBTN4.png\" style=\"height:16px;\">";
                var re = new RegExp(replacedContent, 'g');
                faceback = faceback.replace(re, "");
                document.getElementById("feedback").innerHTML = faceback;
            }
        });
        // Information 5
        $('.Information').eq(13).on("change keyup paste", function(){
            if($('.Information').eq(13).val() != "") {
                $('.FBbutton').eq(4).attr("disabled", false);
            }
            else {
                $('.FBbutton').eq(4).attr("disabled", true);
                // 清空当前的Information时，如果faceback中插入了当前的Information按钮，也要把该按钮删除
                var faceback = document.getElementById("feedback").innerHTML;
                var replacedContent = "<img src=\"../image/informationBTN5.png\" style=\"height:16px;\">";
                var re = new RegExp(replacedContent, 'g');
                faceback = faceback.replace(re, "");
                document.getElementById("feedback").innerHTML = faceback;
            }
        });
        $('.Information').eq(14).on("change keyup paste", function(){
            if($('.Information').eq(14).val() != "") {
                $('.FBbutton').eq(4).attr("disabled", false);
            }
            else {
                $('.FBbutton').eq(4).attr("disabled", true);
                // 清空当前的Information时，如果faceback中插入了当前的Information按钮，也要把该按钮删除
                var faceback = document.getElementById("feedback").innerHTML;
                var replacedContent = "<img src=\"../image/informationBTN5.png\" style=\"height:16px;\">";
                var re = new RegExp(replacedContent, 'g');
                faceback = faceback.replace(re, "");
                document.getElementById("feedback").innerHTML = faceback;
            }
        });
        $('.Information').eq(15).on("change keyup paste", function(){
            if($('.Information').eq(15).val() != "") {
                $('.FBbutton').eq(4).attr("disabled", false);
            }
            else {
                $('.FBbutton').eq(4).attr("disabled", true);
                // 清空当前的Information时，如果faceback中插入了当前的Information按钮，也要把该按钮删除
                var faceback = document.getElementById("feedback").innerHTML;
                var replacedContent = "<img src=\"../image/informationBTN5.png\" style=\"height:16px;\">";
                var re = new RegExp(replacedContent, 'g');
                faceback = faceback.replace(re, "");
                document.getElementById("feedback").innerHTML = faceback;
            }
        });
        $('.Information').eq(16).on("change keyup paste", function(){
            if($('.Information').eq(16).val() != "") {
                $('.FBbutton').eq(4).attr("disabled", false);
            }
            else {
                $('.FBbutton').eq(4).attr("disabled", true);
                // 清空当前的Information时，如果faceback中插入了当前的Information按钮，也要把该按钮删除
                var faceback = document.getElementById("feedback").innerHTML;
                var replacedContent = "<img src=\"../image/informationBTN5.png\" style=\"height:16px;\">";
                var re = new RegExp(replacedContent, 'g');
                faceback = faceback.replace(re, "");
                document.getElementById("feedback").innerHTML = faceback;
            }
        });
        // Information 6
        $('.Information').eq(17).on("change keyup paste", function(){
            if($('.Information').eq(17).val() != "") {
                $('.FBbutton').eq(5).attr("disabled", false);
            }
            else {
                $('.FBbutton').eq(5).attr("disabled", true);
                // 清空当前的Information时，如果faceback中插入了当前的Information按钮，也要把该按钮删除
                var faceback = document.getElementById("feedback").innerHTML;
                var replacedContent = "<img src=\"../image/informationBTN6.png\" style=\"height:16px;\">";
                var re = new RegExp(replacedContent, 'g');
                faceback = faceback.replace(re, "");
                document.getElementById("feedback").innerHTML = faceback;
            }
        });
        $('.Information').eq(18).on("change keyup paste", function(){
            if($('.Information').eq(18).val() != "") {
                $('.FBbutton').eq(5).attr("disabled", false);
            }
            else {
                $('.FBbutton').eq(5).attr("disabled", true);
                // 清空当前的Information时，如果faceback中插入了当前的Information按钮，也要把该按钮删除
                var faceback = document.getElementById("feedback").innerHTML;
                var replacedContent = "<img src=\"../image/informationBTN6.png\" style=\"height:16px;\">";
                var re = new RegExp(replacedContent, 'g');
                faceback = faceback.replace(re, "");
                document.getElementById("feedback").innerHTML = faceback;
            }
        });
        $('.Information').eq(19).on("change keyup paste", function(){
            if($('.Information').eq(19).val() != "") {
                $('.FBbutton').eq(5).attr("disabled", false);
            }
            else {
                $('.FBbutton').eq(5).attr("disabled", true);
                // 清空当前的Information时，如果faceback中插入了当前的Information按钮，也要把该按钮删除
                var faceback = document.getElementById("feedback").innerHTML;
                var replacedContent = "<img src=\"../image/informationBTN6.png\" style=\"height:16px;\">";
                var re = new RegExp(replacedContent, 'g');
                faceback = faceback.replace(re, "");
                document.getElementById("feedback").innerHTML = faceback;
            }
        });
        $('.Information').eq(20).on("change keyup paste", function(){
            if($('.Information').eq(20).val() != "") {
                $('.FBbutton').eq(5).attr("disabled", false);
            }
            else {
                $('.FBbutton').eq(5).attr("disabled", true);
                // 清空当前的Information时，如果faceback中插入了当前的Information按钮，也要把该按钮删除
                var faceback = document.getElementById("feedback").innerHTML;
                var replacedContent = "<img src=\"../image/informationBTN6.png\" style=\"height:16px;\">";
                var re = new RegExp(replacedContent, 'g');
                faceback = faceback.replace(re, "");
                document.getElementById("feedback").innerHTML = faceback;
            }
        });
        // Information 7
        $('.Information').eq(21).on("change keyup paste", function(){
            if($('.Information').eq(21).val() != "") {
                $('.FBbutton').eq(6).attr("disabled", false);
            }
            else {
                $('.FBbutton').eq(6).attr("disabled", true);
                // 清空当前的Information时，如果faceback中插入了当前的Information按钮，也要把该按钮删除
                var faceback = document.getElementById("feedback").innerHTML;
                var replacedContent = "<img src=\"../image/informationBTN7.png\" style=\"height:16px;\">";
                var re = new RegExp(replacedContent, 'g');
                faceback = faceback.replace(re, "");
                document.getElementById("feedback").innerHTML = faceback;
            }
        });
        $('.Information').eq(22).on("change keyup paste", function(){
            if($('.Information').eq(22).val() != "") {
                $('.FBbutton').eq(6).attr("disabled", false);
            }
            else {
                $('.FBbutton').eq(6).attr("disabled", true);
                // 清空当前的Information时，如果faceback中插入了当前的Information按钮，也要把该按钮删除
                var faceback = document.getElementById("feedback").innerHTML;
                var replacedContent = "<img src=\"../image/informationBTN7.png\" style=\"height:16px;\">";
                var re = new RegExp(replacedContent, 'g');
                faceback = faceback.replace(re, "");
                document.getElementById("feedback").innerHTML = faceback;
            }
        });
        $('.Information').eq(23).on("change keyup paste", function(){
            if($('.Information').eq(23).val() != "") {
                $('.FBbutton').eq(6).attr("disabled", false);
            }
            else {
                $('.FBbutton').eq(6).attr("disabled", true);
                // 清空当前的Information时，如果faceback中插入了当前的Information按钮，也要把该按钮删除
                var faceback = document.getElementById("feedback").innerHTML;
                var replacedContent = "<img src=\"../image/informationBTN7.png\" style=\"height:16px;\">";
                var re = new RegExp(replacedContent, 'g');
                faceback = faceback.replace(re, "");
                document.getElementById("feedback").innerHTML = faceback;
            }
        });
        $('.Information').eq(24).on("change keyup paste", function(){
            if($('.Information').eq(24).val() != "") {
                $('.FBbutton').eq(6).attr("disabled", false);
            }
            else {
                $('.FBbutton').eq(6).attr("disabled", true);
                // 清空当前的Information时，如果faceback中插入了当前的Information按钮，也要把该按钮删除
                var faceback = document.getElementById("feedback").innerHTML;
                var replacedContent = "<img src=\"../image/informationBTN7.png\" style=\"height:16px;\">";
                var re = new RegExp(replacedContent, 'g');
                faceback = faceback.replace(re, "");
                document.getElementById("feedback").innerHTML = faceback;
            }
        });
        // Information 8
        $('.Information').eq(25).on("change keyup paste", function(){
            if($('.Information').eq(25).val() != "") {
                $('.FBbutton').eq(7).attr("disabled", false);
            }
            else {
                $('.FBbutton').eq(7).attr("disabled", true);
                // 清空当前的Information时，如果faceback中插入了当前的Information按钮，也要把该按钮删除
                var faceback = document.getElementById("feedback").innerHTML;
                var replacedContent = "<img src=\"../image/informationBTN8.png\" style=\"height:16px;\">";
                var re = new RegExp(replacedContent, 'g');
                faceback = faceback.replace(re, "");
                document.getElementById("feedback").innerHTML = faceback;
            }
        });
        $('.Information').eq(26).on("change keyup paste", function(){
            if($('.Information').eq(26).val() != "") {
                $('.FBbutton').eq(7).attr("disabled", false);
            }
            else {
                $('.FBbutton').eq(7).attr("disabled", true);
                // 清空当前的Information时，如果faceback中插入了当前的Information按钮，也要把该按钮删除
                var faceback = document.getElementById("feedback").innerHTML;
                var replacedContent = "<img src=\"../image/informationBTN8.png\" style=\"height:16px;\">";
                var re = new RegExp(replacedContent, 'g');
                faceback = faceback.replace(re, "");
                document.getElementById("feedback").innerHTML = faceback;
            }
        });
        $('.Information').eq(27).on("change keyup paste", function(){
            if($('.Information').eq(27).val() != "") {
                $('.FBbutton').eq(7).attr("disabled", false);
            }
            else {
                $('.FBbutton').eq(7).attr("disabled", true);
                // 清空当前的Information时，如果faceback中插入了当前的Information按钮，也要把该按钮删除
                var faceback = document.getElementById("feedback").innerHTML;
                var replacedContent = "<img src=\"../image/informationBTN8.png\" style=\"height:16px;\">";
                var re = new RegExp(replacedContent, 'g');
                faceback = faceback.replace(re, "");
                document.getElementById("feedback").innerHTML = faceback;
            }
        });
        $('.Information').eq(28).on("change keyup paste", function(){
            if($('.Information').eq(28).val() != "") {
                $('.FBbutton').eq(7).attr("disabled", false);
            }
            else {
                $('.FBbutton').eq(7).attr("disabled", true);
                // 清空当前的Information时，如果faceback中插入了当前的Information按钮，也要把该按钮删除
                var faceback = document.getElementById("feedback").innerHTML;
                var replacedContent = "<img src=\"../image/informationBTN8.png\" style=\"height:16px;\">";
                var re = new RegExp(replacedContent, 'g');
                faceback = faceback.replace(re, "");
                document.getElementById("feedback").innerHTML = faceback;
            }
        });
        // Information 9
        $('.Information').eq(29).on("change keyup paste", function(){
            if($('.Information').eq(29).val() != "") {
                $('.FBbutton').eq(8).attr("disabled", false);
            }
            else {
                $('.FBbutton').eq(8).attr("disabled", true);
                // 清空当前的Information时，如果faceback中插入了当前的Information按钮，也要把该按钮删除
                var faceback = document.getElementById("feedback").innerHTML;
                var replacedContent = "<img src=\"../image/informationBTN9.png\" style=\"height:16px;\">";
                var re = new RegExp(replacedContent, 'g');
                faceback = faceback.replace(re, "");
                document.getElementById("feedback").innerHTML = faceback;
            }
        });
        $('.Information').eq(30).on("change keyup paste", function(){
            if($('.Information').eq(30).val() != "") {
                $('.FBbutton').eq(8).attr("disabled", false);
            }
            else {
                $('.FBbutton').eq(8).attr("disabled", true);
                // 清空当前的Information时，如果faceback中插入了当前的Information按钮，也要把该按钮删除
                var faceback = document.getElementById("feedback").innerHTML;
                var replacedContent = "<img src=\"../image/informationBTN9.png\" style=\"height:16px;\">";
                var re = new RegExp(replacedContent, 'g');
                faceback = faceback.replace(re, "");
                document.getElementById("feedback").innerHTML = faceback;
            }
        });
        $('.Information').eq(31).on("change keyup paste", function(){
            if($('.Information').eq(31).val() != "") {
                $('.FBbutton').eq(8).attr("disabled", false);
            }
            else {
                $('.FBbutton').eq(8).attr("disabled", true);
                // 清空当前的Information时，如果faceback中插入了当前的Information按钮，也要把该按钮删除
                var faceback = document.getElementById("feedback").innerHTML;
                var replacedContent = "<img src=\"../image/informationBTN9.png\" style=\"height:16px;\">";
                var re = new RegExp(replacedContent, 'g');
                faceback = faceback.replace(re, "");
                document.getElementById("feedback").innerHTML = faceback;
            }
        });
        $('.Information').eq(32).on("change keyup paste", function(){
            if($('.Information').eq(32).val() != "") {
                $('.FBbutton').eq(8).attr("disabled", false);
            }
            else {
                $('.FBbutton').eq(8).attr("disabled", true);
                // 清空当前的Information时，如果faceback中插入了当前的Information按钮，也要把该按钮删除
                var faceback = document.getElementById("feedback").innerHTML;
                var replacedContent = "<img src=\"../image/informationBTN9.png\" style=\"height:16px;\">";
                var re = new RegExp(replacedContent, 'g');
                faceback = faceback.replace(re, "");
                document.getElementById("feedback").innerHTML = faceback;
            }
        });
        // Information 10
        $('.Information').eq(33).on("change keyup paste", function(){
            if($('.Information').eq(33).val() != "") {
                $('.FBbutton').eq(9).attr("disabled", false);
            }
            else {
                $('.FBbutton').eq(9).attr("disabled", true);
                // 清空当前的Information时，如果faceback中插入了当前的Information按钮，也要把该按钮删除
                var faceback = document.getElementById("feedback").innerHTML;
                var replacedContent = "<img src=\"../image/informationBTN10.png\" style=\"height:16px;\">";
                var re = new RegExp(replacedContent, 'g');
                faceback = faceback.replace(re, "");
                document.getElementById("feedback").innerHTML = faceback;
            }
        });
        $('.Information').eq(34).on("change keyup paste", function(){
            if($('.Information').eq(34).val() != "") {
                $('.FBbutton').eq(9).attr("disabled", false);
            }
            else {
                $('.FBbutton').eq(9).attr("disabled", true);
                // 清空当前的Information时，如果faceback中插入了当前的Information按钮，也要把该按钮删除
                var faceback = document.getElementById("feedback").innerHTML;
                var replacedContent = "<img src=\"../image/informationBTN10.png\" style=\"height:16px;\">";
                var re = new RegExp(replacedContent, 'g');
                faceback = faceback.replace(re, "");
                document.getElementById("feedback").innerHTML = faceback;
            }
        });
        $('.Information').eq(35).on("change keyup paste", function(){
            if($('.Information').eq(35).val() != "") {
                $('.FBbutton').eq(9).attr("disabled", false);
            }
            else {
                $('.FBbutton').eq(9).attr("disabled", true);
                // 清空当前的Information时，如果faceback中插入了当前的Information按钮，也要把该按钮删除
                var faceback = document.getElementById("feedback").innerHTML;
                var replacedContent = "<img src=\"../image/informationBTN10.png\" style=\"height:16px;\">";
                var re = new RegExp(replacedContent, 'g');
                faceback = faceback.replace(re, "");
                document.getElementById("feedback").innerHTML = faceback;
            }
        });
        $('.Information').eq(36).on("change keyup paste", function(){
            if($('.Information').eq(36).val() != "") {
                $('.FBbutton').eq(9).attr("disabled", false);
            }
            else {
                $('.FBbutton').eq(9).attr("disabled", true);
                // 清空当前的Information时，如果faceback中插入了当前的Information按钮，也要把该按钮删除
                var faceback = document.getElementById("feedback").innerHTML;
                var replacedContent = "<img src=\"../image/informationBTN10.png\" style=\"height:16px;\">";
                var re = new RegExp(replacedContent, 'g');
                faceback = faceback.replace(re, "");
                document.getElementById("feedback").innerHTML = faceback;
            }
        });
    });
</script>

<!--=============================== Sheet Other Information  =====================================-->
<script>
    $(document).ready(() => {
        // 一开始只有1
        var oldCountCategory1 = 1;
        var oldCountCategory2 = 0;
        var oldCountCategory3 = 0;
        var oldCountCategory4 = 0;
        var oldCountCategory5 = 0;
        
        // 第一次加载，初始化值
        for(var i=1; i<=50; i++) {
            document.getElementById("category1").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
        }

        document.getElementById("otherInformationCategory").onchange = function() {
            var countCategory = document.getElementById("otherInformationCategory").value;

            // 一个Category
            if(countCategory == 1) {
                // 获取当前Category1的option的数量
                var countCategory1 = parseInt(document.getElementById("category1").value);
                
                document.getElementById("category2").style.display = "none";
                document.getElementById("category3").style.display = "none";
                document.getElementById("category4").style.display = "none";
                document.getElementById("category5").style.display = "none";
                document.getElementById("sheetOtherInformationFieldset2").style.display = "none";
                document.getElementById("sheetOtherInformationFieldset3").style.display = "none";
                document.getElementById("sheetOtherInformationFieldset4").style.display = "none";
                document.getElementById("sheetOtherInformationFieldset5").style.display = "none";
                
                // 清空全部
                $('#sheetOtherInformationFieldset2').html("");
                $('#sheetOtherInformationFieldset3').html("");
                $('#sheetOtherInformationFieldset4').html("");
                $('#sheetOtherInformationFieldset5').html("");
                
                for(var j=1; j<5; j++) {
                    document.getElementsByClassName("categoryTitle")[j].style.display = "none";
                }
                
                // 清除Category1的选项，必须要反着清除
                var oldCategory1OptionsLength = document.getElementById('category1').options.length;
                for(var i=oldCategory1OptionsLength-1; i>=0; i--) {
                    document.getElementById("category1").options.remove(i); 
                }

                // 重新加载Category1的选项
                for(var i=1; i<=50; i++) {
                    document.getElementById("category1").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                };
                
                // 保持选中
                document.getElementById('category1').options[countCategory1-1].selected = true;
                
                oldCountCategory2 = 0;
                oldCountCategory3 = 0;
                oldCountCategory4 = 0;
                oldCountCategory5 = 0;
            }
            // 两个Category
            else if(countCategory == 2) { 
                // 获取当前Category1的option的数量
                var countCategory1 = parseInt(document.getElementById("category1").value);
                
                if(oldCountCategory2 == 0) {
                    document.getElementById("category2").style.display = "inline";
                    document.getElementById("sheetOtherInformationFieldset2").style.display = "block";
                    
                    $('#sheetOtherInformationFieldset2').append("<legend>Spread Sheet Other Information Category 2</legend>");
                    $('#sheetOtherInformationFieldset2').append("<label class='label'>Category Name:</label>");
                    $('#sheetOtherInformationFieldset2').append("<input type='text' class='CategoryName' name='Category2Name' autocomplete='off' placeholder='Category Name' /><br>");
                    
                    document.getElementsByClassName("categoryTitle")[1].style.display = "inline-block";
                    
                    // 清除Category1的选项，必须要反着清除
                    var oldCategory1OptionsLength = document.getElementById('category1').options.length;
                    for(var i=oldCategory1OptionsLength-1; i>=0; i--) {
                        document.getElementById("category1").options.remove(i); 
                    }
                    // 清除Category2的选项，必须要反着清除
                    var oldCategory2OptionsLength = document.getElementById('category2').options.length;
                    for(var i=oldCategory2OptionsLength-1; i>=0; i--) {
                        document.getElementById("category2").options.remove(i); 
                    }

                    // 重新加载Category1的选项
                    for(var i=1; i<=49; i++) {
                        document.getElementById("category1").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    }
                    // 重新加载Category2的选项
                    for(var i=1; i<=(50-countCategory1); i++) {
                        document.getElementById("category2").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    };
                    
                    // 保持选中
                    document.getElementById('category1').options[countCategory1-1].selected = true;
                    
                    generateOtherInfoCategoryItems("#sheetOtherInformationFieldset2", countCategory1 + 1);
                    
                    oldCountCategory2 = 1;
                }
                else {
                    document.getElementById("category3").style.display = "none";
                    document.getElementById("category4").style.display = "none";
                    document.getElementById("category5").style.display = "none";
                    document.getElementById("sheetOtherInformationFieldset3").style.display = "none";
                    document.getElementById("sheetOtherInformationFieldset4").style.display = "none";
                    document.getElementById("sheetOtherInformationFieldset5").style.display = "none";
                    
                    // 清空全部
                    $('#sheetOtherInformationFieldset3').html("");
                    $('#sheetOtherInformationFieldset4').html("");
                    $('#sheetOtherInformationFieldset5').html("");
                    
                    for(var j=2; j<5; j++) {
                        document.getElementsByClassName("categoryTitle")[j].style.display = "none";
                    }
                    
                    // 获取当前Category2的option的数量
                    var countCategory2 = parseInt(document.getElementById("category2").value);
                    
                    // 清除Category1的选项，必须要反着清除
                    var oldCategory1OptionsLength = document.getElementById('category1').options.length;
                    for(var i=oldCategory1OptionsLength-1; i>=0; i--) {
                        document.getElementById("category1").options.remove(i); 
                    }
                    // 清除Category2的选项，必须要反着清除
                    var oldCategory2OptionsLength = document.getElementById('category2').options.length;
                    for(var i=oldCategory2OptionsLength-1; i>=0; i--) {
                        document.getElementById("category2").options.remove(i); 
                    }
                    
                    // 重新加载Category1的选项
                    for(var i=1; i<=(50-countCategory2); i++) {
                        document.getElementById("category1").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    }
                    // 重新加载Category2的选项
                    for(var i=1; i<=(50-countCategory1); i++) {
                        document.getElementById("category2").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    }
                    
                    // 保持选中
                    document.getElementById('category1').options[countCategory1-1].selected = true;
                    document.getElementById('category2').options[countCategory2-1].selected = true;
                    
                    oldCountCategory2 = countCategory2;
                }
                oldCountCategory1 = countCategory1;
                oldCountCategory3 = 0;
                oldCountCategory4 = 0;
                oldCountCategory5 = 0;
            }
            // 三个Category
            else if(countCategory == 3) {
                // 获取当前Category1的option的数量
                var countCategory1 = parseInt(document.getElementById("category1").value);
                
                if(oldCountCategory2 == 0) {
                    document.getElementById("category2").style.display = "inline";
                    document.getElementById("sheetOtherInformationFieldset2").style.display = "block";
                    
                    $('#sheetOtherInformationFieldset2').append("<legend>Spread Sheet Other Information Category 2</legend>");
                    $('#sheetOtherInformationFieldset2').append("<label class='label'>Category Name:</label>");
                    $('#sheetOtherInformationFieldset2').append("<input type='text' class='CategoryName' name='Category2Name' autocomplete='off' placeholder='Category Name' /><br>");
                    
                    document.getElementsByClassName("categoryTitle")[1].style.display = "inline-block";
                    
                    // 清除Category2的选项，必须要反着清除
                    var oldCategory2OptionsLength = document.getElementById('category2').options.length;
                    for(var i=oldCategory2OptionsLength-1; i>=0; i--) {
                        document.getElementById("category2").options.remove(i); 
                    }

                    // 重新加载Category2的选项
                    for(var i=1; i<=(50-countCategory1); i++) {
                        document.getElementById("category2").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    };
                    
                    generateOtherInfoCategoryItems("#sheetOtherInformationFieldset2", countCategory1 + 1);
                    
                    oldCountCategory2 = 1;
                }
                
                // 获取当前Category2的option的数量
                var countCategory2 = parseInt(document.getElementById("category2").value);
                
                if(oldCountCategory3 == 0) {
                    document.getElementById("category3").style.display = "inline";
                    document.getElementById("sheetOtherInformationFieldset3").style.display = "block";
                    
                    $('#sheetOtherInformationFieldset3').append("<legend>Spread Sheet Other Information Category 3</legend>");
                    $('#sheetOtherInformationFieldset3').append("<label class='label'>Category Name:</label>");
                    $('#sheetOtherInformationFieldset3').append("<input type='text' class='CategoryName' name='Category3Name' autocomplete='off' placeholder='Category Name' /><br>");
                    
                    document.getElementsByClassName("categoryTitle")[2].style.display = "inline-block";
                    
                    // 清除Category1的选项，必须要反着清除
                    var oldCategory1OptionsLength = document.getElementById('category1').options.length;
                    for(var i=oldCategory1OptionsLength-1; i>=0; i--) {
                        document.getElementById("category1").options.remove(i); 
                    }
                    // 清除Category2的选项，必须要反着清除
                    var oldCategory2OptionsLength = document.getElementById('category2').options.length;
                    for(var i=oldCategory2OptionsLength-1; i>=0; i--) {
                        document.getElementById("category2").options.remove(i); 
                    }
                    // 清除Category3的选项，必须要反着清除
                    var oldCategory3OptionsLength = document.getElementById('category3').options.length;
                    for(var i=oldCategory3OptionsLength-1; i>=0; i--) {
                        document.getElementById("category3").options.remove(i); 
                    }
                    
                    // 重新加载Category1的选项
                    for(var i=1; i<=(49-countCategory2); i++) {
                        document.getElementById("category1").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    }
                    // 重新加载Category2的选项
                    for(var i=1; i<=(49-countCategory1); i++) {
                        document.getElementById("category2").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    };
                    // 重新加载Category3的选项
                    for(var i=1; i<=(50-countCategory1-countCategory2); i++) {
                        document.getElementById("category3").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    };
                    
                    // 保持选中
                    document.getElementById('category1').options[countCategory1-1].selected = true;
                    document.getElementById('category2').options[countCategory2-1].selected = true;
                    
                    generateOtherInfoCategoryItems("#sheetOtherInformationFieldset3", countCategory1 + countCategory2 + 1);
                    
                    oldCountCategory3 = 1;
                }
                else {
                    document.getElementById("category4").style.display = "none";
                    document.getElementById("category5").style.display = "none";
                    document.getElementById("sheetOtherInformationFieldset4").style.display = "none";
                    document.getElementById("sheetOtherInformationFieldset5").style.display = "none";
                    
                    // 清空全部
                    $('#sheetOtherInformationFieldset4').html("");
                    $('#sheetOtherInformationFieldset5').html("");
                    
                    for(var j=3; j<5; j++) {
                        document.getElementsByClassName("categoryTitle")[j].style.display = "none";
                    }
                    
                    // 获取当前Category3的option的数量
                    var countCategory3 = parseInt(document.getElementById("category3").value);
                    
                    // 清除Category1的选项，必须要反着清除
                    var oldCategory1OptionsLength = document.getElementById('category1').options.length;
                    for(var i=oldCategory1OptionsLength-1; i>=0; i--) {
                        document.getElementById("category1").options.remove(i); 
                    }
                    // 清除Category2的选项，必须要反着清除
                    var oldCategory2OptionsLength = document.getElementById('category2').options.length;
                    for(var i=oldCategory2OptionsLength-1; i>=0; i--) {
                        document.getElementById("category2").options.remove(i); 
                    }
                    // 清除Category3的选项，必须要反着清除
                    var oldCategory3OptionsLength = document.getElementById('category3').options.length;
                    for(var i=oldCategory3OptionsLength-1; i>=0; i--) {
                        document.getElementById("category3").options.remove(i); 
                    }
                    
                    // 重新加载Category1的选项
                    for(var i=1; i<=(50-countCategory2-countCategory3); i++) {
                        document.getElementById("category1").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    }
                    // 重新加载Category2的选项
                    for(var i=1; i<=(50-countCategory1-countCategory3); i++) {
                        document.getElementById("category2").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    }
                    // 重新加载Category3的选项
                    for(var i=1; i<=(50-countCategory1-countCategory2); i++) {
                        document.getElementById("category3").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    }
                    
                    // 保持选中
                    document.getElementById('category1').options[countCategory1-1].selected = true;
                    document.getElementById('category2').options[countCategory2-1].selected = true;
                    document.getElementById('category3').options[countCategory3-1].selected = true;
                    
                    oldCountCategory3 = countCategory3;
                }
                oldCountCategory1 = countCategory1;
                oldCountCategory2 = countCategory2;
                oldCountCategory4 = 0;
                oldCountCategory5 = 0;
            }
            // 四个Category
            else if(countCategory == 4) {
                // 获取当前Category1的option的数量
                var countCategory1 = parseInt(document.getElementById("category1").value);
                
                if(oldCountCategory2 == 0) {
                    document.getElementById("category2").style.display = "inline";
                    document.getElementById("sheetOtherInformationFieldset2").style.display = "block";
                    
                    $('#sheetOtherInformationFieldset2').append("<legend>Spread Sheet Other Information Category 2</legend>");
                    $('#sheetOtherInformationFieldset2').append("<label class='label'>Category Name:</label>");
                    $('#sheetOtherInformationFieldset2').append("<input type='text' class='CategoryName' name='Category2Name' autocomplete='off' placeholder='Category Name' /><br>");
                    
                    document.getElementsByClassName("categoryTitle")[1].style.display = "inline-block";
                    
                    // 清除Category2的选项，必须要反着清除
                    var oldCategory2OptionsLength = document.getElementById('category2').options.length;
                    for(var i=oldCategory2OptionsLength-1; i>=0; i--) {
                        document.getElementById("category2").options.remove(i); 
                    }

                    // 重新加载Category2的选项
                    for(var i=1; i<=(50-countCategory1); i++) {
                        document.getElementById("category2").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    };
                    
                    generateOtherInfoCategoryItems("#sheetOtherInformationFieldset2", countCategory1 + 1);
                    
                    oldCountCategory2 = 1;
                }
                
                // 获取当前Category2的option的数量
                var countCategory2 = parseInt(document.getElementById("category2").value);
                
                if(oldCountCategory3 == 0) {
                    document.getElementById("category3").style.display = "inline";
                    document.getElementById("sheetOtherInformationFieldset3").style.display = "block";
                    
                    $('#sheetOtherInformationFieldset3').append("<legend>Spread Sheet Other Information Category 3</legend>");
                    $('#sheetOtherInformationFieldset3').append("<label class='label'>Category Name:</label>");
                    $('#sheetOtherInformationFieldset3').append("<input type='text' class='CategoryName' name='Category3Name' autocomplete='off' placeholder='Category Name' /><br>");
                    
                    document.getElementsByClassName("categoryTitle")[2].style.display = "inline-block";
                    
                    // 清除Category3的选项，必须要反着清除
                    var oldCategory3OptionsLength = document.getElementById('category3').options.length;
                    for(var i=oldCategory3OptionsLength-1; i>=0; i--) {
                        document.getElementById("category3").options.remove(i); 
                    }

                    // 重新加载Category3的选项
                    for(var i=1; i<=(50-countCategory1-countCategory2); i++) {
                        document.getElementById("category3").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    };
                    
                    generateOtherInfoCategoryItems("#sheetOtherInformationFieldset3", countCategory1 + countCategory2 + 1);
                    
                    oldCountCategory3 = 1;
                }
                
                // 获取当前Category3的option的数量
                var countCategory3 = parseInt(document.getElementById("category3").value);
                
                if(oldCountCategory4 == 0) {
                    document.getElementById("category4").style.display = "inline";
                    document.getElementById("sheetOtherInformationFieldset4").style.display = "block";
                    
                    $('#sheetOtherInformationFieldset4').append("<legend>Spread Sheet Other Information Category 4</legend>");
                    $('#sheetOtherInformationFieldset4').append("<label class='label'>Category Name:</label>");
                    $('#sheetOtherInformationFieldset4').append("<input type='text' class='CategoryName' name='Category4Name' autocomplete='off' placeholder='Category Name' /><br>");
                    
                    document.getElementsByClassName("categoryTitle")[3].style.display = "inline-block";
                    
                    // 清除Category1的选项，必须要反着清除
                    var oldCategory1OptionsLength = document.getElementById('category1').options.length;
                    for(var i=oldCategory1OptionsLength-1; i>=0; i--) {
                        document.getElementById("category1").options.remove(i); 
                    }
                    // 清除Category2的选项，必须要反着清除
                    var oldCategory2OptionsLength = document.getElementById('category2').options.length;
                    for(var i=oldCategory2OptionsLength-1; i>=0; i--) {
                        document.getElementById("category2").options.remove(i); 
                    }
                    // 清除Category3的选项，必须要反着清除
                    var oldCategory3OptionsLength = document.getElementById('category3').options.length;
                    for(var i=oldCategory3OptionsLength-1; i>=0; i--) {
                        document.getElementById("category3").options.remove(i); 
                    }
                    // 清除Category4的选项，必须要反着清除
                    var oldCategory4OptionsLength = document.getElementById('category4').options.length;
                    for(var i=oldCategory4OptionsLength-1; i>=0; i--) {
                        document.getElementById("category4").options.remove(i); 
                    }
                    
                    // 重新加载Category1的选项
                    for(var i=1; i<=(49-countCategory2-countCategory3); i++) {
                        document.getElementById("category1").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    }
                    // 重新加载Category2的选项
                    for(var i=1; i<=(49-countCategory1-countCategory3); i++) {
                        document.getElementById("category2").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    };
                    // 重新加载Category3的选项
                    for(var i=1; i<=(49-countCategory1-countCategory2); i++) {
                        document.getElementById("category3").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    };
                    // 重新加载Category4的选项
                    for(var i=1; i<=(50-countCategory1-countCategory2-countCategory3); i++) {
                        document.getElementById("category4").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    };
                    
                    // 保持选中
                    document.getElementById('category1').options[countCategory1-1].selected = true;
                    document.getElementById('category2').options[countCategory2-1].selected = true;
                    document.getElementById('category3').options[countCategory3-1].selected = true;
                    
                    generateOtherInfoCategoryItems("#sheetOtherInformationFieldset4", countCategory1 + countCategory2 + countCategory3 + 1);
                    
                    oldCountCategory3 = 1;
                }
                else {
                    document.getElementById("category5").style.display = "none";
                    document.getElementById("sheetOtherInformationFieldset5").style.display = "none";
                    
                    $('#sheetOtherInformationFieldset5').html("");
                    
                    document.getElementsByClassName("categoryTitle")[4].style.display = "none";
                    
                    // 获取当前Category4的option的数量
                    var countCategory4 = parseInt(document.getElementById("category4").value);
                    
                    // 清除Category1的选项，必须要反着清除
                    var oldCategory1OptionsLength = document.getElementById('category1').options.length;
                    for(var i=oldCategory1OptionsLength-1; i>=0; i--) {
                        document.getElementById("category1").options.remove(i); 
                    }
                    // 清除Category2的选项，必须要反着清除
                    var oldCategory2OptionsLength = document.getElementById('category2').options.length;
                    for(var i=oldCategory2OptionsLength-1; i>=0; i--) {
                        document.getElementById("category2").options.remove(i); 
                    }
                    // 清除Category3的选项，必须要反着清除
                    var oldCategory3OptionsLength = document.getElementById('category3').options.length;
                    for(var i=oldCategory3OptionsLength-1; i>=0; i--) {
                        document.getElementById("category3").options.remove(i); 
                    }
                    // 清除Category4的选项，必须要反着清除
                    var oldCategory4OptionsLength = document.getElementById('category4').options.length;
                    for(var i=oldCategory4OptionsLength-1; i>=0; i--) {
                        document.getElementById("category4").options.remove(i); 
                    }
                    
                    // 重新加载Category1的选项
                    for(var i=1; i<=(50-countCategory2-countCategory3-countCategory4); i++) {
                        document.getElementById("category1").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    }
                    // 重新加载Category2的选项
                    for(var i=1; i<=(50-countCategory1-countCategory3-countCategory4); i++) {
                        document.getElementById("category2").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    }
                    // 重新加载Category3的选项
                    for(var i=1; i<=(50-countCategory1-countCategory2-countCategory4); i++) {
                        document.getElementById("category3").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    }
                    // 重新加载Category4的选项
                    for(var i=1; i<=(50-countCategory1-countCategory2-countCategory3); i++) {
                        document.getElementById("category4").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    };
                    
                    // 保持选中
                    document.getElementById('category1').options[countCategory1-1].selected = true;
                    document.getElementById('category2').options[countCategory2-1].selected = true;
                    document.getElementById('category3').options[countCategory3-1].selected = true;
                    document.getElementById('category4').options[countCategory4-1].selected = true;
                    
                    oldCountCategory4 = countCategory4;
                }
                oldCountCategory1 = countCategory1;
                oldCountCategory2 = countCategory2;
                oldCountCategory3 = countCategory3;
                oldCountCategory5 = 0;
            }
            // 五个Category
            else if(countCategory == 5) {
                // 获取当前Category1的option的数量
                var countCategory1 = parseInt(document.getElementById("category1").value);
                
                if(oldCountCategory2 == 0) {
                    document.getElementById("category2").style.display = "inline";
                    document.getElementById("sheetOtherInformationFieldset2").style.display = "block";
                    
                    $('#sheetOtherInformationFieldset2').append("<legend>Spread Sheet Other Information Category 2</legend>");
                    $('#sheetOtherInformationFieldset2').append("<label class='label'>Category Name:</label>");
                    $('#sheetOtherInformationFieldset2').append("<input type='text' class='CategoryName' name='Category2Name' autocomplete='off' placeholder='Category Name' /><br>");
                    
                    document.getElementsByClassName("categoryTitle")[1].style.display = "inline-block";
                    
                    // 清除Category2的选项，必须要反着清除
                    var oldCategory2OptionsLength = document.getElementById('category2').options.length;
                    for(var i=oldCategory2OptionsLength-1; i>=0; i--) {
                        document.getElementById("category2").options.remove(i); 
                    }

                    // 重新加载Category2的选项
                    for(var i=1; i<=(50-countCategory1); i++) {
                        document.getElementById("category2").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    };
                    
                    generateOtherInfoCategoryItems("#sheetOtherInformationFieldset2", countCategory1 + 1);
                    
                    oldCountCategory2 = 1;
                }
                
                // 获取当前Category2的option的数量
                var countCategory2 = parseInt(document.getElementById("category2").value);
                
                if(oldCountCategory3 == 0) {
                    document.getElementById("category3").style.display = "inline";
                    document.getElementById("sheetOtherInformationFieldset3").style.display = "block";
                    
                    $('#sheetOtherInformationFieldset3').append("<legend>Spread Sheet Other Information Category 3</legend>");
                    $('#sheetOtherInformationFieldset3').append("<label class='label'>Category Name:</label>");
                    $('#sheetOtherInformationFieldset3').append("<input type='text' class='CategoryName' name='Category3Name' autocomplete='off' placeholder='Category Name' /><br>");
                    
                    document.getElementsByClassName("categoryTitle")[2].style.display = "inline-block";
                    
                    // 清除Category3的选项，必须要反着清除
                    var oldCategory3OptionsLength = document.getElementById('category3').options.length;
                    for(var i=oldCategory3OptionsLength-1; i>=0; i--) {
                        document.getElementById("category3").options.remove(i); 
                    }

                    // 重新加载Category3的选项
                    for(var i=1; i<=(50-countCategory1-countCategory2); i++) {
                        document.getElementById("category3").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    };
                    
                    generateOtherInfoCategoryItems("#sheetOtherInformationFieldset3", countCategory1 + countCategory2 + 1);
                    
                    oldCountCategory3 = 1;
                }
                
                // 获取当前Category3的option的数量
                var countCategory3 = parseInt(document.getElementById("category3").value);
                
                if(oldCountCategory4 == 0) {
                    document.getElementById("category4").style.display = "inline";
                    document.getElementById("sheetOtherInformationFieldset4").style.display = "block";
                    
                    $('#sheetOtherInformationFieldset4').append("<legend>Spread Sheet Other Information Category 4</legend>");
                    $('#sheetOtherInformationFieldset4').append("<label class='label'>Category Name:</label>");
                    $('#sheetOtherInformationFieldset4').append("<input type='text' class='CategoryName' name='Category4Name' autocomplete='off' placeholder='Category Name' /><br>");
                    
                    document.getElementsByClassName("categoryTitle")[3].style.display = "inline-block";
                    
                    // 清除Category4的选项，必须要反着清除
                    var oldCategory4OptionsLength = document.getElementById('category4').options.length;
                    for(var i=oldCategory4OptionsLength-1; i>=0; i--) {
                        document.getElementById("category4").options.remove(i); 
                    }

                    // 重新加载Category4的选项
                    for(var i=1; i<=(50-countCategory1-countCategory2-countCategory3); i++) {
                        document.getElementById("category4").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    };
                    
                    generateOtherInfoCategoryItems("#sheetOtherInformationFieldset4", countCategory1 + countCategory2 + countCategory3 + 1);
                    
                    oldCountCategory4 = 1;
                }
                
                // 获取当前Category4的option的数量
                var countCategory4 = parseInt(document.getElementById("category4").value);
                
                if(oldCountCategory5 == 0) {
                    document.getElementById("category5").style.display = "inline";
                    document.getElementById("sheetOtherInformationFieldset5").style.display = "block";
                    
                    $('#sheetOtherInformationFieldset5').append("<legend>Spread Sheet Other Information Category 5</legend>");
                    $('#sheetOtherInformationFieldset5').append("<label class='label'>Category Name:</label>");
                    $('#sheetOtherInformationFieldset5').append("<input type='text' class='CategoryName' name='Category5Name' autocomplete='off' placeholder='Category Name' /><br>");
                    
                    document.getElementsByClassName("categoryTitle")[4].style.display = "inline-block";
                    
                    // 清除Category1的选项，必须要反着清除
                    var oldCategory1OptionsLength = document.getElementById('category1').options.length;
                    for(var i=oldCategory1OptionsLength-1; i>=0; i--) {
                        document.getElementById("category1").options.remove(i); 
                    }
                    // 清除Category2的选项，必须要反着清除
                    var oldCategory2OptionsLength = document.getElementById('category2').options.length;
                    for(var i=oldCategory2OptionsLength-1; i>=0; i--) {
                        document.getElementById("category2").options.remove(i); 
                    }
                    // 清除Category3的选项，必须要反着清除
                    var oldCategory3OptionsLength = document.getElementById('category3').options.length;
                    for(var i=oldCategory3OptionsLength-1; i>=0; i--) {
                        document.getElementById("category3").options.remove(i); 
                    }
                    // 清除Category4的选项，必须要反着清除
                    var oldCategory4OptionsLength = document.getElementById('category4').options.length;
                    for(var i=oldCategory4OptionsLength-1; i>=0; i--) {
                        document.getElementById("category4").options.remove(i); 
                    }
                    // 清除Category5的选项，必须要反着清除
                    var oldCategory5OptionsLength = document.getElementById('category5').options.length;
                    for(var i=oldCategory5OptionsLength-1; i>=0; i--) {
                        document.getElementById("category5").options.remove(i); 
                    }
                    
                    // 重新加载Category1的选项
                    for(var i=1; i<=(49-countCategory2-countCategory3-countCategory4); i++) {
                        document.getElementById("category1").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    }
                    // 重新加载Category2的选项
                    for(var i=1; i<=(49-countCategory1-countCategory3-countCategory4); i++) {
                        document.getElementById("category2").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    };
                    // 重新加载Category3的选项
                    for(var i=1; i<=(49-countCategory1-countCategory2-countCategory4); i++) {
                        document.getElementById("category3").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    };
                    // 重新加载Category4的选项
                    for(var i=1; i<=(49-countCategory1-countCategory2-countCategory3); i++) {
                        document.getElementById("category4").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    };
                    // 重新加载Category5的选项
                    for(var i=1; i<=(50-countCategory1-countCategory2-countCategory3-countCategory4); i++) {
                        document.getElementById("category5").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    };
                    
                    // 保持选中
                    document.getElementById('category1').options[countCategory1-1].selected = true;
                    document.getElementById('category2').options[countCategory2-1].selected = true;
                    document.getElementById('category3').options[countCategory3-1].selected = true;
                    document.getElementById('category4').options[countCategory4-1].selected = true;
                    
                    generateOtherInfoCategoryItems("#sheetOtherInformationFieldset5", countCategory1 + countCategory2 + countCategory3 + countCategory4 + 1);
                    
                    oldCountCategory4 = 1;
                }
                oldCountCategory1 = countCategory1;
                oldCountCategory2 = countCategory2;
                oldCountCategory3 = countCategory3;
                oldCountCategory4 = countCategory4;
            }
        }
        
        /*================================ Sheet Other Information =======================================*/

        // 如果Category1有变化
        $(document).delegate("#category1", "change", function () {
            // 记住oldCategory1Name
            var oldCategory1Name = document.getElementsByName("Category1Name")[0].value;
            
            // 记住oldCategory1所有的Item
            var Category1OtherInformationNameArray = new Array();
            var Category1OtherInformationTypeArray = new Array();
            var Category1OtherInformationContentArray = new Array();
            
            for(var i=0; i<oldCountCategory1; i++) {
                if(!$(".sheetOtherInfoText").eq(i).children("input").prop('disabled')) {
                    Category1OtherInformationTypeArray.push($(".sheetOtherInfoText").eq(i).children("input").eq(0).val());
                }
                else if(!$(".sheetOtherInfoDorpdownList").eq(i).children("input").prop('disabled')) {
                    Category1OtherInformationTypeArray.push($(".sheetOtherInfoDorpdownList").eq(i).children("input").eq(0).val());
                    var DorpdownListContentLength = document.getElementsByName("OtherInformation"+(i+1)+"DorpdownListItem[]").length;
                    if(DorpdownListContentLength > 0) {
                        Category1OtherInformationContentArray[i] = new Array();
                        for(var j=0; j<DorpdownListContentLength; j++) {
                            if($(".sheetOtherInfoDorpdownListContent").eq(i).children("input").eq(j).val() != "" && $(".sheetOtherInfoDorpdownListContent").eq(i).children("input").eq(j).val() != undefined) {
                                var content = $(".sheetOtherInfoDorpdownListContent").eq(i).children("input").eq(j).val();
                                Category1OtherInformationContentArray[i].push(content); 
                            }
                        }
                    }
                }
                else if(!$(".sheetOtherInfoCheckBox").eq(i).children("input").prop('disabled')) {
                    Category1OtherInformationTypeArray.push($(".sheetOtherInfoCheckBox").eq(i).children("input").eq(0).val());
                    var CheckBoxContentLength = document.getElementsByName("OtherInformation"+(i+1)+"CheckBoxItem[]").length;
                    if(CheckBoxContentLength > 0) {
                        Category1OtherInformationContentArray[i] = new Array();
                        for(var j=0; j<CheckBoxContentLength; j++) {
                            if($(".sheetOtherInfoCheckBoxContent").eq(i).children("input").eq(j).val() != "" && $(".sheetOtherInfoCheckBoxContent").eq(i).children("input").eq(j).val() != undefined) {
                                var content = $(".sheetOtherInfoCheckBoxContent").eq(i).children("input").eq(j).val();
                                Category1OtherInformationContentArray[i].push(content);
                            }
                        }
                    }
                }
                else{
                    Category1OtherInformationTypeArray.push($(".sheetOtherInfoRadio").eq(i).children("input").eq(0).val());
                    var RadioContentLength = document.getElementsByName("OtherInformation"+(i+1)+"RadioItem[]").length;
                    if(RadioContentLength > 0) {
                        Category1OtherInformationContentArray[i] = new Array();
                        for(var j=0; j<RadioContentLength; j++) {
                            if($(".sheetOtherInfoRadioContent").eq(i).children("input").eq(j).val() != "" && $(".sheetOtherInfoRadioContent").eq(i).children("input").eq(j).val() != undefined) {
                                var content = $(".sheetOtherInfoRadioContent").eq(i).children("input").eq(j).val();
                                Category1OtherInformationContentArray[i].push(content);
                            }
                        }
                    }
                }
            }
            
            for(var i=0; i<oldCountCategory1; i++) {
                if(!$(".sheetOtherInfoText").eq(i).children("input").prop('disabled')) {
                    Category1OtherInformationNameArray.push($(".sheetOtherInfoText").eq(i).children("input").eq(1).val());
                }
                else if(!$(".sheetOtherInfoDorpdownList").eq(i).children("input").prop('disabled')) {
                    Category1OtherInformationNameArray.push($(".sheetOtherInfoDorpdownList").eq(i).children("input").eq(1).val());
                }
                else if(!$(".sheetOtherInfoCheckBox").eq(i).children("input").prop('disabled')) {
                    Category1OtherInformationNameArray.push($(".sheetOtherInfoCheckBox").eq(i).children("input").eq(1).val());
                }
                else{
                    Category1OtherInformationNameArray.push($(".sheetOtherInfoRadio").eq(i).children("input").eq(1).val());
                }
            }
            
            // 获取当前Category1的option的数量
            var countCategory1 = parseInt(document.getElementById("category1").value);
            
            // 获取当前一共有多少个Category
            var countCategory = document.getElementById("otherInformationCategory").value;
            
            // 在category1更新之前记住oldCategory2所有的Item
            if(countCategory >= 2) {
                // 记住oldCategory2Name
                var oldCategory2Name = document.getElementsByName("Category2Name")[0].value;

                var Category2OtherInformationNameArray = new Array();
                var Category2OtherInformationTypeArray = new Array();
                var Category2OtherInformationContentArray = new Array();
                
                for(var i=oldCountCategory1; i<oldCountCategory1+oldCountCategory2; i++) {
                    if(!$(".sheetOtherInfoText").eq(i).children("input").prop('disabled')) {
                        Category2OtherInformationTypeArray.push($(".sheetOtherInfoText").eq(i).children("input").eq(0).val());
                    }
                    else if(!$(".sheetOtherInfoDorpdownList").eq(i).children("input").prop('disabled')) {
                        Category2OtherInformationTypeArray.push($(".sheetOtherInfoDorpdownList").eq(i).children("input").eq(0).val());
                        var DorpdownListContentLength = document.getElementsByName("OtherInformation"+(i+1)+"DorpdownListItem[]").length;
                        if(DorpdownListContentLength > 0) {
                            Category2OtherInformationContentArray[i-oldCountCategory1] = new Array();
                            for(var j=0; j<DorpdownListContentLength; j++) {
                                if($(".sheetOtherInfoDorpdownListContent").eq(i).children("input").eq(j).val() != "" && $(".sheetOtherInfoDorpdownListContent").eq(i).children("input").eq(j).val() != undefined) {
                                    var content = $(".sheetOtherInfoDorpdownListContent").eq(i).children("input").eq(j).val();
                                    Category2OtherInformationContentArray[i-oldCountCategory1].push(content); 
                                }
                            }
                        }
                    }
                    else if(!$(".sheetOtherInfoCheckBox").eq(i).children("input").prop('disabled')) {
                        Category2OtherInformationTypeArray.push($(".sheetOtherInfoCheckBox").eq(i).children("input").eq(0).val());
                        var CheckBoxContentLength = document.getElementsByName("OtherInformation"+(i+1)+"CheckBoxItem[]").length;
                        if(CheckBoxContentLength > 0) {
                            Category2OtherInformationContentArray[i-oldCountCategory1] = new Array();
                            for(var j=0; j<CheckBoxContentLength; j++) {
                                if($(".sheetOtherInfoCheckBoxContent").eq(i).children("input").eq(j).val() != "" && $(".sheetOtherInfoCheckBoxContent").eq(i).children("input").eq(j).val() != undefined) {
                                    var content = $(".sheetOtherInfoCheckBoxContent").eq(i).children("input").eq(j).val();
                                    Category2OtherInformationContentArray[i-oldCountCategory1].push(content);
                                }
                            }
                        }
                    }
                    else{
                        Category2OtherInformationTypeArray.push($(".sheetOtherInfoRadio").eq(i).children("input").eq(0).val());
                        var RadioContentLength = document.getElementsByName("OtherInformation"+(i+1)+"RadioItem[]").length;
                        if(RadioContentLength > 0) {
                            Category2OtherInformationContentArray[i-oldCountCategory1] = new Array();
                            for(var j=0; j<RadioContentLength; j++) {
                                if($(".sheetOtherInfoRadioContent").eq(i).children("input").eq(j).val() != "" && $(".sheetOtherInfoRadioContent").eq(i).children("input").eq(j).val() != undefined) {
                                    var content = $(".sheetOtherInfoRadioContent").eq(i).children("input").eq(j).val();
                                    Category2OtherInformationContentArray[i-oldCountCategory1].push(content);
                                }
                            }
                        }
                    }
                }

                for(var i=oldCountCategory1; i<oldCountCategory1+oldCountCategory2; i++) {
                    if(!$(".sheetOtherInfoText").eq(i).children("input").prop('disabled')) {
                        Category2OtherInformationNameArray.push($(".sheetOtherInfoText").eq(i).children("input").eq(1).val());
                    }
                    else if(!$(".sheetOtherInfoDorpdownList").eq(i).children("input").prop('disabled')) {
                        Category2OtherInformationNameArray.push($(".sheetOtherInfoDorpdownList").eq(i).children("input").eq(1).val());
                    }
                    else if(!$(".sheetOtherInfoCheckBox").eq(i).children("input").prop('disabled')) {
                        Category2OtherInformationNameArray.push($(".sheetOtherInfoCheckBox").eq(i).children("input").eq(1).val());
                    }
                    else{
                        Category2OtherInformationNameArray.push($(".sheetOtherInfoRadio").eq(i).children("input").eq(1).val());
                    }
                }
            }
            // 在category1更新之前记住oldCategory3所有的Item
            if(countCategory >= 3) {
                // 记住oldCategory3Name
                var oldCategory3Name = document.getElementsByName("Category3Name")[0].value;

                var Category3OtherInformationNameArray = new Array();
                var Category3OtherInformationTypeArray = new Array();
                var Category3OtherInformationContentArray = new Array();
                
                for(var i=oldCountCategory1+oldCountCategory2; i<oldCountCategory1+oldCountCategory2+oldCountCategory3; i++) {
                    if(!$(".sheetOtherInfoText").eq(i).children("input").prop('disabled')) {
                        Category3OtherInformationTypeArray.push($(".sheetOtherInfoText").eq(i).children("input").eq(0).val());
                    }
                    else if(!$(".sheetOtherInfoDorpdownList").eq(i).children("input").prop('disabled')) {
                        Category3OtherInformationTypeArray.push($(".sheetOtherInfoDorpdownList").eq(i).children("input").eq(0).val());
                        var DorpdownListContentLength = document.getElementsByName("OtherInformation"+(i+1)+"DorpdownListItem[]").length;
                        if(DorpdownListContentLength > 0) {
                            Category3OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2] = new Array();
                            for(var j=0; j<DorpdownListContentLength; j++) {
                                if($(".sheetOtherInfoDorpdownListContent").eq(i).children("input").eq(j).val() != "" && $(".sheetOtherInfoDorpdownListContent").eq(i).children("input").eq(j).val() != undefined) {
                                    var content = $(".sheetOtherInfoDorpdownListContent").eq(i).children("input").eq(j).val();
                                    Category3OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2].push(content); 
                                }
                            }
                        }
                    }
                    else if(!$(".sheetOtherInfoCheckBox").eq(i).children("input").prop('disabled')) {
                        Category3OtherInformationTypeArray.push($(".sheetOtherInfoCheckBox").eq(i).children("input").eq(0).val());
                        var CheckBoxContentLength = document.getElementsByName("OtherInformation"+(i+1)+"CheckBoxItem[]").length;
                        if(CheckBoxContentLength > 0) {
                            Category3OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2] = new Array();
                            for(var j=0; j<CheckBoxContentLength; j++) {
                                if($(".sheetOtherInfoCheckBoxContent").eq(i).children("input").eq(j).val() != "" && $(".sheetOtherInfoCheckBoxContent").eq(i).children("input").eq(j).val() != undefined) {
                                    var content = $(".sheetOtherInfoCheckBoxContent").eq(i).children("input").eq(j).val();
                                    Category3OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2].push(content);
                                }
                            }
                        }
                    }
                    else{
                        Category3OtherInformationTypeArray.push($(".sheetOtherInfoRadio").eq(i).children("input").eq(0).val());
                        var RadioContentLength = document.getElementsByName("OtherInformation"+(i+1)+"RadioItem[]").length;
                        if(RadioContentLength > 0) {
                            Category3OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2] = new Array();
                            for(var j=0; j<RadioContentLength; j++) {
                                if($(".sheetOtherInfoRadioContent").eq(i).children("input").eq(j).val() != "" && $(".sheetOtherInfoRadioContent").eq(i).children("input").eq(j).val() != undefined) {
                                    var content = $(".sheetOtherInfoRadioContent").eq(i).children("input").eq(j).val();
                                    Category3OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2].push(content);
                                }
                            }
                        }
                    }
                }

                for(var i=oldCountCategory1+oldCountCategory2; i<oldCountCategory1+oldCountCategory2+oldCountCategory3; i++) {
                    if(!$(".sheetOtherInfoText").eq(i).children("input").prop('disabled')) {
                        Category3OtherInformationNameArray.push($(".sheetOtherInfoText").eq(i).children("input").eq(1).val());
                    }
                    else if(!$(".sheetOtherInfoDorpdownList").eq(i).children("input").prop('disabled')) {
                        Category3OtherInformationNameArray.push($(".sheetOtherInfoDorpdownList").eq(i).children("input").eq(1).val());
                    }
                    else if(!$(".sheetOtherInfoCheckBox").eq(i).children("input").prop('disabled')) {
                        Category3OtherInformationNameArray.push($(".sheetOtherInfoCheckBox").eq(i).children("input").eq(1).val());
                    }
                    else{
                        Category3OtherInformationNameArray.push($(".sheetOtherInfoRadio").eq(i).children("input").eq(1).val());
                    }
                }
            }
            // 在category1更新之前记住oldCategory4所有的Item
            if(countCategory >= 4) {
                // 记住oldCategory4Name
                var oldCategory4Name = document.getElementsByName("Category4Name")[0].value;

                // 记住oldCategory4所有的Item
                var Category4OtherInformationNameArray = new Array();
                var Category4OtherInformationTypeArray = new Array();
                var Category4OtherInformationContentArray = new Array();

                for(var i=oldCountCategory1+oldCountCategory2+oldCountCategory3; i<oldCountCategory1+oldCountCategory2+oldCountCategory3+oldCountCategory4; i++) {
                    if(!$(".sheetOtherInfoText").eq(i).children("input").prop('disabled')) {
                        Category4OtherInformationTypeArray.push($(".sheetOtherInfoText").eq(i).children("input").eq(0).val());
                    }
                    else if(!$(".sheetOtherInfoDorpdownList").eq(i).children("input").prop('disabled')) {
                        Category4OtherInformationTypeArray.push($(".sheetOtherInfoDorpdownList").eq(i).children("input").eq(0).val());
                        var DorpdownListContentLength = document.getElementsByName("OtherInformation"+(i+1)+"DorpdownListItem[]").length;
                        if(DorpdownListContentLength > 0) {
                            Category4OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3] = new Array();
                            for(var j=0; j<DorpdownListContentLength; j++) {
                                if($(".sheetOtherInfoDorpdownListContent").eq(i).children("input").eq(j).val() != "" && $(".sheetOtherInfoDorpdownListContent").eq(i).children("input").eq(j).val() != undefined) {
                                    var content = $(".sheetOtherInfoDorpdownListContent").eq(i).children("input").eq(j).val();
                                    Category4OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3].push(content); 
                                }
                            }
                        }
                    }
                    else if(!$(".sheetOtherInfoCheckBox").eq(i).children("input").prop('disabled')) {
                        Category4OtherInformationTypeArray.push($(".sheetOtherInfoCheckBox").eq(i).children("input").eq(0).val());
                        var CheckBoxContentLength = document.getElementsByName("OtherInformation"+(i+1)+"CheckBoxItem[]").length;
                        if(CheckBoxContentLength > 0) {
                            Category4OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3] = new Array();
                            for(var j=0; j<CheckBoxContentLength; j++) {
                                if($(".sheetOtherInfoCheckBoxContent").eq(i).children("input").eq(j).val() != "" && $(".sheetOtherInfoCheckBoxContent").eq(i).children("input").eq(j).val() != undefined) {
                                    var content = $(".sheetOtherInfoCheckBoxContent").eq(i).children("input").eq(j).val();
                                    Category4OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3].push(content);
                                }
                            }
                        }
                    }
                    else{
                        Category4OtherInformationTypeArray.push($(".sheetOtherInfoRadio").eq(i).children("input").eq(0).val());
                        var RadioContentLength = document.getElementsByName("OtherInformation"+(i+1)+"RadioItem[]").length;
                        if(RadioContentLength > 0) {
                            Category4OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3] = new Array();
                            for(var j=0; j<RadioContentLength; j++) {
                                if($(".sheetOtherInfoRadioContent").eq(i).children("input").eq(j).val() != "" && $(".sheetOtherInfoRadioContent").eq(i).children("input").eq(j).val() != undefined) {
                                    var content = $(".sheetOtherInfoRadioContent").eq(i).children("input").eq(j).val();
                                    Category4OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3].push(content);
                                }
                            }
                        }
                    }
                }

                for(var i=oldCountCategory1+oldCountCategory2+oldCountCategory3; i<oldCountCategory1+oldCountCategory2+oldCountCategory3+oldCountCategory4; i++) {
                    if(!$(".sheetOtherInfoText").eq(i).children("input").prop('disabled')) {
                        Category4OtherInformationNameArray.push($(".sheetOtherInfoText").eq(i).children("input").eq(1).val());
                    }
                    else if(!$(".sheetOtherInfoDorpdownList").eq(i).children("input").prop('disabled')) {
                        Category4OtherInformationNameArray.push($(".sheetOtherInfoDorpdownList").eq(i).children("input").eq(1).val());
                    }
                    else if(!$(".sheetOtherInfoCheckBox").eq(i).children("input").prop('disabled')) {
                        Category4OtherInformationNameArray.push($(".sheetOtherInfoCheckBox").eq(i).children("input").eq(1).val());
                    }
                    else{
                        Category4OtherInformationNameArray.push($(".sheetOtherInfoRadio").eq(i).children("input").eq(1).val());
                    }
                }
            }
            // 在category1更新之前记住oldCategory5所有的Item
            if(countCategory >= 5) {
                // 记住oldCategory5Name
                var oldCategory5Name = document.getElementsByName("Category5Name")[0].value;

                // 记住oldCategory5所有的Item
                var Category5OtherInformationNameArray = new Array();
                var Category5OtherInformationTypeArray = new Array();
                var Category5OtherInformationContentArray = new Array();

                for(var i=oldCountCategory1+oldCountCategory2+oldCountCategory3+oldCountCategory4; i<oldCountCategory1+oldCountCategory2+oldCountCategory3+oldCountCategory4+oldCountCategory5; i++) {
                    if(!$(".sheetOtherInfoText").eq(i).children("input").prop('disabled')) {
                        Category5OtherInformationTypeArray.push($(".sheetOtherInfoText").eq(i).children("input").eq(0).val());
                    }
                    else if(!$(".sheetOtherInfoDorpdownList").eq(i).children("input").prop('disabled')) {
                        Category5OtherInformationTypeArray.push($(".sheetOtherInfoDorpdownList").eq(i).children("input").eq(0).val());
                        var DorpdownListContentLength = document.getElementsByName("OtherInformation"+(i+1)+"DorpdownListItem[]").length;
                        if(DorpdownListContentLength > 0) {
                            Category5OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3-oldCountCategory4] = new Array();
                            for(var j=0; j<DorpdownListContentLength; j++) {
                                if($(".sheetOtherInfoDorpdownListContent").eq(i).children("input").eq(j).val() != "" && $(".sheetOtherInfoDorpdownListContent").eq(i).children("input").eq(j).val() != undefined) {
                                    var content = $(".sheetOtherInfoDorpdownListContent").eq(i).children("input").eq(j).val();
                                    Category5OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3-oldCountCategory4].push(content); 
                                }
                            }
                        }
                    }
                    else if(!$(".sheetOtherInfoCheckBox").eq(i).children("input").prop('disabled')) {
                        Category5OtherInformationTypeArray.push($(".sheetOtherInfoCheckBox").eq(i).children("input").eq(0).val());
                        var CheckBoxContentLength = document.getElementsByName("OtherInformation"+(i+1)+"CheckBoxItem[]").length;
                        if(CheckBoxContentLength > 0) {
                            Category5OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3-oldCountCategory4] = new Array();
                            for(var j=0; j<CheckBoxContentLength; j++) {
                                if($(".sheetOtherInfoCheckBoxContent").eq(i).children("input").eq(j).val() != "" && $(".sheetOtherInfoCheckBoxContent").eq(i).children("input").eq(j).val() != undefined) {
                                    var content = $(".sheetOtherInfoCheckBoxContent").eq(i).children("input").eq(j).val();
                                    Category5OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3-oldCountCategory4].push(content);
                                }
                            }
                        }
                    }
                    else{
                        Category5OtherInformationTypeArray.push($(".sheetOtherInfoRadio").eq(i).children("input").eq(0).val());
                        var RadioContentLength = document.getElementsByName("OtherInformation"+(i+1)+"RadioItem[]").length;
                        if(RadioContentLength > 0) {
                            Category5OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3-oldCountCategory4] = new Array();
                            for(var j=0; j<RadioContentLength; j++) {
                                if($(".sheetOtherInfoRadioContent").eq(i).children("input").eq(j).val() != "" && $(".sheetOtherInfoRadioContent").eq(i).children("input").eq(j).val() != undefined) {
                                    var content = $(".sheetOtherInfoRadioContent").eq(i).children("input").eq(j).val();
                                    Category5OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3-oldCountCategory4].push(content);
                                }
                            }
                        }
                    }
                }

                for(var i=oldCountCategory1+oldCountCategory2+oldCountCategory3+oldCountCategory4; i<oldCountCategory1+oldCountCategory2+oldCountCategory3+oldCountCategory4+oldCountCategory5; i++) {
                    if(!$(".sheetOtherInfoText").eq(i).children("input").prop('disabled')) {
                        Category5OtherInformationNameArray.push($(".sheetOtherInfoText").eq(i).children("input").eq(1).val());
                    }
                    else if(!$(".sheetOtherInfoDorpdownList").eq(i).children("input").prop('disabled')) {
                        Category5OtherInformationNameArray.push($(".sheetOtherInfoDorpdownList").eq(i).children("input").eq(1).val());
                    }
                    else if(!$(".sheetOtherInfoCheckBox").eq(i).children("input").prop('disabled')) {
                        Category5OtherInformationNameArray.push($(".sheetOtherInfoCheckBox").eq(i).children("input").eq(1).val());
                    }
                    else{
                        Category5OtherInformationNameArray.push($(".sheetOtherInfoRadio").eq(i).children("input").eq(1).val());
                    }
                }
            }
            
            // For category1
            $('#sheetOtherInformationFieldset1').html("");
            $('#sheetOtherInformationFieldset1').append("<legend>Spread Sheet Other Information Category 1</legend>");
            $('#sheetOtherInformationFieldset1').append("<label class='label'>Category Name:</label>");
            $('#sheetOtherInformationFieldset1').append("<input type='text' class='CategoryName' name='Category1Name' autocomplete='off' placeholder='Category Name' /><br>");
            
            // 生成Fieldset里面的Item
            for(var i=1; i<=countCategory1; i++) {
                generateOtherInfoCategoryItems("#sheetOtherInformationFieldset1", i);
            }
            
            // 恢复之前的记录
            document.getElementsByName("Category1Name")[0].value = oldCategory1Name;
            
            for(var i=0; i<countCategory1; i++) {
                if(i < oldCountCategory1) {
                    if(Category1OtherInformationTypeArray[i] == "Text") {
                        changeToTextOther(i);
                        $(".sheetOtherInfoText").eq(i).children("input").eq(1).val(Category1OtherInformationNameArray[i]);
                    }
                    else if(Category1OtherInformationTypeArray[i] == "DorpdownList") {
                        changeToDorpdownListOther(i);
                        $(".sheetOtherInfoDorpdownList").eq(i).children("input").eq(1).val(Category1OtherInformationNameArray[i]);
                        if(Category1OtherInformationContentArray[i].length > 3) {
                            for(var j=0; j<(Category1OtherInformationContentArray[i].length-3); j++) {
                                var content = document.getElementsByClassName("sheetOtherInfoDorpdownListContent")[i].innerHTML;
                                var newContent = "<input type='text' name='OtherInformation"+(i+1)+"DorpdownListItem[]' autocomplete='off' placeholder='Item (Dorpdown List)' />"
                                document.getElementsByClassName("sheetOtherInfoDorpdownListContent")[i].innerHTML = content + newContent;
                            }
                        }
                        for(var k=0; k<Category1OtherInformationContentArray[i].length; k++) {
                            document.getElementsByName("OtherInformation"+(i+1)+"DorpdownListItem[]")[k].value = Category1OtherInformationContentArray[i][k];
                        }
                    }
                    else if(Category1OtherInformationTypeArray[i] == "CheckBox") {
                        changeToCheckBoxOther(i);
                        $(".sheetOtherInfoCheckBox").eq(i).children("input").eq(1).val(Category1OtherInformationNameArray[i]);
                        if(Category1OtherInformationContentArray[i].length > 3) {
                            for(var j=0; j<(Category1OtherInformationContentArray[i].length-3); j++) {
                                var content = document.getElementsByClassName("sheetOtherInfoCheckBoxContent")[i].innerHTML;
                                var newContent = "<input type='text' name='OtherInformation"+(i+1)+"CheckBoxItem[]' autocomplete='off' placeholder='Item (CheckBox)' />"
                                document.getElementsByClassName("sheetOtherInfoCheckBoxContent")[i].innerHTML = content + newContent;
                            }
                        }
                        for(var k=0; k<Category1OtherInformationContentArray[i].length; k++) {
                            document.getElementsByName("OtherInformation"+(i+1)+"CheckBoxItem[]")[k].value = Category1OtherInformationContentArray[i][k];
                        }
                    }
                    else if(Category1OtherInformationTypeArray[i] == "Radio") {
                        changeToRadioOther(i);
                        $(".sheetOtherInfoRadio").eq(i).children("input").eq(1).val(Category1OtherInformationNameArray[i]);
                        if(Category1OtherInformationContentArray[i].length > 3) {
                            for(var j=0; j<(Category1OtherInformationContentArray[i].length-3); j++) {
                                var content = document.getElementsByClassName("sheetOtherInfoRadioContent")[i].innerHTML;
                                var newContent = "<input type='text' name='OtherInformation"+(i+1)+"RadioItem[]' autocomplete='off' placeholder='Item (Radio)' />"
                                document.getElementsByClassName("sheetOtherInfoRadioContent")[i].innerHTML = content + newContent;
                            }
                        }
                        for(var k=0; k<Category1OtherInformationContentArray[i].length; k++) {
                            document.getElementsByName("OtherInformation"+(i+1)+"RadioItem[]")[k].value = Category1OtherInformationContentArray[i][k];
                        }
                    }
                }
            }
            
            // 一个Category无需讨论
            // 两个Category
            var countCategory2;
            var countCategory3;
            var countCategory4;
            var countCategory5;
            
            if(countCategory >= 2) {
                // 获取当前Category2的option的数量
                countCategory2 = parseInt(document.getElementById("category2").value);
                
                // 清除Category2的选项，必须要反着清除
                var oldCategory2OptionsLength = document.getElementById('category2').options.length;
                for(var i=oldCategory2OptionsLength-1; i>=0; i--) {
                    document.getElementById("category2").options.remove(i);
                }
            }
            if(countCategory >= 3) {
                // 获取当前Category3的option的数量
                var countCategory3 = parseInt(document.getElementById("category3").value);
                
                // 清除Category3的选项，必须要反着清除
                var oldCategory3OptionsLength = document.getElementById('category3').options.length;
                for(var i=oldCategory3OptionsLength-1; i>=0; i--) {
                    document.getElementById("category3").options.remove(i);
                }
            }
            if(countCategory >= 4) {
                // 获取当前Category4的option的数量
                var countCategory4 = parseInt(document.getElementById("category4").value);
                
                // 清除Category4的选项，必须要反着清除
                var oldCategory4OptionsLength = document.getElementById('category4').options.length;
                for(var i=oldCategory4OptionsLength-1; i>=0; i--) {
                    document.getElementById("category4").options.remove(i);
                }
            }
            if(countCategory >= 5) {
                // 获取当前Category5的option的数量
                var countCategory5 = parseInt(document.getElementById("category5").value);
                
                // 清除Category5的选项，必须要反着清除
                var oldCategory5OptionsLength = document.getElementById('category5').options.length;
                for(var i=oldCategory5OptionsLength-1; i>=0; i--) {
                    document.getElementById("category5").options.remove(i);
                }
            }
            
            if(countCategory == 2) {
                // 重新加载Category2的选项
                for(var i=1; i<=(50-countCategory1); i++) {
                    document.getElementById("category2").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                }
            }
            else if(countCategory == 3) {
                // 重新加载Category2的选项
                for(var i=1; i<=(50-countCategory1-countCategory3); i++) {
                    document.getElementById("category2").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                }
                // 重新加载Category3的选项
                for(var i=1; i<=(50-countCategory1-countCategory2); i++) {
                    document.getElementById("category3").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                }
            }
            else if(countCategory == 4) {
                // 重新加载Category2的选项
                for(var i=1; i<=(50-countCategory1-countCategory3-countCategory4); i++) {
                    document.getElementById("category2").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                }
                // 重新加载Category3的选项
                for(var i=1; i<=(50-countCategory1-countCategory2-countCategory4); i++) {
                    document.getElementById("category3").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                }
                // 重新加载Category4的选项
                for(var i=1; i<=(50-countCategory1-countCategory2-countCategory3); i++) {
                    document.getElementById("category4").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                }
            }
            else if(countCategory == 5) {
                // 重新加载Category2的选项
                for(var i=1; i<=(50-countCategory1-countCategory3-countCategory4-countCategory5); i++) {
                    document.getElementById("category2").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                }
                // 重新加载Category3的选项
                for(var i=1; i<=(50-countCategory1-countCategory2-countCategory4-countCategory5); i++) {
                    document.getElementById("category3").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                }
                // 重新加载Category4的选项
                for(var i=1; i<=(50-countCategory1-countCategory2-countCategory3-countCategory5); i++) {
                    document.getElementById("category4").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                }
                // 重新加载Category5的选项
                for(var i=1; i<=(50-countCategory1-countCategory2-countCategory3-countCategory4); i++) {
                    document.getElementById("category5").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                }
            }
            
            if(countCategory >= 2) {
                // 保持选中
                document.getElementById('category2').options[countCategory2-1].selected = true;
                
                $('#sheetOtherInformationFieldset2').html("");
                $('#sheetOtherInformationFieldset2').append("<legend>Spread Sheet Other Information Category 2</legend>");
                $('#sheetOtherInformationFieldset2').append("<label class='label'>Category Name:</label>");
                $('#sheetOtherInformationFieldset2').append("<input type='text' class='CategoryName' name='Category2Name' autocomplete='off' placeholder='Category Name' /><br>");
                
                for(var i=countCategory1+1; i<=countCategory1+countCategory2; i++) {
                    generateOtherInfoCategoryItems("#sheetOtherInformationFieldset2", i);
                }
                
                // 恢复之前的记录
                document.getElementsByName("Category2Name")[0].value = oldCategory2Name;
                for(var i=countCategory1; i<countCategory1+countCategory2; i++) {
                    if(i < countCategory1+oldCountCategory2) {
                        if(Category2OtherInformationTypeArray[i-countCategory1] == "Text") {
                            changeToTextOther(i);
                            $(".sheetOtherInfoText").eq(i).children("input").eq(1).val(Category2OtherInformationNameArray[i-countCategory1]);
                        }
                        else if(Category2OtherInformationTypeArray[i-countCategory1] == "DorpdownList") {
                            changeToDorpdownListOther(i);
                            $(".sheetOtherInfoDorpdownList").eq(i).children("input").eq(1).val(Category2OtherInformationNameArray[i-countCategory1]);
                            if(Category2OtherInformationContentArray[i-countCategory1].length > 3) {
                                for(var j=0; j<(Category2OtherInformationContentArray[i-countCategory1].length-3); j++) {
                                    var content = document.getElementsByClassName("sheetOtherInfoDorpdownListContent")[i].innerHTML;
                                    var newContent = "<input type='text' name='OtherInformation"+(i+1)+"DorpdownListItem[]' autocomplete='off' placeholder='Item (Dorpdown List)' />"
                                    document.getElementsByClassName("sheetOtherInfoDorpdownListContent")[i].innerHTML = content + newContent;
                                }
                            }
                            for(var k=0; k<Category2OtherInformationContentArray[i-countCategory1].length; k++) {
                                document.getElementsByName("OtherInformation"+(i+1)+"DorpdownListItem[]")[k].value = Category2OtherInformationContentArray[i-countCategory1][k];
                            }
                        }
                        else if(Category2OtherInformationTypeArray[i-countCategory1] == "CheckBox") {
                            changeToCheckBoxOther(i);
                            $(".sheetOtherInfoCheckBox").eq(i).children("input").eq(1).val(Category2OtherInformationNameArray[i-countCategory1]);
                            if(Category2OtherInformationContentArray[i-countCategory1].length > 3) {
                                for(var j=0; j<(Category2OtherInformationContentArray[i-countCategory1].length-3); j++) {
                                    var content = document.getElementsByClassName("sheetOtherInfoCheckBoxContent")[i].innerHTML;
                                    var newContent = "<input type='text' name='OtherInformation"+(i+1)+"CheckBoxItem[]' autocomplete='off' placeholder='Item (CheckBox)' />"
                                    document.getElementsByClassName("sheetOtherInfoCheckBoxContent")[i].innerHTML = content + newContent;
                                }
                            }
                            for(var k=0; k<Category2OtherInformationContentArray[i-countCategory1].length; k++) {
                                document.getElementsByName("OtherInformation"+(i+1)+"CheckBoxItem[]")[k].value = Category2OtherInformationContentArray[i-countCategory1][k];
                            }
                        }
                        else if(Category2OtherInformationTypeArray[i-countCategory1] == "Radio") {
                            changeToRadioOther(i);
                            $(".sheetOtherInfoRadio").eq(i).children("input").eq(1).val(Category2OtherInformationNameArray[i-countCategory1]);
                            if(Category2OtherInformationContentArray[i-countCategory1].length > 3) {
                                for(var j=0; j<(Category2OtherInformationContentArray[i-countCategory1].length-3); j++) {
                                    var content = document.getElementsByClassName("sheetOtherInfoRadioContent")[i].innerHTML;
                                    var newContent = "<input type='text' name='OtherInformation"+(i+1)+"RadioItem[]' autocomplete='off' placeholder='Item (Radio)' />"
                                    document.getElementsByClassName("sheetOtherInfoRadioContent")[i].innerHTML = content + newContent;
                                }
                            }
                            for(var k=0; k<Category2OtherInformationContentArray[i-countCategory1].length; k++) {
                                document.getElementsByName("OtherInformation"+(i+1)+"RadioItem[]")[k].value = Category2OtherInformationContentArray[i-countCategory1][k];
                            }
                        }
                    }
                }
                
                oldCountCategory2 = countCategory2;
            }
            if(countCategory >= 3) {
                // 保持选中
                document.getElementById('category3').options[countCategory3-1].selected = true;
                
                $('#sheetOtherInformationFieldset3').html("");
                $('#sheetOtherInformationFieldset3').append("<legend>Spread Sheet Other Information Category 3</legend>");
                $('#sheetOtherInformationFieldset3').append("<label class='label'>Category Name:</label>");
                $('#sheetOtherInformationFieldset3').append("<input type='text' class='CategoryName' name='Category3Name' autocomplete='off' placeholder='Category Name' /><br>");

                for(var i=countCategory1+countCategory2+1; i<=countCategory1+countCategory2+countCategory3; i++) {
                    generateOtherInfoCategoryItems("#sheetOtherInformationFieldset3", i);
                }
                
                // 恢复之前的记录
                document.getElementsByName("Category3Name")[0].value = oldCategory3Name;
                for(var i=countCategory1+countCategory2; i<countCategory1+countCategory2+countCategory3; i++) {
                    if(i < countCategory1+countCategory2+oldCountCategory3) {
                        if(Category3OtherInformationTypeArray[i-countCategory1-countCategory2] == "Text") {
                            changeToTextOther(i);
                            $(".sheetOtherInfoText").eq(i).children("input").eq(1).val(Category3OtherInformationNameArray[i-countCategory1-countCategory2]);
                        }
                        else if(Category3OtherInformationTypeArray[i-countCategory1-countCategory2] == "DorpdownList") {
                            changeToDorpdownListOther(i);
                            $(".sheetOtherInfoDorpdownList").eq(i).children("input").eq(1).val(Category3OtherInformationNameArray[i-countCategory1-countCategory2]);
                            if(Category3OtherInformationContentArray[i-countCategory1-countCategory2].length > 3) {
                                for(var j=0; j<(Category3OtherInformationContentArray[i-countCategory1-countCategory2].length-3); j++) {
                                    var content = document.getElementsByClassName("sheetOtherInfoDorpdownListContent")[i].innerHTML;
                                    var newContent = "<input type='text' name='OtherInformation"+(i+1)+"DorpdownListItem[]' autocomplete='off' placeholder='Item (Dorpdown List)' />"
                                    document.getElementsByClassName("sheetOtherInfoDorpdownListContent")[i].innerHTML = content + newContent;
                                }
                            }
                            for(var k=0; k<Category3OtherInformationContentArray[i-countCategory1-countCategory2].length; k++) {
                                document.getElementsByName("OtherInformation"+(i+1)+"DorpdownListItem[]")[k].value = Category3OtherInformationContentArray[i-countCategory1-countCategory2][k];
                            }
                        }
                        else if(Category3OtherInformationTypeArray[i-countCategory1-countCategory2] == "CheckBox") {
                            changeToCheckBoxOther(i);
                            $(".sheetOtherInfoCheckBox").eq(i).children("input").eq(1).val(Category3OtherInformationNameArray[i-countCategory1-countCategory2]);
                            if(Category3OtherInformationContentArray[i-countCategory1-countCategory2].length > 3) {
                                for(var j=0; j<(Category3OtherInformationContentArray[i-countCategory1-countCategory2].length-3); j++) {
                                    var content = document.getElementsByClassName("sheetOtherInfoCheckBoxContent")[i].innerHTML;
                                    var newContent = "<input type='text' name='OtherInformation"+(i+1)+"CheckBoxItem[]' autocomplete='off' placeholder='Item (CheckBox)' />"
                                    document.getElementsByClassName("sheetOtherInfoCheckBoxContent")[i].innerHTML = content + newContent;
                                }
                            }
                            for(var k=0; k<Category3OtherInformationContentArray[i-countCategory1-countCategory2].length; k++) {
                                document.getElementsByName("OtherInformation"+(i+1)+"CheckBoxItem[]")[k].value = Category3OtherInformationContentArray[i-countCategory1-countCategory2][k];
                            }
                        }
                        else if(Category3OtherInformationTypeArray[i-countCategory1-countCategory2] == "Radio") {
                            changeToRadioOther(i);
                            $(".sheetOtherInfoRadio").eq(i).children("input").eq(1).val(Category3OtherInformationNameArray[i-countCategory1-countCategory2]);
                            if(Category3OtherInformationContentArray[i-countCategory1-countCategory2].length > 3) {
                                for(var j=0; j<(Category3OtherInformationContentArray[i-countCategory1-countCategory2].length-3); j++) {
                                    var content = document.getElementsByClassName("sheetOtherInfoRadioContent")[i].innerHTML;
                                    var newContent = "<input type='text' name='OtherInformation"+(i+1)+"RadioItem[]' autocomplete='off' placeholder='Item (Radio)' />"
                                    document.getElementsByClassName("sheetOtherInfoRadioContent")[i].innerHTML = content + newContent;
                                }
                            }
                            for(var k=0; k<Category3OtherInformationContentArray[i-countCategory1-countCategory2].length; k++) {
                                document.getElementsByName("OtherInformation"+(i+1)+"RadioItem[]")[k].value = Category3OtherInformationContentArray[i-countCategory1-countCategory2][k];
                            }
                        }
                    }
                }
                
                oldCountCategory3 = countCategory3;
            }
            if(countCategory >= 4) {
                // 保持选中
                document.getElementById('category4').options[countCategory4-1].selected = true;
                
                $('#sheetOtherInformationFieldset4').html("");
                $('#sheetOtherInformationFieldset4').append("<legend>Spread Sheet Other Information Category 4</legend>");
                $('#sheetOtherInformationFieldset4').append("<label class='label'>Category Name:</label>");
                $('#sheetOtherInformationFieldset4').append("<input type='text' class='CategoryName' name='Category4Name' autocomplete='off' placeholder='Category Name' /><br>");

                for(var i=countCategory1+countCategory2+countCategory3+1; i<=countCategory1+countCategory2+countCategory3+countCategory4; i++) {
                    generateOtherInfoCategoryItems("#sheetOtherInformationFieldset4", i);
                }
                
                // 恢复之前的记录
                document.getElementsByName("Category4Name")[0].value = oldCategory4Name;

                for(var i=countCategory1+countCategory2+countCategory3; i<countCategory1+countCategory2+countCategory3+countCategory4; i++) {
                    if(i < countCategory1+countCategory2+countCategory3+oldCountCategory4) {
                        if(Category4OtherInformationTypeArray[i-countCategory1-countCategory2-countCategory3] == "Text") {
                            changeToTextOther(i);
                            $(".sheetOtherInfoText").eq(i).children("input").eq(1).val(Category4OtherInformationNameArray[i-countCategory1-countCategory2-countCategory3]);
                        }
                        else if(Category4OtherInformationTypeArray[i-countCategory1-countCategory2-countCategory3] == "DorpdownList") {
                            changeToDorpdownListOther(i);
                            $(".sheetOtherInfoDorpdownList").eq(i).children("input").eq(1).val(Category4OtherInformationNameArray[i-countCategory1-countCategory2-countCategory3]);
                            if(Category4OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3].length > 3) {
                                for(var j=0; j<(Category4OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3].length-3); j++) {
                                    var content = document.getElementsByClassName("sheetOtherInfoDorpdownListContent")[i].innerHTML;
                                    var newContent = "<input type='text' name='OtherInformation"+(i+1)+"DorpdownListItem[]' autocomplete='off' placeholder='Item (Dorpdown List)' />"
                                    document.getElementsByClassName("sheetOtherInfoDorpdownListContent")[i].innerHTML = content + newContent;
                                }
                            }
                            for(var k=0; k<Category4OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3].length; k++) {
                                document.getElementsByName("OtherInformation"+(i+1)+"DorpdownListItem[]")[k].value = Category4OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3][k];
                            }
                        }
                        else if(Category4OtherInformationTypeArray[i-countCategory1-countCategory2-countCategory3] == "CheckBox") {
                            changeToCheckBoxOther(i);
                            $(".sheetOtherInfoCheckBox").eq(i).children("input").eq(1).val(Category4OtherInformationNameArray[i-countCategory1-countCategory2-countCategory3]);
                            if(Category4OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3].length > 3) {
                                for(var j=0; j<(Category4OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3].length-3); j++) {
                                    var content = document.getElementsByClassName("sheetOtherInfoCheckBoxContent")[i].innerHTML;
                                    var newContent = "<input type='text' name='OtherInformation"+(i+1)+"CheckBoxItem[]' autocomplete='off' placeholder='Item (CheckBox)' />"
                                    document.getElementsByClassName("sheetOtherInfoCheckBoxContent")[i].innerHTML = content + newContent;
                                }
                            }
                            for(var k=0; k<Category4OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3].length; k++) {
                                document.getElementsByName("OtherInformation"+(i+1)+"CheckBoxItem[]")[k].value = Category4OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3][k];
                            }
                        }
                        else if(Category4OtherInformationTypeArray[i-countCategory1-countCategory2-countCategory3] == "Radio") {
                            changeToRadioOther(i);
                            $(".sheetOtherInfoRadio").eq(i).children("input").eq(1).val(Category4OtherInformationNameArray[i-countCategory1-countCategory2-countCategory3]);
                            if(Category4OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3].length > 3) {
                                for(var j=0; j<(Category4OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3].length-3); j++) {
                                    var content = document.getElementsByClassName("sheetOtherInfoRadioContent")[i].innerHTML;
                                    var newContent = "<input type='text' name='OtherInformation"+(i+1)+"RadioItem[]' autocomplete='off' placeholder='Item (Radio)' />"
                                    document.getElementsByClassName("sheetOtherInfoRadioContent")[i].innerHTML = content + newContent;
                                }
                            }
                            for(var k=0; k<Category4OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3].length; k++) {
                                document.getElementsByName("OtherInformation"+(i+1)+"RadioItem[]")[k].value = Category4OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3][k];
                            }
                        }
                    }
                }
                
                oldCountCategory4 = countCategory4;
            }
            if(countCategory >= 5) {   
                // 保持选中
                document.getElementById('category5').options[countCategory5-1].selected = true;
                
                $('#sheetOtherInformationFieldset5').html("");
                $('#sheetOtherInformationFieldset5').append("<legend>Spread Sheet Other Information Category 5</legend>");
                $('#sheetOtherInformationFieldset5').append("<label class='label'>Category Name:</label>");
                $('#sheetOtherInformationFieldset5').append("<input type='text' class='CategoryName' name='Category5Name' autocomplete='off' placeholder='Category Name' /><br>");
                
                for(var i=countCategory1+countCategory2+countCategory3+countCategory4+1; i<=countCategory1+countCategory2+countCategory3+countCategory4+countCategory5; i++) {
                    generateOtherInfoCategoryItems("#sheetOtherInformationFieldset5", i);
                }
                
                // 恢复之前的记录
                document.getElementsByName("Category5Name")[0].value = oldCategory5Name;
                for(var i=countCategory1+countCategory2+countCategory3+countCategory4; i<countCategory1+countCategory2+countCategory3+countCategory4+countCategory5; i++) {
                    if(i < countCategory1+countCategory2+countCategory3+countCategory4+oldCountCategory5) {
                        if(Category5OtherInformationTypeArray[i-countCategory1-countCategory2-countCategory3-countCategory4] == "Text") {
                            changeToTextOther(i);
                            $(".sheetOtherInfoText").eq(i).children("input").eq(1).val(Category5OtherInformationNameArray[i-countCategory1-countCategory2-countCategory3-countCategory4]);
                        }
                        else if(Category5OtherInformationTypeArray[i-countCategory1-countCategory2-countCategory3-countCategory4] == "DorpdownList") {
                            changeToDorpdownListOther(i);
                            $(".sheetOtherInfoDorpdownList").eq(i).children("input").eq(1).val(Category5OtherInformationNameArray[i-countCategory1-countCategory2-countCategory3-countCategory4]);
                            if(Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4].length > 3) {
                                for(var j=0; j<(Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4].length-3); j++) {
                                    var content = document.getElementsByClassName("sheetOtherInfoDorpdownListContent")[i].innerHTML;
                                    var newContent = "<input type='text' name='OtherInformation"+(i+1)+"DorpdownListItem[]' autocomplete='off' placeholder='Item (Dorpdown List)' />"
                                    document.getElementsByClassName("sheetOtherInfoDorpdownListContent")[i].innerHTML = content + newContent;
                                }
                            }
                            for(var k=0; k<Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4].length; k++) {
                                document.getElementsByName("OtherInformation"+(i+1)+"DorpdownListItem[]")[k].value = Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4][k];
                            }
                        }
                        else if(Category5OtherInformationTypeArray[i-countCategory1-countCategory2-countCategory3-countCategory4] == "CheckBox") {
                            changeToCheckBoxOther(i);
                            $(".sheetOtherInfoCheckBox").eq(i).children("input").eq(1).val(Category5OtherInformationNameArray[i-countCategory1-countCategory2-countCategory3-countCategory4]);
                            if(Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4].length > 3) {
                                for(var j=0; j<(Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4].length-3); j++) {
                                    var content = document.getElementsByClassName("sheetOtherInfoCheckBoxContent")[i].innerHTML;
                                    var newContent = "<input type='text' name='OtherInformation"+(i+1)+"CheckBoxItem[]' autocomplete='off' placeholder='Item (CheckBox)' />"
                                    document.getElementsByClassName("sheetOtherInfoCheckBoxContent")[i].innerHTML = content + newContent;
                                }
                            }
                            for(var k=0; k<Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4].length; k++) {
                                document.getElementsByName("OtherInformation"+(i+1)+"CheckBoxItem[]")[k].value = Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4][k];
                            }
                        }
                        else if(Category5OtherInformationTypeArray[i-countCategory1-countCategory2-countCategory3-countCategory4] == "Radio") {
                            changeToRadioOther(i);
                            $(".sheetOtherInfoRadio").eq(i).children("input").eq(1).val(Category5OtherInformationNameArray[i-countCategory1-countCategory2-countCategory3-countCategory4]);
                            if(Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4].length > 3) {
                                for(var j=0; j<(Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4].length-3); j++) {
                                    var content = document.getElementsByClassName("sheetOtherInfoRadioContent")[i].innerHTML;
                                    var newContent = "<input type='text' name='OtherInformation"+(i+1)+"RadioItem[]' autocomplete='off' placeholder='Item (Radio)' />"
                                    document.getElementsByClassName("sheetOtherInfoRadioContent")[i].innerHTML = content + newContent;
                                }
                            }
                            for(var k=0; k<Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4].length; k++) {
                                document.getElementsByName("OtherInformation"+(i+1)+"RadioItem[]")[k].value = Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4][k];
                            }
                        }
                    }
                }
                
                oldCountCategory5 = countCategory5;
            }
            
            // 如果超过50就不可以再加新的Category
            if(countCategory == 1){
                if(countCategory1 == 47) {
                    // 清除Category的选项，必须要反着清除
                    var oldCategoryOptionsLength = document.getElementById('otherInformationCategory').options.length;
                    for(var i=oldCategoryOptionsLength-1; i>=0; i--) {
                        document.getElementById("otherInformationCategory").options.remove(i);
                    }
                    // 重新加载Category的选项
                    for(var i=1; i<=4; i++) {
                        document.getElementById("otherInformationCategory").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    }
                    // 保持选中
                    document.getElementById('otherInformationCategory').options[countCategory-1].selected = true;
                }
                else if(countCategory1 == 48) {
                    // 清除Category的选项，必须要反着清除
                    var oldCategoryOptionsLength = document.getElementById('otherInformationCategory').options.length;
                    for(var i=oldCategoryOptionsLength-1; i>=0; i--) {
                        document.getElementById("otherInformationCategory").options.remove(i);
                    }
                    // 重新加载Category的选项
                    for(var i=1; i<=3; i++) {
                        document.getElementById("otherInformationCategory").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    }
                    // 保持选中
                    document.getElementById('otherInformationCategory').options[countCategory-1].selected = true;
                }
                else if(countCategory1 == 49) {
                    // 清除Category的选项，必须要反着清除
                    var oldCategoryOptionsLength = document.getElementById('otherInformationCategory').options.length;
                    for(var i=oldCategoryOptionsLength-1; i>=0; i--) {
                        document.getElementById("otherInformationCategory").options.remove(i);
                    }
                    // 重新加载Category的选项
                    for(var i=1; i<=2; i++) {
                        document.getElementById("otherInformationCategory").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    }
                    // 保持选中
                    document.getElementById('otherInformationCategory').options[countCategory-1].selected = true;
                }
                else if(countCategory1 == 50) {
                    // 清除Category的选项，必须要反着清除
                    var oldCategoryOptionsLength = document.getElementById('otherInformationCategory').options.length;
                    for(var i=oldCategoryOptionsLength-1; i>=0; i--) {
                        document.getElementById("otherInformationCategory").options.remove(i);
                    }
                    
                    // 重新加载Category的选项
                    document.getElementById("otherInformationCategory").options.add(new Option("\u00A0\u00A0\u00A0" + 1,1));
                    // 保持选中
                    document.getElementById('otherInformationCategory').options[countCategory-1].selected = true;
                }
                else {
                    // 清除Category的选项，必须要反着清除
                    var oldCategoryOptionsLength = document.getElementById('otherInformationCategory').options.length;
                    for(var i=oldCategoryOptionsLength-1; i>=0; i--) {
                        document.getElementById("otherInformationCategory").options.remove(i);
                    }
                    // 重新加载Category的选项
                    for(var i=1; i<=5; i++) {
                        document.getElementById("otherInformationCategory").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    }
                    // 保持选中
                    document.getElementById('otherInformationCategory').options[countCategory-1].selected = true;
                }
            }
            else if(countCategory == 2){
                if(countCategory1+countCategory2 == 48) {
                    // 清除Category的选项，必须要反着清除
                    var oldCategoryOptionsLength = document.getElementById('otherInformationCategory').options.length;
                    for(var i=oldCategoryOptionsLength-1; i>=0; i--) {
                        document.getElementById("otherInformationCategory").options.remove(i);
                    }
                    // 重新加载Category的选项
                    for(var i=1; i<=4; i++) {
                        document.getElementById("otherInformationCategory").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    }
                    // 保持选中
                    document.getElementById('otherInformationCategory').options[countCategory-1].selected = true;
                }
                else if(countCategory1+countCategory2 == 49) {
                    // 清除Category的选项，必须要反着清除
                    var oldCategoryOptionsLength = document.getElementById('otherInformationCategory').options.length;
                    for(var i=oldCategoryOptionsLength-1; i>=0; i--) {
                        document.getElementById("otherInformationCategory").options.remove(i);
                    }
                    // 重新加载Category的选项
                    for(var i=1; i<=3; i++) {
                        document.getElementById("otherInformationCategory").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    }
                    // 保持选中
                    document.getElementById('otherInformationCategory').options[countCategory-1].selected = true;
                }
                else if(countCategory1+countCategory2 == 50) {
                    // 清除Category的选项，必须要反着清除
                    var oldCategoryOptionsLength = document.getElementById('otherInformationCategory').options.length;
                    for(var i=oldCategoryOptionsLength-1; i>=0; i--) {
                        document.getElementById("otherInformationCategory").options.remove(i);
                    }
                    // 重新加载Category的选项
                    for(var i=1; i<=2; i++) {
                        document.getElementById("otherInformationCategory").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    }
                    // 保持选中
                    document.getElementById('otherInformationCategory').options[countCategory-1].selected = true;
                }
                else {
                    // 清除Category的选项，必须要反着清除
                    var oldCategoryOptionsLength = document.getElementById('otherInformationCategory').options.length;
                    for(var i=oldCategoryOptionsLength-1; i>=0; i--) {
                        document.getElementById("otherInformationCategory").options.remove(i);
                    }
                    // 重新加载Category的选项
                    for(var i=1; i<=5; i++) {
                        document.getElementById("otherInformationCategory").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    }
                    // 保持选中
                    document.getElementById('otherInformationCategory').options[countCategory-1].selected = true;
                }
            }
            else if(countCategory == 3){
                if(countCategory1+countCategory2+countCategory3 == 49) {
                    // 清除Category的选项，必须要反着清除
                    var oldCategoryOptionsLength = document.getElementById('otherInformationCategory').options.length;
                    for(var i=oldCategoryOptionsLength-1; i>=0; i--) {
                        document.getElementById("otherInformationCategory").options.remove(i);
                    }
                    // 重新加载Category的选项
                    for(var i=1; i<=4; i++) {
                        document.getElementById("otherInformationCategory").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    }
                    // 保持选中
                    document.getElementById('otherInformationCategory').options[countCategory-1].selected = true;
                }
                else if(countCategory1+countCategory2+countCategory3 == 50) {
                    // 清除Category的选项，必须要反着清除
                    var oldCategoryOptionsLength = document.getElementById('otherInformationCategory').options.length;
                    for(var i=oldCategoryOptionsLength-1; i>=0; i--) {
                        document.getElementById("otherInformationCategory").options.remove(i);
                    }
                    // 重新加载Category的选项
                    for(var i=1; i<=3; i++) {
                        document.getElementById("otherInformationCategory").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    }
                    // 保持选中
                    document.getElementById('otherInformationCategory').options[countCategory-1].selected = true;
                }
                else {
                    // 清除Category的选项，必须要反着清除
                    var oldCategoryOptionsLength = document.getElementById('otherInformationCategory').options.length;
                    for(var i=oldCategoryOptionsLength-1; i>=0; i--) {
                        document.getElementById("otherInformationCategory").options.remove(i);
                    }
                    // 重新加载Category的选项
                    for(var i=1; i<=5; i++) {
                        document.getElementById("otherInformationCategory").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    }
                    // 保持选中
                    document.getElementById('otherInformationCategory').options[countCategory-1].selected = true;
                }
            }
            else if(countCategory == 4){
                if(countCategory1+countCategory2+countCategory3+countCategory4 == 50) {
                    // 清除Category的选项，必须要反着清除
                    var oldCategoryOptionsLength = document.getElementById('otherInformationCategory').options.length;
                    for(var i=oldCategoryOptionsLength-1; i>=0; i--) {
                        document.getElementById("otherInformationCategory").options.remove(i);
                    }
                    // 重新加载Category的选项
                    for(var i=1; i<=4; i++) {
                        document.getElementById("otherInformationCategory").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    }
                    // 保持选中
                    document.getElementById('otherInformationCategory').options[countCategory-1].selected = true;
                }
                else {
                    // 清除Category的选项，必须要反着清除
                    var oldCategoryOptionsLength = document.getElementById('otherInformationCategory').options.length;
                    for(var i=oldCategoryOptionsLength-1; i>=0; i--) {
                        document.getElementById("otherInformationCategory").options.remove(i);
                    }
                    // 重新加载Category的选项
                    for(var i=1; i<=5; i++) {
                        document.getElementById("otherInformationCategory").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    }
                    // 保持选中
                    document.getElementById('otherInformationCategory').options[countCategory-1].selected = true;
                }
            }
            
            // 记住新的CountCategory1作为下次使用
            oldCountCategory1 = countCategory1;
        });
        
        // 如果Category2有变化 
        $(document).delegate("#category2", "change", function () {
            // 记住oldCategory2Name
            var oldCategory2Name = document.getElementsByName("Category2Name")[0].value;
            
            // 记住oldCategory2所有的Item
            var Category2OtherInformationNameArray = new Array();
            var Category2OtherInformationTypeArray = new Array();
            var Category2OtherInformationContentArray = new Array();
            
            for(var i=oldCountCategory1; i<oldCountCategory1+oldCountCategory2; i++) {
                if(!$(".sheetOtherInfoText").eq(i).children("input").prop('disabled')) {
                    Category2OtherInformationTypeArray.push($(".sheetOtherInfoText").eq(i).children("input").eq(0).val());
                }
                else if(!$(".sheetOtherInfoDorpdownList").eq(i).children("input").prop('disabled')) {
                    Category2OtherInformationTypeArray.push($(".sheetOtherInfoDorpdownList").eq(i).children("input").eq(0).val());
                    var DorpdownListContentLength = document.getElementsByName("OtherInformation"+(i+1)+"DorpdownListItem[]").length;
                    if(DorpdownListContentLength > 0) {
                        Category2OtherInformationContentArray[i-oldCountCategory1] = new Array();
                        for(var j=0; j<DorpdownListContentLength; j++) {
                            if($(".sheetOtherInfoDorpdownListContent").eq(i).children("input").eq(j).val() != "" && $(".sheetOtherInfoDorpdownListContent").eq(i).children("input").eq(j).val() != undefined) {
                                var content = $(".sheetOtherInfoDorpdownListContent").eq(i).children("input").eq(j).val();
                                Category2OtherInformationContentArray[i-oldCountCategory1].push(content); 
                            }
                        }
                    }
                }
                else if(!$(".sheetOtherInfoCheckBox").eq(i).children("input").prop('disabled')) {
                    Category2OtherInformationTypeArray.push($(".sheetOtherInfoCheckBox").eq(i).children("input").eq(0).val());
                    var CheckBoxContentLength = document.getElementsByName("OtherInformation"+(i+1)+"CheckBoxItem[]").length;
                    if(CheckBoxContentLength > 0) {
                        Category2OtherInformationContentArray[i-oldCountCategory1] = new Array();
                        for(var j=0; j<CheckBoxContentLength; j++) {
                            if($(".sheetOtherInfoCheckBoxContent").eq(i).children("input").eq(j).val() != "" && $(".sheetOtherInfoCheckBoxContent").eq(i).children("input").eq(j).val() != undefined) {
                                var content = $(".sheetOtherInfoCheckBoxContent").eq(i).children("input").eq(j).val();
                                Category2OtherInformationContentArray[i-oldCountCategory1].push(content);
                            }
                        }
                    }
                }
                else{
                    Category2OtherInformationTypeArray.push($(".sheetOtherInfoRadio").eq(i).children("input").eq(0).val());
                    var RadioContentLength = document.getElementsByName("OtherInformation"+(i+1)+"RadioItem[]").length;
                    if(RadioContentLength > 0) {
                        Category2OtherInformationContentArray[i-oldCountCategory1] = new Array();
                        for(var j=0; j<RadioContentLength; j++) {
                            if($(".sheetOtherInfoRadioContent").eq(i).children("input").eq(j).val() != "" && $(".sheetOtherInfoRadioContent").eq(i).children("input").eq(j).val() != undefined) {
                                var content = $(".sheetOtherInfoRadioContent").eq(i).children("input").eq(j).val();
                                Category2OtherInformationContentArray[i-oldCountCategory1].push(content);
                            }
                        }
                    }
                }
            }
            
            for(var i=oldCountCategory1; i<oldCountCategory1+oldCountCategory2; i++) {
                if(!$(".sheetOtherInfoText").eq(i).children("input").prop('disabled')) {
                    Category2OtherInformationNameArray.push($(".sheetOtherInfoText").eq(i).children("input").eq(1).val());
                }
                else if(!$(".sheetOtherInfoDorpdownList").eq(i).children("input").prop('disabled')) {
                    Category2OtherInformationNameArray.push($(".sheetOtherInfoDorpdownList").eq(i).children("input").eq(1).val());
                }
                else if(!$(".sheetOtherInfoCheckBox").eq(i).children("input").prop('disabled')) {
                    Category2OtherInformationNameArray.push($(".sheetOtherInfoCheckBox").eq(i).children("input").eq(1).val());
                }
                else{
                    Category2OtherInformationNameArray.push($(".sheetOtherInfoRadio").eq(i).children("input").eq(1).val());
                }
            }

            // 获取当前Category1和Category2的option的数量
            var countCategory1 = parseInt(document.getElementById("category1").value);
            var countCategory2 = parseInt(document.getElementById("category2").value);
            
            // 获取当前一共有多少个Category
            var countCategory = document.getElementById("otherInformationCategory").value;
            
            // 计算得到Category345的option的数量
            var countCategory345 = 50 - countCategory1 - countCategory2;
            
            // 在category2更新之前记住oldCategory3所有的Item
            if(countCategory >= 3) {
                // 记住oldCategory3Name
                var oldCategory3Name = document.getElementsByName("Category3Name")[0].value;

                var Category3OtherInformationNameArray = new Array();
                var Category3OtherInformationTypeArray = new Array();
                var Category3OtherInformationContentArray = new Array();
                
                for(var i=oldCountCategory1+oldCountCategory2; i<oldCountCategory1+oldCountCategory2+oldCountCategory3; i++) {
                    if(!$(".sheetOtherInfoText").eq(i).children("input").prop('disabled')) {
                        Category3OtherInformationTypeArray.push($(".sheetOtherInfoText").eq(i).children("input").eq(0).val());
                    }
                    else if(!$(".sheetOtherInfoDorpdownList").eq(i).children("input").prop('disabled')) {
                        Category3OtherInformationTypeArray.push($(".sheetOtherInfoDorpdownList").eq(i).children("input").eq(0).val());
                        var DorpdownListContentLength = document.getElementsByName("OtherInformation"+(i+1)+"DorpdownListItem[]").length;
                        if(DorpdownListContentLength > 0) {
                            Category3OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2] = new Array();
                            for(var j=0; j<DorpdownListContentLength; j++) {
                                if($(".sheetOtherInfoDorpdownListContent").eq(i).children("input").eq(j).val() != "" && $(".sheetOtherInfoDorpdownListContent").eq(i).children("input").eq(j).val() != undefined) {
                                    var content = $(".sheetOtherInfoDorpdownListContent").eq(i).children("input").eq(j).val();
                                    Category3OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2].push(content); 
                                }
                            }
                        }
                    }
                    else if(!$(".sheetOtherInfoCheckBox").eq(i).children("input").prop('disabled')) {
                        Category3OtherInformationTypeArray.push($(".sheetOtherInfoCheckBox").eq(i).children("input").eq(0).val());
                        var CheckBoxContentLength = document.getElementsByName("OtherInformation"+(i+1)+"CheckBoxItem[]").length;
                        if(CheckBoxContentLength > 0) {
                            Category3OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2] = new Array();
                            for(var j=0; j<CheckBoxContentLength; j++) {
                                if($(".sheetOtherInfoCheckBoxContent").eq(i).children("input").eq(j).val() != "" && $(".sheetOtherInfoCheckBoxContent").eq(i).children("input").eq(j).val() != undefined) {
                                    var content = $(".sheetOtherInfoCheckBoxContent").eq(i).children("input").eq(j).val();
                                    Category3OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2].push(content);
                                }
                            }
                        }
                    }
                    else{
                        Category3OtherInformationTypeArray.push($(".sheetOtherInfoRadio").eq(i).children("input").eq(0).val());
                        var RadioContentLength = document.getElementsByName("OtherInformation"+(i+1)+"RadioItem[]").length;
                        if(RadioContentLength > 0) {
                            Category3OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2] = new Array();
                            for(var j=0; j<RadioContentLength; j++) {
                                if($(".sheetOtherInfoRadioContent").eq(i).children("input").eq(j).val() != "" && $(".sheetOtherInfoRadioContent").eq(i).children("input").eq(j).val() != undefined) {
                                    var content = $(".sheetOtherInfoRadioContent").eq(i).children("input").eq(j).val();
                                    Category3OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2].push(content);
                                }
                            }
                        }
                    }
                }

                for(var i=oldCountCategory1+oldCountCategory2; i<oldCountCategory1+oldCountCategory2+oldCountCategory3; i++) {
                    if(!$(".sheetOtherInfoText").eq(i).children("input").prop('disabled')) {
                        Category3OtherInformationNameArray.push($(".sheetOtherInfoText").eq(i).children("input").eq(1).val());
                    }
                    else if(!$(".sheetOtherInfoDorpdownList").eq(i).children("input").prop('disabled')) {
                        Category3OtherInformationNameArray.push($(".sheetOtherInfoDorpdownList").eq(i).children("input").eq(1).val());
                    }
                    else if(!$(".sheetOtherInfoCheckBox").eq(i).children("input").prop('disabled')) {
                        Category3OtherInformationNameArray.push($(".sheetOtherInfoCheckBox").eq(i).children("input").eq(1).val());
                    }
                    else{
                        Category3OtherInformationNameArray.push($(".sheetOtherInfoRadio").eq(i).children("input").eq(1).val());
                    }
                }
            }
            // 在category2更新之前记住oldCategory4所有的Item
            if(countCategory >= 4) {
                // 记住oldCategory4Name
                var oldCategory4Name = document.getElementsByName("Category4Name")[0].value;

                // 记住oldCategory4所有的Item
                var Category4OtherInformationNameArray = new Array();
                var Category4OtherInformationTypeArray = new Array();
                var Category4OtherInformationContentArray = new Array();

                for(var i=oldCountCategory1+oldCountCategory2+oldCountCategory3; i<oldCountCategory1+oldCountCategory2+oldCountCategory3+oldCountCategory4; i++) {
                    if(!$(".sheetOtherInfoText").eq(i).children("input").prop('disabled')) {
                        Category4OtherInformationTypeArray.push($(".sheetOtherInfoText").eq(i).children("input").eq(0).val());
                    }
                    else if(!$(".sheetOtherInfoDorpdownList").eq(i).children("input").prop('disabled')) {
                        Category4OtherInformationTypeArray.push($(".sheetOtherInfoDorpdownList").eq(i).children("input").eq(0).val());
                        var DorpdownListContentLength = document.getElementsByName("OtherInformation"+(i+1)+"DorpdownListItem[]").length;
                        if(DorpdownListContentLength > 0) {
                            Category4OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3] = new Array();
                            for(var j=0; j<DorpdownListContentLength; j++) {
                                if($(".sheetOtherInfoDorpdownListContent").eq(i).children("input").eq(j).val() != "" && $(".sheetOtherInfoDorpdownListContent").eq(i).children("input").eq(j).val() != undefined) {
                                    var content = $(".sheetOtherInfoDorpdownListContent").eq(i).children("input").eq(j).val();
                                    Category4OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3].push(content); 
                                }
                            }
                        }
                    }
                    else if(!$(".sheetOtherInfoCheckBox").eq(i).children("input").prop('disabled')) {
                        Category4OtherInformationTypeArray.push($(".sheetOtherInfoCheckBox").eq(i).children("input").eq(0).val());
                        var CheckBoxContentLength = document.getElementsByName("OtherInformation"+(i+1)+"CheckBoxItem[]").length;
                        if(CheckBoxContentLength > 0) {
                            Category4OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3] = new Array();
                            for(var j=0; j<CheckBoxContentLength; j++) {
                                if($(".sheetOtherInfoCheckBoxContent").eq(i).children("input").eq(j).val() != "" && $(".sheetOtherInfoCheckBoxContent").eq(i).children("input").eq(j).val() != undefined) {
                                    var content = $(".sheetOtherInfoCheckBoxContent").eq(i).children("input").eq(j).val();
                                    Category4OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3].push(content);
                                }
                            }
                        }
                    }
                    else{
                        Category4OtherInformationTypeArray.push($(".sheetOtherInfoRadio").eq(i).children("input").eq(0).val());
                        var RadioContentLength = document.getElementsByName("OtherInformation"+(i+1)+"RadioItem[]").length;
                        if(RadioContentLength > 0) {
                            Category4OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3] = new Array();
                            for(var j=0; j<RadioContentLength; j++) {
                                if($(".sheetOtherInfoRadioContent").eq(i).children("input").eq(j).val() != "" && $(".sheetOtherInfoRadioContent").eq(i).children("input").eq(j).val() != undefined) {
                                    var content = $(".sheetOtherInfoRadioContent").eq(i).children("input").eq(j).val();
                                    Category4OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3].push(content);
                                }
                            }
                        }
                    }
                }

                for(var i=oldCountCategory1+oldCountCategory2+oldCountCategory3; i<oldCountCategory1+oldCountCategory2+oldCountCategory3+oldCountCategory4; i++) {
                    if(!$(".sheetOtherInfoText").eq(i).children("input").prop('disabled')) {
                        Category4OtherInformationNameArray.push($(".sheetOtherInfoText").eq(i).children("input").eq(1).val());
                    }
                    else if(!$(".sheetOtherInfoDorpdownList").eq(i).children("input").prop('disabled')) {
                        Category4OtherInformationNameArray.push($(".sheetOtherInfoDorpdownList").eq(i).children("input").eq(1).val());
                    }
                    else if(!$(".sheetOtherInfoCheckBox").eq(i).children("input").prop('disabled')) {
                        Category4OtherInformationNameArray.push($(".sheetOtherInfoCheckBox").eq(i).children("input").eq(1).val());
                    }
                    else{
                        Category4OtherInformationNameArray.push($(".sheetOtherInfoRadio").eq(i).children("input").eq(1).val());
                    }
                }
            }
            // 在category1更新之前记住oldCategory5所有的Item
            if(countCategory >= 5) {
                // 记住oldCategory5Name
                var oldCategory5Name = document.getElementsByName("Category5Name")[0].value;

                // 记住oldCategory5所有的Item
                var Category5OtherInformationNameArray = new Array();
                var Category5OtherInformationTypeArray = new Array();
                var Category5OtherInformationContentArray = new Array();

                for(var i=oldCountCategory1+oldCountCategory2+oldCountCategory3+oldCountCategory4; i<oldCountCategory1+oldCountCategory2+oldCountCategory3+oldCountCategory4+oldCountCategory5; i++) {
                    if(!$(".sheetOtherInfoText").eq(i).children("input").prop('disabled')) {
                        Category5OtherInformationTypeArray.push($(".sheetOtherInfoText").eq(i).children("input").eq(0).val());
                    }
                    else if(!$(".sheetOtherInfoDorpdownList").eq(i).children("input").prop('disabled')) {
                        Category5OtherInformationTypeArray.push($(".sheetOtherInfoDorpdownList").eq(i).children("input").eq(0).val());
                        var DorpdownListContentLength = document.getElementsByName("OtherInformation"+(i+1)+"DorpdownListItem[]").length;
                        if(DorpdownListContentLength > 0) {
                            Category5OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3-oldCountCategory4] = new Array();
                            for(var j=0; j<DorpdownListContentLength; j++) {
                                if($(".sheetOtherInfoDorpdownListContent").eq(i).children("input").eq(j).val() != "" && $(".sheetOtherInfoDorpdownListContent").eq(i).children("input").eq(j).val() != undefined) {
                                    var content = $(".sheetOtherInfoDorpdownListContent").eq(i).children("input").eq(j).val();
                                    Category5OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3-oldCountCategory4].push(content); 
                                }
                            }
                        }
                    }
                    else if(!$(".sheetOtherInfoCheckBox").eq(i).children("input").prop('disabled')) {
                        Category5OtherInformationTypeArray.push($(".sheetOtherInfoCheckBox").eq(i).children("input").eq(0).val());
                        var CheckBoxContentLength = document.getElementsByName("OtherInformation"+(i+1)+"CheckBoxItem[]").length;
                        if(CheckBoxContentLength > 0) {
                            Category5OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3-oldCountCategory4] = new Array();
                            for(var j=0; j<CheckBoxContentLength; j++) {
                                if($(".sheetOtherInfoCheckBoxContent").eq(i).children("input").eq(j).val() != "" && $(".sheetOtherInfoCheckBoxContent").eq(i).children("input").eq(j).val() != undefined) {
                                    var content = $(".sheetOtherInfoCheckBoxContent").eq(i).children("input").eq(j).val();
                                    Category5OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3-oldCountCategory4].push(content);
                                }
                            }
                        }
                    }
                    else{
                        Category5OtherInformationTypeArray.push($(".sheetOtherInfoRadio").eq(i).children("input").eq(0).val());
                        var RadioContentLength = document.getElementsByName("OtherInformation"+(i+1)+"RadioItem[]").length;
                        if(RadioContentLength > 0) {
                            Category5OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3-oldCountCategory4] = new Array();
                            for(var j=0; j<RadioContentLength; j++) {
                                if($(".sheetOtherInfoRadioContent").eq(i).children("input").eq(j).val() != "" && $(".sheetOtherInfoRadioContent").eq(i).children("input").eq(j).val() != undefined) {
                                    var content = $(".sheetOtherInfoRadioContent").eq(i).children("input").eq(j).val();
                                    Category5OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3-oldCountCategory4].push(content);
                                }
                            }
                        }
                    }
                }

                for(var i=oldCountCategory1+oldCountCategory2+oldCountCategory3+oldCountCategory4; i<oldCountCategory1+oldCountCategory2+oldCountCategory3+oldCountCategory4+oldCountCategory5; i++) {
                    if(!$(".sheetOtherInfoText").eq(i).children("input").prop('disabled')) {
                        Category5OtherInformationNameArray.push($(".sheetOtherInfoText").eq(i).children("input").eq(1).val());
                    }
                    else if(!$(".sheetOtherInfoDorpdownList").eq(i).children("input").prop('disabled')) {
                        Category5OtherInformationNameArray.push($(".sheetOtherInfoDorpdownList").eq(i).children("input").eq(1).val());
                    }
                    else if(!$(".sheetOtherInfoCheckBox").eq(i).children("input").prop('disabled')) {
                        Category5OtherInformationNameArray.push($(".sheetOtherInfoCheckBox").eq(i).children("input").eq(1).val());
                    }
                    else{
                        Category5OtherInformationNameArray.push($(".sheetOtherInfoRadio").eq(i).children("input").eq(1).val());
                    }
                }
            }
            
            // For category2
            $('#sheetOtherInformationFieldset2').html("");
            $('#sheetOtherInformationFieldset2').append("<legend>Spread Sheet Other Information Category 2</legend>");
            $('#sheetOtherInformationFieldset2').append("<label class='label'>Category Name:</label>");
            $('#sheetOtherInformationFieldset2').append("<input type='text' class='CategoryName' name='Category2Name' autocomplete='off' placeholder='Category Name' /><br>");
            
            for(var i=countCategory1+1; i<=countCategory1+countCategory2; i++) {
                generateOtherInfoCategoryItems("#sheetOtherInformationFieldset2", i);
            }
            
            // 恢复之前的记录
            document.getElementsByName("Category2Name")[0].value = oldCategory2Name;
            
            for(var i=countCategory1; i<countCategory1+countCategory2; i++) {
                if(i < countCategory1+oldCountCategory2) {
                    if(Category2OtherInformationTypeArray[i-countCategory1] == "Text") {
                        changeToTextOther(i);
                        $(".sheetOtherInfoText").eq(i).children("input").eq(1).val(Category2OtherInformationNameArray[i-countCategory1]);
                    }
                    else if(Category2OtherInformationTypeArray[i-countCategory1] == "DorpdownList") {
                        changeToDorpdownListOther(i);
                        $(".sheetOtherInfoDorpdownList").eq(i).children("input").eq(1).val(Category2OtherInformationNameArray[i-countCategory1]);
                        if(Category2OtherInformationContentArray[i-countCategory1].length > 3) {
                            for(var j=0; j<(Category2OtherInformationContentArray[i-countCategory1].length-3); j++) {
                                var content = document.getElementsByClassName("sheetOtherInfoDorpdownListContent")[i].innerHTML;
                                var newContent = "<input type='text' name='OtherInformation"+(i+1)+"DorpdownListItem[]' autocomplete='off' placeholder='Item (Dorpdown List)' />"
                                document.getElementsByClassName("sheetOtherInfoDorpdownListContent")[i].innerHTML = content + newContent;
                            }
                        }
                        for(var k=0; k<Category2OtherInformationContentArray[i-countCategory1].length; k++) {
                            document.getElementsByName("OtherInformation"+(i+1)+"DorpdownListItem[]")[k].value = Category2OtherInformationContentArray[i-countCategory1][k];
                        }
                    }
                    else if(Category2OtherInformationTypeArray[i-countCategory1] == "CheckBox") {
                        changeToCheckBoxOther(i);
                        $(".sheetOtherInfoCheckBox").eq(i).children("input").eq(1).val(Category2OtherInformationNameArray[i-countCategory1]);
                        if(Category2OtherInformationContentArray[i-countCategory1].length > 3) {
                            for(var j=0; j<(Category2OtherInformationContentArray[i-countCategory1].length-3); j++) {
                                var content = document.getElementsByClassName("sheetOtherInfoCheckBoxContent")[i].innerHTML;
                                var newContent = "<input type='text' name='OtherInformation"+(i+1)+"CheckBoxItem[]' autocomplete='off' placeholder='Item (CheckBox)' />"
                                document.getElementsByClassName("sheetOtherInfoCheckBoxContent")[i].innerHTML = content + newContent;
                            }
                        }
                        for(var k=0; k<Category2OtherInformationContentArray[i-countCategory1].length; k++) {
                            document.getElementsByName("OtherInformation"+(i+1)+"CheckBoxItem[]")[k].value = Category2OtherInformationContentArray[i-countCategory1][k];
                        }
                    }
                    else if(Category2OtherInformationTypeArray[i-countCategory1] == "Radio") {
                        changeToRadioOther(i);
                        $(".sheetOtherInfoRadio").eq(i).children("input").eq(1).val(Category2OtherInformationNameArray[i-countCategory1]);
                        if(Category2OtherInformationContentArray[i-countCategory1].length > 3) {
                            for(var j=0; j<(Category2OtherInformationContentArray[i-countCategory1].length-3); j++) {
                                var content = document.getElementsByClassName("sheetOtherInfoRadioContent")[i].innerHTML;
                                var newContent = "<input type='text' name='OtherInformation"+(i+1)+"RadioItem[]' autocomplete='off' placeholder='Item (Radio)' />"
                                document.getElementsByClassName("sheetOtherInfoRadioContent")[i].innerHTML = content + newContent;
                            }
                        }
                        for(var k=0; k<Category2OtherInformationContentArray[i-countCategory1].length; k++) {
                            document.getElementsByName("OtherInformation"+(i+1)+"RadioItem[]")[k].value = Category2OtherInformationContentArray[i-countCategory1][k];
                        }
                    }
                }
            }
            
            // Category1无需讨论
            var countCategory3;
            var countCategory4;
            var countCategory5;
            
            if(countCategory >= 2) {
                // 清除Category1的选项，必须要反着清除
                var oldCategory1OptionsLength = document.getElementById('category1').options.length;
                for(var i=oldCategory1OptionsLength-1; i>=0; i--) {
                    document.getElementById("category1").options.remove(i);
                }
            }
            if(countCategory >= 3) {
                // 获取当前Category3的option的数量
                countCategory3 = parseInt(document.getElementById("category3").value);
                
                // 清除Category3的选项，必须要反着清除
                var oldCategory3OptionsLength = document.getElementById('category3').options.length;
                for(var i=oldCategory3OptionsLength-1; i>=0; i--) {
                    document.getElementById("category3").options.remove(i);
                }
            }
            if(countCategory >= 4) {
                // 获取当前Category4的option的数量
                countCategory4 = parseInt(document.getElementById("category4").value);
                
                // 清除Category4的选项，必须要反着清除
                var oldCategory4OptionsLength = document.getElementById('category4').options.length;
                for(var i=oldCategory4OptionsLength-1; i>=0; i--) {
                    document.getElementById("category4").options.remove(i);
                }
            }
            if(countCategory >= 5) {
                // 获取当前Category5的option的数量
                countCategory5 = parseInt(document.getElementById("category5").value);
                
                // 清除Category5的选项，必须要反着清除
                var oldCategory5OptionsLength = document.getElementById('category5').options.length;
                for(var i=oldCategory5OptionsLength-1; i>=0; i--) {
                    document.getElementById("category5").options.remove(i);
                }
            }
            
            if(countCategory == 2) {
                // 重新加载Category1的选项
                for(var i=1; i<=(50-countCategory2); i++) {
                    document.getElementById("category1").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                }
            }
            else if(countCategory == 3) {
                // 重新加载Category1的选项
                for(var i=1; i<=(50-countCategory2-countCategory3); i++) {
                    document.getElementById("category1").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                }
                // 重新加载Category3的选项
                for(var i=1; i<=(50-countCategory1-countCategory2); i++) {
                    document.getElementById("category3").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                }
            }
            else if(countCategory == 4) {
                // 重新加载Category1的选项
                for(var i=1; i<=(50-countCategory2-countCategory3-countCategory4); i++) {
                    document.getElementById("category1").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                }
                // 重新加载Category3的选项
                for(var i=1; i<=(50-countCategory1-countCategory2-countCategory4); i++) {
                    document.getElementById("category3").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                }
                // 重新加载Category4的选项
                for(var i=1; i<=(50-countCategory1-countCategory2-countCategory3); i++) {
                    document.getElementById("category4").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                }
            }
            else if(countCategory == 5) {
                // 重新加载Category1的选项
                for(var i=1; i<=(50-countCategory2-countCategory3-countCategory4-countCategory5); i++) {
                    document.getElementById("category1").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                }
                // 重新加载Category3的选项
                for(var i=1; i<=(50-countCategory1-countCategory2-countCategory4-countCategory5); i++) {
                    document.getElementById("category3").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                }
                // 重新加载Category4的选项
                for(var i=1; i<=(50-countCategory1-countCategory2-countCategory3-countCategory5); i++) {
                    document.getElementById("category4").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                }
                // 重新加载Category5的选项
                for(var i=1; i<=(50-countCategory1-countCategory2-countCategory3-countCategory4); i++) {
                    document.getElementById("category5").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                }
            }
            
            if(countCategory >= 2) {
                // 保持选中
                document.getElementById('category1').options[countCategory1-1].selected = true;
            }
            if(countCategory >= 3) {
                // 保持选中
                document.getElementById('category3').options[countCategory3-1].selected = true;
                
                $('#sheetOtherInformationFieldset3').html("");
                $('#sheetOtherInformationFieldset3').append("<legend>Spread Sheet Other Information Category 3</legend>");
                $('#sheetOtherInformationFieldset3').append("<label class='label'>Category Name:</label>");
                $('#sheetOtherInformationFieldset3').append("<input type='text' class='CategoryName' name='Category3Name' autocomplete='off' placeholder='Category Name' /><br>");

                for(var i=countCategory1+countCategory2+1; i<=countCategory1+countCategory2+countCategory3; i++) {
                    generateOtherInfoCategoryItems("#sheetOtherInformationFieldset3", i);
                }
                
                // 恢复之前的记录
                document.getElementsByName("Category3Name")[0].value = oldCategory3Name;
                for(var i=countCategory1+countCategory2; i<countCategory1+countCategory2+countCategory3; i++) {
                    if(i < countCategory1+countCategory2+oldCountCategory3) {
                        if(Category3OtherInformationTypeArray[i-countCategory1-countCategory2] == "Text") {
                            changeToTextOther(i);
                            $(".sheetOtherInfoText").eq(i).children("input").eq(1).val(Category3OtherInformationNameArray[i-countCategory1-countCategory2]);
                        }
                        else if(Category3OtherInformationTypeArray[i-countCategory1-countCategory2] == "DorpdownList") {
                            changeToDorpdownListOther(i);
                            $(".sheetOtherInfoDorpdownList").eq(i).children("input").eq(1).val(Category3OtherInformationNameArray[i-countCategory1-countCategory2]);
                            if(Category3OtherInformationContentArray[i-countCategory1-countCategory2].length > 3) {
                                for(var j=0; j<(Category3OtherInformationContentArray[i-countCategory1-countCategory2].length-3); j++) {
                                    var content = document.getElementsByClassName("sheetOtherInfoDorpdownListContent")[i].innerHTML;
                                    var newContent = "<input type='text' name='OtherInformation"+(i+1)+"DorpdownListItem[]' autocomplete='off' placeholder='Item (Dorpdown List)' />"
                                    document.getElementsByClassName("sheetOtherInfoDorpdownListContent")[i].innerHTML = content + newContent;
                                }
                            }
                            for(var k=0; k<Category3OtherInformationContentArray[i-countCategory1-countCategory2].length; k++) {
                                document.getElementsByName("OtherInformation"+(i+1)+"DorpdownListItem[]")[k].value = Category3OtherInformationContentArray[i-countCategory1-countCategory2][k];
                            }
                        }
                        else if(Category3OtherInformationTypeArray[i-countCategory1-countCategory2] == "CheckBox") {
                            changeToCheckBoxOther(i);
                            $(".sheetOtherInfoCheckBox").eq(i).children("input").eq(1).val(Category3OtherInformationNameArray[i-countCategory1-countCategory2]);
                            if(Category3OtherInformationContentArray[i-countCategory1-countCategory2].length > 3) {
                                for(var j=0; j<(Category3OtherInformationContentArray[i-countCategory1-countCategory2].length-3); j++) {
                                    var content = document.getElementsByClassName("sheetOtherInfoCheckBoxContent")[i].innerHTML;
                                    var newContent = "<input type='text' name='OtherInformation"+(i+1)+"CheckBoxItem[]' autocomplete='off' placeholder='Item (CheckBox)' />"
                                    document.getElementsByClassName("sheetOtherInfoCheckBoxContent")[i].innerHTML = content + newContent;
                                }
                            }
                            for(var k=0; k<Category3OtherInformationContentArray[i-countCategory1-countCategory2].length; k++) {
                                document.getElementsByName("OtherInformation"+(i+1)+"CheckBoxItem[]")[k].value = Category3OtherInformationContentArray[i-countCategory1-countCategory2][k];
                            }
                        }
                        else if(Category3OtherInformationTypeArray[i-countCategory1-countCategory2] == "Radio") {
                            changeToRadioOther(i);
                            $(".sheetOtherInfoRadio").eq(i).children("input").eq(1).val(Category3OtherInformationNameArray[i-countCategory1-countCategory2]);
                            if(Category3OtherInformationContentArray[i-countCategory1-countCategory2].length > 3) {
                                for(var j=0; j<(Category3OtherInformationContentArray[i-countCategory1-countCategory2].length-3); j++) {
                                    var content = document.getElementsByClassName("sheetOtherInfoRadioContent")[i].innerHTML;
                                    var newContent = "<input type='text' name='OtherInformation"+(i+1)+"RadioItem[]' autocomplete='off' placeholder='Item (Radio)' />"
                                    document.getElementsByClassName("sheetOtherInfoRadioContent")[i].innerHTML = content + newContent;
                                }
                            }
                            for(var k=0; k<Category3OtherInformationContentArray[i-countCategory1-countCategory2].length; k++) {
                                document.getElementsByName("OtherInformation"+(i+1)+"RadioItem[]")[k].value = Category3OtherInformationContentArray[i-countCategory1-countCategory2][k];
                            }
                        }
                    }
                }
                
                oldCountCategory3 = countCategory3;
            }
            if(countCategory >= 4) {
                // 保持选中
                document.getElementById('category4').options[countCategory4-1].selected = true;
                
                $('#sheetOtherInformationFieldset4').html("");
                $('#sheetOtherInformationFieldset4').append("<legend>Spread Sheet Other Information Category 4</legend>");
                $('#sheetOtherInformationFieldset4').append("<label class='label'>Category Name:</label>");
                $('#sheetOtherInformationFieldset4').append("<input type='text' class='CategoryName' name='Category4Name' autocomplete='off' placeholder='Category Name' /><br>");

                for(var i=countCategory1+countCategory2+countCategory3+1; i<=countCategory1+countCategory2+countCategory3+countCategory4; i++) {
                    generateOtherInfoCategoryItems("#sheetOtherInformationFieldset4", i);
                }
                
                // 恢复之前的记录
                document.getElementsByName("Category4Name")[0].value = oldCategory4Name;

                for(var i=countCategory1+countCategory2+countCategory3; i<countCategory1+countCategory2+countCategory3+countCategory4; i++) {
                    if(i < countCategory1+countCategory2+countCategory3+oldCountCategory4) {
                        if(Category4OtherInformationTypeArray[i-countCategory1-countCategory2-countCategory3] == "Text") {
                            changeToTextOther(i);
                            $(".sheetOtherInfoText").eq(i).children("input").eq(1).val(Category4OtherInformationNameArray[i-countCategory1-countCategory2-countCategory3]);
                        }
                        else if(Category4OtherInformationTypeArray[i-countCategory1-countCategory2-countCategory3] == "DorpdownList") {
                            changeToDorpdownListOther(i);
                            $(".sheetOtherInfoDorpdownList").eq(i).children("input").eq(1).val(Category4OtherInformationNameArray[i-countCategory1-countCategory2-countCategory3]);
                            if(Category4OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3].length > 3) {
                                for(var j=0; j<(Category4OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3].length-3); j++) {
                                    var content = document.getElementsByClassName("sheetOtherInfoDorpdownListContent")[i].innerHTML;
                                    var newContent = "<input type='text' name='OtherInformation"+(i+1)+"DorpdownListItem[]' autocomplete='off' placeholder='Item (Dorpdown List)' />"
                                    document.getElementsByClassName("sheetOtherInfoDorpdownListContent")[i].innerHTML = content + newContent;
                                }
                            }
                            for(var k=0; k<Category4OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3].length; k++) {
                                document.getElementsByName("OtherInformation"+(i+1)+"DorpdownListItem[]")[k].value = Category4OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3][k];
                            }
                        }
                        else if(Category4OtherInformationTypeArray[i-countCategory1-countCategory2-countCategory3] == "CheckBox") {
                            changeToCheckBoxOther(i);
                            $(".sheetOtherInfoCheckBox").eq(i).children("input").eq(1).val(Category4OtherInformationNameArray[i-countCategory1-countCategory2-countCategory3]);
                            if(Category4OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3].length > 3) {
                                for(var j=0; j<(Category4OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3].length-3); j++) {
                                    var content = document.getElementsByClassName("sheetOtherInfoCheckBoxContent")[i].innerHTML;
                                    var newContent = "<input type='text' name='OtherInformation"+(i+1)+"CheckBoxItem[]' autocomplete='off' placeholder='Item (CheckBox)' />"
                                    document.getElementsByClassName("sheetOtherInfoCheckBoxContent")[i].innerHTML = content + newContent;
                                }
                            }
                            for(var k=0; k<Category4OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3].length; k++) {
                                document.getElementsByName("OtherInformation"+(i+1)+"CheckBoxItem[]")[k].value = Category4OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3][k];
                            }
                        }
                        else if(Category4OtherInformationTypeArray[i-countCategory1-countCategory2-countCategory3] == "Radio") {
                            changeToRadioOther(i);
                            $(".sheetOtherInfoRadio").eq(i).children("input").eq(1).val(Category4OtherInformationNameArray[i-countCategory1-countCategory2-countCategory3]);
                            if(Category4OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3].length > 3) {
                                for(var j=0; j<(Category4OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3].length-3); j++) {
                                    var content = document.getElementsByClassName("sheetOtherInfoRadioContent")[i].innerHTML;
                                    var newContent = "<input type='text' name='OtherInformation"+(i+1)+"RadioItem[]' autocomplete='off' placeholder='Item (Radio)' />"
                                    document.getElementsByClassName("sheetOtherInfoRadioContent")[i].innerHTML = content + newContent;
                                }
                            }
                            for(var k=0; k<Category4OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3].length; k++) {
                                document.getElementsByName("OtherInformation"+(i+1)+"RadioItem[]")[k].value = Category4OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3][k];
                            }
                        }
                    }
                }
                
                oldCountCategory4 = countCategory4;
            }
            if(countCategory >= 5) {
                // 保持选中
                document.getElementById('category5').options[countCategory5-1].selected = true;
                
                $('#sheetOtherInformationFieldset5').html("");
                $('#sheetOtherInformationFieldset5').append("<legend>Spread Sheet Other Information Category 5</legend>");
                $('#sheetOtherInformationFieldset5').append("<label class='label'>Category Name:</label>");
                $('#sheetOtherInformationFieldset5').append("<input type='text' class='CategoryName' name='Category5Name' autocomplete='off' placeholder='Category Name' /><br>");
                
                for(var i=countCategory1+countCategory2+countCategory3+countCategory4+1; i<=countCategory1+countCategory2+countCategory3+countCategory4+countCategory5; i++) {
                    generateOtherInfoCategoryItems("#sheetOtherInformationFieldset5", i);
                }
                
                // 恢复之前的记录
                document.getElementsByName("Category5Name")[0].value = oldCategory5Name;
                for(var i=countCategory1+countCategory2+countCategory3+countCategory4; i<countCategory1+countCategory2+countCategory3+countCategory4+countCategory5; i++) {
                    if(i < countCategory1+countCategory2+countCategory3+countCategory4+oldCountCategory5) {
                        if(Category5OtherInformationTypeArray[i-countCategory1-countCategory2-countCategory3-countCategory4] == "Text") {
                            changeToTextOther(i);
                            $(".sheetOtherInfoText").eq(i).children("input").eq(1).val(Category5OtherInformationNameArray[i-countCategory1-countCategory2-countCategory3-countCategory4]);
                        }
                        else if(Category5OtherInformationTypeArray[i-countCategory1-countCategory2-countCategory3-countCategory4] == "DorpdownList") {
                            changeToDorpdownListOther(i);
                            $(".sheetOtherInfoDorpdownList").eq(i).children("input").eq(1).val(Category5OtherInformationNameArray[i-countCategory1-countCategory2-countCategory3-countCategory4]);
                            if(Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4].length > 3) {
                                for(var j=0; j<(Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4].length-3); j++) {
                                    var content = document.getElementsByClassName("sheetOtherInfoDorpdownListContent")[i].innerHTML;
                                    var newContent = "<input type='text' name='OtherInformation"+(i+1)+"DorpdownListItem[]' autocomplete='off' placeholder='Item (Dorpdown List)' />"
                                    document.getElementsByClassName("sheetOtherInfoDorpdownListContent")[i].innerHTML = content + newContent;
                                }
                            }
                            for(var k=0; k<Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4].length; k++) {
                                document.getElementsByName("OtherInformation"+(i+1)+"DorpdownListItem[]")[k].value = Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4][k];
                            }
                        }
                        else if(Category5OtherInformationTypeArray[i-countCategory1-countCategory2-countCategory3-countCategory4] == "CheckBox") {
                            changeToCheckBoxOther(i);
                            $(".sheetOtherInfoCheckBox").eq(i).children("input").eq(1).val(Category5OtherInformationNameArray[i-countCategory1-countCategory2-countCategory3-countCategory4]);
                            if(Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4].length > 3) {
                                for(var j=0; j<(Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4].length-3); j++) {
                                    var content = document.getElementsByClassName("sheetOtherInfoCheckBoxContent")[i].innerHTML;
                                    var newContent = "<input type='text' name='OtherInformation"+(i+1)+"CheckBoxItem[]' autocomplete='off' placeholder='Item (CheckBox)' />"
                                    document.getElementsByClassName("sheetOtherInfoCheckBoxContent")[i].innerHTML = content + newContent;
                                }
                            }
                            for(var k=0; k<Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4].length; k++) {
                                document.getElementsByName("OtherInformation"+(i+1)+"CheckBoxItem[]")[k].value = Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4][k];
                            }
                        }
                        else if(Category5OtherInformationTypeArray[i-countCategory1-countCategory2-countCategory3-countCategory4] == "Radio") {
                            changeToRadioOther(i);
                            $(".sheetOtherInfoRadio").eq(i).children("input").eq(1).val(Category5OtherInformationNameArray[i-countCategory1-countCategory2-countCategory3-countCategory4]);
                            if(Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4].length > 3) {
                                for(var j=0; j<(Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4].length-3); j++) {
                                    var content = document.getElementsByClassName("sheetOtherInfoRadioContent")[i].innerHTML;
                                    var newContent = "<input type='text' name='OtherInformation"+(i+1)+"RadioItem[]' autocomplete='off' placeholder='Item (Radio)' />"
                                    document.getElementsByClassName("sheetOtherInfoRadioContent")[i].innerHTML = content + newContent;
                                }
                            }
                            for(var k=0; k<Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4].length; k++) {
                                document.getElementsByName("OtherInformation"+(i+1)+"RadioItem[]")[k].value = Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4][k];
                            }
                        }
                    }
                }
                
                oldCountCategory5 = countCategory5;
            }
            
            // 如果超过50就不可以再加新的Category
            if(countCategory == 2){
                if(countCategory1+countCategory2 == 48) {
                    // 清除Category的选项，必须要反着清除
                    var oldCategoryOptionsLength = document.getElementById('otherInformationCategory').options.length;
                    for(var i=oldCategoryOptionsLength-1; i>=0; i--) {
                        document.getElementById("otherInformationCategory").options.remove(i);
                    }
                    // 重新加载Category的选项
                    for(var i=1; i<=4; i++) {
                        document.getElementById("otherInformationCategory").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    }
                    // 保持选中
                    document.getElementById('otherInformationCategory').options[countCategory-1].selected = true;
                }
                else if(countCategory1+countCategory2 == 49) {
                    // 清除Category的选项，必须要反着清除
                    var oldCategoryOptionsLength = document.getElementById('otherInformationCategory').options.length;
                    for(var i=oldCategoryOptionsLength-1; i>=0; i--) {
                        document.getElementById("otherInformationCategory").options.remove(i);
                    }
                    // 重新加载Category的选项
                    for(var i=1; i<=3; i++) {
                        document.getElementById("otherInformationCategory").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    }
                    // 保持选中
                    document.getElementById('otherInformationCategory').options[countCategory-1].selected = true;
                }
                else if(countCategory1+countCategory2 == 50) {
                    // 清除Category的选项，必须要反着清除
                    var oldCategoryOptionsLength = document.getElementById('otherInformationCategory').options.length;
                    for(var i=oldCategoryOptionsLength-1; i>=0; i--) {
                        document.getElementById("otherInformationCategory").options.remove(i);
                    }
                    // 重新加载Category的选项
                    for(var i=1; i<=2; i++) {
                        document.getElementById("otherInformationCategory").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    }
                    // 保持选中
                    document.getElementById('otherInformationCategory').options[countCategory-1].selected = true;
                }
                else {
                    // 清除Category的选项，必须要反着清除
                    var oldCategoryOptionsLength = document.getElementById('otherInformationCategory').options.length;
                    for(var i=oldCategoryOptionsLength-1; i>=0; i--) {
                        document.getElementById("otherInformationCategory").options.remove(i);
                    }
                    // 重新加载Category的选项
                    for(var i=1; i<=5; i++) {
                        document.getElementById("otherInformationCategory").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    }
                    // 保持选中
                    document.getElementById('otherInformationCategory').options[countCategory-1].selected = true;
                }
            }
            else if(countCategory == 3){
                if(countCategory1+countCategory2+countCategory3 == 49) {
                    // 清除Category的选项，必须要反着清除
                    var oldCategoryOptionsLength = document.getElementById('otherInformationCategory').options.length;
                    for(var i=oldCategoryOptionsLength-1; i>=0; i--) {
                        document.getElementById("otherInformationCategory").options.remove(i);
                    }
                    // 重新加载Category的选项
                    for(var i=1; i<=4; i++) {
                        document.getElementById("otherInformationCategory").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    }
                    // 保持选中
                    document.getElementById('otherInformationCategory').options[countCategory-1].selected = true;
                }
                else if(countCategory1+countCategory2+countCategory3 == 50) {
                    // 清除Category的选项，必须要反着清除
                    var oldCategoryOptionsLength = document.getElementById('otherInformationCategory').options.length;
                    for(var i=oldCategoryOptionsLength-1; i>=0; i--) {
                        document.getElementById("otherInformationCategory").options.remove(i);
                    }
                    // 重新加载Category的选项
                    for(var i=1; i<=3; i++) {
                        document.getElementById("otherInformationCategory").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    }
                    // 保持选中
                    document.getElementById('otherInformationCategory').options[countCategory-1].selected = true;
                }
                else {
                    // 清除Category的选项，必须要反着清除
                    var oldCategoryOptionsLength = document.getElementById('otherInformationCategory').options.length;
                    for(var i=oldCategoryOptionsLength-1; i>=0; i--) {
                        document.getElementById("otherInformationCategory").options.remove(i);
                    }
                    // 重新加载Category的选项
                    for(var i=1; i<=5; i++) {
                        document.getElementById("otherInformationCategory").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    }
                    // 保持选中
                    document.getElementById('otherInformationCategory').options[countCategory-1].selected = true;
                }
            }
            else if(countCategory == 4){
                if(countCategory1+countCategory2+countCategory3+countCategory4 == 50) {
                    // 清除Category的选项，必须要反着清除
                    var oldCategoryOptionsLength = document.getElementById('otherInformationCategory').options.length;
                    for(var i=oldCategoryOptionsLength-1; i>=0; i--) {
                        document.getElementById("otherInformationCategory").options.remove(i);
                    }
                    // 重新加载Category的选项
                    for(var i=1; i<=4; i++) {
                        document.getElementById("otherInformationCategory").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    }
                    // 保持选中
                    document.getElementById('otherInformationCategory').options[countCategory-1].selected = true;
                }
                else {
                    // 清除Category的选项，必须要反着清除
                    var oldCategoryOptionsLength = document.getElementById('otherInformationCategory').options.length;
                    for(var i=oldCategoryOptionsLength-1; i>=0; i--) {
                        document.getElementById("otherInformationCategory").options.remove(i);
                    }
                    // 重新加载Category的选项
                    for(var i=1; i<=5; i++) {
                        document.getElementById("otherInformationCategory").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    }
                    // 保持选中
                    document.getElementById('otherInformationCategory').options[countCategory-1].selected = true;
                }
            }
            
            // 记住新的CountCategory2作为下次使用
            oldCountCategory2 = countCategory2;
        });
        
        // 如果Category3有变化
        $(document).delegate("#category3", "change", function () {
            // 记住oldCategory3Name
            var oldCategory3Name = document.getElementsByName("Category3Name")[0].value;
            
            // 记住oldCategory3所有的Item
            var Category3OtherInformationNameArray = new Array();
            var Category3OtherInformationTypeArray = new Array();
            var Category3OtherInformationContentArray = new Array();
            
            for(var i=oldCountCategory1+oldCountCategory2; i<oldCountCategory1+oldCountCategory2+oldCountCategory3; i++) {
                if(!$(".sheetOtherInfoText").eq(i).children("input").prop('disabled')) {
                    Category3OtherInformationTypeArray.push($(".sheetOtherInfoText").eq(i).children("input").eq(0).val());
                }
                else if(!$(".sheetOtherInfoDorpdownList").eq(i).children("input").prop('disabled')) {
                    Category3OtherInformationTypeArray.push($(".sheetOtherInfoDorpdownList").eq(i).children("input").eq(0).val());
                    var DorpdownListContentLength = document.getElementsByName("OtherInformation"+(i+1)+"DorpdownListItem[]").length;
                    if(DorpdownListContentLength > 0) {
                        Category3OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2] = new Array();
                        for(var j=0; j<DorpdownListContentLength; j++) {
                            if($(".sheetOtherInfoDorpdownListContent").eq(i).children("input").eq(j).val() != "" && $(".sheetOtherInfoDorpdownListContent").eq(i).children("input").eq(j).val() != undefined) {
                                var content = $(".sheetOtherInfoDorpdownListContent").eq(i).children("input").eq(j).val();
                                Category3OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2].push(content); 
                            }
                        }
                    }
                }
                else if(!$(".sheetOtherInfoCheckBox").eq(i).children("input").prop('disabled')) {
                    Category3OtherInformationTypeArray.push($(".sheetOtherInfoCheckBox").eq(i).children("input").eq(0).val());
                    var CheckBoxContentLength = document.getElementsByName("OtherInformation"+(i+1)+"CheckBoxItem[]").length;
                    if(CheckBoxContentLength > 0) {
                        Category3OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2] = new Array();
                        for(var j=0; j<CheckBoxContentLength; j++) {
                            if($(".sheetOtherInfoCheckBoxContent").eq(i).children("input").eq(j).val() != "" && $(".sheetOtherInfoCheckBoxContent").eq(i).children("input").eq(j).val() != undefined) {
                                var content = $(".sheetOtherInfoCheckBoxContent").eq(i).children("input").eq(j).val();
                                Category3OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2].push(content);
                            }
                        }
                    }
                }
                else{
                    Category3OtherInformationTypeArray.push($(".sheetOtherInfoRadio").eq(i).children("input").eq(0).val());
                    var RadioContentLength = document.getElementsByName("OtherInformation"+(i+1)+"RadioItem[]").length;
                    if(RadioContentLength > 0) {
                        Category3OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2] = new Array();
                        for(var j=0; j<RadioContentLength; j++) {
                            if($(".sheetOtherInfoRadioContent").eq(i).children("input").eq(j).val() != "" && $(".sheetOtherInfoRadioContent").eq(i).children("input").eq(j).val() != undefined) {
                                var content = $(".sheetOtherInfoRadioContent").eq(i).children("input").eq(j).val();
                                Category3OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2].push(content);
                            }
                        }
                    }
                }
            }
            
            for(var i=oldCountCategory1+oldCountCategory2; i<oldCountCategory1+oldCountCategory2+oldCountCategory3; i++) {
                if(!$(".sheetOtherInfoText").eq(i).children("input").prop('disabled')) {
                    Category3OtherInformationNameArray.push($(".sheetOtherInfoText").eq(i).children("input").eq(1).val());
                }
                else if(!$(".sheetOtherInfoDorpdownList").eq(i).children("input").prop('disabled')) {
                    Category3OtherInformationNameArray.push($(".sheetOtherInfoDorpdownList").eq(i).children("input").eq(1).val());
                }
                else if(!$(".sheetOtherInfoCheckBox").eq(i).children("input").prop('disabled')) {
                    Category3OtherInformationNameArray.push($(".sheetOtherInfoCheckBox").eq(i).children("input").eq(1).val());
                }
                else{
                    Category3OtherInformationNameArray.push($(".sheetOtherInfoRadio").eq(i).children("input").eq(1).val());
                }
            }
            
            // 获取当前Category1和Category2和Category3的option的数量
            var countCategory1 = parseInt(document.getElementById("category1").value);
            var countCategory2 = parseInt(document.getElementById("category2").value);
            var countCategory3 = parseInt(document.getElementById("category3").value);
            
            // 获取当前一共有多少个Category
            var countCategory = document.getElementById("otherInformationCategory").value;
            
            // 计算得到Category45的option的数量
            var countCategory45 = 50 - countCategory1 - countCategory2 - countCategory3;
            
            // 在category3更新之前记住oldCategory4所有的Item
            if(countCategory >= 4) {
                // 记住oldCategory4Name
                var oldCategory4Name = document.getElementsByName("Category4Name")[0].value;

                // 记住oldCategory4所有的Item
                var Category4OtherInformationNameArray = new Array();
                var Category4OtherInformationTypeArray = new Array();
                var Category4OtherInformationContentArray = new Array();

                for(var i=oldCountCategory1+oldCountCategory2+oldCountCategory3; i<oldCountCategory1+oldCountCategory2+oldCountCategory3+oldCountCategory4; i++) {
                    if(!$(".sheetOtherInfoText").eq(i).children("input").prop('disabled')) {
                        Category4OtherInformationTypeArray.push($(".sheetOtherInfoText").eq(i).children("input").eq(0).val());
                    }
                    else if(!$(".sheetOtherInfoDorpdownList").eq(i).children("input").prop('disabled')) {
                        Category4OtherInformationTypeArray.push($(".sheetOtherInfoDorpdownList").eq(i).children("input").eq(0).val());
                        var DorpdownListContentLength = document.getElementsByName("OtherInformation"+(i+1)+"DorpdownListItem[]").length;
                        if(DorpdownListContentLength > 0) {
                            Category4OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3] = new Array();
                            for(var j=0; j<DorpdownListContentLength; j++) {
                                if($(".sheetOtherInfoDorpdownListContent").eq(i).children("input").eq(j).val() != "" && $(".sheetOtherInfoDorpdownListContent").eq(i).children("input").eq(j).val() != undefined) {
                                    var content = $(".sheetOtherInfoDorpdownListContent").eq(i).children("input").eq(j).val();
                                    Category4OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3].push(content); 
                                }
                            }
                        }
                    }
                    else if(!$(".sheetOtherInfoCheckBox").eq(i).children("input").prop('disabled')) {
                        Category4OtherInformationTypeArray.push($(".sheetOtherInfoCheckBox").eq(i).children("input").eq(0).val());
                        var CheckBoxContentLength = document.getElementsByName("OtherInformation"+(i+1)+"CheckBoxItem[]").length;
                        if(CheckBoxContentLength > 0) {
                            Category4OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3] = new Array();
                            for(var j=0; j<CheckBoxContentLength; j++) {
                                if($(".sheetOtherInfoCheckBoxContent").eq(i).children("input").eq(j).val() != "" && $(".sheetOtherInfoCheckBoxContent").eq(i).children("input").eq(j).val() != undefined) {
                                    var content = $(".sheetOtherInfoCheckBoxContent").eq(i).children("input").eq(j).val();
                                    Category4OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3].push(content);
                                }
                            }
                        }
                    }
                    else{
                        Category4OtherInformationTypeArray.push($(".sheetOtherInfoRadio").eq(i).children("input").eq(0).val());
                        var RadioContentLength = document.getElementsByName("OtherInformation"+(i+1)+"RadioItem[]").length;
                        if(RadioContentLength > 0) {
                            Category4OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3] = new Array();
                            for(var j=0; j<RadioContentLength; j++) {
                                if($(".sheetOtherInfoRadioContent").eq(i).children("input").eq(j).val() != "" && $(".sheetOtherInfoRadioContent").eq(i).children("input").eq(j).val() != undefined) {
                                    var content = $(".sheetOtherInfoRadioContent").eq(i).children("input").eq(j).val();
                                    Category4OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3].push(content);
                                }
                            }
                        }
                    }
                }

                for(var i=oldCountCategory1+oldCountCategory2+oldCountCategory3; i<oldCountCategory1+oldCountCategory2+oldCountCategory3+oldCountCategory4; i++) {
                    if(!$(".sheetOtherInfoText").eq(i).children("input").prop('disabled')) {
                        Category4OtherInformationNameArray.push($(".sheetOtherInfoText").eq(i).children("input").eq(1).val());
                    }
                    else if(!$(".sheetOtherInfoDorpdownList").eq(i).children("input").prop('disabled')) {
                        Category4OtherInformationNameArray.push($(".sheetOtherInfoDorpdownList").eq(i).children("input").eq(1).val());
                    }
                    else if(!$(".sheetOtherInfoCheckBox").eq(i).children("input").prop('disabled')) {
                        Category4OtherInformationNameArray.push($(".sheetOtherInfoCheckBox").eq(i).children("input").eq(1).val());
                    }
                    else{
                        Category4OtherInformationNameArray.push($(".sheetOtherInfoRadio").eq(i).children("input").eq(1).val());
                    }
                }
            }
            // 在category1更新之前记住oldCategory5所有的Item
            if(countCategory >= 5) {
                // 记住oldCategory5Name
                var oldCategory5Name = document.getElementsByName("Category5Name")[0].value;

                // 记住oldCategory5所有的Item
                var Category5OtherInformationNameArray = new Array();
                var Category5OtherInformationTypeArray = new Array();
                var Category5OtherInformationContentArray = new Array();

                for(var i=oldCountCategory1+oldCountCategory2+oldCountCategory3+oldCountCategory4; i<oldCountCategory1+oldCountCategory2+oldCountCategory3+oldCountCategory4+oldCountCategory5; i++) {
                    if(!$(".sheetOtherInfoText").eq(i).children("input").prop('disabled')) {
                        Category5OtherInformationTypeArray.push($(".sheetOtherInfoText").eq(i).children("input").eq(0).val());
                    }
                    else if(!$(".sheetOtherInfoDorpdownList").eq(i).children("input").prop('disabled')) {
                        Category5OtherInformationTypeArray.push($(".sheetOtherInfoDorpdownList").eq(i).children("input").eq(0).val());
                        var DorpdownListContentLength = document.getElementsByName("OtherInformation"+(i+1)+"DorpdownListItem[]").length;
                        if(DorpdownListContentLength > 0) {
                            Category5OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3-oldCountCategory4] = new Array();
                            for(var j=0; j<DorpdownListContentLength; j++) {
                                if($(".sheetOtherInfoDorpdownListContent").eq(i).children("input").eq(j).val() != "" && $(".sheetOtherInfoDorpdownListContent").eq(i).children("input").eq(j).val() != undefined) {
                                    var content = $(".sheetOtherInfoDorpdownListContent").eq(i).children("input").eq(j).val();
                                    Category5OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3-oldCountCategory4].push(content); 
                                }
                            }
                        }
                    }
                    else if(!$(".sheetOtherInfoCheckBox").eq(i).children("input").prop('disabled')) {
                        Category5OtherInformationTypeArray.push($(".sheetOtherInfoCheckBox").eq(i).children("input").eq(0).val());
                        var CheckBoxContentLength = document.getElementsByName("OtherInformation"+(i+1)+"CheckBoxItem[]").length;
                        if(CheckBoxContentLength > 0) {
                            Category5OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3-oldCountCategory4] = new Array();
                            for(var j=0; j<CheckBoxContentLength; j++) {
                                if($(".sheetOtherInfoCheckBoxContent").eq(i).children("input").eq(j).val() != "" && $(".sheetOtherInfoCheckBoxContent").eq(i).children("input").eq(j).val() != undefined) {
                                    var content = $(".sheetOtherInfoCheckBoxContent").eq(i).children("input").eq(j).val();
                                    Category5OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3-oldCountCategory4].push(content);
                                }
                            }
                        }
                    }
                    else{
                        Category5OtherInformationTypeArray.push($(".sheetOtherInfoRadio").eq(i).children("input").eq(0).val());
                        var RadioContentLength = document.getElementsByName("OtherInformation"+(i+1)+"RadioItem[]").length;
                        if(RadioContentLength > 0) {
                            Category5OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3-oldCountCategory4] = new Array();
                            for(var j=0; j<RadioContentLength; j++) {
                                if($(".sheetOtherInfoRadioContent").eq(i).children("input").eq(j).val() != "" && $(".sheetOtherInfoRadioContent").eq(i).children("input").eq(j).val() != undefined) {
                                    var content = $(".sheetOtherInfoRadioContent").eq(i).children("input").eq(j).val();
                                    Category5OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3-oldCountCategory4].push(content);
                                }
                            }
                        }
                    }
                }

                for(var i=oldCountCategory1+oldCountCategory2+oldCountCategory3+oldCountCategory4; i<oldCountCategory1+oldCountCategory2+oldCountCategory3+oldCountCategory4+oldCountCategory5; i++) {
                    if(!$(".sheetOtherInfoText").eq(i).children("input").prop('disabled')) {
                        Category5OtherInformationNameArray.push($(".sheetOtherInfoText").eq(i).children("input").eq(1).val());
                    }
                    else if(!$(".sheetOtherInfoDorpdownList").eq(i).children("input").prop('disabled')) {
                        Category5OtherInformationNameArray.push($(".sheetOtherInfoDorpdownList").eq(i).children("input").eq(1).val());
                    }
                    else if(!$(".sheetOtherInfoCheckBox").eq(i).children("input").prop('disabled')) {
                        Category5OtherInformationNameArray.push($(".sheetOtherInfoCheckBox").eq(i).children("input").eq(1).val());
                    }
                    else{
                        Category5OtherInformationNameArray.push($(".sheetOtherInfoRadio").eq(i).children("input").eq(1).val());
                    }
                }
            }
            
            // For category3
            $('#sheetOtherInformationFieldset3').html("");
            $('#sheetOtherInformationFieldset3').append("<legend>Spread Sheet Other Information Category 3</legend>");
            $('#sheetOtherInformationFieldset3').append("<label class='label'>Category Name:</label>");
            $('#sheetOtherInformationFieldset3').append("<input type='text' class='CategoryName' name='Category3Name' autocomplete='off' placeholder='Category Name' /><br>");
            
            for(var i=countCategory1+countCategory2+1; i<=countCategory1+countCategory2+countCategory3; i++) {
                generateOtherInfoCategoryItems("#sheetOtherInformationFieldset3", i);
            }
            
            // 恢复之前的记录
            document.getElementsByName("Category3Name")[0].value = oldCategory3Name;
            
            for(var i=countCategory1+countCategory2; i<countCategory1+countCategory2+countCategory3; i++) {
                if(i < oldCountCategory1+oldCountCategory2+oldCountCategory3) {
                    if(Category3OtherInformationTypeArray[i-countCategory1-countCategory2] == "Text") {
                        changeToTextOther(i);
                        $(".sheetOtherInfoText").eq(i).children("input").eq(1).val(Category3OtherInformationNameArray[i-countCategory1-countCategory2]);
                    }
                    else if(Category3OtherInformationTypeArray[i-countCategory1-countCategory2] == "DorpdownList") {
                        changeToDorpdownListOther(i);
                        $(".sheetOtherInfoDorpdownList").eq(i).children("input").eq(1).val(Category3OtherInformationNameArray[i-countCategory1-countCategory2]);
                        if(Category3OtherInformationContentArray[i-countCategory1-countCategory2].length > 3) {
                            for(var j=0; j<(Category3OtherInformationContentArray[i-countCategory1-countCategory2].length-3); j++) {
                                var content = document.getElementsByClassName("sheetOtherInfoDorpdownListContent")[i].innerHTML;
                                var newContent = "<input type='text' name='OtherInformation"+(i+1)+"DorpdownListItem[]' autocomplete='off' placeholder='Item (Dorpdown List)' />"
                                document.getElementsByClassName("sheetOtherInfoDorpdownListContent")[i].innerHTML = content + newContent;
                            }
                        }
                        for(var k=0; k<Category3OtherInformationContentArray[i-countCategory1-countCategory2].length; k++) {
                            document.getElementsByName("OtherInformation"+(i+1)+"DorpdownListItem[]")[k].value = Category3OtherInformationContentArray[i-countCategory1-countCategory2][k];
                        }
                    }
                    else if(Category3OtherInformationTypeArray[i-countCategory1-countCategory2] == "CheckBox") {
                        changeToCheckBoxOther(i);
                        $(".sheetOtherInfoCheckBox").eq(i).children("input").eq(1).val(Category3OtherInformationNameArray[i-countCategory1-countCategory2]);
                        if(Category3OtherInformationContentArray[i-countCategory1-countCategory2].length > 3) {
                            for(var j=0; j<(Category3OtherInformationContentArray[i-countCategory1-countCategory2].length-3); j++) {
                                var content = document.getElementsByClassName("sheetOtherInfoCheckBoxContent")[i].innerHTML;
                                var newContent = "<input type='text' name='OtherInformation"+(i+1)+"CheckBoxItem[]' autocomplete='off' placeholder='Item (CheckBox)' />"
                                document.getElementsByClassName("sheetOtherInfoCheckBoxContent")[i].innerHTML = content + newContent;
                            }
                        }
                        for(var k=0; k<Category3OtherInformationContentArray[i-countCategory1-countCategory2].length; k++) {
                            document.getElementsByName("OtherInformation"+(i+1)+"CheckBoxItem[]")[k].value = Category3OtherInformationContentArray[i-countCategory1-countCategory2][k];
                        }
                    }
                    else if(Category3OtherInformationTypeArray[i-countCategory1-countCategory2] == "Radio") {
                        changeToRadioOther(i);
                        $(".sheetOtherInfoRadio").eq(i).children("input").eq(1).val(Category3OtherInformationNameArray[i-countCategory1-countCategory2]);
                        if(Category3OtherInformationContentArray[i-countCategory1-countCategory2].length > 3) {
                            for(var j=0; j<(Category3OtherInformationContentArray[i-countCategory1-countCategory2].length-3); j++) {
                                var content = document.getElementsByClassName("sheetOtherInfoRadioContent")[i].innerHTML;
                                var newContent = "<input type='text' name='OtherInformation"+(i+1)+"RadioItem[]' autocomplete='off' placeholder='Item (Radio)' />"
                                document.getElementsByClassName("sheetOtherInfoRadioContent")[i].innerHTML = content + newContent;
                            }
                        }
                        for(var k=0; k<Category3OtherInformationContentArray[i-countCategory1-countCategory2].length; k++) {
                            document.getElementsByName("OtherInformation"+(i+1)+"RadioItem[]")[k].value = Category3OtherInformationContentArray[i-countCategory1-countCategory2][k];
                        }
                    }
                }
            }
            
            // Category1和Category2无需讨论
            var countCategory4;
            var countCategory5;
            
            if(countCategory >= 3){
                // 清除Category1的选项，必须要反着清除
                var oldCategory1OptionsLength = document.getElementById('category1').options.length;
                for(var i=oldCategory1OptionsLength-1; i>=0; i--) {
                    document.getElementById("category1").options.remove(i);
                }
                // 清除Category2的选项，必须要反着清除
                var oldCategory2OptionsLength = document.getElementById('category2').options.length;
                for(var i=oldCategory2OptionsLength-1; i>=0; i--) {
                    document.getElementById("category2").options.remove(i); 
                }
            }
            if(countCategory >= 4){
                // 获取当前Category4的option的数量
                countCategory4 = parseInt(document.getElementById("category4").value);
                
                // 清除Category4的选项，必须要反着清除
                var oldCategory4OptionsLength = document.getElementById('category4').options.length;
                for(var i=oldCategory4OptionsLength-1; i>=0; i--) {
                    document.getElementById("category4").options.remove(i);
                }
            }
            if(countCategory >= 5){
                // 获取当前Category5的option的数量
                countCategory5 = parseInt(document.getElementById("category5").value);
                
                // 清除Category5的选项，必须要反着清除
                var oldCategory5OptionsLength = document.getElementById('category5').options.length;
                for(var i=oldCategory5OptionsLength-1; i>=0; i--) {
                    document.getElementById("category5").options.remove(i);
                }
            }
            
            if(countCategory == 3){
                // 重新加载Category1的选项
                for(var i=1; i<=(50-countCategory2-countCategory3); i++) {
                    document.getElementById("category1").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                }
                // 重新加载Category2的选项
                for(var i=1; i<=(50-countCategory1-countCategory3); i++) {
                    document.getElementById("category2").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                }
            }
            else if(countCategory == 4){
                // 重新加载Category1的选项
                for(var i=1; i<=(50-countCategory2-countCategory3-countCategory4); i++) {
                    document.getElementById("category1").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                }
                // 重新加载Category2的选项
                for(var i=1; i<=(50-countCategory1-countCategory3-countCategory4); i++) {
                    document.getElementById("category2").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                }
                // 重新加载Category4的选项
                for(var i=1; i<=(50-countCategory1-countCategory2-countCategory3); i++) {
                    document.getElementById("category4").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                }
            }
            else if(countCategory == 5){
                // 重新加载Category1的选项
                for(var i=1; i<=(50-countCategory2-countCategory3-countCategory4-countCategory5); i++) {
                    document.getElementById("category1").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                }
                // 重新加载Category2的选项
                for(var i=1; i<=(50-countCategory1-countCategory3-countCategory4-countCategory5); i++) {
                    document.getElementById("category2").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                }
                // 重新加载Category4的选项
                for(var i=1; i<=(50-countCategory1-countCategory2-countCategory3-countCategory5); i++) {
                    document.getElementById("category4").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                }
                // 重新加载Category5的选项
                for(var i=1; i<=(50-countCategory1-countCategory2-countCategory3-countCategory4); i++) {
                    document.getElementById("category5").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                }
            }
            
            if(countCategory >= 3) {
                // 保持选中
                document.getElementById('category1').options[countCategory1-1].selected = true;
                document.getElementById('category2').options[countCategory2-1].selected = true;
            }
            if(countCategory >= 4) {
                // 保持选中
                document.getElementById('category4').options[countCategory4-1].selected = true;
                
                $('#sheetOtherInformationFieldset4').html("");
                $('#sheetOtherInformationFieldset4').append("<legend>Spread Sheet Other Information Category 4</legend>");
                $('#sheetOtherInformationFieldset4').append("<label class='label'>Category Name:</label>");
                $('#sheetOtherInformationFieldset4').append("<input type='text' class='CategoryName' name='Category4Name' autocomplete='off' placeholder='Category Name' /><br>");

                for(var i=countCategory1+countCategory2+countCategory3+1; i<=countCategory1+countCategory2+countCategory3+countCategory4; i++) {
                    generateOtherInfoCategoryItems("#sheetOtherInformationFieldset4", i);
                }
                
                // 恢复之前的记录
                document.getElementsByName("Category4Name")[0].value = oldCategory4Name;

                for(var i=countCategory1+countCategory2+countCategory3; i<countCategory1+countCategory2+countCategory3+countCategory4; i++) {
                    if(i < countCategory1+countCategory2+countCategory3+oldCountCategory4) {
                        if(Category4OtherInformationTypeArray[i-countCategory1-countCategory2-countCategory3] == "Text") {
                            changeToTextOther(i);
                            $(".sheetOtherInfoText").eq(i).children("input").eq(1).val(Category4OtherInformationNameArray[i-countCategory1-countCategory2-countCategory3]);
                        }
                        else if(Category4OtherInformationTypeArray[i-countCategory1-countCategory2-countCategory3] == "DorpdownList") {
                            changeToDorpdownListOther(i);
                            $(".sheetOtherInfoDorpdownList").eq(i).children("input").eq(1).val(Category4OtherInformationNameArray[i-countCategory1-countCategory2-countCategory3]);
                            if(Category4OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3].length > 3) {
                                for(var j=0; j<(Category4OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3].length-3); j++) {
                                    var content = document.getElementsByClassName("sheetOtherInfoDorpdownListContent")[i].innerHTML;
                                    var newContent = "<input type='text' name='OtherInformation"+(i+1)+"DorpdownListItem[]' autocomplete='off' placeholder='Item (Dorpdown List)' />"
                                    document.getElementsByClassName("sheetOtherInfoDorpdownListContent")[i].innerHTML = content + newContent;
                                }
                            }
                            for(var k=0; k<Category4OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3].length; k++) {
                                document.getElementsByName("OtherInformation"+(i+1)+"DorpdownListItem[]")[k].value = Category4OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3][k];
                            }
                        }
                        else if(Category4OtherInformationTypeArray[i-countCategory1-countCategory2-countCategory3] == "CheckBox") {
                            changeToCheckBoxOther(i);
                            $(".sheetOtherInfoCheckBox").eq(i).children("input").eq(1).val(Category4OtherInformationNameArray[i-countCategory1-countCategory2-countCategory3]);
                            if(Category4OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3].length > 3) {
                                for(var j=0; j<(Category4OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3].length-3); j++) {
                                    var content = document.getElementsByClassName("sheetOtherInfoCheckBoxContent")[i].innerHTML;
                                    var newContent = "<input type='text' name='OtherInformation"+(i+1)+"CheckBoxItem[]' autocomplete='off' placeholder='Item (CheckBox)' />"
                                    document.getElementsByClassName("sheetOtherInfoCheckBoxContent")[i].innerHTML = content + newContent;
                                }
                            }
                            for(var k=0; k<Category4OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3].length; k++) {
                                document.getElementsByName("OtherInformation"+(i+1)+"CheckBoxItem[]")[k].value = Category4OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3][k];
                            }
                        }
                        else if(Category4OtherInformationTypeArray[i-countCategory1-countCategory2-countCategory3] == "Radio") {
                            changeToRadioOther(i);
                            $(".sheetOtherInfoRadio").eq(i).children("input").eq(1).val(Category4OtherInformationNameArray[i-countCategory1-countCategory2-countCategory3]);
                            if(Category4OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3].length > 3) {
                                for(var j=0; j<(Category4OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3].length-3); j++) {
                                    var content = document.getElementsByClassName("sheetOtherInfoRadioContent")[i].innerHTML;
                                    var newContent = "<input type='text' name='OtherInformation"+(i+1)+"RadioItem[]' autocomplete='off' placeholder='Item (Radio)' />"
                                    document.getElementsByClassName("sheetOtherInfoRadioContent")[i].innerHTML = content + newContent;
                                }
                            }
                            for(var k=0; k<Category4OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3].length; k++) {
                                document.getElementsByName("OtherInformation"+(i+1)+"RadioItem[]")[k].value = Category4OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3][k];
                            }
                        }
                    }
                }
                
                oldCountCategory4 = countCategory4;
            }
            if(countCategory >= 5) { 
                // 保持选中
                document.getElementById('category5').options[countCategory5-1].selected = true;
                
                $('#sheetOtherInformationFieldset5').html("");
                $('#sheetOtherInformationFieldset5').append("<legend>Spread Sheet Other Information Category 5</legend>");
                $('#sheetOtherInformationFieldset5').append("<label class='label'>Category Name:</label>");
                $('#sheetOtherInformationFieldset5').append("<input type='text' class='CategoryName' name='Category5Name' autocomplete='off' placeholder='Category Name' /><br>");
                
                for(var i=countCategory1+countCategory2+countCategory3+countCategory4+1; i<=countCategory1+countCategory2+countCategory3+countCategory4+countCategory5; i++) {
                    generateOtherInfoCategoryItems("#sheetOtherInformationFieldset5", i);
                }
                
                // 恢复之前的记录
                document.getElementsByName("Category5Name")[0].value = oldCategory5Name;
                for(var i=countCategory1+countCategory2+countCategory3+countCategory4; i<countCategory1+countCategory2+countCategory3+countCategory4+countCategory5; i++) {
                    if(i < countCategory1+countCategory2+countCategory3+countCategory4+oldCountCategory5) {
                        if(Category5OtherInformationTypeArray[i-countCategory1-countCategory2-countCategory3-countCategory4] == "Text") {
                            changeToTextOther(i);
                            $(".sheetOtherInfoText").eq(i).children("input").eq(1).val(Category5OtherInformationNameArray[i-countCategory1-countCategory2-countCategory3-countCategory4]);
                        }
                        else if(Category5OtherInformationTypeArray[i-countCategory1-countCategory2-countCategory3-countCategory4] == "DorpdownList") {
                            changeToDorpdownListOther(i);
                            $(".sheetOtherInfoDorpdownList").eq(i).children("input").eq(1).val(Category5OtherInformationNameArray[i-countCategory1-countCategory2-countCategory3-countCategory4]);
                            if(Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4].length > 3) {
                                for(var j=0; j<(Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4].length-3); j++) {
                                    var content = document.getElementsByClassName("sheetOtherInfoDorpdownListContent")[i].innerHTML;
                                    var newContent = "<input type='text' name='OtherInformation"+(i+1)+"DorpdownListItem[]' autocomplete='off' placeholder='Item (Dorpdown List)' />"
                                    document.getElementsByClassName("sheetOtherInfoDorpdownListContent")[i].innerHTML = content + newContent;
                                }
                            }
                            for(var k=0; k<Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4].length; k++) {
                                document.getElementsByName("OtherInformation"+(i+1)+"DorpdownListItem[]")[k].value = Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4][k];
                            }
                        }
                        else if(Category5OtherInformationTypeArray[i-countCategory1-countCategory2-countCategory3-countCategory4] == "CheckBox") {
                            changeToCheckBoxOther(i);
                            $(".sheetOtherInfoCheckBox").eq(i).children("input").eq(1).val(Category5OtherInformationNameArray[i-countCategory1-countCategory2-countCategory3-countCategory4]);
                            if(Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4].length > 3) {
                                for(var j=0; j<(Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4].length-3); j++) {
                                    var content = document.getElementsByClassName("sheetOtherInfoCheckBoxContent")[i].innerHTML;
                                    var newContent = "<input type='text' name='OtherInformation"+(i+1)+"CheckBoxItem[]' autocomplete='off' placeholder='Item (CheckBox)' />"
                                    document.getElementsByClassName("sheetOtherInfoCheckBoxContent")[i].innerHTML = content + newContent;
                                }
                            }
                            for(var k=0; k<Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4].length; k++) {
                                document.getElementsByName("OtherInformation"+(i+1)+"CheckBoxItem[]")[k].value = Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4][k];
                            }
                        }
                        else if(Category5OtherInformationTypeArray[i-countCategory1-countCategory2-countCategory3-countCategory4] == "Radio") {
                            changeToRadioOther(i);
                            $(".sheetOtherInfoRadio").eq(i).children("input").eq(1).val(Category5OtherInformationNameArray[i-countCategory1-countCategory2-countCategory3-countCategory4]);
                            if(Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4].length > 3) {
                                for(var j=0; j<(Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4].length-3); j++) {
                                    var content = document.getElementsByClassName("sheetOtherInfoRadioContent")[i].innerHTML;
                                    var newContent = "<input type='text' name='OtherInformation"+(i+1)+"RadioItem[]' autocomplete='off' placeholder='Item (Radio)' />"
                                    document.getElementsByClassName("sheetOtherInfoRadioContent")[i].innerHTML = content + newContent;
                                }
                            }
                            for(var k=0; k<Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4].length; k++) {
                                document.getElementsByName("OtherInformation"+(i+1)+"RadioItem[]")[k].value = Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4][k];
                            }
                        }
                    }
                }
                
                oldCountCategory5 = countCategory5;
            }
            
            // 如果超过50就不可以再加新的Category
            if(countCategory == 3){
                if(countCategory1+countCategory2+countCategory3 == 49) {
                    // 清除Category的选项，必须要反着清除
                    var oldCategoryOptionsLength = document.getElementById('otherInformationCategory').options.length;
                    for(var i=oldCategoryOptionsLength-1; i>=0; i--) {
                        document.getElementById("otherInformationCategory").options.remove(i);
                    }
                    // 重新加载Category的选项
                    for(var i=1; i<=4; i++) {
                        document.getElementById("otherInformationCategory").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    }
                    // 保持选中
                    document.getElementById('otherInformationCategory').options[countCategory-1].selected = true;
                }
                else if(countCategory1+countCategory2+countCategory3 == 50) {
                    // 清除Category的选项，必须要反着清除
                    var oldCategoryOptionsLength = document.getElementById('otherInformationCategory').options.length;
                    for(var i=oldCategoryOptionsLength-1; i>=0; i--) {
                        document.getElementById("otherInformationCategory").options.remove(i);
                    }
                    // 重新加载Category的选项
                    for(var i=1; i<=3; i++) {
                        document.getElementById("otherInformationCategory").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    }
                    // 保持选中
                    document.getElementById('otherInformationCategory').options[countCategory-1].selected = true;
                }
                else {
                    // 清除Category的选项，必须要反着清除
                    var oldCategoryOptionsLength = document.getElementById('otherInformationCategory').options.length;
                    for(var i=oldCategoryOptionsLength-1; i>=0; i--) {
                        document.getElementById("otherInformationCategory").options.remove(i);
                    }
                    // 重新加载Category的选项
                    for(var i=1; i<=5; i++) {
                        document.getElementById("otherInformationCategory").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    }
                    // 保持选中
                    document.getElementById('otherInformationCategory').options[countCategory-1].selected = true;
                }
            }
            else if(countCategory == 4){
                if(countCategory1+countCategory2+countCategory3+countCategory4 == 50) {
                    // 清除Category的选项，必须要反着清除
                    var oldCategoryOptionsLength = document.getElementById('otherInformationCategory').options.length;
                    for(var i=oldCategoryOptionsLength-1; i>=0; i--) {
                        document.getElementById("otherInformationCategory").options.remove(i);
                    }
                    // 重新加载Category的选项
                    for(var i=1; i<=4; i++) {
                        document.getElementById("otherInformationCategory").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    }
                    // 保持选中
                    document.getElementById('otherInformationCategory').options[countCategory-1].selected = true;
                }
                else {
                    // 清除Category的选项，必须要反着清除
                    var oldCategoryOptionsLength = document.getElementById('otherInformationCategory').options.length;
                    for(var i=oldCategoryOptionsLength-1; i>=0; i--) {
                        document.getElementById("otherInformationCategory").options.remove(i);
                    }
                    // 重新加载Category的选项
                    for(var i=1; i<=5; i++) {
                        document.getElementById("otherInformationCategory").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    }
                    // 保持选中
                    document.getElementById('otherInformationCategory').options[countCategory-1].selected = true;
                }
            }
            
            // 记住新的CountCategory3作为下次使用
            oldCountCategory3 = countCategory3;
        });
        
        // 如果Category4有变化
        $(document).delegate("#category4", "change", function () {
            // 记住oldCategory4Name
            var oldCategory4Name = document.getElementsByName("Category4Name")[0].value;
            
            // 记住oldCategory4所有的Item
            var Category4OtherInformationNameArray = new Array();
            var Category4OtherInformationTypeArray = new Array();
            var Category4OtherInformationContentArray = new Array();
            
            for(var i=oldCountCategory1+oldCountCategory2+oldCountCategory3; i<oldCountCategory1+oldCountCategory2+oldCountCategory3+oldCountCategory4; i++) {
                if(!$(".sheetOtherInfoText").eq(i).children("input").prop('disabled')) {
                    Category4OtherInformationTypeArray.push($(".sheetOtherInfoText").eq(i).children("input").eq(0).val());
                }
                else if(!$(".sheetOtherInfoDorpdownList").eq(i).children("input").prop('disabled')) {
                    Category4OtherInformationTypeArray.push($(".sheetOtherInfoDorpdownList").eq(i).children("input").eq(0).val());
                    var DorpdownListContentLength = document.getElementsByName("OtherInformation"+(i+1)+"DorpdownListItem[]").length;
                    if(DorpdownListContentLength > 0) {
                        Category4OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3] = new Array();
                        for(var j=0; j<DorpdownListContentLength; j++) {
                            if($(".sheetOtherInfoDorpdownListContent").eq(i).children("input").eq(j).val() != "" && $(".sheetOtherInfoDorpdownListContent").eq(i).children("input").eq(j).val() != undefined) {
                                var content = $(".sheetOtherInfoDorpdownListContent").eq(i).children("input").eq(j).val();
                                Category4OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3].push(content); 
                            }
                        }
                    }
                }
                else if(!$(".sheetOtherInfoCheckBox").eq(i).children("input").prop('disabled')) {
                    Category4OtherInformationTypeArray.push($(".sheetOtherInfoCheckBox").eq(i).children("input").eq(0).val());
                    var CheckBoxContentLength = document.getElementsByName("OtherInformation"+(i+1)+"CheckBoxItem[]").length;
                    if(CheckBoxContentLength > 0) {
                        Category4OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3] = new Array();
                        for(var j=0; j<CheckBoxContentLength; j++) {
                            if($(".sheetOtherInfoCheckBoxContent").eq(i).children("input").eq(j).val() != "" && $(".sheetOtherInfoCheckBoxContent").eq(i).children("input").eq(j).val() != undefined) {
                                var content = $(".sheetOtherInfoCheckBoxContent").eq(i).children("input").eq(j).val();
                                Category4OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3].push(content);
                            }
                        }
                    }
                }
                else{
                    Category4OtherInformationTypeArray.push($(".sheetOtherInfoRadio").eq(i).children("input").eq(0).val());
                    var RadioContentLength = document.getElementsByName("OtherInformation"+(i+1)+"RadioItem[]").length;
                    if(RadioContentLength > 0) {
                        Category4OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3] = new Array();
                        for(var j=0; j<RadioContentLength; j++) {
                            if($(".sheetOtherInfoRadioContent").eq(i).children("input").eq(j).val() != "" && $(".sheetOtherInfoRadioContent").eq(i).children("input").eq(j).val() != undefined) {
                                var content = $(".sheetOtherInfoRadioContent").eq(i).children("input").eq(j).val();
                                Category4OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3].push(content);
                            }
                        }
                    }
                }
            }
            
            for(var i=oldCountCategory1+oldCountCategory2+oldCountCategory3; i<oldCountCategory1+oldCountCategory2+oldCountCategory3+oldCountCategory4; i++) {
                if(!$(".sheetOtherInfoText").eq(i).children("input").prop('disabled')) {
                    Category4OtherInformationNameArray.push($(".sheetOtherInfoText").eq(i).children("input").eq(1).val());
                }
                else if(!$(".sheetOtherInfoDorpdownList").eq(i).children("input").prop('disabled')) {
                    Category4OtherInformationNameArray.push($(".sheetOtherInfoDorpdownList").eq(i).children("input").eq(1).val());
                }
                else if(!$(".sheetOtherInfoCheckBox").eq(i).children("input").prop('disabled')) {
                    Category4OtherInformationNameArray.push($(".sheetOtherInfoCheckBox").eq(i).children("input").eq(1).val());
                }
                else{
                    Category4OtherInformationNameArray.push($(".sheetOtherInfoRadio").eq(i).children("input").eq(1).val());
                }
            }
            
            // 获取当前Category1和Category2和Category3的option的数量
            var countCategory1 = parseInt(document.getElementById("category1").value);
            var countCategory2 = parseInt(document.getElementById("category2").value);
            var countCategory3 = parseInt(document.getElementById("category3").value);
            var countCategory4 = parseInt(document.getElementById("category4").value);
            
            // 获取当前一共有多少个Category
            var countCategory = document.getElementById("otherInformationCategory").value;
            
            // 计算得到Category5的option的数量
            var countCategory5 = 50 - countCategory1 - countCategory2 - countCategory3 - countCategory4;
            
            // 在category1更新之前记住oldCategory5所有的Item
            if(countCategory >= 5) {
                // 记住oldCategory5Name
                var oldCategory5Name = document.getElementsByName("Category5Name")[0].value;

                // 记住oldCategory5所有的Item
                var Category5OtherInformationNameArray = new Array();
                var Category5OtherInformationTypeArray = new Array();
                var Category5OtherInformationContentArray = new Array();

                for(var i=oldCountCategory1+oldCountCategory2+oldCountCategory3+oldCountCategory4; i<oldCountCategory1+oldCountCategory2+oldCountCategory3+oldCountCategory4+oldCountCategory5; i++) {
                    if(!$(".sheetOtherInfoText").eq(i).children("input").prop('disabled')) {
                        Category5OtherInformationTypeArray.push($(".sheetOtherInfoText").eq(i).children("input").eq(0).val());
                    }
                    else if(!$(".sheetOtherInfoDorpdownList").eq(i).children("input").prop('disabled')) {
                        Category5OtherInformationTypeArray.push($(".sheetOtherInfoDorpdownList").eq(i).children("input").eq(0).val());
                        var DorpdownListContentLength = document.getElementsByName("OtherInformation"+(i+1)+"DorpdownListItem[]").length;
                        if(DorpdownListContentLength > 0) {
                            Category5OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3-oldCountCategory4] = new Array();
                            for(var j=0; j<DorpdownListContentLength; j++) {
                                if($(".sheetOtherInfoDorpdownListContent").eq(i).children("input").eq(j).val() != "" && $(".sheetOtherInfoDorpdownListContent").eq(i).children("input").eq(j).val() != undefined) {
                                    var content = $(".sheetOtherInfoDorpdownListContent").eq(i).children("input").eq(j).val();
                                    Category5OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3-oldCountCategory4].push(content); 
                                }
                            }
                        }
                    }
                    else if(!$(".sheetOtherInfoCheckBox").eq(i).children("input").prop('disabled')) {
                        Category5OtherInformationTypeArray.push($(".sheetOtherInfoCheckBox").eq(i).children("input").eq(0).val());
                        var CheckBoxContentLength = document.getElementsByName("OtherInformation"+(i+1)+"CheckBoxItem[]").length;
                        if(CheckBoxContentLength > 0) {
                            Category5OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3-oldCountCategory4] = new Array();
                            for(var j=0; j<CheckBoxContentLength; j++) {
                                if($(".sheetOtherInfoCheckBoxContent").eq(i).children("input").eq(j).val() != "" && $(".sheetOtherInfoCheckBoxContent").eq(i).children("input").eq(j).val() != undefined) {
                                    var content = $(".sheetOtherInfoCheckBoxContent").eq(i).children("input").eq(j).val();
                                    Category5OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3-oldCountCategory4].push(content);
                                }
                            }
                        }
                    }
                    else{
                        Category5OtherInformationTypeArray.push($(".sheetOtherInfoRadio").eq(i).children("input").eq(0).val());
                        var RadioContentLength = document.getElementsByName("OtherInformation"+(i+1)+"RadioItem[]").length;
                        if(RadioContentLength > 0) {
                            Category5OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3-oldCountCategory4] = new Array();
                            for(var j=0; j<RadioContentLength; j++) {
                                if($(".sheetOtherInfoRadioContent").eq(i).children("input").eq(j).val() != "" && $(".sheetOtherInfoRadioContent").eq(i).children("input").eq(j).val() != undefined) {
                                    var content = $(".sheetOtherInfoRadioContent").eq(i).children("input").eq(j).val();
                                    Category5OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3-oldCountCategory4].push(content);
                                }
                            }
                        }
                    }
                }

                for(var i=oldCountCategory1+oldCountCategory2+oldCountCategory3+oldCountCategory4; i<oldCountCategory1+oldCountCategory2+oldCountCategory3+oldCountCategory4+oldCountCategory5; i++) {
                    if(!$(".sheetOtherInfoText").eq(i).children("input").prop('disabled')) {
                        Category5OtherInformationNameArray.push($(".sheetOtherInfoText").eq(i).children("input").eq(1).val());
                    }
                    else if(!$(".sheetOtherInfoDorpdownList").eq(i).children("input").prop('disabled')) {
                        Category5OtherInformationNameArray.push($(".sheetOtherInfoDorpdownList").eq(i).children("input").eq(1).val());
                    }
                    else if(!$(".sheetOtherInfoCheckBox").eq(i).children("input").prop('disabled')) {
                        Category5OtherInformationNameArray.push($(".sheetOtherInfoCheckBox").eq(i).children("input").eq(1).val());
                    }
                    else{
                        Category5OtherInformationNameArray.push($(".sheetOtherInfoRadio").eq(i).children("input").eq(1).val());
                    }
                }
            }
            
            // For category4
            $('#sheetOtherInformationFieldset4').html("");
            $('#sheetOtherInformationFieldset4').append("<legend>Spread Sheet Other Information Category 4</legend>");
            $('#sheetOtherInformationFieldset4').append("<label class='label'>Category Name:</label>");
            $('#sheetOtherInformationFieldset4').append("<input type='text' class='CategoryName' name='Category4Name' autocomplete='off' placeholder='Category Name' /><br>");
            
            for(var i=countCategory1+countCategory2+countCategory3+1; i<=countCategory1+countCategory2+countCategory3+countCategory4; i++) {
                generateOtherInfoCategoryItems("#sheetOtherInformationFieldset4", i);
            }
            
            // 恢复之前的记录
            document.getElementsByName("Category4Name")[0].value = oldCategory4Name;
            
            for(var i=countCategory1+countCategory2+countCategory3; i<countCategory1+countCategory2+countCategory3+countCategory4; i++) {
                if(i < oldCountCategory1+oldCountCategory2+oldCountCategory3+oldCountCategory4) {
                    if(Category4OtherInformationTypeArray[i-countCategory1-countCategory2-countCategory3] == "Text") {
                        changeToTextOther(i);
                        $(".sheetOtherInfoText").eq(i).children("input").eq(1).val(Category4OtherInformationNameArray[i-countCategory1-countCategory2-countCategory3]);
                    }
                    else if(Category4OtherInformationTypeArray[i-countCategory1-countCategory2-countCategory3] == "DorpdownList") {
                        changeToDorpdownListOther(i);
                        $(".sheetOtherInfoDorpdownList").eq(i).children("input").eq(1).val(Category4OtherInformationNameArray[i-countCategory1-countCategory2-countCategory3]);
                        if(Category4OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3].length > 3) {
                            for(var j=0; j<(Category4OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3].length-3); j++) {
                                var content = document.getElementsByClassName("sheetOtherInfoDorpdownListContent")[i].innerHTML;
                                var newContent = "<input type='text' name='OtherInformation"+(i+1)+"DorpdownListItem[]' autocomplete='off' placeholder='Item (Dorpdown List)' />"
                                document.getElementsByClassName("sheetOtherInfoDorpdownListContent")[i].innerHTML = content + newContent;
                            }
                        }
                        for(var k=0; k<Category4OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3].length; k++) {
                            document.getElementsByName("OtherInformation"+(i+1)+"DorpdownListItem[]")[k].value = Category4OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3][k];
                        }
                    }
                    else if(Category4OtherInformationTypeArray[i-countCategory1-countCategory2-countCategory3] == "CheckBox") {
                        changeToCheckBoxOther(i);
                        $(".sheetOtherInfoCheckBox").eq(i).children("input").eq(1).val(Category4OtherInformationNameArray[i-countCategory1-countCategory2-countCategory3]);
                        if(Category4OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3].length > 3) {
                            for(var j=0; j<(Category4OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3].length-3); j++) {
                                var content = document.getElementsByClassName("sheetOtherInfoCheckBoxContent")[i].innerHTML;
                                var newContent = "<input type='text' name='OtherInformation"+(i+1)+"CheckBoxItem[]' autocomplete='off' placeholder='Item (CheckBox)' />"
                                document.getElementsByClassName("sheetOtherInfoCheckBoxContent")[i].innerHTML = content + newContent;
                            }
                        }
                        for(var k=0; k<Category4OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3].length; k++) {
                            document.getElementsByName("OtherInformation"+(i+1)+"CheckBoxItem[]")[k].value = Category4OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3][k];
                        }
                    }
                    else if(Category4OtherInformationTypeArray[i-countCategory1-countCategory2-countCategory3] == "Radio") {
                        changeToRadioOther(i);
                        $(".sheetOtherInfoRadio").eq(i).children("input").eq(1).val(Category4OtherInformationNameArray[i-countCategory1-countCategory2-countCategory3]);
                        if(Category4OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3].length > 3) {
                            for(var j=0; j<(Category4OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3].length-3); j++) {
                                var content = document.getElementsByClassName("sheetOtherInfoRadioContent")[i].innerHTML;
                                var newContent = "<input type='text' name='OtherInformation"+(i+1)+"RadioItem[]' autocomplete='off' placeholder='Item (Radio)' />"
                                document.getElementsByClassName("sheetOtherInfoRadioContent")[i].innerHTML = content + newContent;
                            }
                        }
                        for(var k=0; k<Category4OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3].length; k++) {
                            document.getElementsByName("OtherInformation"+(i+1)+"RadioItem[]")[k].value = Category4OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3][k];
                        }
                    }
                }
            }
            
            // Category1, Category2, Category3无需讨论
            var countCategory5;
            
            if(countCategory >= 4) {
                // 清除Category1的选项，必须要反着清除
                var oldCategory1OptionsLength = document.getElementById('category1').options.length;
                for(var i=oldCategory1OptionsLength-1; i>=0; i--) {
                    document.getElementById("category1").options.remove(i);
                }
                // 清除Category2的选项，必须要反着清除
                var oldCategory2OptionsLength = document.getElementById('category2').options.length;
                for(var i=oldCategory2OptionsLength-1; i>=0; i--) {
                    document.getElementById("category2").options.remove(i); 
                }
                // 清除Category3的选项，必须要反着清除
                var oldCategory3OptionsLength = document.getElementById('category3').options.length;
                for(var i=oldCategory3OptionsLength-1; i>=0; i--) {
                    document.getElementById("category3").options.remove(i); 
                }
            }
            if(countCategory >= 5) {
                // 获取当前Category5的option的数量
                countCategory5 = parseInt(document.getElementById("category5").value);
                
                // 清除Category5的选项，必须要反着清除
                var oldCategory5OptionsLength = document.getElementById('category5').options.length;
                for(var i=oldCategory5OptionsLength-1; i>=0; i--) {
                    document.getElementById("category5").options.remove(i);
                }
            }
            
            if(countCategory == 4) {
                // 重新加载Category1的选项
                for(var i=1; i<=(50-countCategory2-countCategory3-countCategory4); i++) {
                    document.getElementById("category1").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                }
                // 重新加载Category2的选项
                for(var i=1; i<=(50-countCategory1-countCategory3-countCategory4); i++) {
                    document.getElementById("category2").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                }
                // 重新加载Category3的选项
                for(var i=1; i<=(50-countCategory1-countCategory2-countCategory4); i++) {
                    document.getElementById("category3").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                }
            }
            else if(countCategory == 5) {
                // 重新加载Category1的选项
                for(var i=1; i<=(50-countCategory2-countCategory3-countCategory4-countCategory5); i++) {
                    document.getElementById("category1").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                }
                // 重新加载Category2的选项
                for(var i=1; i<=(50-countCategory1-countCategory3-countCategory4-countCategory5); i++) {
                    document.getElementById("category2").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                }
                // 重新加载Category3的选项
                for(var i=1; i<=(50-countCategory1-countCategory2-countCategory4-countCategory5); i++) {
                    document.getElementById("category3").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                }
                // 重新加载Category5的选项
                for(var i=1; i<=(50-countCategory1-countCategory2-countCategory3-countCategory4); i++) {
                    document.getElementById("category5").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                }
            }
            
            if(countCategory >= 4) {
                // 保持选中
                document.getElementById('category1').options[countCategory1-1].selected = true;
                document.getElementById('category2').options[countCategory2-1].selected = true;
                document.getElementById('category3').options[countCategory3-1].selected = true;
            }
            if(countCategory >= 5) {
                // 保持选中
                document.getElementById('category5').options[countCategory5-1].selected = true;
                
                $('#sheetOtherInformationFieldset5').html("");
                $('#sheetOtherInformationFieldset5').append("<legend>Spread Sheet Other Information Category 5</legend>");
                $('#sheetOtherInformationFieldset5').append("<label class='label'>Category Name:</label>");
                $('#sheetOtherInformationFieldset5').append("<input type='text' class='CategoryName' name='Category5Name' autocomplete='off' placeholder='Category Name' /><br>");
                
                for(var i=countCategory1+countCategory2+countCategory3+countCategory4+1; i<=countCategory1+countCategory2+countCategory3+countCategory4+countCategory5; i++) {
                    generateOtherInfoCategoryItems("#sheetOtherInformationFieldset5", i);
                }
                
                // 恢复之前的记录
                document.getElementsByName("Category5Name")[0].value = oldCategory5Name;
                for(var i=countCategory1+countCategory2+countCategory3+countCategory4; i<countCategory1+countCategory2+countCategory3+countCategory4+countCategory5; i++) {
                    if(i < countCategory1+countCategory2+countCategory3+countCategory4+oldCountCategory5) {
                        if(Category5OtherInformationTypeArray[i-countCategory1-countCategory2-countCategory3-countCategory4] == "Text") {
                            changeToTextOther(i);
                            $(".sheetOtherInfoText").eq(i).children("input").eq(1).val(Category5OtherInformationNameArray[i-countCategory1-countCategory2-countCategory3-countCategory4]);
                        }
                        else if(Category5OtherInformationTypeArray[i-countCategory1-countCategory2-countCategory3-countCategory4] == "DorpdownList") {
                            changeToDorpdownListOther(i);
                            $(".sheetOtherInfoDorpdownList").eq(i).children("input").eq(1).val(Category5OtherInformationNameArray[i-countCategory1-countCategory2-countCategory3-countCategory4]);
                            if(Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4].length > 3) {
                                for(var j=0; j<(Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4].length-3); j++) {
                                    var content = document.getElementsByClassName("sheetOtherInfoDorpdownListContent")[i].innerHTML;
                                    var newContent = "<input type='text' name='OtherInformation"+(i+1)+"DorpdownListItem[]' autocomplete='off' placeholder='Item (Dorpdown List)' />"
                                    document.getElementsByClassName("sheetOtherInfoDorpdownListContent")[i].innerHTML = content + newContent;
                                }
                            }
                            for(var k=0; k<Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4].length; k++) {
                                document.getElementsByName("OtherInformation"+(i+1)+"DorpdownListItem[]")[k].value = Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4][k];
                            }
                        }
                        else if(Category5OtherInformationTypeArray[i-countCategory1-countCategory2-countCategory3-countCategory4] == "CheckBox") {
                            changeToCheckBoxOther(i);
                            $(".sheetOtherInfoCheckBox").eq(i).children("input").eq(1).val(Category5OtherInformationNameArray[i-countCategory1-countCategory2-countCategory3-countCategory4]);
                            if(Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4].length > 3) {
                                for(var j=0; j<(Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4].length-3); j++) {
                                    var content = document.getElementsByClassName("sheetOtherInfoCheckBoxContent")[i].innerHTML;
                                    var newContent = "<input type='text' name='OtherInformation"+(i+1)+"CheckBoxItem[]' autocomplete='off' placeholder='Item (CheckBox)' />"
                                    document.getElementsByClassName("sheetOtherInfoCheckBoxContent")[i].innerHTML = content + newContent;
                                }
                            }
                            for(var k=0; k<Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4].length; k++) {
                                document.getElementsByName("OtherInformation"+(i+1)+"CheckBoxItem[]")[k].value = Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4][k];
                            }
                        }
                        else if(Category5OtherInformationTypeArray[i-countCategory1-countCategory2-countCategory3-countCategory4] == "Radio") {
                            changeToRadioOther(i);
                            $(".sheetOtherInfoRadio").eq(i).children("input").eq(1).val(Category5OtherInformationNameArray[i-countCategory1-countCategory2-countCategory3-countCategory4]);
                            if(Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4].length > 3) {
                                for(var j=0; j<(Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4].length-3); j++) {
                                    var content = document.getElementsByClassName("sheetOtherInfoRadioContent")[i].innerHTML;
                                    var newContent = "<input type='text' name='OtherInformation"+(i+1)+"RadioItem[]' autocomplete='off' placeholder='Item (Radio)' />"
                                    document.getElementsByClassName("sheetOtherInfoRadioContent")[i].innerHTML = content + newContent;
                                }
                            }
                            for(var k=0; k<Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4].length; k++) {
                                document.getElementsByName("OtherInformation"+(i+1)+"RadioItem[]")[k].value = Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4][k];
                            }
                        }
                    }
                }
                
                oldCountCategory5 = countCategory5;
            }
            
            // 如果超过50就不可以再加新的Category
            if(countCategory == 4){
                if(countCategory1+countCategory2+countCategory3+countCategory4 == 50) {
                    // 清除Category的选项，必须要反着清除
                    var oldCategoryOptionsLength = document.getElementById('otherInformationCategory').options.length;
                    for(var i=oldCategoryOptionsLength-1; i>=0; i--) {
                        document.getElementById("otherInformationCategory").options.remove(i);
                    }
                    // 重新加载Category的选项
                    for(var i=1; i<=4; i++) {
                        document.getElementById("otherInformationCategory").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    }
                    // 保持选中
                    document.getElementById('otherInformationCategory').options[countCategory-1].selected = true;
                }
                else {
                    // 清除Category的选项，必须要反着清除
                    var oldCategoryOptionsLength = document.getElementById('otherInformationCategory').options.length;
                    for(var i=oldCategoryOptionsLength-1; i>=0; i--) {
                        document.getElementById("otherInformationCategory").options.remove(i);
                    }
                    // 重新加载Category的选项
                    for(var i=1; i<=5; i++) {
                        document.getElementById("otherInformationCategory").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                    }
                    // 保持选中
                    document.getElementById('otherInformationCategory').options[countCategory-1].selected = true;
                }
            }
            
            // 记住新的CountCategory4作为下次使用
            oldCountCategory4 = countCategory4;
        });
        
        // 如果Category5有变化
        $(document).delegate("#category5", "change", function () {
            // 记住oldCategory5Name
            var oldCategory5Name = document.getElementsByName("Category5Name")[0].value;
            
            // 记住oldCategory5所有的Item
            var Category5OtherInformationNameArray = new Array();
            var Category5OtherInformationTypeArray = new Array();
            var Category5OtherInformationContentArray = new Array();
            
            for(var i=oldCountCategory1+oldCountCategory2+oldCountCategory3+oldCountCategory4; i<oldCountCategory1+oldCountCategory2+oldCountCategory3+oldCountCategory4+oldCountCategory5; i++) {
                if(!$(".sheetOtherInfoText").eq(i).children("input").prop('disabled')) {
                    Category5OtherInformationTypeArray.push($(".sheetOtherInfoText").eq(i).children("input").eq(0).val());
                }
                else if(!$(".sheetOtherInfoDorpdownList").eq(i).children("input").prop('disabled')) {
                    Category5OtherInformationTypeArray.push($(".sheetOtherInfoDorpdownList").eq(i).children("input").eq(0).val());
                    var DorpdownListContentLength = document.getElementsByName("OtherInformation"+(i+1)+"DorpdownListItem[]").length;
                    if(DorpdownListContentLength > 0) {
                        Category5OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3-oldCountCategory4] = new Array();
                        for(var j=0; j<DorpdownListContentLength; j++) {
                            if($(".sheetOtherInfoDorpdownListContent").eq(i).children("input").eq(j).val() != "" && $(".sheetOtherInfoDorpdownListContent").eq(i).children("input").eq(j).val() != undefined) {
                                var content = $(".sheetOtherInfoDorpdownListContent").eq(i).children("input").eq(j).val();
                                Category5OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3-oldCountCategory4].push(content); 
                            }
                        }
                    }
                }
                else if(!$(".sheetOtherInfoCheckBox").eq(i).children("input").prop('disabled')) {
                    Category5OtherInformationTypeArray.push($(".sheetOtherInfoCheckBox").eq(i).children("input").eq(0).val());
                    var CheckBoxContentLength = document.getElementsByName("OtherInformation"+(i+1)+"CheckBoxItem[]").length;
                    if(CheckBoxContentLength > 0) {
                        Category5OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3-oldCountCategory4] = new Array();
                        for(var j=0; j<CheckBoxContentLength; j++) {
                            if($(".sheetOtherInfoCheckBoxContent").eq(i).children("input").eq(j).val() != "" && $(".sheetOtherInfoCheckBoxContent").eq(i).children("input").eq(j).val() != undefined) {
                                var content = $(".sheetOtherInfoCheckBoxContent").eq(i).children("input").eq(j).val();
                                Category5OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3-oldCountCategory4].push(content);
                            }
                        }
                    }
                }
                else{
                    Category5OtherInformationTypeArray.push($(".sheetOtherInfoRadio").eq(i).children("input").eq(0).val());
                    var RadioContentLength = document.getElementsByName("OtherInformation"+(i+1)+"RadioItem[]").length;
                    if(RadioContentLength > 0) {
                        Category5OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3-oldCountCategory4] = new Array();
                        for(var j=0; j<RadioContentLength; j++) {
                            if($(".sheetOtherInfoRadioContent").eq(i).children("input").eq(j).val() != "" && $(".sheetOtherInfoRadioContent").eq(i).children("input").eq(j).val() != undefined) {
                                var content = $(".sheetOtherInfoRadioContent").eq(i).children("input").eq(j).val();
                                Category5OtherInformationContentArray[i-oldCountCategory1-oldCountCategory2-oldCountCategory3-oldCountCategory4].push(content);
                            }
                        }
                    }
                }
            }
            
            for(var i=oldCountCategory1+oldCountCategory2+oldCountCategory3+oldCountCategory4; i<oldCountCategory1+oldCountCategory2+oldCountCategory3+oldCountCategory4+oldCountCategory5; i++) {
                if(!$(".sheetOtherInfoText").eq(i).children("input").prop('disabled')) {
                    Category5OtherInformationNameArray.push($(".sheetOtherInfoText").eq(i).children("input").eq(1).val());
                }
                else if(!$(".sheetOtherInfoDorpdownList").eq(i).children("input").prop('disabled')) {
                    Category5OtherInformationNameArray.push($(".sheetOtherInfoDorpdownList").eq(i).children("input").eq(1).val());
                }
                else if(!$(".sheetOtherInfoCheckBox").eq(i).children("input").prop('disabled')) {
                    Category5OtherInformationNameArray.push($(".sheetOtherInfoCheckBox").eq(i).children("input").eq(1).val());
                }
                else{
                    Category5OtherInformationNameArray.push($(".sheetOtherInfoRadio").eq(i).children("input").eq(1).val());
                }
            }
            
            // 获取当前一共有多少个Category
            var countCategory = document.getElementById("otherInformationCategory").value;
            
            // 获取当前Category1和Category2和Category3的option的数量
            var countCategory1 = parseInt(document.getElementById("category1").value);
            var countCategory2 = parseInt(document.getElementById("category2").value);
            var countCategory3 = parseInt(document.getElementById("category3").value);
            var countCategory4 = parseInt(document.getElementById("category4").value);
            var countCategory5 = parseInt(document.getElementById("category5").value);
            
            // For category5
            $('#sheetOtherInformationFieldset5').html("");
            $('#sheetOtherInformationFieldset5').append("<legend>Spread Sheet Other Information Category 5</legend>");
            $('#sheetOtherInformationFieldset5').append("<label class='label'>Category Name:</label>");
            $('#sheetOtherInformationFieldset5').append("<input type='text' class='CategoryName' name='Category5Name' autocomplete='off' placeholder='Category Name' /><br>");
            
            for(var i=countCategory1+countCategory2+countCategory3+countCategory4+1; i<=countCategory1+countCategory2+countCategory3+countCategory4+countCategory5; i++) {
                generateOtherInfoCategoryItems("#sheetOtherInformationFieldset5", i);
            }
            
            // 恢复之前的记录
            document.getElementsByName("Category5Name")[0].value = oldCategory5Name;
            
            for(var i=countCategory1+countCategory2+countCategory3+countCategory4; i<countCategory1+countCategory2+countCategory3+countCategory4+countCategory5; i++) {
                if(i < oldCountCategory1+oldCountCategory2+oldCountCategory3+oldCountCategory4+oldCountCategory5) {
                    if(Category5OtherInformationTypeArray[i-countCategory1-countCategory2-countCategory3-countCategory4] == "Text") {
                        changeToTextOther(i);
                        $(".sheetOtherInfoText").eq(i).children("input").eq(1).val(Category5OtherInformationNameArray[i-countCategory1-countCategory2-countCategory3-countCategory4]);
                    }
                    else if(Category5OtherInformationTypeArray[i-countCategory1-countCategory2-countCategory3-countCategory4] == "DorpdownList") {
                        changeToDorpdownListOther(i);
                        $(".sheetOtherInfoDorpdownList").eq(i).children("input").eq(1).val(Category5OtherInformationNameArray[i-countCategory1-countCategory2-countCategory3-countCategory4]);
                        if(Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4].length > 3) {
                            for(var j=0; j<(Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4].length-3); j++) {
                                var content = document.getElementsByClassName("sheetOtherInfoDorpdownListContent")[i].innerHTML;
                                var newContent = "<input type='text' name='OtherInformation"+(i+1)+"DorpdownListItem[]' autocomplete='off' placeholder='Item (Dorpdown List)' />"
                                document.getElementsByClassName("sheetOtherInfoDorpdownListContent")[i].innerHTML = content + newContent;
                            }
                        }
                        for(var k=0; k<Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4].length; k++) {
                            document.getElementsByName("OtherInformation"+(i+1)+"DorpdownListItem[]")[k].value = Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4][k];
                        }
                    }
                    else if(Category5OtherInformationTypeArray[i-countCategory1-countCategory2-countCategory3-countCategory4] == "CheckBox") {
                        changeToCheckBoxOther(i);
                        $(".sheetOtherInfoCheckBox").eq(i).children("input").eq(1).val(Category5OtherInformationNameArray[i-countCategory1-countCategory2-countCategory3-countCategory4]);
                        if(Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4].length > 3) {
                            for(var j=0; j<(Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4].length-3); j++) {
                                var content = document.getElementsByClassName("sheetOtherInfoCheckBoxContent")[i].innerHTML;
                                var newContent = "<input type='text' name='OtherInformation"+(i+1)+"CheckBoxItem[]' autocomplete='off' placeholder='Item (CheckBox)' />"
                                document.getElementsByClassName("sheetOtherInfoCheckBoxContent")[i].innerHTML = content + newContent;
                            }
                        }
                        for(var k=0; k<Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4].length; k++) {
                            document.getElementsByName("OtherInformation"+(i+1)+"CheckBoxItem[]")[k].value = Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4][k];
                        }
                    }
                    else if(Category5OtherInformationTypeArray[i-countCategory1-countCategory2-countCategory3-countCategory4] == "Radio") {
                        changeToRadioOther(i);
                        $(".sheetOtherInfoRadio").eq(i).children("input").eq(1).val(Category5OtherInformationNameArray[i-countCategory1-countCategory2-countCategory3-countCategory4]);
                        if(Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4].length > 3) {
                            for(var j=0; j<(Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4].length-3); j++) {
                                var content = document.getElementsByClassName("sheetOtherInfoRadioContent")[i].innerHTML;
                                var newContent = "<input type='text' name='OtherInformation"+(i+1)+"RadioItem[]' autocomplete='off' placeholder='Item (Radio)' />"
                                document.getElementsByClassName("sheetOtherInfoRadioContent")[i].innerHTML = content + newContent;
                            }
                        }
                        for(var k=0; k<Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4].length; k++) {
                            document.getElementsByName("OtherInformation"+(i+1)+"RadioItem[]")[k].value = Category5OtherInformationContentArray[i-countCategory1-countCategory2-countCategory3-countCategory4][k];
                        }
                    }
                }
            }
            
            // Category1, Category2, Category3, Category4无需讨论
            if(countCategory >= 5) {
                // 清除Category1的选项，必须要反着清除
                var oldCategory1OptionsLength = document.getElementById('category1').options.length;
                for(var i=oldCategory1OptionsLength-1; i>=0; i--) {
                    document.getElementById("category1").options.remove(i);
                }
                // 清除Category2的选项，必须要反着清除
                var oldCategory2OptionsLength = document.getElementById('category2').options.length;
                for(var i=oldCategory2OptionsLength-1; i>=0; i--) {
                    document.getElementById("category2").options.remove(i); 
                }
                // 清除Category3的选项，必须要反着清除
                var oldCategory3OptionsLength = document.getElementById('category3').options.length;
                for(var i=oldCategory3OptionsLength-1; i>=0; i--) {
                    document.getElementById("category3").options.remove(i); 
                }
                // 清除Category4的选项，必须要反着清除
                var oldCategory4OptionsLength = document.getElementById('category4').options.length;
                for(var i=oldCategory4OptionsLength-1; i>=0; i--) {
                    document.getElementById("category4").options.remove(i); 
                }
                
                // 重新加载Category1的选项
                for(var i=1; i<=(50-countCategory2-countCategory3-countCategory4-countCategory5); i++) {
                    document.getElementById("category1").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                }
                // 重新加载Category2的选项
                for(var i=1; i<=(50-countCategory1-countCategory3-countCategory4-countCategory5); i++) {
                    document.getElementById("category2").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                }
                // 重新加载Category3的选项
                for(var i=1; i<=(50-countCategory1-countCategory2-countCategory4-countCategory5); i++) {
                    document.getElementById("category3").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                }
                // 重新加载Category4的选项
                for(var i=1; i<=(50-countCategory1-countCategory2-countCategory3-countCategory5); i++) {
                    document.getElementById("category4").options.add(new Option("\u00A0\u00A0\u00A0" + i,i));
                }
                
                // 保持选中
                document.getElementById('category1').options[countCategory1-1].selected = true;
                document.getElementById('category2').options[countCategory2-1].selected = true;
                document.getElementById('category3').options[countCategory3-1].selected = true;
                document.getElementById('category4').options[countCategory4-1].selected = true;
            }
            
            // 记住新的CountCategory5作为下次使用
            oldCountCategory5 = countCategory5;
        });
        
        // 函数，生成Category Items
        function generateOtherInfoCategoryItems(sheetOtherInformationFieldset, i) {
            $(sheetOtherInformationFieldset).append("<label class='label'>Information "+i+" :</label>");

            var sheetOtherInfoText = $("<div class='sheetOtherInfoText'>");
            sheetOtherInfoText.append("<input type='hidden' name='OtherInformationType"+i+"' value='Text' />");
            sheetOtherInfoText.append("<input type='text' class='OtherInformation' name='OtherInformationName"+i+"' autocomplete='off' placeholder='Name (Text)' />");
            $(sheetOtherInformationFieldset).append(sheetOtherInfoText);

            var sheetOtherInfoDorpdownList = $("<div class='sheetOtherInfoDorpdownList'>");
            sheetOtherInfoDorpdownList.append("<input type='hidden' name='OtherInformationType"+i+"' value='DorpdownList' disabled/>");
            sheetOtherInfoDorpdownList.append("<input type='text' class='OtherInformation' name='OtherInformationName"+i+"' autocomplete='off' placeholder='Name (Dorpdown List)' disabled/>");
            $(sheetOtherInformationFieldset).append(sheetOtherInfoDorpdownList);

            var sheetOtherInfoCheckBox = $("<div class='sheetOtherInfoCheckBox'>");
            sheetOtherInfoCheckBox.append("<input type='hidden' name='OtherInformationType"+i+"' value='CheckBox' disabled/>");
            sheetOtherInfoCheckBox.append("<input type='text' class='OtherInformation' name='OtherInformationName"+i+"' autocomplete='off' placeholder='Name (CheckBox)' disabled/>");
            $(sheetOtherInformationFieldset).append(sheetOtherInfoCheckBox);

            var sheetOtherInfoRadio = $("<div class='sheetOtherInfoRadio'>");
            sheetOtherInfoRadio.append("<input type='hidden' name='OtherInformationType"+i+"' value='Radio' disabled/>");
            sheetOtherInfoRadio.append("<input type='text' class='OtherInformation' name='OtherInformationName"+i+"' autocomplete='off' placeholder='Name (Radio)' disabled/>");
            $(sheetOtherInformationFieldset).append(sheetOtherInfoRadio);

            var sheetOtherInfoButtonContainer = $("<div class='sheetOtherInfoButtonContainer'>");
            sheetOtherInfoButtonContainer.append("<button class='TextBTNOther' type='button' onclick='changeToTextOther("+(i-1)+")'>Text</button>");
            sheetOtherInfoButtonContainer.append("<button class='DorpdownListBTNOther' type='button' onclick='changeToDorpdownListOther("+(i-1)+")'>Dorpdown List</button>");
            sheetOtherInfoButtonContainer.append("<button class='CheckBoxBTNOther' type='button' onclick='changeToCheckBoxOther("+(i-1)+")'>CheckBox</button>");
            sheetOtherInfoButtonContainer.append("<button class='RadioBTNOther' type='button' onclick='changeToRadioOther("+(i-1)+")'>Radio</button>");
            $(sheetOtherInformationFieldset).append(sheetOtherInfoButtonContainer);

            $(sheetOtherInformationFieldset).append("<br>");

            var sheetOtherInfoInput = $("<div class='sheetOtherInfoInput'>");
            sheetOtherInfoInput.append("<label class='label'><img class='plusImg' src='../image/plus.png' width='14px;' onclick='addItemOther("+(i-1)+")'/><br><img class='minusImg' src='../image/minus.png' width='14px;' onclick='removeItemOther("+(i-1)+")'/></label>");
            var sheetOtherInfoDorpdownListContent = $("<div class='sheetOtherInfoDorpdownListContent'>");
            sheetOtherInfoDorpdownListContent.append("<input type='text' name='OtherInformation"+i+"DorpdownListItem[]' autocomplete='off' placeholder='Item (Dorpdown List)' disabled/>");
            sheetOtherInfoDorpdownListContent.append("<input type='text' name='OtherInformation"+i+"DorpdownListItem[]' autocomplete='off' placeholder='Item (Dorpdown List)' disabled/>");
            sheetOtherInfoDorpdownListContent.append("<input type='text' name='OtherInformation"+i+"DorpdownListItem[]' autocomplete='off' placeholder='Item (Dorpdown List)' disabled/>");
            sheetOtherInfoInput.append(sheetOtherInfoDorpdownListContent);
            var sheetOtherInfoCheckBoxContent = $("<div class='sheetOtherInfoCheckBoxContent'>");
            sheetOtherInfoCheckBoxContent.append("<input type='text' name='OtherInformation"+i+"CheckBoxItem[]' autocomplete='off' placeholder='Item (CheckBox)' disabled/>");
            sheetOtherInfoCheckBoxContent.append("<input type='text' name='OtherInformation"+i+"CheckBoxItem[]' autocomplete='off' placeholder='Item (CheckBox)' disabled/>");
            sheetOtherInfoCheckBoxContent.append("<input type='text' name='OtherInformation"+i+"CheckBoxItem[]' autocomplete='off' placeholder='Item (CheckBox)' disabled/>");
            sheetOtherInfoInput.append(sheetOtherInfoCheckBoxContent);
            var sheetOtherInfoRadioContent = $("<div class='sheetOtherInfoRadioContent'>");
            sheetOtherInfoRadioContent.append("<input type='text' name='OtherInformation"+i+"RadioItem[]' autocomplete='off' placeholder='Item (Radio)' disabled/>");
            sheetOtherInfoRadioContent.append("<input type='text' name='OtherInformation"+i+"RadioItem[]' autocomplete='off' placeholder='Item (Radio)' disabled/>");
            sheetOtherInfoRadioContent.append("<input type='text' name='OtherInformation"+i+"RadioItem[]' autocomplete='off' placeholder='Item (Radio)' disabled/>");
            sheetOtherInfoInput.append(sheetOtherInfoRadioContent);
            $(sheetOtherInformationFieldset).append(sheetOtherInfoInput);
        }
    });
    
    // Text, Dropdown lIst, Checkbox, Radio 切换
    function changeToTextOther(id) {
        document.getElementsByClassName("TextBTNOther")[id].style.display = "none";
        document.getElementsByClassName("DorpdownListBTNOther")[id].style.display = "inline";
        document.getElementsByClassName("CheckBoxBTNOther")[id].style.display = "inline";
        document.getElementsByClassName("RadioBTNOther")[id].style.display = "inline";
        
        document.getElementsByClassName("sheetOtherInfoText")[id].style.display = "inline-block";
        document.getElementsByClassName("sheetOtherInfoDorpdownList")[id].style.display = "none";
        document.getElementsByClassName("sheetOtherInfoCheckBox")[id].style.display = "none";
        document.getElementsByClassName("sheetOtherInfoRadio")[id].style.display = "none";
        
        $(document).ready(() => {
            var temp = "";
            if($(".sheetOtherInfoDorpdownList").eq(id).children("input").eq(1).val() != "") {
                temp = $(".sheetOtherInfoDorpdownList").eq(id).children("input").eq(1).val();
            }
            else if($(".sheetOtherInfoCheckBox").eq(id).children("input").eq(1).val() != "") {
                temp = $(".sheetOtherInfoCheckBox").eq(id).children("input").eq(1).val();
            }
            else if($(".sheetOtherInfoRadio").eq(id).children("input").eq(1).val() != "") {
                temp = $(".sheetOtherInfoRadio").eq(id).children("input").eq(1).val();
            }
            $(".sheetOtherInfoText").eq(id).children("input").prop('disabled', false);
            $(".sheetOtherInfoDorpdownList").eq(id).children("input").prop('disabled', true);
            $(".sheetOtherInfoCheckBox").eq(id).children("input").prop('disabled', true);
            $(".sheetOtherInfoRadio").eq(id).children("input").prop('disabled', true);
            $(".sheetOtherInfoDorpdownList").eq(id).children("input").val("");
            $(".sheetOtherInfoCheckBox").eq(id).children("input").val("");
            $(".sheetOtherInfoRadio").eq(id).children("input").val("");
            $(".sheetOtherInfoText").eq(id).children("input").eq(0).val("Text");
            $(".sheetOtherInfoText").eq(id).children("input").eq(1).val(temp);
        });
        
        document.getElementsByClassName("sheetOtherInfoInput")[id].style.display = "none";
        document.getElementsByClassName("sheetOtherInfoDorpdownListContent")[id].style.display = "none";
        document.getElementsByClassName("sheetOtherInfoCheckBoxContent")[id].style.display = "none";
        document.getElementsByClassName("sheetOtherInfoRadioContent")[id].style.display = "none";
        
        $(document).ready(() => {
            $(".sheetOtherInfoDorpdownListContent").eq(id).children("input").prop('disabled', true);
            $(".sheetOtherInfoCheckBoxContent").eq(id).children("input").prop('disabled', true);
            $(".sheetOtherInfoRadioContent").eq(id).children("input").prop('disabled', true);
            $(".sheetOtherInfoDorpdownListContent").eq(id).children("input").val("");
            $(".sheetOtherInfoCheckBoxContent").eq(id).children("input").val("");
            $(".sheetOtherInfoRadioContent").eq(id).children("input").val("");
        });
    }
    
    function changeToDorpdownListOther(id) {
        document.getElementsByClassName("TextBTNOther")[id].style.display = "inline";
        document.getElementsByClassName("DorpdownListBTNOther")[id].style.display = "none";
        document.getElementsByClassName("CheckBoxBTNOther")[id].style.display = "inline";
        document.getElementsByClassName("RadioBTNOther")[id].style.display = "inline";
        
        document.getElementsByClassName("sheetOtherInfoText")[id].style.display = "none";
        document.getElementsByClassName("sheetOtherInfoDorpdownList")[id].style.display = "inline-block";
        document.getElementsByClassName("sheetOtherInfoCheckBox")[id].style.display = "none";
        document.getElementsByClassName("sheetOtherInfoRadio")[id].style.display = "none";
        
        $(document).ready(() => {
            var temp = "";
            if($(".sheetOtherInfoText").eq(id).children("input").eq(1).val() != "") {
                temp = $(".sheetOtherInfoText").eq(id).children("input").eq(1).val();
            }
            else if($(".sheetOtherInfoCheckBox").eq(id).children("input").eq(1).val() != "") {
                temp = $(".sheetOtherInfoCheckBox").eq(id).children("input").eq(1).val();
            }
            else if($(".sheetOtherInfoRadio").eq(id).children("input").eq(1).val() != "") {
                temp = $(".sheetOtherInfoRadio").eq(id).children("input").eq(1).val();
            }
            $(".sheetOtherInfoText").eq(id).children("input").prop('disabled', true);
            $(".sheetOtherInfoDorpdownList").eq(id).children("input").prop('disabled', false);
            $(".sheetOtherInfoCheckBox").eq(id).children("input").prop('disabled', true);
            $(".sheetOtherInfoRadio").eq(id).children("input").prop('disabled', true);
            $(".sheetOtherInfoText").eq(id).children("input").val("");
            $(".sheetOtherInfoCheckBox").eq(id).children("input").val("");
            $(".sheetOtherInfoRadio").eq(id).children("input").val("");
            $(".sheetOtherInfoDorpdownList").eq(id).children("input").eq(0).val("DorpdownList");
            $(".sheetOtherInfoDorpdownList").eq(id).children("input").eq(1).val(temp);
        });
        
        document.getElementsByClassName("sheetOtherInfoInput")[id].style.display = "block";
        document.getElementsByClassName("sheetOtherInfoDorpdownListContent")[id].style.display = "inline-block";
        document.getElementsByClassName("sheetOtherInfoCheckBoxContent")[id].style.display = "none";
        document.getElementsByClassName("sheetOtherInfoRadioContent")[id].style.display = "none";
        
        $(document).ready(() => {
            $(".sheetOtherInfoDorpdownListContent").eq(id).children("input").prop('disabled', false);
            $(".sheetOtherInfoCheckBoxContent").eq(id).children("input").prop('disabled', true);
            $(".sheetOtherInfoRadioContent").eq(id).children("input").prop('disabled', true);
            $(".sheetOtherInfoCheckBoxContent").eq(id).children("input").val("");
            $(".sheetOtherInfoRadioContent").eq(id).children("input").val("");
        });
    }
    
    function changeToCheckBoxOther(id) {
        document.getElementsByClassName("TextBTNOther")[id].style.display = "inline";
        document.getElementsByClassName("DorpdownListBTNOther")[id].style.display = "inline";
        document.getElementsByClassName("CheckBoxBTNOther")[id].style.display = "none";
        document.getElementsByClassName("RadioBTNOther")[id].style.display = "inline";
        
        document.getElementsByClassName("sheetOtherInfoText")[id].style.display = "none";
        document.getElementsByClassName("sheetOtherInfoDorpdownList")[id].style.display = "none";
        document.getElementsByClassName("sheetOtherInfoCheckBox")[id].style.display = "inline-block";
        document.getElementsByClassName("sheetOtherInfoRadio")[id].style.display = "none";
        
        $(document).ready(() => {
            var temp = "";
            if($(".sheetOtherInfoText").eq(id).children("input").eq(1).val() != "") {
                temp = $(".sheetOtherInfoText").eq(id).children("input").eq(1).val();
            }
            else if($(".sheetOtherInfoDorpdownList").eq(id).children("input").eq(1).val() != "") {
                temp = $(".sheetOtherInfoDorpdownList").eq(id).children("input").eq(1).val();
            }
            else if($(".sheetOtherInfoRadio").eq(id).children("input").eq(1).val() != "") {
                temp = $(".sheetOtherInfoRadio").eq(id).children("input").eq(1).val();
            }
            $(".sheetOtherInfoText").eq(id).children("input").prop('disabled', true);
            $(".sheetOtherInfoDorpdownList").eq(id).children("input").prop('disabled', true);
            $(".sheetOtherInfoCheckBox").eq(id).children("input").prop('disabled', false);
            $(".sheetOtherInfoRadio").eq(id).children("input").prop('disabled', true);
            $(".sheetOtherInfoText").eq(id).children("input").val("");
            $(".sheetOtherInfoDorpdownList").eq(id).children("input").val("");
            $(".sheetOtherInfoRadio").eq(id).children("input").val("");
            $(".sheetOtherInfoCheckBox").eq(id).children("input").eq(0).val("CheckBox");
            $(".sheetOtherInfoCheckBox").eq(id).children("input").eq(1).val(temp);
        });
        
        document.getElementsByClassName("sheetOtherInfoInput")[id].style.display = "block";
        document.getElementsByClassName("sheetOtherInfoDorpdownListContent")[id].style.display = "none";
        document.getElementsByClassName("sheetOtherInfoCheckBoxContent")[id].style.display = "inline-block";
        document.getElementsByClassName("sheetOtherInfoRadioContent")[id].style.display = "none";
        
        $(document).ready(() => {
            $(".sheetOtherInfoDorpdownListContent").eq(id).children("input").prop('disabled', true);
            $(".sheetOtherInfoCheckBoxContent").eq(id).children("input").prop('disabled', false);
            $(".sheetOtherInfoRadioContent").eq(id).children("input").prop('disabled', true);
            $(".sheetOtherInfoDorpdownListContent").eq(id).children("input").val("");
            $(".sheetOtherInfoRadioContent").eq(id).children("input").val("");
        });
    }
    
    function changeToRadioOther(id) {
        document.getElementsByClassName("TextBTNOther")[id].style.display = "inline";
        document.getElementsByClassName("DorpdownListBTNOther")[id].style.display = "inline";
        document.getElementsByClassName("CheckBoxBTNOther")[id].style.display = "inline";
        document.getElementsByClassName("RadioBTNOther")[id].style.display = "none";
        
        document.getElementsByClassName("sheetOtherInfoText")[id].style.display = "none";
        document.getElementsByClassName("sheetOtherInfoDorpdownList")[id].style.display = "none";
        document.getElementsByClassName("sheetOtherInfoCheckBox")[id].style.display = "none";
        document.getElementsByClassName("sheetOtherInfoRadio")[id].style.display = "inline-block";
        
        $(document).ready(() => {
            var temp = "";
            if($(".sheetOtherInfoText").eq(id).children("input").eq(1).val() != "") {
                temp = $(".sheetOtherInfoText").eq(id).children("input").eq(1).val();
            }
            else if($(".sheetOtherInfoDorpdownList").eq(id).children("input").eq(1).val() != "") {
                temp = $(".sheetOtherInfoDorpdownList").eq(id).children("input").eq(1).val();
            }
            else if($(".sheetOtherInfoCheckBox").eq(id).children("input").eq(1).val() != "") {
                temp = $(".sheetOtherInfoCheckBox").eq(id).children("input").eq(1).val();
            }
            $(".sheetOtherInfoText").eq(id).children("input").prop('disabled', true);
            $(".sheetOtherInfoDorpdownList").eq(id).children("input").prop('disabled', true);
            $(".sheetOtherInfoCheckBox").eq(id).children("input").prop('disabled', true);
            $(".sheetOtherInfoRadio").eq(id).children("input").prop('disabled', false);
            $(".sheetOtherInfoText").eq(id).children("input").val("");
            $(".sheetOtherInfoDorpdownList").eq(id).children("input").val("");
            $(".sheetOtherInfoCheckBox").eq(id).children("input").val("");
            $(".sheetOtherInfoRadio").eq(id).children("input").eq(0).val("Radio");
            $(".sheetOtherInfoRadio").eq(id).children("input").eq(1).val(temp);
        });
        
        document.getElementsByClassName("sheetOtherInfoInput")[id].style.display = "block";
        document.getElementsByClassName("sheetOtherInfoDorpdownListContent")[id].style.display = "none";
        document.getElementsByClassName("sheetOtherInfoCheckBoxContent")[id].style.display = "none";
        document.getElementsByClassName("sheetOtherInfoRadioContent")[id].style.display = "inline-block";
        
        $(document).ready(() => {
            $(".sheetOtherInfoDorpdownListContent").eq(id).children("input").prop('disabled', true);
            $(".sheetOtherInfoCheckBoxContent").eq(id).children("input").prop('disabled', true);
            $(".sheetOtherInfoRadioContent").eq(id).children("input").prop('disabled', false);
            $(".sheetOtherInfoDorpdownListContent").eq(id).children("input").val("");
            $(".sheetOtherInfoCheckBoxContent").eq(id).children("input").val("");
        });
    }
    
    function addItemOther(id) {
        if(document.getElementsByClassName("sheetOtherInfoDorpdownList")[id].style.display == "inline-block") {
            var content = document.getElementsByClassName("sheetOtherInfoDorpdownListContent")[id].innerHTML;
            var n = (content.split("<input")).length - 1;
            var OldValuesArray = new Array();
            for(var i=0; i<n; i++) {
                var oldValue = document.getElementsByName("OtherInformation"+(id+1)+"DorpdownListItem[]")[i].value;
                OldValuesArray.push(oldValue);
            }
            var newContent = "<input type='text' name='OtherInformation"+(id+1)+"DorpdownListItem[]' autocomplete='off' placeholder='Item (Dorpdown List)' />"
            document.getElementsByClassName("sheetOtherInfoDorpdownListContent")[id].innerHTML = content + newContent;
            for(var i=0; i<n; i++) {
                document.getElementsByName("OtherInformation"+(id+1)+"DorpdownListItem[]")[i].value = OldValuesArray[i];
            }
        }
        else if(document.getElementsByClassName("sheetOtherInfoCheckBox")[id].style.display == "inline-block") {
            var content = document.getElementsByClassName("sheetOtherInfoCheckBoxContent")[id].innerHTML;
            var n = (content.split("<input")).length - 1;
            var OldValuesArray = new Array();
            for(var i=0; i<n; i++) {
                var oldValue = document.getElementsByName("OtherInformation"+(id+1)+"CheckBoxItem[]")[i].value;
                OldValuesArray.push(oldValue);
            }
            var newContent = "<input type='text' name='OtherInformation"+(id+1)+"CheckBoxItem[]' autocomplete='off' placeholder='Item (CheckBox)' />"
            document.getElementsByClassName("sheetOtherInfoCheckBoxContent")[id].innerHTML = content + newContent;
            for(var i=0; i<n; i++) {
                document.getElementsByName("OtherInformation"+(id+1)+"CheckBoxItem[]")[i].value = OldValuesArray[i];
            }
        }
        else if(document.getElementsByClassName("sheetOtherInfoRadio")[id].style.display == "inline-block") {
            var content = document.getElementsByClassName("sheetOtherInfoRadioContent")[id].innerHTML;
            var n = (content.split("<input")).length - 1;
            var OldValuesArray = new Array();
            for(var i=0; i<n; i++) {
                var oldValue = document.getElementsByName("OtherInformation"+(id+1)+"RadioItem[]")[i].value;
                OldValuesArray.push(oldValue);
            }
            var newContent = "<input type='text' name='OtherInformation"+(id+1)+"RadioItem[]' autocomplete='off' placeholder='Item (Radio)' />"
            document.getElementsByClassName("sheetOtherInfoRadioContent")[id].innerHTML = content + newContent;
            for(var i=0; i<n; i++) {
                document.getElementsByName("OtherInformation"+(id+1)+"RadioItem[]")[i].value = OldValuesArray[i];
            }
        }
    }
    
    function removeItemOther(id) {
        if(document.getElementsByClassName("sheetOtherInfoDorpdownList")[id].style.display == "inline-block") {
            var content = document.getElementsByClassName("sheetOtherInfoDorpdownListContent")[id].innerHTML;
            var n = (content.split("<input")).length - 1;
            if(n > 1) {
                var OldValuesArray = new Array();
                for(var i=0; i<(n-1); i++) {
                    var oldValue = document.getElementsByName("OtherInformation"+(id+1)+"DorpdownListItem[]")[i].value;
                    OldValuesArray.push(oldValue);
                }
                var position = content.lastIndexOf("<input");
                var newContent = content.substring(0, position);
                document.getElementsByClassName("sheetOtherInfoDorpdownListContent")[id].innerHTML = newContent;
                for(var i=0; i<(n-1); i++) {
                    document.getElementsByName("OtherInformation"+(id+1)+"DorpdownListItem[]")[i].value = OldValuesArray[i];
                }
            }
        }
        else if(document.getElementsByClassName("sheetOtherInfoCheckBox")[id].style.display == "inline-block") {
            var content = document.getElementsByClassName("sheetOtherInfoCheckBoxContent")[id].innerHTML;
            var n = (content.split("<input")).length - 1;
            if(n > 1) {
                var OldValuesArray = new Array();
                for(var i=0; i<(n-1); i++) {
                    var oldValue = document.getElementsByName("OtherInformation"+(id+1)+"CheckBoxItem[]")[i].value;
                    OldValuesArray.push(oldValue);
                }
                var position = content.lastIndexOf("<input");
                var newContent = content.substring(0, position);
                document.getElementsByClassName("sheetOtherInfoCheckBoxContent")[id].innerHTML = newContent;
                for(var i=0; i<(n-1); i++) {
                    document.getElementsByName("OtherInformation"+(id+1)+"CheckBoxItem[]")[i].value = OldValuesArray[i];
                }
            }
        }
        else if(document.getElementsByClassName("sheetOtherInfoRadio")[id].style.display == "inline-block") {
            var content = document.getElementsByClassName("sheetOtherInfoRadioContent")[id].innerHTML;
            var n = (content.split("<input")).length - 1;
            if(n > 1) {
                var OldValuesArray = new Array();
                for(var i=0; i<(n-1); i++) {
                    var oldValue = document.getElementsByName("OtherInformation"+(id+1)+"RadioItem[]")[i].value;
                    OldValuesArray.push(oldValue);
                }
                var position = content.lastIndexOf("<input");
                var newContent = content.substring(0, position);
                document.getElementsByClassName("sheetOtherInfoRadioContent")[id].innerHTML = newContent;
                for(var i=0; i<(n-1); i++) {
                    document.getElementsByName("OtherInformation"+(id+1)+"RadioItem[]")[i].value = OldValuesArray[i];
                }
            }
        }
    }
</script>

<!--================================ Is Other Information =======================================-->
<script>
    document.getElementById("isOtherInformation").addEventListener('change', function() {
        if(this.checked) {
            document.getElementsByClassName("sheetOtherInformationCategoryFieldsetContainer")[0].style.display = "block";
            document.getElementsByClassName("sheetOtherInformationFieldsetContainer")[0].style.display = "block";
            document.getElementsByClassName("sheetOrganizerFieldsetContainer")[0].style.display = "block";
        } 
        else {
            document.getElementsByClassName("sheetOtherInformationCategoryFieldsetContainer")[0].style.display = "none";
            document.getElementsByClassName("sheetOtherInformationFieldsetContainer")[0].style.display = "none";
            document.getElementsByClassName("sheetOrganizerFieldsetContainer")[0].style.display = "none";
        }
    });
</script>

<!--=================================== Check Submit ============================================-->
<script>
    function checkSubmit() {
        var m = 0;
        var a = 0;
        var b = 0;
        var c = 0;
        var d = 0;
        // Information 1
        if(document.getElementsByClassName("Information")[0].value != "") {
            m++;
        }
        // Information 2 3 4 5 6 7 8 9 10
        for(var i=0; i<=8; i++) {
            if(!$(".sheetInfoText").eq(i).children("input").prop('disabled')) {
                if(document.getElementsByClassName("Information")[i*4+1].value != "") {
                    if(i+1 != m) {
                        if(a > 0) {
                            document.getElementsByClassName("Information")[(i-1)*4+1].focus();
                        }
                        else if(b > 0) {
                            document.getElementsByClassName("Information")[(i-1)*4+2].focus();
                        }
                        else if(c > 0) {
                            document.getElementsByClassName("Information")[(i-1)*4+3].focus();
                        }
                        else if(d > 0) {
                            document.getElementsByClassName("Information")[(i-1)*4+4].focus();
                        }
                        alert("Please fill in the information in order!");
                        return false;
                    }
                    m++;
                }
                else {
                    a++;
                }
            }
            if(!$(".sheetInfoDorpdownList").eq(i).children("input").prop('disabled')) {
                if(document.getElementsByClassName("Information")[i*4+2].value != "") {
                    if(i+1 != m) {
                        if(a > 0) {
                            document.getElementsByClassName("Information")[(i-1)*4+1].focus();
                        }
                        else if(b > 0) {
                            document.getElementsByClassName("Information")[(i-1)*4+2].focus();
                        }
                        else if(c > 0) {
                            document.getElementsByClassName("Information")[(i-1)*4+3].focus();
                        }
                        else if(d > 0) {
                            document.getElementsByClassName("Information")[(i-1)*4+4].focus();
                        }
                        alert("Please fill in the information in order!");
                        return false;
                    }
                    m++;
                }
                else {
                    b++;
                }
            }
            if(!$(".sheetInfoCheckBox").eq(i).children("input").prop('disabled')) {
                if(document.getElementsByClassName("Information")[i*4+3].value != "") {
                    if(i+1 != m) {
                        if(a > 0) {
                            document.getElementsByClassName("Information")[(i-1)*4+1].focus();
                        }
                        else if(b > 0) {
                            document.getElementsByClassName("Information")[(i-1)*4+2].focus();
                        }
                        else if(c > 0) {
                            document.getElementsByClassName("Information")[(i-1)*4+3].focus();
                        }
                        else if(d > 0) {
                            document.getElementsByClassName("Information")[(i-1)*4+4].focus();
                        }
                        alert("Please fill in the information in order!");
                        return false;
                    }
                    m++;
                }
                else {
                    c++;
                }
            }
            if(!$(".sheetInfoRadio").eq(i).children("input").prop('disabled')) {
                if(document.getElementsByClassName("Information")[i*4+4].value != "") {
                    if(i+1 != m) {
                        if(a > 0) {
                            document.getElementsByClassName("Information")[(i-1)*4+1].focus();
                        }
                        else if(b > 0) {
                            document.getElementsByClassName("Information")[(i-1)*4+2].focus();
                        }
                        else if(c > 0) {
                            document.getElementsByClassName("Information")[(i-1)*4+3].focus();
                        }
                        else if(d > 0) {
                            document.getElementsByClassName("Information")[(i-1)*4+4].focus();
                        }
                        alert("Please fill in the information in order!");
                        return false;
                    }
                    m++;
                }
                else {
                    d++;
                }
            }
            
            if(document.getElementsByClassName("sheetInfoInput")[i].style.display != "none") { 
                if(!$(".sheetInfoDorpdownListContent").eq(i).children("input").prop('disabled')) {
                    var DorpdownListItemLength = $(".sheetInfoDorpdownListContent").eq(i).children("input").length;
                    var DorpdownListNotNullItemLength = 0;
                    // 获取非空Item的数量
                    for(var k=0; k<DorpdownListItemLength; k++) {
                        if($(".sheetInfoDorpdownListContent").eq(i).children("input").eq(k).val() != "") {
                            DorpdownListNotNullItemLength++;
                        }
                    }
                    
                    // Information有值，Item没值
                    if($(".sheetInfoDorpdownList").eq(i).children("input").eq(1).val() != "" && DorpdownListNotNullItemLength == 0) {
                        $(".sheetInfoDorpdownListContent").eq(i).children("input").eq(0).focus();
                        alert("Please fill in at least one dorpdown list item!");
                        return false;
                    }
                    
                    // Information没值，Item有值
                    if($(".sheetInfoDorpdownList").eq(i).children("input").eq(1).val() == "" && DorpdownListNotNullItemLength != 0) {
                        $(".sheetInfoDorpdownList").eq(i).children("input").eq(1).focus();
                        alert("Please fill in information!");
                        return false;
                    }
                    
                    // 按顺序填写
                    var l = 0;
                    for(var k=0; k<DorpdownListNotNullItemLength; k++) {
                        if($(".sheetInfoDorpdownListContent").eq(i).children("input").eq(k).val() != "") {
                            l++;
                        }
                        if((l-1) != k) {
                            $(".sheetInfoDorpdownListContent").eq(i).children("input").eq(k).focus();
                            alert("Please fill in the dorpdown list item in order!");
                            return false;
                        }
                    }
                }
                if(!$(".sheetInfoCheckBoxContent").eq(i).children("input").prop('disabled')) {
                    var CheckBoxItemLength = $(".sheetInfoCheckBoxContent").eq(i).children("input").length;
                    var CheckBoxNotNullItemLength = 0;
                    // 获取非空Item的数量
                    for(var k=0; k<CheckBoxItemLength; k++) {
                        if($(".sheetInfoCheckBoxContent").eq(i).children("input").eq(k).val() != "") {
                            CheckBoxNotNullItemLength++;
                        }
                    }
                    
                    // Information有值，Item没值
                    if($(".sheetInfoCheckBox").eq(i).children("input").eq(1).val() != "" && CheckBoxNotNullItemLength == 0) {
                        $(".sheetInfoCheckBoxContent").eq(i).children("input").eq(0).focus();
                        alert("Please fill in at least one check box item!");
                        return false;
                    }
                    
                    // Information没值，Item有值
                    if($(".sheetInfoCheckBox").eq(i).children("input").eq(1).val() == "" && CheckBoxNotNullItemLength != 0) {
                        $(".sheetInfoCheckBox").eq(i).children("input").eq(1).focus();
                        alert("Please fill in information!");
                        return false;
                    }
                    
                    // 按顺序填写
                    var l = 0;
                    for(var k=0; k<CheckBoxNotNullItemLength; k++) {
                        if($(".sheetInfoCheckBoxContent").eq(i).children("input").eq(k).val() != "") {
                            l++;
                        }
                        if((l-1) != k) {
                            $(".sheetInfoCheckBoxContent").eq(i).children("input").eq(k).focus();
                            alert("Please fill in the check box item in order!");
                            return false;
                        }
                    }
                }
                if(!$(".sheetInfoRadioContent").eq(i).children("input").prop('disabled')) {
                    var RadioItemLength = $(".sheetInfoRadioContent").eq(i).children("input").length;
                    var RadioNotNullItemLength = 0;
                    // 获取非空Item的数量
                    for(var k=0; k<RadioItemLength; k++) {
                        if($(".sheetInfoRadioContent").eq(i).children("input").eq(k).val() != "") {
                            RadioNotNullItemLength++;
                        }
                    }
                    
                    // Information有值，Item没值
                    if($(".sheetInfoRadio").eq(i).children("input").eq(1).val() != "" && RadioNotNullItemLength == 0) {
                        $(".sheetInfoRadioContent").eq(i).children("input").eq(0).focus();
                        alert("Please fill in at least one radio item!");
                        return false;
                    }
                    
                    // Information没值，Item有值
                    if($(".sheetInfoRadio").eq(i).children("input").eq(1).val() == "" && RadioNotNullItemLength != 0) {
                        $(".sheetInfoRadio").eq(i).children("input").eq(1).focus();
                        alert("Please fill in information!");
                        return false;
                    }
                    
                    // 按顺序填写
                    var l = 0;
                    for(var k=0; k<RadioNotNullItemLength; k++) {
                        if($(".sheetInfoRadioContent").eq(i).children("input").eq(k).val() != "") {
                            l++;
                        }
                        if((l-1) != k) {
                            $(".sheetInfoRadioContent").eq(i).children("input").eq(k).focus();
                            alert("Please fill in the radio item in order!");
                            return false;
                        }
                    }
                }
            }
        }
        
        // 是否存在Other Information
        if(document.getElementById("isOtherInformation").checked) {
            
            $(document).ready(() => {
                $("#countCategory1Item").prop('disabled', true);
                $("#countCategory2Item").prop('disabled', true);
                $("#countCategory3Item").prop('disabled', true);
                $("#countCategory4Item").prop('disabled', true);
                $("#countCategory5Item").prop('disabled', true);
            });
            
            // 计算所有的category分别有多少已经填写的item
            // 不用else if，并且用">="，确保每种可能性都跑一遍
            // 获取当前一共有多少个Category
            var countCategory = parseInt(document.getElementById("otherInformationCategory").value);
            
            if(countCategory >= 1) {
                // CategoryName 不可为空
                if(document.getElementsByClassName("CategoryName")[0].value == "") {
                    document.getElementsByClassName("CategoryName")[0].focus();
                    alert("Please fill in the Category 1 Name!");
                    return false;
                }
                
                // 获取当前Category1的option的数量
                var countCategory1 = parseInt(document.getElementById("category1").value);
                var countCategory1Item = 0;
                var e = 0;
                var f = 0;
                var g = 0;
                var h = 0;
                for(var j=0; j<countCategory1; j++) {
                    if(!$(".sheetOtherInfoText").eq(j).children("input").prop('disabled')) {
                        if(document.getElementsByClassName("OtherInformation")[j*4].value != "") {
                            if(j != countCategory1Item) {
                                if(e > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4].focus();
                                }
                                else if(f > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+1].focus();
                                }
                                else if(g > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+2].focus();
                                }
                                else if(h > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+3].focus();
                                }
                                alert("Please fill in the information in order!");
                                return false;
                            }
                            countCategory1Item++;
                        }
                        else {
                            e++;
                        }
                    }
                    if(!$(".sheetOtherInfoDorpdownList").eq(j).children("input").prop('disabled')) {
                        if(document.getElementsByClassName("OtherInformation")[j*4+1].value != "") {
                            if(j != countCategory1Item) {
                                if(e > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4].focus();
                                }
                                else if(f > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+1].focus();
                                }
                                else if(g > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+2].focus();
                                }
                                else if(h > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+3].focus();
                                }
                                alert("Please fill in the information in order!");
                                return false;
                            }
                            countCategory1Item++;
                        }
                        else {
                            f++;
                        }
                    }
                    if(!$(".sheetOtherInfoCheckBox").eq(j).children("input").prop('disabled')) {
                        if(document.getElementsByClassName("OtherInformation")[j*4+2].value != "") {
                            if(j != countCategory1Item) {
                                if(e > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4].focus();
                                }
                                else if(f > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+1].focus();
                                }
                                else if(g > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+2].focus();
                                }
                                else if(h > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+3].focus();
                                }
                                alert("Please fill in the information in order!");
                                return false;
                            }
                            countCategory1Item++;
                        }
                        else {
                            g++;
                        }
                    }
                    if(!$(".sheetOtherInfoRadio").eq(j).children("input").prop('disabled')) {
                        if(document.getElementsByClassName("OtherInformation")[j*4+3].value != "") {
                            if(j != countCategory1Item) {
                                if(e > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4].focus();
                                }
                                else if(f > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+1].focus();
                                }
                                else if(g > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+2].focus();
                                }
                                else if(h > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+3].focus();
                                }
                                alert("Please fill in the information in order!");
                                return false;
                            }
                            countCategory1Item++;
                        }
                        else {
                            h++;
                        }
                    }
                    
                    if(document.getElementsByClassName("sheetOtherInfoInput")[j].style.display != "none") {
                        if(!$(".sheetOtherInfoDorpdownListContent").eq(j).children("input").prop('disabled')) {
                            var DorpdownListItemLength = $(".sheetOtherInfoDorpdownListContent").eq(j).children("input").length;
                            var DorpdownListNotNullItemLength = 0;
                            // 获取非空Item的数量
                            for(var k=0; k<DorpdownListItemLength; k++) {
                                if($(".sheetOtherInfoDorpdownListContent").eq(j).children("input").eq(k).val() != "") {
                                    DorpdownListNotNullItemLength++;
                                }
                            }

                            // Information有值，Item没值
                            if($(".sheetOtherInfoDorpdownList").eq(j).children("input").eq(1).val() != "" && DorpdownListNotNullItemLength == 0) {
                                $(".sheetOtherInfoDorpdownListContent").eq(j).children("input").eq(0).focus();
                                alert("Please fill in at least one dorpdown list item!");
                                return false;
                            }

                            // Information没值，Item有值
                            if($(".sheetOtherInfoDorpdownList").eq(j).children("input").eq(1).val() == "" && DorpdownListNotNullItemLength != 0) {
                                $(".sheetOtherInfoDorpdownList").eq(j).children("input").eq(1).focus();
                                alert("Please fill in information!");
                                return false;
                            }

                            // 按顺序填写
                            var l = 0;
                            for(var k=0; k<DorpdownListNotNullItemLength; k++) {
                                if($(".sheetOtherInfoDorpdownListContent").eq(j).children("input").eq(k).val() != "") {
                                    l++;
                                }
                                if((l-1) != k) {
                                    $(".sheetOtherInfoDorpdownListContent").eq(j).children("input").eq(k).focus();
                                    alert("Please fill in the dorpdown list item in order!");
                                    return false;
                                }
                            }
                        }
                        if(!$(".sheetOtherInfoCheckBoxContent").eq(j).children("input").prop('disabled')) {
                            var CheckBoxItemLength = $(".sheetOtherInfoCheckBoxContent").eq(j).children("input").length;
                            var CheckBoxNotNullItemLength = 0;
                            // 获取非空Item的数量
                            for(var k=0; k<CheckBoxItemLength; k++) {
                                if($(".sheetOtherInfoCheckBoxContent").eq(j).children("input").eq(k).val() != "") {
                                    CheckBoxNotNullItemLength++;
                                }
                            }

                            // Information有值，Item没值
                            if($(".sheetOtherInfoCheckBox").eq(j).children("input").eq(1).val() != "" && CheckBoxNotNullItemLength == 0) {
                                $(".sheetOtherInfoCheckBoxContent").eq(j).children("input").eq(0).focus();
                                alert("Please fill in at least one check box item!");
                                return false;
                            }

                            // Information没值，Item有值
                            if($(".sheetOtherInfoCheckBox").eq(j).children("input").eq(1).val() == "" && CheckBoxNotNullItemLength != 0) {
                                $(".sheetOtherInfoCheckBox").eq(j).children("input").eq(1).focus();
                                alert("Please fill in information!");
                                return false;
                            }

                            // 按顺序填写
                            var l = 0;
                            for(var k=0; k<CheckBoxNotNullItemLength; k++) {
                                if($(".sheetOtherInfoCheckBoxContent").eq(j).children("input").eq(k).val() != "") {
                                    l++;
                                }
                                if((l-1) != k) {
                                    $(".sheetOtherInfoCheckBoxContent").eq(j).children("input").eq(k).focus();
                                    alert("Please fill in the check box item in order!");
                                    return false;
                                }
                            }
                        }
                        if(!$(".sheetOtherInfoRadioContent").eq(j).children("input").prop('disabled')) {
                            var RadioItemLength = $(".sheetOtherInfoRadioContent").eq(j).children("input").length;
                            var RadioNotNullItemLength = 0;
                            // 获取非空Item的数量
                            for(var k=0; k<RadioItemLength; k++) {
                                if($(".sheetOtherInfoRadioContent").eq(j).children("input").eq(k).val() != "") {
                                    RadioNotNullItemLength++;
                                }
                            }

                            // Information有值，Item没值
                            if($(".sheetOtherInfoRadio").eq(j).children("input").eq(1).val() != "" && RadioNotNullItemLength == 0) {
                                $(".sheetOtherInfoRadioContent").eq(j).children("input").eq(0).focus();
                                alert("Please fill in at least one radio item!");
                                return false;
                            }

                            // Information没值，Item有值
                            if($(".sheetOtherInfoRadio").eq(j).children("input").eq(1).val() == "" && RadioNotNullItemLength != 0) {
                                $(".sheetOtherInfoRadio").eq(j).children("input").eq(1).focus();
                                alert("Please fill in information!");
                                return false;
                            }

                            // 按顺序填写
                            var l = 0;
                            for(var k=0; k<RadioNotNullItemLength; k++) {
                                if($(".sheetOtherInfoRadioContent").eq(j).children("input").eq(k).val() != "") {
                                    l++;
                                }
                                if((l-1) != k) {
                                    $(".sheetOtherInfoRadioContent").eq(j).children("input").eq(k).focus();
                                    alert("Please fill in the radio item in order!");
                                    return false;
                                }
                            }
                        }
                    }
                }
                if(countCategory1Item == 0) {
                    alert("Please fill in at least one item for category 1");
                    return false;
                }
                else {
                    $(document).ready(() => {
                        $("#countCategory1Item").prop('disabled', false);
                        $("#countCategory1Item").val("1," + countCategory1Item);
                    });
                }
            }
            if(countCategory >= 2) {
                // CategoryName 不可为空
                if(document.getElementsByClassName("CategoryName")[1].value == "") {
                    document.getElementsByClassName("CategoryName")[1].focus();
                    alert("Please fill in the Category 2 Name!");
                    return false;
                }
                
                // 获取当前Category1和Category2的option的数量
                var countCategory1 = parseInt(document.getElementById("category1").value);
                var countCategory2 = parseInt(document.getElementById("category2").value);
                var countCategory2Item = 0;
                var e = 0;
                var f = 0;
                var g = 0;
                var h = 0;
                for(var j=countCategory1; j<countCategory1+countCategory2; j++) {
                    if(!$(".sheetOtherInfoText").eq(j).children("input").prop('disabled')) {
                        if(document.getElementsByClassName("OtherInformation")[j*4].value != "") {
                            if(j != countCategory1+countCategory2Item) {
                                if(e > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4].focus();
                                }
                                else if(f > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+1].focus();
                                }
                                else if(g > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+2].focus();
                                }
                                else if(h > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+3].focus();
                                }
                                alert("Please fill in the information in order!");
                                return false;
                            }
                            countCategory2Item++;
                        }
                        else {
                            e++;
                        }
                    }
                    if(!$(".sheetOtherInfoDorpdownList").eq(j).children("input").prop('disabled')) {
                        if(document.getElementsByClassName("OtherInformation")[j*4+1].value != "") {
                            if(j != countCategory1+countCategory2Item) {
                                if(e > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4].focus();
                                }
                                else if(f > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+1].focus();
                                }
                                else if(g > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+2].focus();
                                }
                                else if(h > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+3].focus();
                                }
                                alert("Please fill in the information in order!");
                                return false;
                            }
                            countCategory2Item++;
                        }
                        else {
                            f++;
                        }
                    }
                    if(!$(".sheetOtherInfoCheckBox").eq(j).children("input").prop('disabled')) {
                        if(document.getElementsByClassName("OtherInformation")[j*4+2].value != "") {
                            if(j != countCategory1+countCategory2Item) {
                                if(e > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4].focus();
                                }
                                else if(f > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+1].focus();
                                }
                                else if(g > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+2].focus();
                                }
                                else if(h > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+3].focus();
                                }
                                alert("Please fill in the information in order!");
                                return false;
                            }
                            countCategory2Item++;
                        }
                        else {
                            g++;
                        }
                    }
                    if(!$(".sheetOtherInfoRadio").eq(j).children("input").prop('disabled')) {
                        if(document.getElementsByClassName("OtherInformation")[j*4+3].value != "") {
                            if(j != countCategory1+countCategory2Item) {
                                if(e > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4].focus();
                                }
                                else if(f > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+1].focus();
                                }
                                else if(g > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+2].focus();
                                }
                                else if(h > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+3].focus();
                                }
                                alert("Please fill in the information in order!");
                                return false;
                            }
                            countCategory2Item++;
                        }
                        else {
                            h++;
                        }
                    }
                    
                    if(document.getElementsByClassName("sheetOtherInfoInput")[j].style.display != "none") {
                        if(!$(".sheetOtherInfoDorpdownListContent").eq(j).children("input").prop('disabled')) {
                            var DorpdownListItemLength = $(".sheetOtherInfoDorpdownListContent").eq(j).children("input").length;
                            var DorpdownListNotNullItemLength = 0;
                            // 获取非空Item的数量
                            for(var k=0; k<DorpdownListItemLength; k++) {
                                if($(".sheetOtherInfoDorpdownListContent").eq(j).children("input").eq(k).val() != "") {
                                    DorpdownListNotNullItemLength++;
                                }
                            }

                            // Information有值，Item没值
                            if($(".sheetOtherInfoDorpdownList").eq(j).children("input").eq(1).val() != "" && DorpdownListNotNullItemLength == 0) {
                                $(".sheetOtherInfoDorpdownListContent").eq(j).children("input").eq(0).focus();
                                alert("Please fill in at least one dorpdown list item!");
                                return false;
                            }

                            // Information没值，Item有值
                            if($(".sheetOtherInfoDorpdownList").eq(j).children("input").eq(1).val() == "" && DorpdownListNotNullItemLength != 0) {
                                $(".sheetOtherInfoDorpdownList").eq(j).children("input").eq(1).focus();
                                alert("Please fill in information!");
                                return false;
                            }

                            // 按顺序填写
                            var l = 0;
                            for(var k=0; k<DorpdownListNotNullItemLength; k++) {
                                if($(".sheetOtherInfoDorpdownListContent").eq(j).children("input").eq(k).val() != "") {
                                    l++;
                                }
                                if((l-1) != k) {
                                    $(".sheetOtherInfoDorpdownListContent").eq(j).children("input").eq(k).focus();
                                    alert("Please fill in the dorpdown list item in order!");
                                    return false;
                                }
                            }
                        }
                        if(!$(".sheetOtherInfoCheckBoxContent").eq(j).children("input").prop('disabled')) {
                            var CheckBoxItemLength = $(".sheetOtherInfoCheckBoxContent").eq(j).children("input").length;
                            var CheckBoxNotNullItemLength = 0;
                            // 获取非空Item的数量
                            for(var k=0; k<CheckBoxItemLength; k++) {
                                if($(".sheetOtherInfoCheckBoxContent").eq(j).children("input").eq(k).val() != "") {
                                    CheckBoxNotNullItemLength++;
                                }
                            }

                            // Information有值，Item没值
                            if($(".sheetOtherInfoCheckBox").eq(j).children("input").eq(1).val() != "" && CheckBoxNotNullItemLength == 0) {
                                $(".sheetOtherInfoCheckBoxContent").eq(j).children("input").eq(0).focus();
                                alert("Please fill in at least one check box item!");
                                return false;
                            }

                            // Information没值，Item有值
                            if($(".sheetOtherInfoCheckBox").eq(j).children("input").eq(1).val() == "" && CheckBoxNotNullItemLength != 0) {
                                $(".sheetOtherInfoCheckBox").eq(j).children("input").eq(1).focus();
                                alert("Please fill in information!");
                                return false;
                            }

                            // 按顺序填写
                            var l = 0;
                            for(var k=0; k<CheckBoxNotNullItemLength; k++) {
                                if($(".sheetOtherInfoCheckBoxContent").eq(j).children("input").eq(k).val() != "") {
                                    l++;
                                }
                                if((l-1) != k) {
                                    $(".sheetOtherInfoCheckBoxContent").eq(j).children("input").eq(k).focus();
                                    alert("Please fill in the check box item in order!");
                                    return false;
                                }
                            }
                        }
                        if(!$(".sheetOtherInfoRadioContent").eq(j).children("input").prop('disabled')) {
                            var RadioItemLength = $(".sheetOtherInfoRadioContent").eq(j).children("input").length;
                            var RadioNotNullItemLength = 0;
                            // 获取非空Item的数量
                            for(var k=0; k<RadioItemLength; k++) {
                                if($(".sheetOtherInfoRadioContent").eq(j).children("input").eq(k).val() != "") {
                                    RadioNotNullItemLength++;
                                }
                            }

                            // Information有值，Item没值
                            if($(".sheetOtherInfoRadio").eq(j).children("input").eq(1).val() != "" && RadioNotNullItemLength == 0) {
                                $(".sheetOtherInfoRadioContent").eq(j).children("input").eq(0).focus();
                                alert("Please fill in at least one radio item!");
                                return false;
                            }

                            // Information没值，Item有值
                            if($(".sheetOtherInfoRadio").eq(j).children("input").eq(1).val() == "" && RadioNotNullItemLength != 0) {
                                $(".sheetOtherInfoRadio").eq(j).children("input").eq(1).focus();
                                alert("Please fill in information!");
                                return false;
                            }

                            // 按顺序填写
                            var l = 0;
                            for(var k=0; k<RadioNotNullItemLength; k++) {
                                if($(".sheetOtherInfoRadioContent").eq(j).children("input").eq(k).val() != "") {
                                    l++;
                                }
                                if((l-1) != k) {
                                    $(".sheetOtherInfoRadioContent").eq(j).children("input").eq(k).focus();
                                    alert("Please fill in the radio item in order!");
                                    return false;
                                }
                            }
                        }
                    }
                }
                if(countCategory2Item == 0) {
                    alert("Please fill in at least one item for category 2");
                    return false;
                }
                else {
                    $(document).ready(() => {
                        $("#countCategory2Item").prop('disabled', false);
                        $("#countCategory2Item").val((countCategory1+1) + "," + (countCategory1 + countCategory2Item));
                    });
                }
            }
            if(countCategory >= 3) {
                // CategoryName 不可为空
                if(document.getElementsByClassName("CategoryName")[2].value == "") {
                    document.getElementsByClassName("CategoryName")[2].focus();
                    alert("Please fill in the Category 3 Name!");
                    return false;
                }
                
                // 获取当前Category1和Category2和Category3的option的数量
                var countCategory1 = parseInt(document.getElementById("category1").value);
                var countCategory2 = parseInt(document.getElementById("category2").value);
                var countCategory3 = parseInt(document.getElementById("category3").value);
                var countCategory3Item = 0;
                var e = 0;
                var f = 0;
                var g = 0;
                var h = 0;
                for(var j=countCategory1+countCategory2; j<countCategory1+countCategory2+countCategory3; j++) {
                    if(!$(".sheetOtherInfoText").eq(j).children("input").prop('disabled')) {
                        if(document.getElementsByClassName("OtherInformation")[j*4].value != "") {
                            if(j != countCategory1+countCategory2+countCategory3Item) {
                                if(e > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4].focus();
                                }
                                else if(f > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+1].focus();
                                }
                                else if(g > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+2].focus();
                                }
                                else if(h > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+3].focus();
                                }
                                alert("Please fill in the information in order!");
                                return false;
                            }
                            countCategory3Item++;
                        }
                        else {
                            e++;
                        }
                    }
                    if(!$(".sheetOtherInfoDorpdownList").eq(j).children("input").prop('disabled')) {
                        if(document.getElementsByClassName("OtherInformation")[j*4+1].value != "") {
                            if(j != countCategory1+countCategory2+countCategory3Item) {
                                if(e > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4].focus();
                                }
                                else if(f > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+1].focus();
                                }
                                else if(g > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+2].focus();
                                }
                                else if(h > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+3].focus();
                                }
                                alert("Please fill in the information in order!");
                                return false;
                            }
                            countCategory3Item++;
                        }
                        else {
                            f++;
                        }
                    }
                    if(!$(".sheetOtherInfoCheckBox").eq(j).children("input").prop('disabled')) {
                        if(document.getElementsByClassName("OtherInformation")[j*4+2].value != "") {
                            if(j != countCategory1+countCategory2+countCategory3Item) {
                                if(e > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4].focus();
                                }
                                else if(f > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+1].focus();
                                }
                                else if(g > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+2].focus();
                                }
                                else if(h > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+3].focus();
                                }
                                alert("Please fill in the information in order!");
                                return false;
                            }
                            countCategory3Item++;
                        }
                        else {
                            g++;
                        }
                    }
                    if(!$(".sheetOtherInfoRadio").eq(j).children("input").prop('disabled')) {
                        if(document.getElementsByClassName("OtherInformation")[j*4+3].value != "") {
                            if(j != countCategory1+countCategory2+countCategory3Item) {
                                if(e > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4].focus();
                                }
                                else if(f > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+1].focus();
                                }
                                else if(g > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+2].focus();
                                }
                                else if(h > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+3].focus();
                                }
                                alert("Please fill in the information in order!");
                                return false;
                            }
                            countCategory3Item++;
                        }
                        else {
                            h++;
                        }
                    }
                    
                    if(document.getElementsByClassName("sheetOtherInfoInput")[j].style.display != "none") {
                        if(!$(".sheetOtherInfoDorpdownListContent").eq(j).children("input").prop('disabled')) {
                            var DorpdownListItemLength = $(".sheetOtherInfoDorpdownListContent").eq(j).children("input").length;
                            var DorpdownListNotNullItemLength = 0;
                            // 获取非空Item的数量
                            for(var k=0; k<DorpdownListItemLength; k++) {
                                if($(".sheetOtherInfoDorpdownListContent").eq(j).children("input").eq(k).val() != "") {
                                    DorpdownListNotNullItemLength++;
                                }
                            }

                            // Information有值，Item没值
                            if($(".sheetOtherInfoDorpdownList").eq(j).children("input").eq(1).val() != "" && DorpdownListNotNullItemLength == 0) {
                                $(".sheetOtherInfoDorpdownListContent").eq(j).children("input").eq(0).focus();
                                alert("Please fill in at least one dorpdown list item!");
                                return false;
                            }

                            // Information没值，Item有值
                            if($(".sheetOtherInfoDorpdownList").eq(j).children("input").eq(1).val() == "" && DorpdownListNotNullItemLength != 0) {
                                $(".sheetOtherInfoDorpdownList").eq(j).children("input").eq(1).focus();
                                alert("Please fill in information!");
                                return false;
                            }

                            // 按顺序填写
                            var l = 0;
                            for(var k=0; k<DorpdownListNotNullItemLength; k++) {
                                if($(".sheetOtherInfoDorpdownListContent").eq(j).children("input").eq(k).val() != "") {
                                    l++;
                                }
                                if((l-1) != k) {
                                    $(".sheetOtherInfoDorpdownListContent").eq(j).children("input").eq(k).focus();
                                    alert("Please fill in the dorpdown list item in order!");
                                    return false;
                                }
                            }
                        }
                        if(!$(".sheetOtherInfoCheckBoxContent").eq(j).children("input").prop('disabled')) {
                            var CheckBoxItemLength = $(".sheetOtherInfoCheckBoxContent").eq(j).children("input").length;
                            var CheckBoxNotNullItemLength = 0;
                            // 获取非空Item的数量
                            for(var k=0; k<CheckBoxItemLength; k++) {
                                if($(".sheetOtherInfoCheckBoxContent").eq(j).children("input").eq(k).val() != "") {
                                    CheckBoxNotNullItemLength++;
                                }
                            }

                            // Information有值，Item没值
                            if($(".sheetOtherInfoCheckBox").eq(j).children("input").eq(1).val() != "" && CheckBoxNotNullItemLength == 0) {
                                $(".sheetOtherInfoCheckBoxContent").eq(j).children("input").eq(0).focus();
                                alert("Please fill in at least one check box item!");
                                return false;
                            }

                            // Information没值，Item有值
                            if($(".sheetOtherInfoCheckBox").eq(j).children("input").eq(1).val() == "" && CheckBoxNotNullItemLength != 0) {
                                $(".sheetOtherInfoCheckBox").eq(j).children("input").eq(1).focus();
                                alert("Please fill in information!");
                                return false;
                            }

                            // 按顺序填写
                            var l = 0;
                            for(var k=0; k<CheckBoxNotNullItemLength; k++) {
                                if($(".sheetOtherInfoCheckBoxContent").eq(j).children("input").eq(k).val() != "") {
                                    l++;
                                }
                                if((l-1) != k) {
                                    $(".sheetOtherInfoCheckBoxContent").eq(j).children("input").eq(k).focus();
                                    alert("Please fill in the check box item in order!");
                                    return false;
                                }
                            }
                        }
                        if(!$(".sheetOtherInfoRadioContent").eq(j).children("input").prop('disabled')) {
                            var RadioItemLength = $(".sheetOtherInfoRadioContent").eq(j).children("input").length;
                            var RadioNotNullItemLength = 0;
                            // 获取非空Item的数量
                            for(var k=0; k<RadioItemLength; k++) {
                                if($(".sheetOtherInfoRadioContent").eq(j).children("input").eq(k).val() != "") {
                                    RadioNotNullItemLength++;
                                }
                            }

                            // Information有值，Item没值
                            if($(".sheetOtherInfoRadio").eq(j).children("input").eq(1).val() != "" && RadioNotNullItemLength == 0) {
                                $(".sheetOtherInfoRadioContent").eq(j).children("input").eq(0).focus();
                                alert("Please fill in at least one radio item!");
                                return false;
                            }

                            // Information没值，Item有值
                            if($(".sheetOtherInfoRadio").eq(j).children("input").eq(1).val() == "" && RadioNotNullItemLength != 0) {
                                $(".sheetOtherInfoRadio").eq(j).children("input").eq(1).focus();
                                alert("Please fill in information!");
                                return false;
                            }

                            // 按顺序填写
                            var l = 0;
                            for(var k=0; k<RadioNotNullItemLength; k++) {
                                if($(".sheetOtherInfoRadioContent").eq(j).children("input").eq(k).val() != "") {
                                    l++;
                                }
                                if((l-1) != k) {
                                    $(".sheetOtherInfoRadioContent").eq(j).children("input").eq(k).focus();
                                    alert("Please fill in the radio item in order!");
                                    return false;
                                }
                            }
                        }
                    }
                }
                if(countCategory3Item == 0) {
                    alert("Please fill in at least one item for category 3");
                    return false;
                }
                else {
                    $(document).ready(() => {
                        $("#countCategory3Item").prop('disabled', false);
                        $("#countCategory3Item").val((countCategory1 + countCategory2 + 1) + "," + (countCategory1 + countCategory2 + countCategory3Item));
                    });
                }
            }
            if(countCategory >= 4) {
                // CategoryName 不可为空
                if(document.getElementsByClassName("CategoryName")[3].value == "") {
                    document.getElementsByClassName("CategoryName")[3].focus();
                    alert("Please fill in the Category 4 Name!");
                    return false;
                }
                
                // 获取当前Category1和Category2和Category3和Category4的option的数量
                var countCategory1 = parseInt(document.getElementById("category1").value);
                var countCategory2 = parseInt(document.getElementById("category2").value);
                var countCategory3 = parseInt(document.getElementById("category3").value);
                var countCategory4 = parseInt(document.getElementById("category4").value);
                var countCategory4Item = 0;
                var e = 0;
                var f = 0;
                var g = 0;
                var h = 0;
                for(var j=countCategory1+countCategory2+countCategory3; j<countCategory1+countCategory2+countCategory3+countCategory4; j++) {
                    if(!$(".sheetOtherInfoText").eq(j).children("input").prop('disabled')) {
                        if(document.getElementsByClassName("OtherInformation")[j*4].value != "") {
                            if(j != countCategory1+countCategory2+countCategory3+countCategory4Item) {
                                if(e > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4].focus();
                                }
                                else if(f > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+1].focus();
                                }
                                else if(g > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+2].focus();
                                }
                                else if(h > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+3].focus();
                                }
                                alert("Please fill in the information in order!");
                                return false;
                            }
                            countCategory4Item++;
                        }
                        else {
                            e++;
                        }
                    }
                    if(!$(".sheetOtherInfoDorpdownList").eq(j).children("input").prop('disabled')) {
                        if(document.getElementsByClassName("OtherInformation")[j*4+1].value != "") {
                            if(j != countCategory1+countCategory2+countCategory3+countCategory4Item) {
                                if(e > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4].focus();
                                }
                                else if(f > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+1].focus();
                                }
                                else if(g > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+2].focus();
                                }
                                else if(h > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+3].focus();
                                }
                                alert("Please fill in the information in order!");
                                return false;
                            }
                            countCategory4Item++;
                        }
                        else {
                            f++;
                        }
                    }
                    if(!$(".sheetOtherInfoCheckBox").eq(j).children("input").prop('disabled')) {
                        if(document.getElementsByClassName("OtherInformation")[j*4+2].value != "") {
                            if(j != countCategory1+countCategory2+countCategory3+countCategory4Item) {
                                if(e > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4].focus();
                                }
                                else if(f > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+1].focus();
                                }
                                else if(g > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+2].focus();
                                }
                                else if(h > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+3].focus();
                                }
                                alert("Please fill in the information in order!");
                                return false;
                            }
                            countCategory4Item++;
                        }
                        else {
                            g++;
                        }
                    }
                    if(!$(".sheetOtherInfoRadio").eq(j).children("input").prop('disabled')) {
                        if(document.getElementsByClassName("OtherInformation")[j*4+3].value != "") {
                            if(j != countCategory1+countCategory2+countCategory3+countCategory4Item) {
                                if(e > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4].focus();
                                }
                                else if(f > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+1].focus();
                                }
                                else if(g > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+2].focus();
                                }
                                else if(h > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+3].focus();
                                }
                                alert("Please fill in the information in order!");
                                return false;
                            }
                            countCategory4Item++;
                        }
                        else {
                            h++;
                        }
                    }
                    
                    if(document.getElementsByClassName("sheetOtherInfoInput")[j].style.display != "none") {
                        if(!$(".sheetOtherInfoDorpdownListContent").eq(j).children("input").prop('disabled')) {
                            var DorpdownListItemLength = $(".sheetOtherInfoDorpdownListContent").eq(j).children("input").length;
                            var DorpdownListNotNullItemLength = 0;
                            // 获取非空Item的数量
                            for(var k=0; k<DorpdownListItemLength; k++) {
                                if($(".sheetOtherInfoDorpdownListContent").eq(j).children("input").eq(k).val() != "") {
                                    DorpdownListNotNullItemLength++;
                                }
                            }

                            // Information有值，Item没值
                            if($(".sheetOtherInfoDorpdownList").eq(j).children("input").eq(1).val() != "" && DorpdownListNotNullItemLength == 0) {
                                $(".sheetOtherInfoDorpdownListContent").eq(j).children("input").eq(0).focus();
                                alert("Please fill in at least one dorpdown list item!");
                                return false;
                            }

                            // Information没值，Item有值
                            if($(".sheetOtherInfoDorpdownList").eq(j).children("input").eq(1).val() == "" && DorpdownListNotNullItemLength != 0) {
                                $(".sheetOtherInfoDorpdownList").eq(j).children("input").eq(1).focus();
                                alert("Please fill in information!");
                                return false;
                            }

                            // 按顺序填写
                            var l = 0;
                            for(var k=0; k<DorpdownListNotNullItemLength; k++) {
                                if($(".sheetOtherInfoDorpdownListContent").eq(j).children("input").eq(k).val() != "") {
                                    l++;
                                }
                                if((l-1) != k) {
                                    $(".sheetOtherInfoDorpdownListContent").eq(j).children("input").eq(k).focus();
                                    alert("Please fill in the dorpdown list item in order!");
                                    return false;
                                }
                            }
                        }
                        if(!$(".sheetOtherInfoCheckBoxContent").eq(j).children("input").prop('disabled')) {
                            var CheckBoxItemLength = $(".sheetOtherInfoCheckBoxContent").eq(j).children("input").length;
                            var CheckBoxNotNullItemLength = 0;
                            // 获取非空Item的数量
                            for(var k=0; k<CheckBoxItemLength; k++) {
                                if($(".sheetOtherInfoCheckBoxContent").eq(j).children("input").eq(k).val() != "") {
                                    CheckBoxNotNullItemLength++;
                                }
                            }

                            // Information有值，Item没值
                            if($(".sheetOtherInfoCheckBox").eq(j).children("input").eq(1).val() != "" && CheckBoxNotNullItemLength == 0) {
                                $(".sheetOtherInfoCheckBoxContent").eq(j).children("input").eq(0).focus();
                                alert("Please fill in at least one check box item!");
                                return false;
                            }

                            // Information没值，Item有值
                            if($(".sheetOtherInfoCheckBox").eq(j).children("input").eq(1).val() == "" && CheckBoxNotNullItemLength != 0) {
                                $(".sheetOtherInfoCheckBox").eq(j).children("input").eq(1).focus();
                                alert("Please fill in information!");
                                return false;
                            }

                            // 按顺序填写
                            var l = 0;
                            for(var k=0; k<CheckBoxNotNullItemLength; k++) {
                                if($(".sheetOtherInfoCheckBoxContent").eq(j).children("input").eq(k).val() != "") {
                                    l++;
                                }
                                if((l-1) != k) {
                                    $(".sheetOtherInfoCheckBoxContent").eq(j).children("input").eq(k).focus();
                                    alert("Please fill in the check box item in order!");
                                    return false;
                                }
                            }
                        }
                        if(!$(".sheetOtherInfoRadioContent").eq(j).children("input").prop('disabled')) {
                            var RadioItemLength = $(".sheetOtherInfoRadioContent").eq(j).children("input").length;
                            var RadioNotNullItemLength = 0;
                            // 获取非空Item的数量
                            for(var k=0; k<RadioItemLength; k++) {
                                if($(".sheetOtherInfoRadioContent").eq(j).children("input").eq(k).val() != "") {
                                    RadioNotNullItemLength++;
                                }
                            }

                            // Information有值，Item没值
                            if($(".sheetOtherInfoRadio").eq(j).children("input").eq(1).val() != "" && RadioNotNullItemLength == 0) {
                                $(".sheetOtherInfoRadioContent").eq(j).children("input").eq(0).focus();
                                alert("Please fill in at least one radio item!");
                                return false;
                            }

                            // Information没值，Item有值
                            if($(".sheetOtherInfoRadio").eq(j).children("input").eq(1).val() == "" && RadioNotNullItemLength != 0) {
                                $(".sheetOtherInfoRadio").eq(j).children("input").eq(1).focus();
                                alert("Please fill in information!");
                                return false;
                            }

                            // 按顺序填写
                            var l = 0;
                            for(var k=0; k<RadioNotNullItemLength; k++) {
                                if($(".sheetOtherInfoRadioContent").eq(j).children("input").eq(k).val() != "") {
                                    l++;
                                }
                                if((l-1) != k) {
                                    $(".sheetOtherInfoRadioContent").eq(j).children("input").eq(k).focus();
                                    alert("Please fill in the radio item in order!");
                                    return false;
                                }
                            }
                        }
                    }
                }
                if(countCategory4Item == 0) {
                    alert("Please fill in at least one item for category 4");
                    return false;
                }
                else {
                    $(document).ready(() => {
                        $("#countCategory4Item").prop('disabled', false);
                        $("#countCategory4Item").val((countCategory1 + countCategory2 + countCategory3 + 1) + "," + (countCategory1 + countCategory2 + countCategory3 + countCategory4Item));
                    });
                }
            }
            if(countCategory >= 5) {
                // CategoryName 不可为空
                if(document.getElementsByClassName("CategoryName")[4].value == "") {
                    document.getElementsByClassName("CategoryName")[4].focus();
                    alert("Please fill in the Category 5 Name!");
                    return false;
                }
                
                // 获取当前Category1和Category2和Category3和Category4和Category5的option的数量
                var countCategory1 = parseInt(document.getElementById("category1").value);
                var countCategory2 = parseInt(document.getElementById("category2").value);
                var countCategory3 = parseInt(document.getElementById("category3").value);
                var countCategory4 = parseInt(document.getElementById("category4").value);
                var countCategory5 = parseInt(document.getElementById("category5").value);
                var countCategory5Item = 0;
                var e = 0;
                var f = 0;
                var g = 0;
                var h = 0;
                for(var j=countCategory1+countCategory2+countCategory3+countCategory4; j<countCategory1+countCategory2+countCategory3+countCategory4+countCategory5; j++) {
                    if(!$(".sheetOtherInfoText").eq(j).children("input").prop('disabled')) {
                        if(document.getElementsByClassName("OtherInformation")[j*4].value != "") {
                            if(j != countCategory1+countCategory2+countCategory3+countCategory4+countCategory5Item) {
                                if(e > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4].focus();
                                }
                                else if(f > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+1].focus();
                                }
                                else if(g > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+2].focus();
                                }
                                else if(h > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+3].focus();
                                }
                                alert("Please fill in the information in order!");
                                return false;
                            }
                            countCategory5Item++;
                        }
                        else {
                            e++;
                        }
                    }
                    if(!$(".sheetOtherInfoDorpdownList").eq(j).children("input").prop('disabled')) {
                        if(document.getElementsByClassName("OtherInformation")[j*4+1].value != "") {
                            if(j != countCategory1+countCategory2+countCategory3+countCategory4+countCategory5Item) {
                                if(e > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4].focus();
                                }
                                else if(f > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+1].focus();
                                }
                                else if(g > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+2].focus();
                                }
                                else if(h > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+3].focus();
                                }
                                alert("Please fill in the information in order!");
                                return false;
                            }
                            countCategory5Item++;
                        }
                        else {
                            f++;
                        }
                    }
                    if(!$(".sheetOtherInfoCheckBox").eq(j).children("input").prop('disabled')) {
                        if(document.getElementsByClassName("OtherInformation")[j*4+2].value != "") {
                            if(j != countCategory1+countCategory2+countCategory3+countCategory4+countCategory5Item) {
                                if(e > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4].focus();
                                }
                                else if(f > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+1].focus();
                                }
                                else if(g > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+2].focus();
                                }
                                else if(h > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+3].focus();
                                }
                                alert("Please fill in the information in order!");
                                return false;
                            }
                            countCategory5Item++;
                        }
                        else {
                            g++;
                        }
                    }
                    if(!$(".sheetOtherInfoRadio").eq(j).children("input").prop('disabled')) {
                        if(document.getElementsByClassName("OtherInformation")[j*4+3].value != "") {
                            if(j != countCategory1+countCategory2+countCategory3+countCategory4+countCategory5Item) {
                                if(e > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4].focus();
                                }
                                else if(f > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+1].focus();
                                }
                                else if(g > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+2].focus();
                                }
                                else if(h > 0) {
                                    document.getElementsByClassName("OtherInformation")[(j-1)*4+3].focus();
                                }
                                alert("Please fill in the information in order!");
                                return false;
                            }
                            countCategory5Item++;
                        }
                        else {
                            h++;
                        }
                    }
                    
                    if(document.getElementsByClassName("sheetOtherInfoInput")[j].style.display != "none") {
                        if(!$(".sheetOtherInfoDorpdownListContent").eq(j).children("input").prop('disabled')) {
                            var DorpdownListItemLength = $(".sheetOtherInfoDorpdownListContent").eq(j).children("input").length;
                            var DorpdownListNotNullItemLength = 0;
                            // 获取非空Item的数量
                            for(var k=0; k<DorpdownListItemLength; k++) {
                                if($(".sheetOtherInfoDorpdownListContent").eq(j).children("input").eq(k).val() != "") {
                                    DorpdownListNotNullItemLength++;
                                }
                            }

                            // Information有值，Item没值
                            if($(".sheetOtherInfoDorpdownList").eq(j).children("input").eq(1).val() != "" && DorpdownListNotNullItemLength == 0) {
                                $(".sheetOtherInfoDorpdownListContent").eq(j).children("input").eq(0).focus();
                                alert("Please fill in at least one dorpdown list item!");
                                return false;
                            }

                            // Information没值，Item有值
                            if($(".sheetOtherInfoDorpdownList").eq(j).children("input").eq(1).val() == "" && DorpdownListNotNullItemLength != 0) {
                                $(".sheetOtherInfoDorpdownList").eq(j).children("input").eq(1).focus();
                                alert("Please fill in information!");
                                return false;
                            }

                            // 按顺序填写
                            var l = 0;
                            for(var k=0; k<DorpdownListNotNullItemLength; k++) {
                                if($(".sheetOtherInfoDorpdownListContent").eq(j).children("input").eq(k).val() != "") {
                                    l++;
                                }
                                if((l-1) != k) {
                                    $(".sheetOtherInfoDorpdownListContent").eq(j).children("input").eq(k).focus();
                                    alert("Please fill in the dorpdown list item in order!");
                                    return false;
                                }
                            }
                        }
                        if(!$(".sheetOtherInfoCheckBoxContent").eq(j).children("input").prop('disabled')) {
                            var CheckBoxItemLength = $(".sheetOtherInfoCheckBoxContent").eq(j).children("input").length;
                            var CheckBoxNotNullItemLength = 0;
                            // 获取非空Item的数量
                            for(var k=0; k<CheckBoxItemLength; k++) {
                                if($(".sheetOtherInfoCheckBoxContent").eq(j).children("input").eq(k).val() != "") {
                                    CheckBoxNotNullItemLength++;
                                }
                            }

                            // Information有值，Item没值
                            if($(".sheetOtherInfoCheckBox").eq(j).children("input").eq(1).val() != "" && CheckBoxNotNullItemLength == 0) {
                                $(".sheetOtherInfoCheckBoxContent").eq(j).children("input").eq(0).focus();
                                alert("Please fill in at least one check box item!");
                                return false;
                            }

                            // Information没值，Item有值
                            if($(".sheetOtherInfoCheckBox").eq(j).children("input").eq(1).val() == "" && CheckBoxNotNullItemLength != 0) {
                                $(".sheetOtherInfoCheckBox").eq(j).children("input").eq(1).focus();
                                alert("Please fill in information!");
                                return false;
                            }

                            // 按顺序填写
                            var l = 0;
                            for(var k=0; k<CheckBoxNotNullItemLength; k++) {
                                if($(".sheetOtherInfoCheckBoxContent").eq(j).children("input").eq(k).val() != "") {
                                    l++;
                                }
                                if((l-1) != k) {
                                    $(".sheetOtherInfoCheckBoxContent").eq(j).children("input").eq(k).focus();
                                    alert("Please fill in the check box item in order!");
                                    return false;
                                }
                            }
                        }
                        if(!$(".sheetOtherInfoRadioContent").eq(j).children("input").prop('disabled')) {
                            var RadioItemLength = $(".sheetOtherInfoRadioContent").eq(j).children("input").length;
                            var RadioNotNullItemLength = 0;
                            // 获取非空Item的数量
                            for(var k=0; k<RadioItemLength; k++) {
                                if($(".sheetOtherInfoRadioContent").eq(j).children("input").eq(k).val() != "") {
                                    RadioNotNullItemLength++;
                                }
                            }

                            // Information有值，Item没值
                            if($(".sheetOtherInfoRadio").eq(j).children("input").eq(1).val() != "" && RadioNotNullItemLength == 0) {
                                $(".sheetOtherInfoRadioContent").eq(j).children("input").eq(0).focus();
                                alert("Please fill in at least one radio item!");
                                return false;
                            }

                            // Information没值，Item有值
                            if($(".sheetOtherInfoRadio").eq(j).children("input").eq(1).val() == "" && RadioNotNullItemLength != 0) {
                                $(".sheetOtherInfoRadio").eq(j).children("input").eq(1).focus();
                                alert("Please fill in information!");
                                return false;
                            }

                            // 按顺序填写
                            var l = 0;
                            for(var k=0; k<RadioNotNullItemLength; k++) {
                                if($(".sheetOtherInfoRadioContent").eq(j).children("input").eq(k).val() != "") {
                                    l++;
                                }
                                if((l-1) != k) {
                                    $(".sheetOtherInfoRadioContent").eq(j).children("input").eq(k).focus();
                                    alert("Please fill in the radio item in order!");
                                    return false;
                                }
                            }
                        }
                    }
                }
                if(countCategory5Item == 0) {
                    alert("Please fill in at least one item for category 5");
                    return false;
                }
                else {
                    $(document).ready(() => {
                        $("#countCategory5Item").prop('disabled', false);
                        $("#countCategory5Item").val((countCategory1 + countCategory2 + countCategory3 + countCategory4 + 1) + "," + (countCategory1 + countCategory2 + countCategory3 + countCategory4 + countCategory5Item));
                    });
                }
            }
            
            // 用户名验证
            if(document.getElementById("usernameLabel").style.display == "inline") {
                alert("Please enter another username");
                return false;
            }
            
            // 密码验证
            var password = document.getElementById("password").value;  
            var cpassword = document.getElementById("cpassword").value;  
            if(password!=cpassword || password == ""){
                document.getElementById("password").focus();
                alert("Please enter correct password");
                return false;
            }
        }
        
        var temp = document.getElementById("feedback").innerHTML;
        temp = escapeToHtml(temp);
        document.getElementById("feedbackHidden").value = temp;
        
        return true;
    }
    
    function escapeToHtml(str) {
        var arrEntities={'lt':'<','gt':'>','nbsp':' ','amp':'&','quot':'"'};
        return str.replace(/&(lt|gt|nbsp|amp|quot);/ig,function(all,t){return arrEntities[t];});
    }
</script>