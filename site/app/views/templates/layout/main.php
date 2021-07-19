<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> <?php
        echo $title ?> </title>
</head>
<body>

<?php include("menu.php");?>

<div id="main-content">
    <?php include(__DIR__."/../pages/$page_name.php"); ?>
</div>

<?php include("footer.php");?>

</body>
</html>
