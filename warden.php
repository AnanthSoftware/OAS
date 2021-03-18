<?php
include "authz.php";
include_once("fixed/header.php");
include_once("fixed/menu.php");

if($_GET) {
    if(isset($_GET["entry"])) {
        $head = "<div id='message'>";
        $last = "<form action='warden?entry' method='post'><center><input style='width:50%' type='submit' value='Back'></center></form></div>";
    
        if(isset($_GET["view"]))
            include_once("forms/view.php");
        elseif(isset($_GET["add"]) and $_GET["add"]=="success")
            echo $head."<h3 class='green'>Added</h3><h6>Entries added successfully</h6><p>Everything is ok, go back.</p>".$last;
        elseif(isset($_GET["add"]) and $_GET["add"]=="failed")
            echo $head."<h3>Failed</h3><h6>Entries add failed</h6><p>Try again, go back.</p>".$last;
        else
            include_once("forms/entry.php");
    }
    elseif(isset($_GET["profile"])) {
        $head = "<div id='message'>";
        $last = "<form action='warden?profile' method='post'><center><input style='width:50%' type='submit' value='Back'></center></form></div>";
        
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