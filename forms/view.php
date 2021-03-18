<?php
    $branch = $_GET["view"];
    $year = $_GET["year"];
    $month = $_GET["month"];
    
    include "config/db.php";
    $query = "select regno, name, fee, duedate from messfees where month='$month' and year=$year and branch='$branch'";
    $result = mysqli_query($con, $query);
    
    $sno = 0;
    $table = "<table><tr><th>S.No</th><th>Resister Number</th><th>Name</th><th>Fee</th><th>Due Date</th></tr>";
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $sno = $sno + 1;
            $table .= "<tr><td>$sno</td><td>".$row['regno']."</td><td>".$row['name']."</td><td>".$row['fee']."</td><td>".$row['duedate']."</td></tr>";
        }
    }
    $table .= "</table>";
    mysqli_close($con);
?>

<div id="panel" class="card">
    <div style="padding:20px">
        <div id="print">
            <h2>Mess Fees</h2>
            <div class="info">
                <label>Branch: <?php echo $branch?>&emsp;&emsp;</label>
                <label>Year: <?php echo $year?></label>
                <label style="float:right">Month: <?php echo $month?></label>
            </div>
            <?php echo $table?>
        </div>
        <div class="table">
            <center>
                <a href="warden?entry"><input style="width:100px" type="button" value="Back"></a>
                <input style="width:100px" type="button" value="Print" onClick="window.print()">
            </center>    
        </div>
    </div>
</div>