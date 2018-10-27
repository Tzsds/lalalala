<?php
    if (isset($_GET['Email']) && isset($_GET['Id'])) {
        $Email = $_GET['Email'];
        $Id = $_GET['Id'];
    }
?>

<!DOCTYLE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>EventDat</title>
    </head>
    <body onLoad="autoclick()">
        <a id="link" href="excel/<?php echo $Email; ?>_<?php echo $Id; ?>.xlsx" download="<?php echo $Email; ?>_<?php echo $Id; ?>.xlsx"></a>
    </body>
</html>

<script>
    function autoclick() {
        document.getElementById("link").click();
        window.location.href = "sheet.php";
    }
</script>