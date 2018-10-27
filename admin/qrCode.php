<?php
    require_once '../ipaddress.php';
    require_once 'config.php';

    if (isset($_GET['Id']) && isset($_GET['Target'])) {
        
        $Id = $_GET['Id'];
        $Target = $_GET['Target'];
        
        $conn = mysqli_connect(HOST, USER, PASS, DB) or die('Unable to Connect...');

        $search_sql = "SELECT * FROM spreadsheetcolumn WHERE Id = $Id";
        $search_result = mysqli_query($conn, $search_sql);
        
        $UserDetails = "";

        if (!$search_result || mysqli_num_rows($search_result) == 0){

        }
        else {
            while ($one_search_result = mysqli_fetch_assoc($search_result)) {
                $SheetName = $one_search_result['SheetName'];
                $UserDetails = $one_search_result['IsUserDetails'];
            }
        }

        mysqli_close($conn);
    }
    else {
        header("Location:../404.php");
    }
?>

<!DOCTYLE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>EventDat</title>
        <link rel='stylesheet' href='css/qrcode.css' type='text/css' />
        <script type="text/javascript" src="../js/jquery.min.js"></script>
        <script type="text/javascript" src="../js/qrcode/qrcode.js"></script>
    </head>
    <body>
        <h1 class="title"><?php echo $SheetName; ?></h1>
        <?php
            if($Target == "User") {
            ?>
                <p class="subtitle">QRCode For User</p>
            <?php
            }
            else if($Target == "Organizer") {
            ?>
                <p class="subtitle">QRCode For Organizer</p>
            <?php    
            }
        ?>
        <div id="qrcode"></div>
    </body>
</html>

<script type="text/javascript">
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        width: 300,
        height: 300
    });

    function makeCode() {
        <?php
            if($Target == "User") {
                if($UserDetails == 1) {
                ?>
                    var url = "http://<?php echo $ipaddress; ?>/EventDat/user/signIn.php?Id=<?php echo $Id; ?>";
                <?php
                }
                else {
                ?>
                    var url = "http://<?php echo $ipaddress; ?>/EventDat/user/registration.php?Id=<?php echo $Id; ?>";
                <?php
                }
                ?>
                qrcode.makeCode(url);
            <?php
            }
            else if($Target == "Organizer") {
            ?>
                var url = "http://<?php echo $ipaddress; ?>/EventDat/admin/organizer.php?Id=<?php echo $Id; ?>";
                qrcode.makeCode(url);
            <?php
            }
        ?>
    }
    makeCode();
</script>