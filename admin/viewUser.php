<?php
    require_once 'config.php';

    session_start();

    if (isset($_SESSION['Email'])) {
        $Email = $_SESSION['Email'];
        
        if(isset($_GET['Id'])) {
            $Id = $_GET['Id'];
            
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
        <link rel='stylesheet' href='css/viewUser.css' type='text/css' />
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
            <?php 
                $InformationName1 = $one_search_infocolumn_result['InformationName1'];
            ?>
            <p class="searchBar">
                <?php echo $InformationName1; ?>:&nbsp;&nbsp;
                <?php
                    if(isset($_GET['Search']) && !empty($_GET['Search'])) {
                        $Search = $_GET['Search'];
                    ?>
                        <input id="searchTxt" type="text" placeholder="Search here" value="<?php echo $Search; ?>">&nbsp;&nbsp;
                    <?php
                    }
                    else {
                    ?>
                        <input id="searchTxt" type="text" placeholder="Search here">&nbsp;&nbsp;
                    <?php
                    }
                ?>
                <button type="button" onclick="search()">Search</button>
        </p>
            <table id="table" border="1" cellspacing="0" align="center">
            <?php 
                $InformationName2 = $one_search_infocolumn_result['InformationName2'];
                $InformationName3 = $one_search_infocolumn_result['InformationName3'];
                $InformationName4 = $one_search_infocolumn_result['InformationName4'];
                $InformationName5 = $one_search_infocolumn_result['InformationName5'];
                $InformationName6 = $one_search_infocolumn_result['InformationName6'];
                $InformationName7 = $one_search_infocolumn_result['InformationName7'];
                $InformationName8 = $one_search_infocolumn_result['InformationName8'];
                $InformationName9 = $one_search_infocolumn_result['InformationName9'];
                $InformationName10 = $one_search_infocolumn_result['InformationName10'];
            
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
                    <th id="informationCell" colspan="<?php echo $InformationColumn+1; ?>">Information</th>
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
                    ?>
                </tr>
                <?php
                if(isset($_GET['Search']) && !empty($_GET['Search'])) {
                    $Search = $_GET['Search'];
                    $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE SpreadSheetColumnId = $Id && Information1 LIKE '$Search%'";
                }
                else {
                    $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE SpreadSheetColumnId = $Id";
                }
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
    function search() {
        var searchTxt = document.getElementById("searchTxt").value;
        window.location.href = "viewUser.php?Id=<?php echo $Id; ?>&&Search="+searchTxt;
    }
</script>