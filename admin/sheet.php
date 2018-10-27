<?php
    require_once 'config.php';

    session_start();

    if (isset($_SESSION['Email'])) {
        $Email = $_SESSION['Email'];
        
        $conn = mysqli_connect(HOST, USER, PASS, DB) or die('Unable to Connect...');
            
        $search_sql = "SELECT * FROM spreadsheetcolumn WHERE Email = '$Email' ORDER BY TimeStamp DESC";
        $search_result = mysqli_query($conn, $search_sql);
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
        <link rel='stylesheet' href='css/sheet.css' type='text/css' />
    </head>
    <body>
        <h1 class="title">EventDat</h1>
        <?php
            if (isset($_SESSION['Email'])) {
                $Email = $_SESSION['Email'];
                echo "<p class='email'>Hello, $Email</p>";
            }
        ?>
        <table border="1">
            <tr>
                <th>User Details</th>
                <th>Sheet Name</th>
                <th>Sheet Subject</th>
                <th>Time Stamp</th>
                <th>User</th>
                <th>Organizer</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>View User</th>
                <th>View Sheet</th>
                <th>Export Sheet</th>
                <th>Email</th>
            </tr>
            <?php
                if (!$search_result || mysqli_num_rows($search_result) == 0){
                ?>
                    <tr>
                        <td colspan="12">No Record</td>
                    </tr>  
                <?php      
                }
                else {
                    $WithCategoryView = 0;
                    $WithoutCategoryView = 0;
                    $WithCategoryExport = 0;
                    $WithoutCategoryExport = 0;
                    
                    while ($one_search_result = mysqli_fetch_assoc($search_result)) {
                        $Id = $one_search_result['Id'];
                        $IsUserDetails = $one_search_result['IsUserDetails'];
                        $IsEmailNotification = $one_search_result['IsEmailNotification'];
                        $Category1Name = $one_search_result['Category1Name'];
                        $Category2Name = $one_search_result['Category2Name'];
                        $Category3Name = $one_search_result['Category3Name'];
                        $Category4Name = $one_search_result['Category4Name'];
                        $Category5Name = $one_search_result['Category5Name'];
                    ?>
                    <tr>
                        <td>
                            <?php
                                if($IsUserDetails == 1) {
                                    echo "Yes";
                                }
                                else {
                                    echo "No";
                                }
                            ?>
                        </td>
                        <td><?php echo $one_search_result['SheetName']; ?></td>
                        <td><label class="sheetSubject"><?php echo $one_search_result['SheetSubject']; ?></label></td>
                        <td><?php echo $one_search_result['TimeStamp']; ?></td>
                        <td>
                            <a href="qrCode.php?Target=User&&Id=<?php echo $Id; ?>" target="__blank "><button type="button">QRCode</button></a>
                        </td>
                        <td>
                        <?php
                            if($one_search_result['isOtherInformation'] == 1) {
                            ?>
                                <a href="qrCode.php?Target=Organizer&&Id=<?php echo $one_search_result['Id']; ?>" target="__blank "><button type="button">QRCode</button></a>
                            <?php
                            }
                            else {
                            ?>    
                                <button type="button" disabled>QRCode</button>
                            <?php
                            }
                        ?>
                        </td>
                        <td>
                            <?php
                                if($IsUserDetails == 0) {
                                ?>    
                                    <a href="updateSheet.php?Id=<?php echo $one_search_result['Id']; ?>"><button type="button">Edit</button></a>
                                <?php
                                }
                                else {
                                    $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE 	SpreadSheetColumnId = $Id";
                                    $search_content_result = mysqli_query($conn, $search_content_sql);
                                    $result_content_found = mysqli_num_rows($search_content_result);
                                    if($result_content_found >= 1) {
                                    ?>
                                        <button type="button" disabled>Edit</button>
                                    <?php
                                    }
                                    else {
                                    ?>    
                                        <a href="updateSheet.php?Id=<?php echo $one_search_result['Id']; ?>"><button type="button">Edit</button></a>
                                    <?php
                                    }
                                }
                            ?>
                        </td>
                        <td>
                            <a href="deleteSheet.php?Id=<?php echo $one_search_result['Id']; ?>" onclick="if(confirm('Are you sure to delete?')==false)return false;"><button type="button">Delete</button></a>
                        </td>
                        <td>
                            <a href="viewUser.php?Id=<?php echo $one_search_result['Id']; ?>"><button type="button">View</button></a>
                        </td>
                        <td>
                        <?php
                            if(empty($Category1Name) && empty($Category2Name) && empty($Category3Name) && empty($Category4Name) && empty($Category5Name)) {
                                $WithoutCategoryView++;
                            ?>                                
                                <button type="button" onclick="viewSheetWithoutCategory(<?php echo $Id; ?>)">View</button>
                            <?php
                            }
                            else {
                                $WithCategoryView++;
                            ?>   
                                <select name="CategoryNameView">
                                <?php
                                    if(!empty($Category1Name)) {
                                    ?>
                                        <option value="Category1Name"><?php echo $Category1Name ?></option>
                                    <?php
                                    }
                                    if(!empty($Category2Name)) {
                                    ?>
                                        <option value="Category2Name"><?php echo $Category2Name ?></option>
                                    <?php
                                    }
                                    if(!empty($Category3Name)) {
                                    ?>
                                        <option value="Category3Name"><?php echo $Category3Name ?></option>
                                    <?php
                                    }
                                    if(!empty($Category4Name)) {
                                    ?>
                                        <option value="Category4Name"><?php echo $Category4Name ?></option>
                                    <?php
                                    }
                                    if(!empty($Category5Name)) {
                                    ?>
                                        <option value="Category5Name"><?php echo $Category5Name ?></option>
                                    <?php
                                    }
                                ?>
                                </select>
                                <button type="button" onclick="viewSheetWithCategory(<?php echo $Id; ?>, <?php echo $WithCategoryView; ?>)">View</button>
                            <?php
                            }
                        ?>
                        </td>
                        <td>
                        <?php
                            if(empty($Category1Name) && empty($Category2Name) && empty($Category3Name) && empty($Category4Name) && empty($Category5Name)) {
                                $WithoutCategoryExport++;
                            ?>                                
                                <button type="button" onclick="exportSheetWithoutCategory(<?php echo $Id; ?>)">Export</button>
                            <?php
                            }
                            else {
                                $WithCategoryExport++;
                            ?>   
                                <select name="CategoryNameExport">
                                <?php
                                    if(!empty($Category1Name)) {
                                    ?>
                                        <option value="Category1Name"><?php echo $Category1Name ?></option>
                                    <?php
                                    }
                                    if(!empty($Category2Name)) {
                                    ?>
                                        <option value="Category2Name"><?php echo $Category2Name ?></option>
                                    <?php
                                    }
                                    if(!empty($Category3Name)) {
                                    ?>
                                        <option value="Category3Name"><?php echo $Category3Name ?></option>
                                    <?php
                                    }
                                    if(!empty($Category4Name)) {
                                    ?>
                                        <option value="Category4Name"><?php echo $Category4Name ?></option>
                                    <?php
                                    }
                                    if(!empty($Category5Name)) {
                                    ?>
                                        <option value="Category5Name"><?php echo $Category5Name ?></option>
                                    <?php
                                    }
                                ?>
                                </select>
                                <button type="button" onclick="exportSheetWithCategory(<?php echo $Id; ?>, <?php echo $WithCategoryExport; ?>)">Export</button>
                            <?php
                            }
                        ?>
                        </td>
                        <td>
                            <?php
                                if($IsEmailNotification == 1) {
                                ?>
                                    <a href="emailNotification.php?Id=<?php echo $Id; ?>"><button type="button">Email</button></a>
                                <?php
                                }
                                else {
                                ?>    
                                    <button type="button" disabled>Email</button>
                                <?php
                                }
                            ?>
                        </td>
                    </tr>
                    <?php
                    }
                }
                mysqli_close($conn);
            ?>
        </table>
        <div class="addSheetAndLogoutBTN">
            <a href="addSheet.php"><button>Add new sheet</button></a>
            <button type="button" onclick="goToLogout();" >Logout</button>
        </div>
    </body>
</html>

<script>
    function goToLogout() {
        window.location.href = "logout.php";
    }
    function exportSheetWithCategory(id, category) {
        var v = document.getElementsByName("CategoryNameExport")[category-1].value;
        window.location.href = "exportSheet.php?Id="+id+"&&CategoryName="+v;
    }
    function exportSheetWithoutCategory(id, category) {
        window.location.href = "exportSheet.php?Id="+id+"&&CategoryName=Null";
    }
    function viewSheetWithCategory(id, category) {
        var v = document.getElementsByName("CategoryNameView")[category-1].value;
        window.location.href = "viewSheet.php?Id="+id+"&&CategoryName="+v;
    }
    function viewSheetWithoutCategory(id, category) {
        window.location.href = "viewSheet.php?Id="+id+"&&CategoryName=Null";
    }
</script>