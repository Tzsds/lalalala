<?php
    require_once 'config.php';
    
    $msg = "";

    if (isset($_GET['Id'])) {
        $Id = $_GET['Id'];
        
        // 表单提交
        if(isset($_POST['Id']) && isset($_POST['Username']) && isset($_POST['Password'])) {
            $Id = $_POST['Id'];
            $Username = $_POST['Username'];
            $Password = $_POST['Password'];
            
            $conn = mysqli_connect(HOST, USER, PASS, DB) or die('Unable to Connect...');
            $search_sql = "SELECT * FROM spreadsheetcolumn WHERE Id = $Id && Username = '$Username' && Password = '$Password'";
            $search_result = mysqli_query($conn, $search_sql);
            $search_found = mysqli_num_rows($search_result);

            if($search_found >= 1) {
                mysqli_close($conn);
                header("Location: organizerSelection.php?Id=$Id&&Username=$Username&&Password=$Password");
            }
            else {
                mysqli_close($conn);
                $msg = "Login failed";
            }
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
        <link rel='stylesheet' href='css/organizer.css' type='text/css' />
        <title>EventDat</title>
        <script src="../js/md5.min.js"></script>
        <script src="../js/jquery.min.js"></script>
    </head> 
    <body>
        <h1 class="title">Login</h1>
        <div class="loginContainer">
            <form method="post" action="organizer.php?Id=<?php echo $Id; ?>" onsubmit="return MD5()">
                <input type="hidden" name="Id" value="<?php echo $Id; ?>"/>
                <label class="label">Username:</label><br>
                <input type="text" name="Username" required/><br>
                <label class="label">Password:</label><br>
                <input id="password" type="password" name="Password" required/><br>
                <div class="formBTN">
                    <input type="submit" value="Login" />
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