<?php
    include_once('fixed/function.php');

    $billno = $_GET["receipt"];
    
    include "config/db.php";
    $query = "select * from transactions where billno=$billno";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    
    $admitno = $row['admitno'];
    
    $data = admitno($admitno);
    
    $date = $row['date'];
    $time = $row['time'];
    
    $type = $row['type'];
    if($type == "tutionfee") $type = "Tution Fee";
    elseif($type == "bookfee") $type = "Book Fee";
    elseif($type == "busfee") $type = "Bus Fee";
    elseif($type == "hostelrent") $type = "Hostel Rent";
    elseif($type == "otherfee") $type = "Other Fee";
    elseif($type == "messfee") $type = "Mess Fee";
    
    $paid = $row['paid'];
    $hash = $row['hash'];
    
    mysqli_close($con);
?>
<div id="panel" class="card">
    <div style="padding:20px">
        <div id="print"><div style="border:1px solid black;padding:20px"><div class="table">
            <h2>Receipt</h2>
            <div class="col">
                <label>Bill Number: <?php echo $billno?></label>
            </div>
        </div>
        <div class="table">
            <div class="col">
                <label>Date: <?php echo $date?></label><br>
                <label>Admission Number: <?php echo $admitno?></label><br>
                <label>Name: <?php echo $data['name']?></label><br>
                <label>Fee Type: <?php echo $type?></label>
                
            </div>
            <div class="col">
                <label>Time: <?php echo $time?></label><br>
                <label>Register Number: <?php echo $data['regno']?></label><br>
                <label>Branch: <?php echo $data['branch']?></label><br>
                <label>Amount Paid: (₹) <?php echo $paid?>/-</label>
            </div>
        </div>
        <div class="table">
            <div class="col">
                <label>Signature: <?php echo $hash?></label>
            </div>
        </div></div></div>
        <div class="table">
            <center>
                <a href="cashier?pay"><input style="width:100px" type="button" value="Back"></a>
                <input style="width:100px" type="button" value="Print" onClick="window.print()">
            </center>    
        </div>
    </div>
</div>