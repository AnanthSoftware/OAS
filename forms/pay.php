<?php
include_once('fixed/function.php');

## Pay
if(isset($_POST['pay1'])) {
    $admitno = $_POST['admitno'];
    $regno = $_POST['regno'];
    $year = $_POST['year'];
    
    if($regno != null) {
        $admitno = regno2admitno($regno);
        if($admitno == null) {
            header("Location: cashier?pay&invalid=regno");
            exit;
        }
    }
    
    $data = admitno($admitno);
    
    include "config/db.php";
    $query1 = "select * from stufeestruct where admitno='$admitno'";
    $query2 = "select * from stufeepend where admitno='$admitno' and year=$year";
    $result1 = mysqli_query($con, $query1);
    $result2 = mysqli_query($con, $query2);
    
    $table = "<table><tr><th>Fees</th><th>Tution Fee</th><th>Book Fee</th><th>Bus Fee</th><th>Hostel Rent</th><th>Other Fee</th><th>Total Fee</th></tr>";        
    if(mysqli_num_rows($result1) > 0) {
        while($row1 = mysqli_fetch_assoc($result1)) {
            $table .= "<tr><td>Structure</td><td>".$row1['tutionfee']."</td><td>".$row1['bookfee']."</td><td>".$row1['busfee']."</td>
                       <td>".$row1['hostelrent']."</td><td>".$row1['otherfee']."</td><td>".$row1['totalfee']."</td></tr>";
        }
        while($row2 = mysqli_fetch_assoc($result2)) {
            $table .= "<tr><td>Pending</td><td>".$row2['tutionfee']."</td><td>".$row2['bookfee']."</td><td>".$row2['busfee']."</td>
                       <td>".$row2['hostelrent']."</td><td>".$row2['otherfee']."</td><td>".$row2['totalfee']."</td></tr>";
                    
            $_SESSION['tutionfee'] = $row2['tutionfee'];
            $_SESSION['bookfee'] = $row2['bookfee'];
            $_SESSION['busfee'] = $row2['busfee'];
            $_SESSION['hostelrent'] = $row2['hostelrent'];
            $_SESSION['otherfee'] = $row2['otherfee'];
            $_SESSION['totalfee'] = $row2['totalfee'];
        }
    } else {
        header("Location: cashier?pay&invalid=admitno");
        exit;
    }
    $table .= "</table>";
    mysqli_close($con);
}
if(isset($_POST['pay2'])) {
    $admitno = $_POST['admitno'];
    $year = $_POST['year'];
    $type = $_POST['type'];
    $paid = $_POST['paid'];
            
    if($type == "tutionfee") $amount = $_SESSION['tutionfee'] - $paid;
    elseif($type == "bookfee") $amount = $_SESSION['bookfee'] - $paid;
    elseif($type == "busfee") $amount = $_SESSION['busfee'] - $paid;
    elseif($type == "hostelrent") $amount = $_SESSION['hostelrent'] - $paid;
    elseif($type == "otherfee") $amount = $_SESSION['otherfee'] - $paid;
            
    $totalfee = $_SESSION['totalfee'] - $paid;
    
    $date = date("Y-m-d");
    $time = strtoupper(date("h:i:sa"));
    $hash = hash('sha256',$date.$time.$type.$paid);
            
    include "config/db.php";
    $query = "select AUTO_INCREMENT from INFORMATION_SCHEMA.TABLES where TABLE_SCHEMA = 'projectoas' AND TABLE_NAME = 'transactions'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $billno = $row['AUTO_INCREMENT'];
            
    $query1 = "insert into transactions values($billno,'$admitno',$year,'$date','$time','$type',$paid,'$hash')";
    $query2 = "update stufeepend set $type='$amount', totalfee='$totalfee' where admitno='$admitno' and year=$year";
    if(mysqli_query($con,$query1) && mysqli_query($con,$query2)) header("Location: cashier?pay&receipt=$billno");
    else header("Location: cashier?pay&failed");
    mysqli_close($con);
    exit;
}

## Mess Fee
if(isset($_POST['fee1'])) {
    $admitno = $_POST['admitno'];
    $regno = $_POST['regno'];
    $year = $_POST['year'];
    
    if($regno != null) {
        $admitno = regno2admitno($regno);
        if($admitno == null) {
            header("Location: cashier?pay&invalid=regno");
            exit;
        }
    }
    
    $data = admitno($admitno);
            
    include "config/db.php";
    $query = "select month, fee, duedate from messfees where admitno='$admitno' and year=$year and paid='NO' order by month desc;";
    $result = mysqli_query($con, $query);
            
    $sno = 0;
    $pending = 0;
    date_default_timezone_set("Asia/Kolkata");
    $date = date("Y-m-d");
    $table = "<table><tr><th>S.No</th><th>Month</th><th>Amount</th><th>Due date</th><th>Pay</th></tr>";
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            if(strtotime($date) <= strtotime($row['duedate'])) {
                $fee = "<span class='green'>".$row['fee']."</span>";
                $duedate = "<span class='green'>".$row['duedate']."</span>";
            } else {
                $fee = "<span style='color:red'>".$row['fee']."</span>";
                $duedate = "<span style='color:red'>".$row['duedate']."</span>";
                $pending += $row['fee'];
            }
                    
            $sno = $sno + 1;
            $table .= "<tr><td>$sno</td><td>".$row['month']."</td><td>$fee</td><td>$duedate</td>
                    <td class='white'><center><form action='cashier?pay' method='post'>
                    <input type='hidden' name='fee2'>
                    <input type='hidden' name='admitno' value='$admitno'>
                    <input type='hidden' name='year' value='$year'>
                    <input type='hidden' name='month' value='".$row['month']."'>
                    <input type='hidden' name='maxfee' value='".$row['fee']."'>
                    ₹ <input style='width:auto' type='number' min=1 max=".$row['fee']." name='fee' value='".$row['fee']."' required>
                    <input type='hidden' name='token' value='".$_SESSION['token']."'>
                    <input style='width:100px;margin:0' type='submit' value='Pay'></form></center></td></tr>";
        }
    } else {
        header("Location: cashier?pay&invalid=admitno");
        exit;
    }
    $table .= "</table>";
}       
if(isset($_POST['fee2'])) {
    $admitno = $_POST['admitno'];
    $year = $_POST['year'];
    $month = $_POST['month'];
    $type = "messfee";
    $paid = $_POST['fee'];
    
    $maxfee = (int)$_POST['maxfee'];
    $fee = (int)$paid;
    $balfee = $maxfee - $fee;
    
    $date = date("Y-m-d");
    $time = strtoupper(date("h:i:sa"));
    $hash = hash('sha256',$date.$time.$type.$paid);
            
    include "config/db.php";
    $auto = "select AUTO_INCREMENT from information_schema.TABLES where TABLE_SCHEMA = 'projectoas' AND TABLE_NAME = 'transactions'";
    $result = mysqli_query($con, $auto);
    $row = mysqli_fetch_assoc($result);
    $billno = $row['AUTO_INCREMENT'];
            
    $query1 = "insert into transactions values($billno,'$admitno',$year,'$date','$time','$type',$paid,'$hash')";
    
    if($fee == $maxfee)
        $query2 = "update messfees set paid='YES' where admitno='$admitno' and month='$month'";
    else 
        $query2 = "update messfees set fee=$balfee where admitno='$admitno' and month='$month'";
    
    if(mysqli_query($con,$query1) && mysqli_query($con,$query2)) header("Location: cashier?pay&receipt=$billno");
    else header("Location: cashier?pay&failed");
    mysqli_close($con);
    exit;
}

## History
if(isset($_POST['history'])) {
    $admitno = $_POST['admitno'];
    $regno = $_POST['regno'];
    $year = $_POST['year'];
    
    if($regno != null) {
        $admitno = regno2admitno($regno);
        if($admitno == null) {
            header("Location: cashier?pay&invalid=regno");
            exit;
        }
    }
            
    header("Location: cashier?pay&history=$admitno&year=$year");
    exit;
}

## Receipt
if(isset($_POST['receipt'])) {
    $billno = $_POST['billno'];
    
    if(isbillno($billno)) {
        header("Location: cashier?pay&receipt=$billno");
        exit;
    } else {
        header("Location: cashier?pay&invalid=billno");
        exit;
    }
}
?>

<div id="panel" class="card">
    <div class="tab">
        <button class="tablinks <?php if(!$_POST || isset($_POST['pay1'])) echo "active"?>" onclick="action(event, 'pay')">College Fee</button>
        <button class="tablinks <?php if(isset($_POST['fee1'])) echo "active"?>" onclick="action(event, 'messfee')">Mess Fee</button>
        <button class="tablinks <?php if(isset($_POST['history'])) echo "active"?>" onclick="action(event, 'history')">Transaction History</button>
        <button class="tablinks <?php if(isset($_POST['receipt'])) echo "active"?>" onclick="action(event, 'receipt')">Receipt</button>
        <a href="cashier" style="float:right"><button class="tablinks">✕</button></a>
    </div>
    
    <div id="pay" class="tabcontent <?php if(!$_POST || isset($_POST['pay1'])) echo "display"?>">
    <center><form action="cashier?pay" method="post">
        <?php if(!isset($_POST['pay1'])):?>
        <div class="table">
            <div class="col">
                <label for="admitno">Admission Number</label>
                <input type="text" id="admitno" name="admitno" placeholder="Admission Number" maxlength="10">
                
                <label for="year">Year<span>*</span></label>
                <select id="year" name="year" required>
                    <option disabled selected value>Select Year</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
            </div>
            <div class="col">
                <label for="regno">Register Number</label>
                <input type="text" id="regno" name="regno" placeholder="Register Number" maxlength="12">
                
                <input type="hidden" name="pay1">
                <input type="hidden" name="token" value="<?php echo $_SESSION['token']?>">
                <input style="width:100px;margin:0;margin-top:30px" type="submit" value="Submit">
            </div>
        </div>
        <?php elseif(isset($_POST['pay1'])):?>
        
        <script>
        function maxfee() {
            var x = document.getElementById("type").value;
            if(x == "tutionfee") document.getElementById("paid").setAttribute("max",<?php echo $_SESSION['tutionfee']?>);
            else if(x == "bookfee") document.getElementById("paid").setAttribute("max",<?php echo $_SESSION['bookfee']?>);
            else if(x == "busfee") document.getElementById("paid").setAttribute("max",<?php echo $_SESSION['busfee']?>);
            else if(x == "hostelrent") document.getElementById("paid").setAttribute("max",<?php echo $_SESSION['hostelrent']?>);
            else if(x == "otherfee") document.getElementById("paid").setAttribute("max",<?php echo $_SESSION['otherfee']?>);
        } 
        </script>
        
        <center><form action="cashier?pay" method="post">
        <div class="table" style="padding:0 20px">
            <div class="info">
                <label>Name: <?php echo $data['name']?>&emsp;&emsp;</label>
                <label>Register Number: <?php echo $data['regno']?>&emsp;&emsp;</label>
                <label>Branch: <?php echo $data['branch']?>&emsp;&emsp;</label>
                <label style="float:right">Year: <?php echo $year?></label>
            </div>
            <?php echo $table?>
        </div>
        <div class="table">
            <div class="col">
                <label for="type">Fee Type<span>*</span></label>
                <select id="type" name="type" onchange="maxfee()" required>
                    <option disabled selected value>Select Fee Type</option>
                    <option value="tutionfee">Tution Fee</option>
                    <option value="bookfee">Book Fee</option>
                    <option value="busfee">Bus Fee</option>
                    <option value="hostelrent">Hostel Rent</option>
                    <option value="otherfee">Other Fee</option>
                </select>
            </div>
            <div class="col">
                <label for="paid">Amount(₹)<span>*</span></label>
                <input type="number" min="1" id="paid" name="paid" placeholder="Amount" required>
            </div>
        </div>
        <a href="cashier?pay">Cancel</a>
        <input type="hidden" name="pay2">
        <input type="hidden" name="admitno" value="<?php echo $admitno?>">
        <input type="hidden" name="year" value="<?php echo $year?>">
        <input type="hidden" name="token" value="<?php echo $_SESSION['token']?>">
        <input style="width:100px;margin:0" type="submit" value="pay">
        <?php endif;?>
    </center></form>
    </div>
    
    <div id="messfee" class="tabcontent <?php if(isset($_POST['fee1'])) echo "display"?>">
        <?php if(!isset($_POST['fee1'])):?>
        <center><form action="cashier?pay" method="post">
        <div class="table">
            <div class="col">
                <label for="admitno">Admission Number</label>
                <input type="text" id="admitno" name="admitno" placeholder="Admission Number" maxlength="10">
                
                <label for="year">Year<span>*</span></label>
                <select id="year" name="year" required>
                    <option disabled selected value>Select Year</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
            </div>
            <div class="col">
                <label for="regno">Register Number</label>
                <input type="text" id="regno" name="regno" placeholder="Register Number" maxlength="12">
                
                <input type="hidden" name="fee1">
                <input type="hidden" name="token" value="<?php echo $_SESSION['token']?>">
                <input style="width:100px;margin:0;margin-top:30px" type="submit" value="Submit">
            </div>
        </div>
        </center></form>
        <?php elseif(isset($_POST['fee1'])):?>
        <div class="table" style="padding:0 20px">
            <div class="info">
                <label>Name: <?php echo $data['name']?>&emsp;&emsp;</label>
                <label>Register Number: <?php echo $data['regno']?>&emsp;&emsp;</label>
                <label>Branch: <?php echo $data['branch']?>&emsp;&emsp;</label>
                <label style="float:right">Year: <?php echo $year?></label>
            </div>
            <?php echo $table?>
            <div style="margin-top:10px">
                <label>Pending: <span><?php echo $pending?>/-</span></label>
            </div>
        </div>
        <center><a href="cashier?pay"><button style="width:100px;height:32px">Back</button></a></center>
        <?php endif;?>
    </div>
    
    <div id="history" class="tabcontent">
    <center><form action="cashier?pay" method="post">
        <div class="table">
            <div class="col">
                <label for="admitno">Admission Number</label>
                <input type="text" id="admitno" name="admitno" placeholder="Admission Number" maxlength="10">
                
                <label for="year">Year<span>*</span></label>
                <select id="year" name="year" required>
                    <option disabled selected value>Select Year</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
            </div>
            <div class="col">
                <label for="regno">Register Number</label>
                <input type="text" id="regno" name="regno" placeholder="Register Number" maxlength="12">
                
                <input type="hidden" name="history">
                <input type="hidden" name="token" value="<?php echo $_SESSION['token']?>">
                <input style="width:100px;margin:0;margin-top:30px" type="submit" value="Submit">
            </div>
        </div>
    </center></form>
    </div>
    
    <div id="receipt" class="tabcontent">
    <center><form action="cashier?pay" method="post">
        <div class="table">
            <div class="col">
                <label for="billno">Bill Number<span>*</span></label>
                <input type="text" id="billno" name="billno" placeholder="Bill Number" maxlength="10" required>
            </div>
            <div class="col">
                <input type="hidden" name="receipt">
                <input type="hidden" name="token" value="<?php echo $_SESSION['token']?>">
                <input style="width:100px;margin:0;margin-top:30px" type="submit" value="Submit">
            </div>
        </div>
    </center></form>
    </div>
</div>