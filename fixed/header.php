<?php 
    date_default_timezone_set("Asia/Kolkata");
    
    if(!isset($_SESSION)) session_start();
    if(isset($_SESSION['username'])) $user = strtoupper($_SESSION['username']);
    else $user = "<a href=''>REFRESH</a>";
?>

<!DOCTYPE html>
<html lang="en">
    
<head>
    <title>OAS</title>
    <meta name="robots" content="noindex">
    <meta http-equiv="content-type" content="text/html" charset="UTF-8">
    <meta name="description" content="Project: Office Automation Software">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Anantharaj B & Team">
    <link rel="icon shortcut" href="assets/logo.png">
    <link rel="stylesheet" href="assets/style.css">
    <script src="assets/script.js"></script>
</head>

<body onload="clock()">
    <div id="header">
        <h2>Office Automation Software</h2>
        
        <div class="clock">
           <span><?php echo date("d/m/Y")?></span> <span id="time"></span>
        </div>
        <div class="user">
            <span><?php echo $user?></span>
        </div>
    </div>

    <div style="height:56px"></div>