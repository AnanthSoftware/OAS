<?php
include_once('fixed/function.php');

## Generate
if(isset($_POST['generate'])) {
    $admitno = $_POST['admitno'];
    $regno = $_POST['regno'];
    $cert = $_POST['cert'];
    
    if($regno != null) {
        $admitno = regno2admitno($regno);
        if($admitno == null) {
            header("Location: staff?document&invalid=regno");
            exit;
        }
    }
    
    if(isadmitno($admitno)) {
        
    } else {
        header("Location: staff?document&invalid=admitno");
        exit;
    }
}

## Store
if(isset($_POST['store'])) {
    $admitno = $_POST['admitno'];
    $regno = $_POST['regno'];
    
    if($regno != null) {
        $admitno = regno2admitno($regno);
        if($admitno == null) {
            header("Location: staff?document&invalid=regno");
            exit;
        }
    }
    
    if(isadmitno($admitno)) {
        header("Location: staff?document&files=$admitno");
        exit;
    } else {
        header("Location: staff?document&invalid=admitno");
        exit;
    }
}
?>

<div id="panel" class="card">
    <div class="tab">
        <button class="tablinks <?php if(!$_POST) echo "active"?>" onclick="action(event, 'generate')">Generate</button>
        <button class="tablinks <?php if(isset($_POST['store'])) echo "active"?>" onclick="action(event, 'store')">Store</button>
        <a href="cashier" style="float:right"><button class="tablinks">✕</button></a>
    </div>
    
    <div id="generate" class="tabcontent <?php if(!$_POST) echo "display"?>">
    <center><form action="staff?document" method="post">
        <div class="table">
            <div class="col">
                <label for="admitno">Admission Number</label>
                <input type="text" id="admitno" name="admitno" placeholder="Admission Number" maxlength="10">
                
                <label for="cert">Certificate<span>*</span></label>
                <select id="cert" name="cert" required>
                    <option disabled selected value>Select Certificate</option>
                    <option value="bc">Bonafide</option>
                    <option value="tc">Transfer</option>
                </select>
            </div>
            <div class="col">
                <label for="regno">Register Number</label>
                <input type="text" id="regno" name="regno" placeholder="Register Number" maxlength="12">
                
                <input type="hidden" name="generate">
                <input type="hidden" name="token" value="<?php echo $_SESSION['token']?>">
                <input style="width:100px;margin:0;margin-top:30px" type="submit" value="Submit">
            </div>
        </div>
    </center></form>
    </div>
    
    <div id="store" class="tabcontent">
    <center><form action="staff?document" method="post">
        <div class="table">
            <div class="col">
                <label for="admitno">Admission Number</label>
                <input type="text" id="admitno" name="admitno" placeholder="Admission Number" maxlength="10">
                
            </div>
            <div class="col">
                <label for="regno">Register Number</label>
                <input type="text" id="regno" name="regno" placeholder="Register Number" maxlength="12">
            </div>
        </div>
        <input type="hidden" name="store">
        <input type="hidden" name="token" value="<?php echo $_SESSION['token']?>">
        <input style="width:100px" type="submit" value="Submit">
    </center></form>
    </div>
</div>