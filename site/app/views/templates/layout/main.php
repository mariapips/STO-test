<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link type="image/png" sizes="16x16" rel="icon" href="../../../../public/img/logo.jpg">
    <link rel="stylesheet" href="../../../../public/css/styles.css">
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
