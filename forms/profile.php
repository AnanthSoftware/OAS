<?php
## Change
if(isset($_POST['change1'])) {
    $password = $_POST['password'];
}
if(isset($_POST['change2'])) {
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    
    if($password1 != $password2) {
        header("Location: {$_SESSION['category']}?profile&mismatch=password");
        exit;
    }
    
    // Password Hash Generator    
    $hash = password_hash($password1, PASSWORD_DEFAULT);
            
    include "config/db.php";
    $query = "update authuser set password='$hash' where username='{$_SESSION['username']}'";
    if(mysqli_query($con,$query)) header("Location: {$_SESSION['category']}?profile&change=success");
    else header("Location: {$_SESSION['category']}?profile&change=failed");
    mysqli_close($con);
    exit;
}
?> 

<div id="panel" class="card">
    <div class="tab">
        <button class="tablinks <?php if(!$_POST) echo "active"?>" onclick="action(event, 'profile')">Profile</button>
        <button class="tablinks <?php if(isset($_POST['change1'])) echo "active"?>" onclick="action(event, 'change')">Change Password</button>
        <a href="<?php echo $_SESSION['category']?>" style="float:right"><button class="tablinks">✕</button></a>
    </div>
    
    <div id="profile" class="tabcontent <?php if(!$_POST) echo "display"?>">
        <?php
            $username = $_SESSION['username'];
            include "config/db.php";
            $query = "select email, category from authuser where username='$username'";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($result);
            $email = $row['email'];
            $category = $row['category'];
            mysqli_close($con);
        ?>
        <div class="table" style="margin-left:20px">
            <h4 style="text-align:left"><?php echo $_SESSION['name']?></h4>
            <p><b>Username:</b> <?php echo $username?></p>
            <p><b>Email:</b> <?php echo $email?></p>
            <p><b>Category:</b> <?php echo $category?></p>
        </div>
    </div>
    
    <div id="change" class="tabcontent <?php if(isset($_POST['change1'])) echo "display"?>">
    <center><form action="<?php echo $_SESSION['category']?>?profile" method="post">
        <?php if(!isset($_POST['change1'])):?>
        <div class="table">
            <div class="col">
                <label for="password">New Password (Minimum 8 characters)<span>*</span></label>
                <input type="text" id="password" name="password" pattern=".{8,20}" placeholder="New Password" maxlength="20" required>
            </div>
            <div class="col2">
                <input type="hidden" name="change1">
                <input type="hidden" name="token" value="<?php echo $_SESSION['token']?>">
                <input style="width:100px;margin:0;margin-top:50px" type="submit" value="Submit">
            </div>
        </div>
        <?php elseif(isset($_POST['change1'])):?>
        <center><form action="<?php echo $_SESSION['category']?>?profile" method="post">
        <div class="table">
            <div class="col">
                <label for="password1">New Password<span>*</span></label>
                <input type="password" id="password1" name="password1" pattern=".{8,20}" placeholder="New Password" value="<?php echo $password?>" maxlength="20" required readonly>
            </div>
            <div class="col">
                <label for="password2">Conform Password<span>*</span></label>
                <input type="password" id="password2" name="password2" pattern=".{8,20}" placeholder="Conform Password" maxlength="20" required>
            </div>
        </div>
        <a style="width:100px;margin:0" href="<?php echo $_SESSION['category']?>?profile">Cancel</a>
        <input type="hidden" name="change2">
        <input type="hidden" name="token" value="<?php echo $_SESSION['token']?>">
        <input style="width:100px;margin:0" type="submit" value="Submit">
        <?php endif;?>
    </center></form>
    </div>
</div>