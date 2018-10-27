<?php
    require_once 'config.php';
    require_once '../ipaddress.php';
    
    $msg = "";

    if (isset($_GET['Id']) && isset($_GET['Username']) && isset($_GET['Password'])) {
        $Id = $_GET['Id'];
        $Username = $_GET['Username'];
        $Password = $_GET['Password'];
        
        $conn = mysqli_connect(HOST, USER, PASS, DB) or die('Unable to Connect...');
        $search_sql = "SELECT * FROM spreadsheetcolumn WHERE Id = $Id && Username = '$Username' && Password = '$Password'";
        $search_result = mysqli_query($conn, $search_sql);
        $search_found = mysqli_num_rows($search_result);

        if($search_found >= 1) {
            
            // 表单提交
            if(isset($_POST['CategoryName']) && isset($_POST['OtherInformationName'])) {
                $CategoryName = $_POST['CategoryName'];
                $OtherInformationName = $_POST['OtherInformationName'];
                $CategoryNameArray = explode(',',$CategoryName);
                $OtherInformationNameArray = explode(',',$OtherInformationName);

                $Number = substr($OtherInformationNameArray[0], 20, strlen($OtherInformationNameArray[0]) - 20);
                $OtherInformationType = "OtherInformationType".$Number;

                $url = "https://$ipaddress/EventDat/QRCodeScanner/index.html?Id=".$Id."&&CategoryName=".$CategoryNameArray[0]."&&CategoryNameText=".$CategoryNameArray[1]."&&OtherInformationName=".$OtherInformationNameArray[0]."&&OtherInformationNameText=".$OtherInformationNameArray[1]."&&OtherInformationType=".$OtherInformationType."&&Username=".$Username."&&Password=".$Password;
                header("Location: $url");
            }
            
            if (!$search_result || mysqli_num_rows($search_result) == 0){
                mysqli_close($conn);
                header("Location: ../404.php");
            }
            else {
                $one_search_result = mysqli_fetch_assoc($search_result);
                $Category1Name = $one_search_result['Category1Name'];
                $Category2Name = $one_search_result['Category2Name'];
                $Category3Name = $one_search_result['Category3Name'];
                $Category4Name = $one_search_result['Category4Name'];
                $Category5Name = $one_search_result['Category5Name'];
                $CountCategory1Item = $one_search_result['CountCategory1Item'];
                $CountCategory2Item = $one_search_result['CountCategory2Item'];
                $CountCategory3Item = $one_search_result['CountCategory3Item'];
                $CountCategory4Item = $one_search_result['CountCategory4Item'];
                $CountCategory5Item = $one_search_result['CountCategory5Item'];
                if($Category1Name != "") {
                    $Category1ItemArray = array();
                    $CountCategory1ItemArray = explode(",",$CountCategory1Item);
                    for($i=$CountCategory1ItemArray[0]; $i<=$CountCategory1ItemArray[1]; $i++) {
                        $OtherInformationName = "OtherInformationName".$i;
                        $$OtherInformationName = $one_search_result["$OtherInformationName"];
                        array_push($Category1ItemArray, $$OtherInformationName);
                    }
                }
                if($Category2Name != "") {
                    $Category2ItemArray = array();
                    $CountCategory2ItemArray = explode(",",$CountCategory2Item);
                    for($i=$CountCategory2ItemArray[0]; $i<=$CountCategory2ItemArray[1]; $i++) {
                        $OtherInformationName = "OtherInformationName".$i;
                        $$OtherInformationName = $one_search_result["$OtherInformationName"];
                        array_push($Category2ItemArray, $$OtherInformationName);
                    }
                }
                if($Category3Name != "") {
                    $Category3ItemArray = array();
                    $CountCategory3ItemArray = explode(",",$CountCategory3Item);
                    for($i=$CountCategory3ItemArray[0]; $i<=$CountCategory3ItemArray[1]; $i++) {
                        $OtherInformationName = "OtherInformationName".$i;
                        $$OtherInformationName = $one_search_result["$OtherInformationName"];
                        array_push($Category3ItemArray, $$OtherInformationName);
                    }
                }
                if($Category4Name != "") {
                    $Category4ItemArray = array();
                    $CountCategory4ItemArray = explode(",",$CountCategory4Item);
                    for($i=$CountCategory4ItemArray[0]; $i<=$CountCategory4ItemArray[1]; $i++) {
                        $OtherInformationName = "OtherInformationName".$i;
                        $$OtherInformationName = $one_search_result["$OtherInformationName"];
                        array_push($Category4ItemArray, $$OtherInformationName);
                    }
                }
                if($Category5Name != "") {
                    $Category5ItemArray = array();
                    $CountCategory5ItemArray = explode(",",$CountCategory5Item);
                    for($i=$CountCategory5ItemArray[0]; $i<=$CountCategory5ItemArray[1]; $i++) {
                    $OtherInformationName = "OtherInformationName".$i;
                        $$OtherInformationName = $one_search_result["$OtherInformationName"];
                        array_push($Category5ItemArray, $$OtherInformationName);
                    }
                }
                mysqli_close($conn);
            }
        }
        else {
            mysqli_close($conn);
            header("Location: organizer.php?Id=$Id");
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
        <link rel='stylesheet' href='css/organizerSelection.css' type='text/css' />
        <title>EventDat</title>
        <script src="../js/md5.min.js"></script>
        <script src="../js/jquery.min.js"></script>
    </head> 
    <body>
        <h1 class="title">Selection</h1>
        <div class="loginContainer">
            <form method="post" action="organizerSelection.php?Id=<?php echo $Id; ?>&&Username=<?php echo $Username; ?>&&Password=<?php echo $Password; ?>" onsubmit="return MD5()">
                <div class="categoryContainer">
                    <label class="label">Category:</label><br>
                    <select name="CategoryName" >
                    <?php
                        if($Category1Name != "") {
                        ?>
                            <option value="Category1Name,<?php echo $Category1Name; ?>"><?php echo $Category1Name; ?></option>
                        <?php    
                        }
                        if($Category2Name != "") {
                        ?>
                            <option value="Category2Name,<?php echo $Category2Name; ?>"><?php echo $Category2Name; ?></option>
                        <?php    
                        }
                        if($Category3Name != "") {
                        ?>
                            <option value="Category3Name,<?php echo $Category3Name; ?>"><?php echo $Category3Name; ?></option>
                        <?php    
                        }
                        if($Category4Name != "") {
                        ?>
                            <option value="Category4Name,<?php echo $Category4Name; ?>"><?php echo $Category4Name; ?></option>
                        <?php    
                        }
                        if($Category5Name != "") {
                        ?>
                            <option value="Category5Name,<?php echo $Category5Name; ?>"><?php echo $Category5Name; ?></option>
                        <?php    
                        }
                    ?>
                    </select>
                </div>
                <div class="otherInformationContainer">
                    <label class="label">Information:</label><br>
                    <select name="OtherInformationName"></select>
                </div>
                <div class="formBTN">
                    <input type="submit" value="Scan" /><br>
                    <a href="organizer.php?Id=<?php echo $Id; ?>"><input type="button" value="Back"></a>
                </div>
            </form>
        </div>
        <?php 
            if($msg != "") {
                echo "<p class='msg'>$msg</p>";
            }
        ?>
    </body>
</html>

<script>
    var Category1ItemArray = new Array();
    var Category2ItemArray = new Array();
    var Category3ItemArray = new Array();
    var Category4ItemArray = new Array();
    var Category5ItemArray = new Array();
    
    var CountCategory1Item = "";
    var CountCategory2Item = "";
    var CountCategory3Item = "";
    var CountCategory4Item = "";
    var CountCategory5Item = "";
    
    <?php
        if(isset($Category1ItemArray)) {
            ?>
            CountCategory1Item = "<?php echo $CountCategory1Item; ?>"; 
            <?php
            for($i=0; $i<count($Category1ItemArray); $i++) {
            ?>
                Category1ItemArray.push("<?php echo $Category1ItemArray[$i]; ?>");
            <?php
            }
        }
    ?>
    
    <?php
        if(isset($Category2ItemArray)) {
            ?>
            CountCategory2Item = "<?php echo $CountCategory2Item; ?>"; 
            <?php
            for($i=0; $i<count($Category2ItemArray); $i++) {
            ?>
                Category2ItemArray.push("<?php echo $Category2ItemArray[$i]; ?>");
            <?php
            }
        }
    ?>
    
    <?php
        if(isset($Category3ItemArray)) {
            ?>
            CountCategory3Item = "<?php echo $CountCategory3Item; ?>"; 
            <?php
            for($i=0; $i<count($Category3ItemArray); $i++) {
            ?>
                Category3ItemArray.push("<?php echo $Category3ItemArray[$i]; ?>");
            <?php
            }
        }
    ?>
    
    <?php
        if(isset($Category4ItemArray)) {
            ?>
            CountCategory4Item = "<?php echo $CountCategory4Item; ?>"; 
            <?php
            for($i=0; $i<count($Category4ItemArray); $i++) {
            ?>
                Category4ItemArray.push("<?php echo $Category4ItemArray[$i]; ?>");
            <?php
            }
        }
    ?>
    
    <?php
        if(isset($Category5ItemArray)) {
            ?>
            CountCategory5Item = "<?php echo $CountCategory5Item; ?>"; 
            <?php
            for($i=0; $i<count($Category5ItemArray); $i++) {
            ?>
                Category5ItemArray.push("<?php echo $Category5ItemArray[$i]; ?>");
            <?php
            }
        }
    ?>
    
    if(CountCategory1Item == "") {
        $(document).ready(function() {
            $("select[name='CategoryName']").prop('disabled', true);
            $("select[name='OtherInformationName']").prop('disabled', true);
            $(".categoryContainer").css('display', 'none');
            $(".otherInformationContainer").css('display', 'none');
        });
    }
</script>

<script>
    function MD5() {
        var password = document.getElementById("password").value;
        var hashPassword = md5(password);
        document.getElementById("password").value = hashPassword;
        return true;
    }
</script>

<script>
    $(document).ready(function() {
        var selected = $("select[name='CategoryName']").val();
        var selectedArray = selected.split(",");
        if (selectedArray[0] == "Category1Name") {

            var CountCategory1ItemArray = CountCategory1Item.split(",");
            var beginCategory1Item = parseInt(CountCategory1ItemArray[0]);

            for(var i=0; i<Category1ItemArray.length; i++) {
                $("select[name='OtherInformationName']").append("<option value='OtherInformationName"+(i+beginCategory1Item)+","+Category1ItemArray[i]+"'>"+Category1ItemArray[i]+"</option>");
            }
        } 
        else if (selectedArray[0] == "Category2Name") {

            var CountCategory2ItemArray = CountCategory2Item.split(",");
            var beginCategory2Item = parseInt(CountCategory2ItemArray[0]);

            for(var i=0; i<Category2ItemArray.length; i++) {
                $("select[name='OtherInformationName']").append("<option value='OtherInformationName"+(i+beginCategory2Item)+","+Category2ItemArray[i]+"'>"+Category2ItemArray[i]+"</option>");
            }
        }
        else if (selectedArray[0] == "Category3Name") {

            var CountCategory3ItemArray = CountCategory3Item.split(",");
            var beginCategory3Item = parseInt(CountCategory3ItemArray[0]);

            for(var i=0; i<Category3ItemArray.length; i++) {
                $("select[name='OtherInformationName']").append("<option value='OtherInformationName"+(i+beginCategory3Item)+","+Category3ItemArray[i]+"'>"+Category3ItemArray[i]+"</option>");
            }
        }
        else if (selectedArray[0] == "Category4Name") {

            var CountCategory4ItemArray = CountCategory4Item.split(",");
            var beginCategory4Item = parseInt(CountCategory4ItemArray[0]);

            for(var i=0; i<Category4ItemArray.length; i++) {
                $("select[name='OtherInformationName']").append("<option value='OtherInformationName"+(i+beginCategory4Item)+","+Category4ItemArray[i]+"'>"+Category4ItemArray[i]+"</option>");
            }
        }
        else if (selectedArray[0] == "Category5Name") {

            var CountCategory5ItemArray = CountCategory5Item.split(",");
            var beginCategory5Item = parseInt(CountCategory5ItemArray[0]);

            for(var i=0; i<Category5ItemArray.length; i++) {
                $("select[name='OtherInformationName']").append("<option value='OtherInformationName"+(i+beginCategory5Item)+","+Category5ItemArray[i]+"'>"+Category5ItemArray[i]+"</option>");
            }
        }
        
        $("select[name='CategoryName']").change(function() {
            var newSelected = $(this).children('option:selected').val();
            var newSelectedArray = newSelected.split(",");
            $("select[name='OtherInformationName']").empty();
            if (newSelectedArray[0] == "Category1Name") {
                
                var CountCategory1ItemArray = CountCategory1Item.split(",");
                var beginCategory1Item = parseInt(CountCategory1ItemArray[0]);
                
                for(var i=0; i<Category1ItemArray.length; i++) {
                    $("select[name='OtherInformationName']").append("<option value='OtherInformationName"+(i+beginCategory1Item)+","+Category1ItemArray[i]+"'>"+Category1ItemArray[i]+"</option>");
                }
            } 
            else if (newSelectedArray[0] == "Category2Name") {
                
                var CountCategory2ItemArray = CountCategory2Item.split(",");
                var beginCategory2Item = parseInt(CountCategory2ItemArray[0]);
                
                for(var i=0; i<Category2ItemArray.length; i++) {
                    $("select[name='OtherInformationName']").append("<option value='OtherInformationName"+(i+beginCategory2Item)+","+Category2ItemArray[i]+"'>"+Category2ItemArray[i]+"</option>");
                }
            }
            else if (newSelectedArray[0] == "Category3Name") {
                
                var CountCategory3ItemArray = CountCategory3Item.split(",");
                var beginCategory3Item = parseInt(CountCategory3ItemArray[0]);
                
                for(var i=0; i<Category3ItemArray.length; i++) {
                    $("select[name='OtherInformationName']").append("<option value='OtherInformationName"+(i+beginCategory3Item)+","+Category3ItemArray[i]+"'>"+Category3ItemArray[i]+"</option>");
                }
            }
            else if (newSelectedArray[0] == "Category4Name") {
                
                var CountCategory4ItemArray = CountCategory4Item.split(",");
                var beginCategory4Item = parseInt(CountCategory4ItemArray[0]);
                
                for(var i=0; i<Category4ItemArray.length; i++) {
                    $("select[name='OtherInformationName']").append("<option value='OtherInformationName"+(i+beginCategory4Item)+","+Category4ItemArray[i]+"'>"+Category4ItemArray[i]+"</option>");
                }
            }
            else if (newSelectedArray[0] == "Category5Name") {
                
                var CountCategory5ItemArray = CountCategory5Item.split(",");
                var beginCategory5Item = parseInt(CountCategory5ItemArray[0]);
                
                for(var i=0; i<Category5ItemArray.length; i++) {
                    $("select[name='OtherInformationName']").append("<option value='OtherInformationName"+(i+beginCategory5Item)+","+Category5ItemArray[i]+"'>"+Category5ItemArray[i]+"</option>");
                }
            }
        });
        
    });
</script>