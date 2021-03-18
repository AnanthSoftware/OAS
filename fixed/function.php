<?php 
function regno2admitno($regno) {
    include "config/db.php";
    $query = "select admitno from studetails where regno='$regno'";
    $result = mysqli_query($con, $query);
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        mysqli_close($con);
        return $row['admitno'];
    }
    mysqli_close($con);
    return null;
}

function admitno($admitno) {
    include "config/db.php";
    $query = "select regno, branch, fname, lname, status, batch from studetails where admitno='$admitno'";
    $result = mysqli_query($con, $query);
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        mysqli_close($con);
        
        $year = date("Y") - (2000 + substr($row['batch'],2,2));
        if(date("m") > 5) $year += 1;
        if($year == substr(date("Y"),2)) $year = null;

        return array("regno"=>$row['regno'], "branch"=>$row['branch'], "name"=>$row['fname']." ".$row['lname'],
                     "status"=>$row['status'], "year"=>$year);
    }
    mysqli_close($con);
    return null;
}

function isadmitno($admitno) {
    include "config/db.php";
    $query = "select admitno from studetails where admitno='$admitno'";
    $result = mysqli_query($con, $query);
    if(mysqli_num_rows($result) > 0) {
        mysqli_close($con);
        return true;
    }
    mysqli_close($con);
    return false;
}

function isregno($regno) {
    include "config/db.php";
    $query = "select regno from studetails where regno='$regno'";
    $result = mysqli_query($con, $query);
    if(mysqli_num_rows($result) > 0) {
        mysqli_close($con);
        return true;
    }
    mysqli_close($con);
    return false;
}

function isbillno($billno) {
    include "config/db.php";
    $query = "select billno from transactions where billno='$billno'";
    $result = mysqli_query($con, $query);
    if(mysqli_num_rows($result) > 0) {
        mysqli_close($con);
        return true;
    }
    mysqli_close($con);
    return false;
}
?>