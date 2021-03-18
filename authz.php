<?php
if(!isset($_SESSION)) session_start();
if(isset($_SESSION['OASUSERID'])) {
    if(isset($_COOKIE['OASUSERID'])) {
        if($_SESSION['OASUSERID'] != $_COOKIE['OASUSERID']) {
            header("Location: error?mismatch"); exit;
        }
    } else {
        header("Location: error?cookie"); exit;
    }
} else {
    header("Location: error?session"); exit;
}

if($_SESSION['category'] != substr(basename($_SERVER['PHP_SELF']),0,-4)) {
    header("Location: error?illegal"); exit;
}

if($_POST) {
    if($_SESSION['token'] != $_POST['token']) {
        header("Location: error?token"); exit;
    }
}
?>