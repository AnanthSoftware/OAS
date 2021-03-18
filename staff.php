<?php
include "authz.php";
include_once("fixed/header.php");
include_once("fixed/menu.php");

if($_GET) {
    if(isset($_GET["document"])) {
        if(isset($_GET["files"])) {
            include_once("forms/files.php");
        }
        elseif(isset($_GET["invalid"])) {
            $head = "<div id='message'>";
            $last = "<form action='staff?document' method='post'><center><input style='width:50%' type='submit' value='Back'></center></form></div>";
            
            if(isset($_GET["invalid"]) and $_GET["invalid"]=="regno")
                echo $head."<h3>Invaild</h3><h6>Wrong Register Number</h6><p>Try again, go back.</p>".$last;
            elseif(isset($_GET["invalid"]) and $_GET["invalid"]=="admitno")
                echo $head."<h3>Invaild</h3><h6>Wrong Admission Number</h6><p>Try again, go back.</p>".$last;
        }
        else
            include_once("forms/document.php");
    }
    elseif(isset($_GET["profile"])) {
        $head = "<div id='message'>";
        $last = "<form action='staff?profile' method='post'><center><input style='width:50%' type='submit' value='Back'></center></form></div>";
        
        if(isset($_GET["change"]) and $_GET["change"]=="success")
            echo $head."<h3 class='green'>Changed</h3><h6>Password changed successfully</h6><p>Everything is ok, go back.</p>".$last;
        elseif(isset($_GET["change"]) and $_GET["change"]=="failed")
            echo $head."<h3>Failed</h3><h6>Password change failed</h6><p>Try again, go back.</p>".$last;
        elseif(isset($_GET["mismatch"]) and $_GET["mismatch"]=="password")
            echo $head."<h3>Mismatch</h3><h6>Passwords are mismatch</h6><p>Try again, go back.</p>".$last;
            
        else include_once("forms/profile.php");
    }
    elseif(isset($_GET["logout"])) {
        include_once("fixed/logout.php");
    }
}

include_once("fixed/footer.php")
?>