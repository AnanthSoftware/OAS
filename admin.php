<?php
include "authz.php";
include_once("fixed/header.php");
include_once("fixed/menu.php");

if($_GET) {
    if(isset($_GET["users"])) {
        $head = "<div id='message'>";
        $last = "<form action='admin?users' method='post'><center><input style='width:50%' type='submit' value='Back'></center></form></div>";
        
        if(isset($_GET["add"]) and $_GET["add"]=="success")
            echo $head."<h3 class='green'>Added</h3><h6>User added successfully</h6><p>Everything is ok, go back.</p>".$last;
        elseif(isset($_GET["add"]) and $_GET["add"]=="failed")
            echo $head."<h3>Failed</h3><h6>User add failed</h6><p>Try again, go back.</p>".$last;
            
        elseif(isset($_GET["update"]) and $_GET["update"]=="success")
            echo $head."<h3 class='green'>Updated</h3><h6>User updated successfully</h6><p>Everything is ok, go back.</p>".$last;
        elseif(isset($_GET["update"]) and $_GET["update"]=="failed")
            echo $head."<h3>Failed</h3><h6>User updation failed</h6><p>Try again, go back.</p>".$last;
        
        elseif(isset($_GET["delete"])  and $_GET["delete"]=="success")
            echo $head."<h3 class='green'>Deleted</h3><h6>User deleted successfully</h6><p>Everything is ok, go back.</p>".$last;
        elseif(isset($_GET["delete"]) and $_GET["delete"]=="failed")
            echo $head."<h3>Failed</h3><h6>User deletion failed</h6><p>Try again, go back.</p>".$last;
            
        elseif(isset($_GET["invalid"]) and $_GET["invalid"]=="username")
            echo $head."<h3>Invalid</h3><h6>Invalid username</h6><p>Try again, go back.</p>".$last;
            
        elseif(isset($_GET["mail"]) and $_GET["mail"]=="failed")
            echo $head."<h3>Error</h3><h6>Unable to send mail</h6><p>Try again, go back.</p>".$last;
            
        else include_once("forms/users.php");
    }
    elseif(isset($_GET["admissions"])) {
        $head = "<div id='message'>";
        $last = "<form action='admin?admissions' method='post'><center><input style='width:50%' type='submit' value='Back'></center></form></div>";
        
        if(isset($_GET["add"]) and $_GET["add"]=="success")
            echo $head."<h3 class='green'>Added</h3><h6>Application added successfully</h6><p>Everything is ok, go back.</p>".$last;
        elseif(isset($_GET["add"]) and $_GET["add"]=="failed")
            echo $head."<h3>Failed</h3><h6>Application add failed</h6><p>Try again, go back.</p>".$last;
        else
            include_once("forms/admissions.php");
    } elseif(isset($_GET["staff"])) {
        include_once("forms/staff.php");
    }
    elseif(isset($_GET["profile"])) {
        $head = "<div id='message'>";
        $last = "<form action='admin?profile' method='post'><center><input style='width:50%' type='submit' value='Back'></center></form></div>";
        
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