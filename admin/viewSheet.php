<?php
    require_once 'config.php';

    session_start();

    if (isset($_SESSION['Email'])) {
        $Email = $_SESSION['Email'];
        
        if(isset($_GET['Id']) && isset($_GET['CategoryName'])) {
            $Id = $_GET['Id'];
            $CategoryName = $_GET['CategoryName'];
            
            $conn = mysqli_connect(HOST, USER, PASS, DB) or die('Unable to Connect...');

            $search_infocolumn_sql = "SELECT * FROM spreadsheetcolumn WHERE Id = $Id";
            $search_infocolumn_result = mysqli_query($conn, $search_infocolumn_sql);
        }
        else {
            header("Location:../404.php");
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
        <link rel='stylesheet' href='css/viewSheet.css' type='text/css' />
        <style>

        </style>
    </head>
    <body>
    <?php
        if (!$search_infocolumn_result || mysqli_num_rows($search_infocolumn_result) == 0){
        ?>
            <h1 class="title">No Record</h1> 
        <?php      
        }
        else {  
            $one_search_infocolumn_result = mysqli_fetch_assoc($search_infocolumn_result);
            
            $SheetName = $one_search_infocolumn_result['SheetName'];
            $SheetSubject = $one_search_infocolumn_result['SheetSubject'];
            ?>
            <h1 class="title"><?php echo $SheetName; ?></h1> 
            <h2 class="subtitle"><?php echo $SheetSubject; ?></h2> 
            <table id="table" border="1" cellspacing="0" align="center">
                <?php 
                $InformationName1 = $one_search_infocolumn_result['InformationName1'];
                $InformationName2 = $one_search_infocolumn_result['InformationName2'];
                $InformationName3 = $one_search_infocolumn_result['InformationName3'];
                $InformationName4 = $one_search_infocolumn_result['InformationName4'];
                $InformationName5 = $one_search_infocolumn_result['InformationName5'];
                $InformationName6 = $one_search_infocolumn_result['InformationName6'];
                $InformationName7 = $one_search_infocolumn_result['InformationName7'];
                $InformationName8 = $one_search_infocolumn_result['InformationName8'];
                $InformationName9 = $one_search_infocolumn_result['InformationName9'];
                $InformationName10 = $one_search_infocolumn_result['InformationName10'];
                $isOtherInformation = $one_search_infocolumn_result['isOtherInformation'];
                $Category1Name = $one_search_infocolumn_result['Category1Name'];
                $Category2Name = $one_search_infocolumn_result['Category2Name'];
                $Category3Name = $one_search_infocolumn_result['Category3Name'];
                $Category4Name = $one_search_infocolumn_result['Category4Name'];
                $Category5Name = $one_search_infocolumn_result['Category5Name'];
            
                $InformationColumn = 1;
                if(!empty($InformationName1)) {
                    $InformationColumn++;
                }
                if(!empty($InformationName2)) {
                    $InformationColumn++;
                }
                if(!empty($InformationName3)) {
                    $InformationColumn++;
                }
                if(!empty($InformationName4)) {
                    $InformationColumn++;
                }
                if(!empty($InformationName5)) {
                    $InformationColumn++;
                }
                if(!empty($InformationName6)) {
                    $InformationColumn++;
                }
                if(!empty($InformationName7)) {
                    $InformationColumn++;
                }
                if(!empty($InformationName8)) {
                    $InformationColumn++;
                }
                if(!empty($InformationName9)) {
                    $InformationColumn++;
                }
                if(!empty($InformationName10)) {
                    $InformationColumn++;
                }
                ?>
                <tr bgcolor="#dddddd">
                    <th id="informationCell" colspan="<?php echo $InformationColumn; ?>">Information</th>
                    <?php 
                    if($isOtherInformation == 1 && $CategoryName != "Null") {
                    ?>
                        <th id="borderCell" width="1px"></th>
                        <th id="otherInformationCell"><?php echo $$CategoryName; ?></th>
                    <?php
                    }
                    ?>
                </tr>
                <tr bgcolor="#e8e8e8">
                    <th>Time Stamp</th>
                    <?php
                    if(!empty($InformationName1)) {
                    ?>
                        <th><?php echo $InformationName1; ?></th>
                    <?php
                    }
                    if(!empty($InformationName2)) {
                    ?>
                        <th><?php echo $InformationName2; ?></th>
                    <?php    
                    }
                    if(!empty($InformationName3)) {
                    ?>
                        <th><?php echo $InformationName3; ?></th>
                    <?php    
                    }
                    if(!empty($InformationName4)) {
                    ?>
                        <th><?php echo $InformationName4; ?></th>
                    <?php    
                    }
                    if(!empty($InformationName5)) {
                    ?>
                        <th><?php echo $InformationName5; ?></th>
                    <?php    
                    }
                    if(!empty($InformationName6)) {
                    ?>
                        <th><?php echo $InformationName6; ?></th>
                    <?php    
                    }
                    if(!empty($InformationName7)) {
                    ?>
                        <th><?php echo $InformationName7; ?></th>
                    <?php    
                    }
                    if(!empty($InformationName8)) {
                    ?>
                        <th><?php echo $InformationName8; ?></th>
                    <?php    
                    }
                    if(!empty($InformationName9)) {
                    ?>
                        <th><?php echo $InformationName9; ?></th>
                    <?php    
                    }
                    if(!empty($InformationName10)) {
                    ?>
                        <th><?php echo $InformationName10; ?></th>
                    <?php    
                    }
                    if($isOtherInformation == 1 && $CategoryName != "Null") {
                        if($CategoryName == "Category1Name") {
                            $Category1Name = $one_search_infocolumn_result["Category1Name"];
                            $CountCategory1Item = $one_search_infocolumn_result["CountCategory1Item"];
                            $CountCategory1ItemArray = explode(",",$CountCategory1Item);

                            $k = 0;
                            for($i=$CountCategory1ItemArray[0]; $i<=$CountCategory1ItemArray[1]; $i++) {
                                $OtherInformationName = "OtherInformationName".$i;
                                $$OtherInformationName = $one_search_infocolumn_result["$OtherInformationName"];
                                ?>
                                    <th><?php echo $$OtherInformationName; ?></th>
                                <?php
                                $k++;
                            }
                            $OtherInfoColumnCount = $CountCategory1ItemArray[1]-$CountCategory1ItemArray[0]+1;
                            ?>
                            <script>
                                document.getElementById("otherInformationCell").colSpan = <?php echo $OtherInfoColumnCount; ?>;
                            </script>
                            <?php
                        }
                        if($CategoryName == "Category2Name") {
                            $Category2Name = $one_search_infocolumn_result["Category2Name"];
                            $CountCategory2Item = $one_search_infocolumn_result["CountCategory2Item"];
                            $CountCategory2ItemArray = explode(",",$CountCategory2Item);

                            $k = 0;
                            for($i=$CountCategory2ItemArray[0]; $i<=$CountCategory2ItemArray[1]; $i++) {
                                $OtherInformationName = "OtherInformationName".$i;
                                $$OtherInformationName = $one_search_infocolumn_result["$OtherInformationName"];
                                ?>
                                    <th><?php echo $$OtherInformationName; ?></th>
                                <?php
                                $k++;
                            }
                            $OtherInfoColumnCount = $CountCategory2ItemArray[1]-$CountCategory2ItemArray[0]+1;
                            ?>
                            <script>
                                document.getElementById("otherInformationCell").colSpan = <?php echo $OtherInfoColumnCount; ?>;
                            </script>
                            <?php
                        }
                        if($CategoryName == "Category3Name") {
                            $Category3Name = $one_search_infocolumn_result["Category3Name"];
                            $CountCategory3Item = $one_search_infocolumn_result["CountCategory3Item"];
                            $CountCategory3ItemArray = explode(",",$CountCategory3Item);

                            $k = 0;
                            for($i=$CountCategory3ItemArray[0]; $i<=$CountCategory3ItemArray[1]; $i++) {
                                $OtherInformationName = "OtherInformationName".$i;
                                $$OtherInformationName = $one_search_infocolumn_result["$OtherInformationName"];
                                ?>
                                    <th><?php echo $$OtherInformationName; ?></th>
                                <?php
                                $k++;
                            }
                            $OtherInfoColumnCount = $CountCategory3ItemArray[1]-$CountCategory3ItemArray[0]+1;
                            ?>
                            <script>
                                document.getElementById("otherInformationCell").colSpan = <?php echo $OtherInfoColumnCount; ?>;
                            </script>
                            <?php
                        }
                        if($CategoryName == "Category4Name") {
                            $Category4Name = $one_search_infocolumn_result["Category4Name"];
                            $CountCategory4Item = $one_search_infocolumn_result["CountCategory4Item"];
                            $CountCategory4ItemArray = explode(",",$CountCategory4Item);

                            $k = 0;
                            for($i=$CountCategory4ItemArray[0]; $i<=$CountCategory4ItemArray[1]; $i++) {
                                $OtherInformationName = "OtherInformationName".$i;
                                $$OtherInformationName = $one_search_infocolumn_result["$OtherInformationName"];
                                ?>
                                    <th><?php echo $$OtherInformationName; ?></th>
                                <?php
                                $k++;
                            }
                            $OtherInfoColumnCount = $CountCategory4ItemArray[1]-$CountCategory4ItemArray[0]+1;
                            ?>
                            <script>
                                document.getElementById("otherInformationCell").colSpan = <?php echo $OtherInfoColumnCount; ?>;
                            </script>
                            <?php
                        }
                        if($CategoryName == "Category5Name") {
                            $Category5Name = $one_search_infocolumn_result["Category5Name"];
                            $CountCategory5Item = $one_search_infocolumn_result["CountCategory5Item"];
                            $CountCategory5ItemArray = explode(",",$CountCategory5Item);

                            $k = 0;
                            for($i=$CountCategory5ItemArray[0]; $i<=$CountCategory5ItemArray[1]; $i++) {
                                $OtherInformationName = "OtherInformationName".$i;
                                $$OtherInformationName = $one_search_infocolumn_result["$OtherInformationName"];
                                ?>
                                    <th><?php echo $$OtherInformationName; ?></th>
                                <?php
                                $k++;
                            }
                            $OtherInfoColumnCount = $CountCategory5ItemArray[1]-$CountCategory5ItemArray[0]+1;
                            ?>
                            <script>
                                document.getElementById("otherInformationCell").colSpan = <?php echo $OtherInfoColumnCount; ?>;
                            </script>
                            <?php
                        }
                    }
                    ?>
                </tr>
                <?php
                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE SpreadSheetColumnId = $Id";
                $search_content_result = mysqli_query($conn, $search_content_sql);

                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){

                }
                else {
                    while ($one_search_content_result = mysqli_fetch_assoc($search_content_result)) {
                        $VerificationCode = $one_search_content_result["VerificationCode"];
                        $Information1 = $one_search_content_result["Information1"];
                        $Information2 = $one_search_content_result["Information2"];
                        $Information3 = $one_search_content_result["Information3"];
                        $Information4 = $one_search_content_result["Information4"];
                        $Information5 = $one_search_content_result["Information5"];
                        $Information6 = $one_search_content_result["Information6"];
                        $Information7 = $one_search_content_result["Information7"];
                        $Information8 = $one_search_content_result["Information8"];
                        $Information9 = $one_search_content_result["Information9"];
                        $Information10 = $one_search_content_result["Information10"];
                        $TimeStamp = $one_search_content_result["TimeStamp"];
                        ?>
                        <tr>
                            <td><?php echo $TimeStamp; ?></td>
                            <?php
                            if(!empty($InformationName1)) {
                            ?>
                                <td><?php echo $Information1; ?></td>
                            <?php
                            }
                            else {
                                if(!empty($InformationName2)) {
                                ?>
                                    <td></td>
                                <?php
                                }
                            }
                            if(!empty($InformationName2)) {
                            ?>
                                <td><?php echo $Information2; ?></td>
                            <?php    
                            }
                            else {
                                if(!empty($InformationName3)) {
                                ?>
                                    <td></td>
                                <?php
                                }
                            }
                            if(!empty($InformationName3)) {
                            ?>
                                <td><?php echo $Information3; ?></td>
                            <?php    
                            }
                            else {
                                if(!empty($InformationName4)) {
                                ?>
                                    <td></td>
                                <?php
                                }
                            }
                            if(!empty($InformationName4)) {
                            ?>
                                <td><?php echo $Information4; ?></td>
                            <?php    
                            }
                            else {
                                if(!empty($InformationName5)) {
                                ?>
                                    <td></td>
                                <?php
                                }
                            }
                            if(!empty($InformationName5)) {
                            ?>
                                <td><?php echo $Information5; ?></td>
                            <?php    
                            }
                            else {
                                if(!empty($InformationName6)) {
                                ?>
                                    <td></td>
                                <?php
                                }
                            }
                            if(!empty($InformationName6)) {
                            ?>
                                <td><?php echo $Information6; ?></td>
                            <?php    
                            }
                            else {
                                if(!empty($InformationName7)) {
                                ?>
                                    <td></td>
                                <?php
                                }
                            }
                            if(!empty($InformationName7)) {
                            ?>
                                <td><?php echo $Information7; ?></td>
                            <?php    
                            }
                            else {
                                if(!empty($InformationName8)) {
                                ?>
                                    <td></td>
                                <?php
                                }
                            }
                            if(!empty($InformationName8)) {
                            ?>
                                <td><?php echo $Information8; ?></td>
                            <?php    
                            }
                            else {
                                if(!empty($InformationName9)) {
                                ?>
                                    <td></td>
                                <?php
                                }
                            }
                            if(!empty($InformationName9)) {
                            ?>
                                <td><?php echo $Information9; ?></td>
                            <?php    
                            }
                            else {
                                if(!empty($InformationName10)) {
                                ?>
                                    <td></td>
                                <?php
                                }
                            }
                            if(!empty($InformationName10)) {
                            ?>
                                <td><?php echo $Information10; ?></td>
                            <?php    
                            }
                            if($isOtherInformation == 1 && $CategoryName != "Null") {
                            ?>
                                <?php
                                if($CategoryName == "Category1Name") {
                                    for($i=$CountCategory1ItemArray[0]; $i<=$CountCategory1ItemArray[1]; $i++) {
                                        $OtherInformation = "OtherInformation".$i;
                                        $$OtherInformation = $one_search_content_result["$OtherInformation"];
                                        ?>
                                            <td><?php echo $$OtherInformation; ?></td>
                                        <?php
                                    }
                                }
                                if($CategoryName == "Category2Name") {
                                    for($i=$CountCategory2ItemArray[0]; $i<=$CountCategory2ItemArray[1]; $i++) {
                                        $OtherInformation = "OtherInformation".$i;
                                        $$OtherInformation = $one_search_content_result["$OtherInformation"];
                                        ?>
                                            <td><?php echo $$OtherInformation; ?></td>
                                        <?php
                                    }
                                }
                                if($CategoryName == "Category3Name") {
                                    for($i=$CountCategory3ItemArray[0]; $i<=$CountCategory3ItemArray[1]; $i++) {
                                        $OtherInformation = "OtherInformation".$i;
                                        $$OtherInformation = $one_search_content_result["$OtherInformation"];
                                        ?>
                                            <td><?php echo $$OtherInformation; ?></td>
                                        <?php
                                    }
                                }
                                if($CategoryName == "Category4Name") {
                                    for($i=$CountCategory4ItemArray[0]; $i<=$CountCategory4ItemArray[1]; $i++) {
                                        $OtherInformation = "OtherInformation".$i;
                                        $$OtherInformation = $one_search_content_result["$OtherInformation"];
                                        ?>
                                            <td><?php echo $$OtherInformation; ?></td>
                                        <?php
                                    }
                                }
                                if($CategoryName == "Category5Name") {
                                    for($i=$CountCategory5ItemArray[0]; $i<=$CountCategory5ItemArray[1]; $i++) {
                                        $OtherInformation = "OtherInformation".$i;
                                        $$OtherInformation = $one_search_content_result["$OtherInformation"];
                                        ?>
                                            <td><?php echo $$OtherInformation; ?></td>
                                        <?php
                                    }
                                }
                            }
                            ?>
                        </tr>
                        <?php
                    }
                }
            ?>    
            </table>
            <div class="backBTN">
                <a href="sheet.php"><button type="button">Back</button></a>
            </div>
        <?php 
        }
        mysqli_close($conn);
    ?>
    </body>
</html>

<script>
    var rowCount = document.getElementById("table").rows.length;
    document.getElementById("borderCell").rowSpan = rowCount;
</script>