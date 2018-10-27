<?php
    require_once '../ipaddress.php';
    require_once 'config.php';

    date_default_timezone_set("Asia/Singapore");
    $timestamp = date('y-m-d H:i:s',time());

    if (isset($_GET['SpreadSheetContentId']) && isset($_GET['SpreadSheetColumnId']) && isset($_GET['isOtherInformation'])) {
        $SpreadSheetContentId = $_GET['SpreadSheetContentId'];
        $SpreadSheetColumnId = $_GET['SpreadSheetColumnId'];
        $isOtherInformation = $_GET['isOtherInformation'];
        
        $SheetName = "";
        $SheetSubject = "";
        $UserDetails = "";
        $Feedback = "";
        $Category1Name = "";
        $Category2Name = "";
        $Category3Name = "";
        $Category4Name = "";
        $Category5Name = "";
        $CountCategory1Item = "";
        $CountCategory2Item = "";
        $CountCategory3Item = "";
        $CountCategory4Item = "";
        $CountCategory5Item = "";
        $OtherInformationName1 = "";
        $OtherInformationType1 = ""; 
        $OtherInformationName2 = "";
        $OtherInformationType2 = "";
        $OtherInformationName3 = "";
        $OtherInformationType3 = ""; 
        $OtherInformationName4 = "";
        $OtherInformationType4 = ""; 
        $OtherInformationName5 = "";
        $OtherInformationType5 = ""; 
        $OtherInformationName6 = "";
        $OtherInformationType6 = ""; 
        $OtherInformationName7 = "";
        $OtherInformationType7 = ""; 
        $OtherInformationName8 = "";
        $OtherInformationType8 = ""; 
        $OtherInformationName9 = "";
        $OtherInformationType9 = "";
        $OtherInformationName10 = "";
        $OtherInformationType10 = ""; 
        $OtherInformationName11 = "";
        $OtherInformationType11 = ""; 
        $OtherInformationName12 = "";
        $OtherInformationType12 = "";
        $OtherInformationName13 = "";
        $OtherInformationType13 = ""; 
        $OtherInformationName14 = "";
        $OtherInformationType14 = ""; 
        $OtherInformationName15 = "";
        $OtherInformationType15 = ""; 
        $OtherInformationName16 = "";
        $OtherInformationType16 = ""; 
        $OtherInformationName17 = "";
        $OtherInformationType17 = ""; 
        $OtherInformationName18 = "";
        $OtherInformationType18 = ""; 
        $OtherInformationName19 = "";
        $OtherInformationType19 = "";
        $OtherInformationName20 = "";
        $OtherInformationType20 = ""; 
        $OtherInformationName31 = "";
        $OtherInformationType31 = ""; 
        $OtherInformationName32 = "";
        $OtherInformationType32 = "";
        $OtherInformationName33 = "";
        $OtherInformationType33 = ""; 
        $OtherInformationName34 = "";
        $OtherInformationType34 = ""; 
        $OtherInformationName35 = "";
        $OtherInformationType35 = ""; 
        $OtherInformationName36 = "";
        $OtherInformationType36 = ""; 
        $OtherInformationName37 = "";
        $OtherInformationType37 = ""; 
        $OtherInformationName38 = "";
        $OtherInformationType38 = ""; 
        $OtherInformationName39 = "";
        $OtherInformationType39 = "";
        $OtherInformationName40 = "";
        $OtherInformationType40 = ""; 
        $OtherInformationName41 = "";
        $OtherInformationType41 = ""; 
        $OtherInformationName42 = "";
        $OtherInformationType42 = "";
        $OtherInformationName43 = "";
        $OtherInformationType43 = ""; 
        $OtherInformationName44 = "";
        $OtherInformationType44 = ""; 
        $OtherInformationName45 = "";
        $OtherInformationType45 = ""; 
        $OtherInformationName46 = "";
        $OtherInformationType46 = ""; 
        $OtherInformationName47 = "";
        $OtherInformationType47 = ""; 
        $OtherInformationName48 = "";
        $OtherInformationType48 = ""; 
        $OtherInformationName49 = "";
        $OtherInformationType49 = "";
        $OtherInformationName50 = "";
        $OtherInformationType50 = "";
        $VerificationCode = "";
        $Information1 = "";
        $Information2 = "";
        $Information3 = "";
        $Information4 = "";
        $Information5 = "";
        $Information6 = "";
        $Information7 = "";
        $Information8 = "";
        $Information9 = "";
        $Information10 = "";
        $OtherInformation1 = "";
        $OtherInformation2 = "";
        $OtherInformation3 = "";
        $OtherInformation4 = "";
        $OtherInformation5 = "";
        $OtherInformation6 = "";
        $OtherInformation7 = "";
        $OtherInformation8 = "";
        $OtherInformation9 = "";
        $OtherInformation10 = "";
        $OtherInformation11 = "";
        $OtherInformation12 = "";
        $OtherInformation13 = "";
        $OtherInformation14 = "";
        $OtherInformation15 = "";
        $OtherInformation16 = "";
        $OtherInformation17 = "";
        $OtherInformation18 = "";
        $OtherInformation19 = "";
        $OtherInformation20 = "";
        $OtherInformation21 = "";
        $OtherInformation22 = "";
        $OtherInformation23 = "";
        $OtherInformation24 = "";
        $OtherInformation25 = "";
        $OtherInformation26 = "";
        $OtherInformation27 = "";
        $OtherInformation28 = "";
        $OtherInformation29 = "";
        $OtherInformation30 = "";
        $OtherInformation31 = "";
        $OtherInformation32 = "";
        $OtherInformation33 = "";
        $OtherInformation34 = "";
        $OtherInformation35 = "";
        $OtherInformation36 = "";
        $OtherInformation37 = "";
        $OtherInformation38 = "";
        $OtherInformation39 = "";
        $OtherInformation40 = "";
        $OtherInformation41 = "";
        $OtherInformation42 = "";
        $OtherInformation43 = "";
        $OtherInformation44 = "";
        $OtherInformation45 = "";
        $OtherInformation46 = "";
        $OtherInformation47 = "";
        $OtherInformation48 = "";
        $OtherInformation49 = "";
        $OtherInformation50 = "";
        $OtherInformationArray = array();
        $Category1ItemArray = array();
        $Category2ItemArray = array();
        $Category3ItemArray = array();
        $Category4ItemArray = array();
        $Category5ItemArray = array();
        
        $conn = mysqli_connect(HOST, USER, PASS, DB) or die('Unable to Connect...');
        
        $search_spreadsheetcolumn_sql = "SELECT * FROM spreadsheetcolumn WHERE Id = '$SpreadSheetColumnId'";
        $search_spreadsheetcolumn_result = mysqli_query($conn, $search_spreadsheetcolumn_sql);
        if (!$search_spreadsheetcolumn_result || mysqli_num_rows($search_spreadsheetcolumn_result) == 0){
        
        }
        else {
            $one_search_spreadsheetcolumn_result = mysqli_fetch_assoc($search_spreadsheetcolumn_result);
            $SheetName = $one_search_spreadsheetcolumn_result['SheetName'];
            $SheetSubject = $one_search_spreadsheetcolumn_result['SheetSubject'];
            $UserDetails = $one_search_spreadsheetcolumn_result['IsUserDetails'];
            $Feedback = $one_search_spreadsheetcolumn_result['Feedback'];
            $Category1Name = $one_search_spreadsheetcolumn_result['Category1Name'];
            $Category2Name = $one_search_spreadsheetcolumn_result['Category2Name'];
            $Category3Name = $one_search_spreadsheetcolumn_result['Category3Name'];
            $Category4Name = $one_search_spreadsheetcolumn_result['Category4Name'];
            $Category5Name = $one_search_spreadsheetcolumn_result['Category5Name'];
            $CountCategory1Item = $one_search_spreadsheetcolumn_result['CountCategory1Item'];
            $CountCategory2Item = $one_search_spreadsheetcolumn_result['CountCategory2Item'];
            $CountCategory3Item = $one_search_spreadsheetcolumn_result['CountCategory3Item'];
            $CountCategory4Item = $one_search_spreadsheetcolumn_result['CountCategory4Item'];
            $CountCategory5Item = $one_search_spreadsheetcolumn_result['CountCategory5Item'];
            $OtherInformationName1 = $one_search_spreadsheetcolumn_result['OtherInformationName1'];
            $OtherInformationType1 = $one_search_spreadsheetcolumn_result['OtherInformationType1']; 
            $OtherInformationName2 = $one_search_spreadsheetcolumn_result['OtherInformationName2'];
            $OtherInformationType2 = $one_search_spreadsheetcolumn_result['OtherInformationType2']; 
            $OtherInformationName3 = $one_search_spreadsheetcolumn_result['OtherInformationName3'];
            $OtherInformationType3 = $one_search_spreadsheetcolumn_result['OtherInformationType3'];  
            $OtherInformationName4 = $one_search_spreadsheetcolumn_result['OtherInformationName4'];
            $OtherInformationType4 = $one_search_spreadsheetcolumn_result['OtherInformationType4']; 
            $OtherInformationName5 = $one_search_spreadsheetcolumn_result['OtherInformationName5'];
            $OtherInformationType5 = $one_search_spreadsheetcolumn_result['OtherInformationType5']; 
            $OtherInformationName6 = $one_search_spreadsheetcolumn_result['OtherInformationName6'];
            $OtherInformationType6 = $one_search_spreadsheetcolumn_result['OtherInformationType6']; 
            $OtherInformationName7 = $one_search_spreadsheetcolumn_result['OtherInformationName7'];
            $OtherInformationType7 = $one_search_spreadsheetcolumn_result['OtherInformationType7'];  
            $OtherInformationName8 = $one_search_spreadsheetcolumn_result['OtherInformationName8'];
            $OtherInformationType8 = $one_search_spreadsheetcolumn_result['OtherInformationType8']; 
            $OtherInformationName9 = $one_search_spreadsheetcolumn_result['OtherInformationName9'];
            $OtherInformationType9 = $one_search_spreadsheetcolumn_result['OtherInformationType9']; 
            $OtherInformationName10 = $one_search_spreadsheetcolumn_result['OtherInformationName10'];
            $OtherInformationType10 = $one_search_spreadsheetcolumn_result['OtherInformationType10']; 
            $OtherInformationName11 = $one_search_spreadsheetcolumn_result['OtherInformationName11'];
            $OtherInformationType11 = $one_search_spreadsheetcolumn_result['OtherInformationType11']; 
            $OtherInformationName12 = $one_search_spreadsheetcolumn_result['OtherInformationName12'];
            $OtherInformationType12 = $one_search_spreadsheetcolumn_result['OtherInformationType12']; 
            $OtherInformationName13 = $one_search_spreadsheetcolumn_result['OtherInformationName13'];
            $OtherInformationType13 = $one_search_spreadsheetcolumn_result['OtherInformationType13'];  
            $OtherInformationName14 = $one_search_spreadsheetcolumn_result['OtherInformationName14'];
            $OtherInformationType14 = $one_search_spreadsheetcolumn_result['OtherInformationType14']; 
            $OtherInformationName15 = $one_search_spreadsheetcolumn_result['OtherInformationName15'];
            $OtherInformationType15 = $one_search_spreadsheetcolumn_result['OtherInformationType15']; 
            $OtherInformationName16 = $one_search_spreadsheetcolumn_result['OtherInformationName16'];
            $OtherInformationType16 = $one_search_spreadsheetcolumn_result['OtherInformationType16']; 
            $OtherInformationName17 = $one_search_spreadsheetcolumn_result['OtherInformationName17'];
            $OtherInformationType17 = $one_search_spreadsheetcolumn_result['OtherInformationType17'];  
            $OtherInformationName18 = $one_search_spreadsheetcolumn_result['OtherInformationName18'];
            $OtherInformationType18 = $one_search_spreadsheetcolumn_result['OtherInformationType18']; 
            $OtherInformationName19 = $one_search_spreadsheetcolumn_result['OtherInformationName19'];
            $OtherInformationType19 = $one_search_spreadsheetcolumn_result['OtherInformationType19']; 
            $OtherInformationName20 = $one_search_spreadsheetcolumn_result['OtherInformationName20'];
            $OtherInformationType20 = $one_search_spreadsheetcolumn_result['OtherInformationType20'];
            $OtherInformationName31 = $one_search_spreadsheetcolumn_result['OtherInformationName31'];
            $OtherInformationType31 = $one_search_spreadsheetcolumn_result['OtherInformationType31']; 
            $OtherInformationName32 = $one_search_spreadsheetcolumn_result['OtherInformationName32'];
            $OtherInformationType32 = $one_search_spreadsheetcolumn_result['OtherInformationType32']; 
            $OtherInformationName33 = $one_search_spreadsheetcolumn_result['OtherInformationName33'];
            $OtherInformationType33 = $one_search_spreadsheetcolumn_result['OtherInformationType33'];  
            $OtherInformationName34 = $one_search_spreadsheetcolumn_result['OtherInformationName34'];
            $OtherInformationType34 = $one_search_spreadsheetcolumn_result['OtherInformationType34']; 
            $OtherInformationName35 = $one_search_spreadsheetcolumn_result['OtherInformationName35'];
            $OtherInformationType35 = $one_search_spreadsheetcolumn_result['OtherInformationType35']; 
            $OtherInformationName36 = $one_search_spreadsheetcolumn_result['OtherInformationName36'];
            $OtherInformationType36 = $one_search_spreadsheetcolumn_result['OtherInformationType36']; 
            $OtherInformationName37 = $one_search_spreadsheetcolumn_result['OtherInformationName37'];
            $OtherInformationType37 = $one_search_spreadsheetcolumn_result['OtherInformationType37'];  
            $OtherInformationName38 = $one_search_spreadsheetcolumn_result['OtherInformationName38'];
            $OtherInformationType38 = $one_search_spreadsheetcolumn_result['OtherInformationType38']; 
            $OtherInformationName39 = $one_search_spreadsheetcolumn_result['OtherInformationName39'];
            $OtherInformationType39 = $one_search_spreadsheetcolumn_result['OtherInformationType39']; 
            $OtherInformationName40 = $one_search_spreadsheetcolumn_result['OtherInformationName40'];
            $OtherInformationType40 = $one_search_spreadsheetcolumn_result['OtherInformationType40'];
            $OtherInformationName41 = $one_search_spreadsheetcolumn_result['OtherInformationName41'];
            $OtherInformationType41 = $one_search_spreadsheetcolumn_result['OtherInformationType41']; 
            $OtherInformationName42 = $one_search_spreadsheetcolumn_result['OtherInformationName42'];
            $OtherInformationType42 = $one_search_spreadsheetcolumn_result['OtherInformationType42']; 
            $OtherInformationName43 = $one_search_spreadsheetcolumn_result['OtherInformationName43'];
            $OtherInformationType43 = $one_search_spreadsheetcolumn_result['OtherInformationType43'];  
            $OtherInformationName44 = $one_search_spreadsheetcolumn_result['OtherInformationName44'];
            $OtherInformationType44 = $one_search_spreadsheetcolumn_result['OtherInformationType44']; 
            $OtherInformationName45 = $one_search_spreadsheetcolumn_result['OtherInformationName45'];
            $OtherInformationType45 = $one_search_spreadsheetcolumn_result['OtherInformationType45']; 
            $OtherInformationName46 = $one_search_spreadsheetcolumn_result['OtherInformationName46'];
            $OtherInformationType46 = $one_search_spreadsheetcolumn_result['OtherInformationType46']; 
            $OtherInformationName47 = $one_search_spreadsheetcolumn_result['OtherInformationName47'];
            $OtherInformationType47 = $one_search_spreadsheetcolumn_result['OtherInformationType47'];  
            $OtherInformationName48 = $one_search_spreadsheetcolumn_result['OtherInformationName48'];
            $OtherInformationType48 = $one_search_spreadsheetcolumn_result['OtherInformationType48']; 
            $OtherInformationName49 = $one_search_spreadsheetcolumn_result['OtherInformationName49'];
            $OtherInformationType49 = $one_search_spreadsheetcolumn_result['OtherInformationType49']; 
            $OtherInformationName50 = $one_search_spreadsheetcolumn_result['OtherInformationName50'];
            $OtherInformationType50 = $one_search_spreadsheetcolumn_result['OtherInformationType50'];
        }
        
        $search_spreadsheetcontent_sql = "SELECT * FROM spreadsheetcontent WHERE Id = '$SpreadSheetContentId'";
        $search_spreadsheetcontent_result = mysqli_query($conn, $search_spreadsheetcontent_sql);
        if (!$search_spreadsheetcontent_result || mysqli_num_rows($search_spreadsheetcontent_result) == 0){
        
        }
        else {
            $one_search_spreadsheetcontent_result = mysqli_fetch_assoc($search_spreadsheetcontent_result);
            $VerificationCode = $one_search_spreadsheetcontent_result['VerificationCode'];
            $Information1 = $one_search_spreadsheetcontent_result['Information1'];
            $Information2 = $one_search_spreadsheetcontent_result['Information2'];
            $Information3 = $one_search_spreadsheetcontent_result['Information3'];
            $Information4 = $one_search_spreadsheetcontent_result['Information4'];
            $Information5 = $one_search_spreadsheetcontent_result['Information5'];
            $Information6 = $one_search_spreadsheetcontent_result['Information6'];
            $Information7 = $one_search_spreadsheetcontent_result['Information7'];
            $Information8 = $one_search_spreadsheetcontent_result['Information8'];
            $Information9 = $one_search_spreadsheetcontent_result['Information9'];
            $Information10 = $one_search_spreadsheetcontent_result['Information10'];
            $OtherInformation1 = $one_search_spreadsheetcontent_result['OtherInformation1'];
            $OtherInformation2 = $one_search_spreadsheetcontent_result['OtherInformation2'];
            $OtherInformation3 = $one_search_spreadsheetcontent_result['OtherInformation3'];
            $OtherInformation4 = $one_search_spreadsheetcontent_result['OtherInformation4'];
            $OtherInformation5 = $one_search_spreadsheetcontent_result['OtherInformation5'];
            $OtherInformation6 = $one_search_spreadsheetcontent_result['OtherInformation6'];
            $OtherInformation7 = $one_search_spreadsheetcontent_result['OtherInformation7'];
            $OtherInformation8 = $one_search_spreadsheetcontent_result['OtherInformation8'];
            $OtherInformation9 = $one_search_spreadsheetcontent_result['OtherInformation9'];
            $OtherInformation10 = $one_search_spreadsheetcontent_result['OtherInformation10'];
            $OtherInformation11 = $one_search_spreadsheetcontent_result['OtherInformation11'];
            $OtherInformation12 = $one_search_spreadsheetcontent_result['OtherInformation12'];
            $OtherInformation13 = $one_search_spreadsheetcontent_result['OtherInformation13'];
            $OtherInformation14 = $one_search_spreadsheetcontent_result['OtherInformation14'];
            $OtherInformation15 = $one_search_spreadsheetcontent_result['OtherInformation15'];
            $OtherInformation16 = $one_search_spreadsheetcontent_result['OtherInformation16'];
            $OtherInformation17 = $one_search_spreadsheetcontent_result['OtherInformation17'];
            $OtherInformation18 = $one_search_spreadsheetcontent_result['OtherInformation18'];
            $OtherInformation19 = $one_search_spreadsheetcontent_result['OtherInformation19'];
            $OtherInformation20 = $one_search_spreadsheetcontent_result['OtherInformation20'];
            $OtherInformation21 = $one_search_spreadsheetcontent_result['OtherInformation21'];
            $OtherInformation22 = $one_search_spreadsheetcontent_result['OtherInformation22'];
            $OtherInformation23 = $one_search_spreadsheetcontent_result['OtherInformation23'];
            $OtherInformation24 = $one_search_spreadsheetcontent_result['OtherInformation24'];
            $OtherInformation25 = $one_search_spreadsheetcontent_result['OtherInformation25'];
            $OtherInformation26 = $one_search_spreadsheetcontent_result['OtherInformation26'];
            $OtherInformation27 = $one_search_spreadsheetcontent_result['OtherInformation27'];
            $OtherInformation28 = $one_search_spreadsheetcontent_result['OtherInformation28'];
            $OtherInformation29 = $one_search_spreadsheetcontent_result['OtherInformation29'];
            $OtherInformation30 = $one_search_spreadsheetcontent_result['OtherInformation30'];
            $OtherInformation31 = $one_search_spreadsheetcontent_result['OtherInformation31'];
            $OtherInformation32 = $one_search_spreadsheetcontent_result['OtherInformation32'];
            $OtherInformation33 = $one_search_spreadsheetcontent_result['OtherInformation33'];
            $OtherInformation34 = $one_search_spreadsheetcontent_result['OtherInformation34'];
            $OtherInformation35 = $one_search_spreadsheetcontent_result['OtherInformation35'];
            $OtherInformation36 = $one_search_spreadsheetcontent_result['OtherInformation36'];
            $OtherInformation37 = $one_search_spreadsheetcontent_result['OtherInformation37'];
            $OtherInformation38 = $one_search_spreadsheetcontent_result['OtherInformation38'];
            $OtherInformation39 = $one_search_spreadsheetcontent_result['OtherInformation39'];
            $OtherInformation40 = $one_search_spreadsheetcontent_result['OtherInformation40'];
            $OtherInformation41 = $one_search_spreadsheetcontent_result['OtherInformation41'];
            $OtherInformation42 = $one_search_spreadsheetcontent_result['OtherInformation42'];
            $OtherInformation43 = $one_search_spreadsheetcontent_result['OtherInformation43'];
            $OtherInformation44 = $one_search_spreadsheetcontent_result['OtherInformation44'];
            $OtherInformation45 = $one_search_spreadsheetcontent_result['OtherInformation45'];
            $OtherInformation46 = $one_search_spreadsheetcontent_result['OtherInformation46'];
            $OtherInformation47 = $one_search_spreadsheetcontent_result['OtherInformation47'];
            $OtherInformation48 = $one_search_spreadsheetcontent_result['OtherInformation48'];
            $OtherInformation49 = $one_search_spreadsheetcontent_result['OtherInformation49'];
            $OtherInformation50 = $one_search_spreadsheetcontent_result['OtherInformation50'];
            
            if(!empty($OtherInformation1)) {
                $OtherInformationArray[count($OtherInformationArray)] = 1;
            }
            if(!empty($OtherInformation2)) {
                $OtherInformationArray[count($OtherInformationArray)] = 2;
            }
            if(!empty($OtherInformation3)) {
                $OtherInformationArray[count($OtherInformationArray)] = 3;
            }
            if(!empty($OtherInformation4)) {
                $OtherInformationArray[count($OtherInformationArray)] = 4;
            }
            if(!empty($OtherInformation5)) {
                $OtherInformationArray[count($OtherInformationArray)] = 5;
            }
            if(!empty($OtherInformation6)) {
                $OtherInformationArray[count($OtherInformationArray)] = 6;
            }
            if(!empty($OtherInformation7)) {
                $OtherInformationArray[count($OtherInformationArray)] = 7;
            }
            if(!empty($OtherInformation8)) {
                $OtherInformationArray[count($OtherInformationArray)] = 8;
            }
            if(!empty($OtherInformation9)) {
                $OtherInformationArray[count($OtherInformationArray)] = 9;
            }
            if(!empty($OtherInformation10)) {
                $OtherInformationArray[count($OtherInformationArray)] = 10;
            }
            if(!empty($OtherInformation11)) {
                $OtherInformationArray[count($OtherInformationArray)] = 11;
            }
            if(!empty($OtherInformation12)) {
                $OtherInformationArray[count($OtherInformationArray)] = 12;
            }
            if(!empty($OtherInformation13)) {
                $OtherInformationArray[count($OtherInformationArray)] = 13;
            }
            if(!empty($OtherInformation14)) {
                $OtherInformationArray[count($OtherInformationArray)] = 14;
            }
            if(!empty($OtherInformation15)) {
                $OtherInformationArray[count($OtherInformationArray)] = 15;
            }
            if(!empty($OtherInformation16)) {
                $OtherInformationArray[count($OtherInformationArray)] = 16;
            }
            if(!empty($OtherInformation17)) {
                $OtherInformationArray[count($OtherInformationArray)] = 17;
            }
            if(!empty($OtherInformation18)) {
                $OtherInformationArray[count($OtherInformationArray)] = 18;
            }
            if(!empty($OtherInformation19)) {
                $OtherInformationArray[count($OtherInformationArray)] = 19;
            }
            if(!empty($OtherInformation20)) {
                $OtherInformationArray[count($OtherInformationArray)] = 20;
            }
            if(!empty($OtherInformation21)) {
                $OtherInformationArray[count($OtherInformationArray)] = 21;
            }
            if(!empty($OtherInformation22)) {
                $OtherInformationArray[count($OtherInformationArray)] = 22;
            }
            if(!empty($OtherInformation23)) {
                $OtherInformationArray[count($OtherInformationArray)] = 23;
            }
            if(!empty($OtherInformation24)) {
                $OtherInformationArray[count($OtherInformationArray)] = 24;
            }
            if(!empty($OtherInformation25)) {
                $OtherInformationArray[count($OtherInformationArray)] = 25;
            }
            if(!empty($OtherInformation26)) {
                $OtherInformationArray[count($OtherInformationArray)] = 26;
            }
            if(!empty($OtherInformation27)) {
                $OtherInformationArray[count($OtherInformationArray)] = 27;
            }
            if(!empty($OtherInformation28)) {
                $OtherInformationArray[count($OtherInformationArray)] = 28;
            }
            if(!empty($OtherInformation29)) {
                $OtherInformationArray[count($OtherInformationArray)] = 29;
            }
            if(!empty($OtherInformation30)) {
                $OtherInformationArray[count($OtherInformationArray)] = 30;
            }
            if(!empty($OtherInformation31)) {
                $OtherInformationArray[count($OtherInformationArray)] = 31;
            }
            if(!empty($OtherInformation32)) {
                $OtherInformationArray[count($OtherInformationArray)] = 32;
            }
            if(!empty($OtherInformation33)) {
                $OtherInformationArray[count($OtherInformationArray)] = 33;
            }
            if(!empty($OtherInformation34)) {
                $OtherInformationArray[count($OtherInformationArray)] = 34;
            }
            if(!empty($OtherInformation35)) {
                $OtherInformationArray[count($OtherInformationArray)] = 35;
            }
            if(!empty($OtherInformation36)) {
                $OtherInformationArray[count($OtherInformationArray)] = 36;
            }
            if(!empty($OtherInformation37)) {
                $OtherInformationArray[count($OtherInformationArray)] = 37;
            }
            if(!empty($OtherInformation38)) {
                $OtherInformationArray[count($OtherInformationArray)] = 38;
            }
            if(!empty($OtherInformation39)) {
                $OtherInformationArray[count($OtherInformationArray)] = 39;
            }
            if(!empty($OtherInformation40)) {
                $OtherInformationArray[count($OtherInformationArray)] = 40;
            }
            if(!empty($OtherInformation41)) {
                $OtherInformationArray[count($OtherInformationArray)] = 41;
            }
            if(!empty($OtherInformation42)) {
                $OtherInformationArray[count($OtherInformationArray)] = 42;
            }
            if(!empty($OtherInformation43)) {
                $OtherInformationArray[count($OtherInformationArray)] = 43;
            }
            if(!empty($OtherInformation44)) {
                $OtherInformationArray[count($OtherInformationArray)] = 44;
            }
            if(!empty($OtherInformation45)) {
                $OtherInformationArray[count($OtherInformationArray)] = 45;
            }
            if(!empty($OtherInformation46)) {
                $OtherInformationArray[count($OtherInformationArray)] = 46;
            }
            if(!empty($OtherInformation47)) {
                $OtherInformationArray[count($OtherInformationArray)] = 47;
            }
            if(!empty($OtherInformation48)) {
                $OtherInformationArray[count($OtherInformationArray)] = 48;
            }
            if(!empty($OtherInformation49)) {
                $OtherInformationArray[count($OtherInformationArray)] = 49;
            }
            if(!empty($OtherInformation50)) {
                $OtherInformationArray[count($OtherInformationArray)] = 50;
            }
            
            $CountCategory1ItemArray = explode(",", $CountCategory1Item);
            $CountCategory2ItemArray = explode(",", $CountCategory2Item);
            $CountCategory3ItemArray = explode(",", $CountCategory3Item);
            $CountCategory4ItemArray = explode(",", $CountCategory4Item);
            $CountCategory5ItemArray = explode(",", $CountCategory5Item);
            
            for($i=0; $i<count($OtherInformationArray); $i++) {
                if($CountCategory1ItemArray[0] <= $OtherInformationArray[$i] && $CountCategory1ItemArray[1] >= $OtherInformationArray[$i]) {
                    $Category1ItemArray[count($Category1ItemArray)] = $OtherInformationArray[$i];
                }
                if($CountCategory2ItemArray[0] <= $OtherInformationArray[$i] && $CountCategory2ItemArray[1] >= $OtherInformationArray[$i]) {
                    $Category2ItemArray[count($Category2ItemArray)] = $OtherInformationArray[$i];
                }
                if($CountCategory3ItemArray[0] <= $OtherInformationArray[$i] && $CountCategory3ItemArray[1] >= $OtherInformationArray[$i]) {
                    $Category3ItemArray[count($Category3ItemArray)] = $OtherInformationArray[$i];
                }
                if($CountCategory4ItemArray[0] <= $OtherInformationArray[$i] && $CountCategory4ItemArray[1] >= $OtherInformationArray[$i]) {
                    $Category4ItemArray[count($Category4ItemArray)] = $OtherInformationArray[$i];
                }
                if($CountCategory5ItemArray[0] <= $OtherInformationArray[$i] && $CountCategory5ItemArray[1] >= $OtherInformationArray[$i]) {
                    $Category5ItemArray[count($Category5ItemArray)] = $OtherInformationArray[$i];
                }
            }
        }
        
        mysqli_close($conn);
    }
    else {
        header("Location:404.php");
    }
?>



<!DOCTYLE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1, maximum-scale=3, minimum-scale=1, user-scalable=yes">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>EventDat</title>
        <link rel='stylesheet' href='css/result.css' type='text/css' />
        <script type="text/javascript" src="../js/qrcode/qrcode.js"></script>
    </head>
    <body>
        <h1 class="title">User Info</h1>
        <h2 class="subtitle"><?php echo $SheetName; ?></h2>
        <p class="subject"><?php echo $SheetSubject; ?></p>
        <?php
            if(!empty($Feedback)) {
            ?>
            <div class="feedback">
                <p><?php 
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
                echo $Feedback;
                ?></p>
                <?php
            ?></div>
            <?php
            }
            if($isOtherInformation == 1) {
            ?>    
                <div id="qrcode"></div>
            <?php        
            }
        ?>
        <div class="backBTNContainer">
            <?php
                if($UserDetails == 1) {
                ?> 
                    <a href="signIn.php?Id=<?php echo $SpreadSheetColumnId; ?>"><button class="backBTN">Back</button></a>
                <?php
                }
                else {
                ?>  
                    <label class="checkDetail">Details >></label>
                    <a href="registration.php?Id=<?php echo $SpreadSheetColumnId; ?>"><button class="backBTN">Back</button></a>
                <?php
                }
            ?>
        </div>
        <!--======================== The Modal ============================-->
        <div id="myModal" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
                <span class="close">&times;</span>
                <div class="moreDetail">
                    <?php
                        if(count($Category1ItemArray) > 0) {
                        ?> 
                            <p class="CategoryName"><?php echo $Category1Name; ?></p>
                        <?php
                            for($a=0; $a<count($Category1ItemArray); $a++) {
                                $OtherInformationName = "OtherInformationName$Category1ItemArray[$a]";
                                $OtherInformationType = "OtherInformationType$Category1ItemArray[$a]";
                                $OtherInformation = "OtherInformation$Category1ItemArray[$a]";
                                ?>
                                    <label class="OtherInformationName"><?php echo $$OtherInformationName; ?>:</label>
                                <?php
                                if($$OtherInformationType != "Text") {
                                ?>
                                    <label class="OtherInformation"><?php echo $$OtherInformation; ?></label>
                                <?php    
                                }
                                else {
                                ?>    
                                    <div class="imageContainer">
                                        <img src="../image/tick.png" />
                                    </div>
                                <?php
                                }
                                ?>
                                <br>
                            <?php
                            }
                        }
                        if(count($Category2ItemArray) > 0) {
                        ?> 
                            <p class="CategoryName"><?php echo $Category2Name; ?></p>
                        <?php
                            for($a=0; $a<count($Category2ItemArray); $a++) {
                                $OtherInformationName = "OtherInformationName$Category2ItemArray[$a]";
                                $OtherInformationType = "OtherInformationType$Category2ItemArray[$a]";
                                $OtherInformation = "OtherInformation$Category2ItemArray[$a]";
                                ?>
                                    <label class="OtherInformationName"><?php echo $$OtherInformationName; ?>:</label>

                                <?php
                                if($$OtherInformationType != "Text") {
                                ?>
                                    <label class="OtherInformation"><?php echo $$OtherInformation; ?></label>
                                <?php    
                                }
                                else {
                                ?>    
                                    <div class="imageContainer">
                                        <img src="../image/tick.png" />
                                    </div>
                                <?php
                                }
                                ?>
                                <br>
                            <?php
                            }
                        }
                        if(count($Category3ItemArray) > 0) {
                        ?> 
                            <p class="CategoryName"><?php echo $Category3Name; ?></p>
                        <?php
                            for($a=0; $a<count($Category3ItemArray); $a++) {
                                $OtherInformationName = "OtherInformationName$Category3ItemArray[$a]";
                                $OtherInformationType = "OtherInformationType$Category3ItemArray[$a]";
                                $OtherInformation = "OtherInformation$Category3ItemArray[$a]";
                                ?>
                                    <label class="OtherInformationName"><?php echo $$OtherInformationName; ?>:</label>

                                <?php
                                if($$OtherInformationType != "Text") {
                                ?>
                                    <label class="OtherInformation"><?php echo $$OtherInformation; ?></label>
                                <?php    
                                }
                                else {
                                ?>    
                                    <div class="imageContainer">
                                        <img src="../image/tick.png" />
                                    </div>
                                <?php
                                }
                                ?>
                                <br>
                            <?php
                            }
                        }
                        if(count($Category4ItemArray) > 0) {
                        ?> 
                            <p class="CategoryName"><?php echo $Category4Name; ?></p>
                        <?php
                            for($a=0; $a<count($Category4ItemArray); $a++) {
                                $OtherInformationName = "OtherInformationName$Category4ItemArray[$a]";
                                $OtherInformationType = "OtherInformationType$Category4ItemArray[$a]";
                                $OtherInformation = "OtherInformation$Category4ItemArray[$a]";
                                ?>
                                    <label class="OtherInformationName"><?php echo $$OtherInformationName; ?>:</label>

                                <?php
                                if($$OtherInformationType != "Text") {
                                ?>
                                    <label class="OtherInformation"><?php echo $$OtherInformation; ?></label>
                                <?php    
                                }
                                else {
                                ?>    
                                    <div class="imageContainer">
                                        <img src="../image/tick.png" />
                                    </div>
                                <?php
                                }
                                ?>
                                <br>
                            <?php
                            }
                        }
                        if(count($Category5ItemArray) > 0) {
                        ?> 
                            <p class="CategoryName"><?php echo $Category5Name; ?></p>
                        <?php
                            for($a=0; $a<count($Category5ItemArray); $a++) {
                                $OtherInformationName = "OtherInformationName$Category5ItemArray[$a]";
                                $OtherInformationType = "OtherInformationType$Category5ItemArray[$a]";
                                $OtherInformation = "OtherInformation$Category5ItemArray[$a]";
                                ?>
                                    <label class="OtherInformationName"><?php echo $$OtherInformationName; ?>:</label>

                                <?php
                                if($$OtherInformationType != "Text") {
                                ?>
                                    <label class="OtherInformation"><?php echo $$OtherInformation; ?></label>
                                <?php    
                                }
                                else {
                                ?>    
                                    <div class="imageContainer">
                                        <img src="../image/tick.png" />
                                    </div>
                                <?php
                                }
                                ?>
                                <br>
                            <?php
                            }
                        }
                        if(count($Category1ItemArray) == 0 && count($Category2ItemArray) == 0 && count($Category3ItemArray) == 0 && count($Category4ItemArray) == 0 && count($Category5ItemArray) == 0) {
                        ?>
                            <p class="CategoryName">No Records</p>
                        <?php    
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>

<script>
    var boolCheckDetail = false;
    
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        width: 300,
        height: 300
    });

    function makeCode() {
        var url = "http://<?php echo $ipaddress; ?>/EventDat/admin/scanResult.php?SpreadSheetContentId=<?php echo $SpreadSheetContentId; ?>";
        qrcode.makeCode(url);
    }
    makeCode();
</script>

<script>
    var modal = document.getElementById('myModal');
    var btn = document.getElementsByClassName("checkDetail")[0];
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>