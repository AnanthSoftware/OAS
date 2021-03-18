<?php
    include_once('fixed/function.php');
    
    $admitno = $_GET["history"];
    $year = $_GET["year"];
    
    $data = admitno($admitno);
    
    include "config/db.php";
    $query = "select billno, date, time, type, paid from transactions where admitno='$admitno' and year='$year'";
    $result = mysqli_query($con, $query);
    
    $table = "<table><tr><th>Bill Number</th><th>Date</th><th>Time</th><th>Fee Type</th><th>Amount Paid</th></tr>";
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $type = $row['type'];
            if($type == "tutionfee") $feetype = "Tution Fee";
            elseif($type == "bookfee") $feetype = "Book Fee";
            elseif($type == "busfee") $feetype = "Bus Fee";
            elseif($type == "hostelrent") $feetype = "Hostel Rent";
            elseif($type == "otherfee") $feetype = "Other Fee";
            elseif($type == "messfee") $feetype = "Mess Fee";
            $table .= "<tr><td><a class='link' href='cashier?pay&receipt=".$row['billno']."'>".$row['billno']."</a></td>
                    <td>".$row['date']."</td><td>".$row['time']."</td><td>$feetype</td><td>".$row['paid']."</td></tr>";
        }
    } else {
        header("Location: cashier?pay&record=zero");
        exit;
    }
    
    $table .= "</table>";
    mysqli_close($con);
?>

<div id="panel" class="card">
    <div style="padding:20px">
        <div id="print">
            <h2>Transaction History</h2>
            <div class="info">
                <label>Name: <?php echo $data['name']?>&emsp;&emsp;</label>
                <label>Register Number: <?php echo $data['regno']?>&emsp;&emsp;</label>
                <label>Branch: <?php echo $data['branch']?>&emsp;&emsp;</label>
                <label style="float:right">Year: <?php echo $year?></label>
            </div>
            <?php echo $table?>
        </div>
        <div class="table">
            <center>
                <a href="cashier?pay"><input style="width:100px" type="button" value="Back"></a>
                <input style="width:100px" type="button" value="Print" onClick="window.print()">
            </center>    
        </div>
    </div>
</div>