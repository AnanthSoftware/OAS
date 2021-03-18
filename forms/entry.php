<?php
## Entry
if(isset($_POST['entry1'])) {
    $year = $_POST['year'];
    $branch = $_POST['branch'];
    $month = $_POST['fy']."-".$_POST['fm'];
    $fee = $_POST['fee'];
    $duedate = $_POST['duedate'];
    
    $_SESSION['year'] = $year;
    $_SESSION['branch'] = $branch;
    $_SESSION['month'] = $month;
    $_SESSION['duedate'] = $duedate;
            
    include "config/db.php";
    $query = "select studetails.admitno, studetails.regno, studetails.branch, studetails.status, studetails.fname, studetails.lname 
              from studetails inner join stuadmission 
              on studetails.admitno = stuadmission.admitno 
              where stuadmission.hostel='YES' and studetails.branch='$branch' and studetails.status='pursuing'";
    $result = mysqli_query($con, $query);
       
    $admitnos = array();     
    $table = "<table><tr><th>Register No</th><th>Name</th><th>Month</th><th>Fee</th><th>Due Date</th></tr>";
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $table .= "<tr><td>".$row['regno']."</td><td class='break'>".$row['fname']." ".$row['lname']."</td><td>".$month."</td>
                       <td class='white'><input type='number' min='0' max='10000' name='f".$row['admitno']."' value=$fee required></td>
                       <td>".$duedate."</td>";
            array_push($admitnos, 'f'.$row['admitno']);
        }
    }
    $table .= "</table>";
    $_SESSION['admitnos'] = $admitnos;
    mysqli_close($con);
}
if(isset($_POST['entry2'])) {
    $year = $_SESSION['year'];
    $branch = $_SESSION['branch'];
    $month = $_SESSION['month'];
    $duedate = $_SESSION['duedate'];
            
    include "config/db.php";
    if(isset($_SESSION['admitnos'])){
        foreach($_SESSION['admitnos'] as $admitno) {
            if($admitno == isset($_POST[$admitno])) {
                $fee = $_POST[$admitno];
                $admitno = substr($admitno,1);
                        
                $query = "select regno, fname, lname from studetails where admitno='$admitno'";
                $result = mysqli_query($con, $query);
                $row = mysqli_fetch_assoc($result);
                $regno = $row['regno'];
                $name = $row['fname']." ".$row['lname'];
                        
                $query = "select * from messfees where admitno='$admitno' and month='$month'";
                $result = mysqli_query($con, $query);
                if(mysqli_num_rows($result) == 0) {
                    $query = "insert into messfees values('$admitno','$month',$year,'$branch','$regno','$name',$fee,'$duedate','NO')";
                    $result = mysqli_query($con, $query);
                }
            }
        }
        header("Location: warden?entry&add=success");
        mysqli_close($con);
        exit;
    }
    header("Location: warden?entry&add=failed");
    mysqli_close($con);
    exit;
}
        
## View
if(isset($_POST['view'])) {
    $year = $_POST['year'];
    $branch = $_POST['branch'];
    $month = $_POST['fy']."-".$_POST['fm'];
            
    header("Location: warden?entry&view=$branch&year=$year&month=$month");
    exit;
}
?>

<div id="panel" class="card">
    <div class="tab">
        <button class="tablinks <?php if(!$_POST || isset($_POST['entry1'])) echo "active"?>" onclick="action(event, 'entry')">Entry</button>
        <button class="tablinks" onclick="action(event, 'view')">View</button>
        <a href="admin" style="float:right"><button class="tablinks">✕</button></a>
    </div>
    
    <div id="entry" class="tabcontent scroll <?php if(!$_POST || isset($_POST['entry1'])) echo "display"?>">
    <center><form action="warden?entry" method="post">
        <?php if(!isset($_POST['entry1'])):?>
        <div class="table">
            <div class="col">
                <label for="year">Year<span>*</span></label>
                <select id="year" name="year" required>
                    <option disabled selected value>Select Year</option>
                    <option value=1>1</option>
                    <option value=2>2</option>
                    <option value=3>3</option>
                    <option value=4>4</option>
                </select>
                
                <label for="fm">Fee Month<span>*</span></label>
                <select id="fm" name="fm" required>
                    <option disabled selected value>Select Fee Month</option>
                    <option value=01>1</option>
                    <option value=02>2</option>
                    <option value=03>3</option>
                    <option value=04>4</option>
                    <option value=05>5</option>
                    <option value=06>6</option>
                    <option value=07>7</option>
                    <option value=08>8</option>
                    <option value=09>9</option>
                    <option value=10>10</option>
                    <option value=11>11</option>
                    <option value=12>12</option>
                </select>
                
                <label for="fee">Fee</label>
                <input type="number" min="0" max="10000" id="fee" name="fee" placeholder="Fee">
            </div>
            <div class="col">
                <label for="branch">Branch<span>*</span></label>
                <select id="branch" name="branch" required>
                    <option disabled selected value>Select Branch</option>
                    <option value="CIVIL">CIVIL</option>
                    <option value="CSE">CSE</option>
                    <option value="ECE">ECE</option>
                    <option value="EEE">EEE</option>
                    <option value="IT">IT</option>
                    <option value="MECH">MECH</option>
                    <option value="MBA">MBA</option>
                    <option value="MCA">MCA</option>
                </select>
                
                <label for="fy">Fee Year<span>*</span></label>
                <input type="number" min="2000" max="2100" id="fy" name="fy" placeholder="Fee Year" required>
                
                <label for="duedate">Due date<span>*</span></label>
                <input type="date" id="duedate" name="duedate" required>
            </div>
        </div>
        <input type="hidden" name="entry1">
        <input type="hidden" name="token" value="<?php echo $_SESSION['token']?>">
        <input style="width:100px;margin:0" type="submit" value="Submit">
        <?php elseif(isset($_POST['entry1'])):?>
        <div class="table">
            <div style="padding-bottom:10px">
                <label>Branch: <?php echo $branch?></label>
                <label style="float:right">Year: <?php echo $year?></label>
            </div>
            <div style="padding-bottom:20px">
                <?php echo $table?>
            </div>
            <a href="warden?entry">Cancel</a>
            <input type="hidden" name="entry2">
            <input type="hidden" name="token" value="<?php echo $_SESSION['token']?>">
            <input style="width:100px;margin:0" type="submit" value="Submit">
        </div>
        <?php endif;?>
    </center></form>
    </div>
    
    <div id="view" class="tabcontent">
    <center><form action="warden?entry" method="post">
        <div class="table">
            <div class="col">
                <label for="year">Year<span>*</span></label>
                <select id="year" name="year" required>
                    <option disabled selected value>Select Year</option>
                    <option value=1>1</option>
                    <option value=2>2</option>
                    <option value=3>3</option>
                    <option value=4>4</option>
                </select>
                
                <label for="fm">Fee Month<span>*</span></label>
                <select id="fm" name="fm" required>
                    <option disabled selected value>Select Fee Month</option>
                    <option value=01>1</option>
                    <option value=02>2</option>
                    <option value=03>3</option>
                    <option value=04>4</option>
                    <option value=05>5</option>
                    <option value=06>6</option>
                    <option value=07>7</option>
                    <option value=08>8</option>
                    <option value=09>9</option>
                    <option value=10>10</option>
                    <option value=11>11</option>
                    <option value=12>12</option>
                </select>
            </div>
            <div class="col">
                <label for="branch">Branch<span>*</span></label>
                <select id="branch" name="branch" required>
                    <option disabled selected value>Select Branch</option>
                    <option value="CIVIL">CIVIL</option>
                    <option value="CSE">CSE</option>
                    <option value="ECE">ECE</option>
                    <option value="EEE">EEE</option>
                    <option value="IT">IT</option>
                    <option value="MECH">MECH</option>
                    <option value="MBA">MBA</option>
                    <option value="MCA">MCA</option>
                </select>
                
                <label for="fy">Fee Year<span>*</span></label>
                <input type="number" min="2000" max="2100" id="fy" name="fy" placeholder="Fee Year" required>
            </div>
        </div>
        <input type="hidden" name="view">
        <input type="hidden" name="token" value="<?php echo $_SESSION['token']?>">
        <input style="width:100px;margin:0" type="submit" value="Submit">
    </form></center>
    </div>
</div>