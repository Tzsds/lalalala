<?php
    require_once 'config.php';

    session_start();
    
    if (isset($_SESSION['Email']) && isset($_GET['Id'])) {
        $Email = $_SESSION['Email'];
        $Id = $_GET['Id'];
        
        $conn = mysqli_connect(HOST, USER, PASS, DB) or die('Unable to Connect...');
        $delete_sql = "DELETE FROM spreadsheetcolumn WHERE Id = $Id;";
        $delete_sql .= "DELETE FROM spreadsheetcontent WHERE SpreadSheetColumnId = $Id;";
        
        $delete_sql .= "DELETE FROM information2 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM information3 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM information4 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM information5 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM information6 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM information7 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM information8 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM information9 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM information10 WHERE SpreadSheetColumnId = $Id;";
        
        $delete_sql .= "DELETE FROM otherinformation1 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM otherinformation2 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM otherinformation3 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM otherinformation4 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM otherinformation5 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM otherinformation6 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM otherinformation7 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM otherinformation8 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM otherinformation9 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM otherinformation10 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM otherinformation11 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM otherinformation12 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM otherinformation13 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM otherinformation14 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM otherinformation15 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM otherinformation16 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM otherinformation17 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM otherinformation18 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM otherinformation19 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM otherinformation20 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM otherinformation21 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM otherinformation22 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM otherinformation23 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM otherinformation24 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM otherinformation25 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM otherinformation26 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM otherinformation27 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM otherinformation28 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM otherinformation29 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM otherinformation30 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM otherinformation31 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM otherinformation32 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM otherinformation33 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM otherinformation34 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM otherinformation35 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM otherinformation36 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM otherinformation37 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM otherinformation38 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM otherinformation39 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM otherinformation40 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM otherinformation41 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM otherinformation42 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM otherinformation43 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM otherinformation44 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM otherinformation45 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM otherinformation46 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM otherinformation47 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM otherinformation48 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM otherinformation49 WHERE SpreadSheetColumnId = $Id;";
        $delete_sql .= "DELETE FROM otherinformation50 WHERE SpreadSheetColumnId = $Id;";
        
        if (mysqli_multi_query($conn, $delete_sql)) {
            do {
                if ($result = mysqli_store_result($conn)) {
                    while ($row = mysqli_fetch_array($result)) {
                        
                    }
                    mysqli_free_result($result);
                }
            }
            while (mysqli_more_results($conn) && mysqli_next_result($conn));
        }
        mysqli_close($conn);
        
        if(is_file("excel/".$Email."_".$Id.".xlsx")) {
            unlink("excel/".$Email."_".$Id.".xlsx");
        };
        header("Location:sheet.php");
    }
    else {
        header("Location:login.php");
    }
?>