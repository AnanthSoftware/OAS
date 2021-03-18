<?php
include "authz.php";
include_once("fixed/header.php");
include_once("fixed/menu.php");

if($_GET) {
    if(isset($_GET["pay"])) {
        if(isset($_GET["invalid"]) or isset($_GET["failed"]) or isset($_GET["record"])) {
            $head = "<div id='message'>";
            $last = "<form action='cashier?pay' method='post'><center><input style='width:50%' type='submit' value='Back'></center></form></div>";
            
            if(isset($_GET["invalid"]) and $_GET["invalid"]=="regno")
                echo $head."<h3>Invaild</h3><h6>Wrong Register Number</h6><p>Try again, go back.</p>".$last;
            elseif(isset($_GET["invalid"]) and $_GET["invalid"]=="admitno")
                echo $head."<h3>Invaild</h3><h6>Wrong Admission Number</h6><p>Try again, go back.</p>".$last;
            elseif(isset($_GET["invalid"]) and $_GET["invalid"]=="billno")
                echo $head."<h3>Invaild</h3><h6>Wrong Bill Number</h6><p>Try again, go back.</p>".$last;
            elseif(isset($_GET["record"]) and $_GET["record"]=="zero")
                echo $head."<h3>Not Found</h3><h6>No record found or Wrong Admission Number</h6><p>Try again, go back.</p>".$last;
            else
                echo $head."<h3>Failed</h3><h6>Payment Failed</h6><p>Try again, go back.</p>".$last;
        }
        elseif(isset($_GET["receipt"])) 
            include_once("forms/receipt.php");
        elseif(isset($_GET["history"])) 
            include_once("forms/history.php");
        else 
            include_once("forms/pay.php");
    }
    elseif(isset($_GET["profile"])) {
        $head = "<div id='message'>";
        $last = "<form action='cashier?profile' method='post'><center><input style='width:50%' type='submit' value='Back'></center></form></div>";
        
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

include_once("fixed/footer.php");
?>