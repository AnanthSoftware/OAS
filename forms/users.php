<?php
## Add
if(isset($_POST['add'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    
    // Random Password Generator
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; $password = '';
    for ($i = 0; $i < 8; $i++) $password .= $characters[mt_rand(0, strlen($characters) - 1)];
            
    // Mail Preparation
    $sender = "oas@ananthsoft.org";
    $subject = "Office Automation Software";
    $message = "<div style='margin:10px'><h2 style='margin:10px 0'>Mail from admin</h2>
                    <p style='margin-bottom:5px'><b>Hi $name, your login credentials</b></p>
                    <p style='margin:5px 0'><b>Login Page:</b> <a href='ananthsoft.org/oas'>ananthsoft.org/oas</a></p>
                    <p style='margin:5px 0'><b>Username:</b> $username</p>
                    <p style='margin:5px 0'><b>Email:</b> $email</p>
                    <p style='margin:5px 0'><b>Category:</b> $category</p>
                    <p style='margin:5px 0'><b>Password:</b> $password</p>
                    <p style='margin:5px 0'>Note: This password is generated by Office Automation Software. So, After login change password to your convenience.</p>
                <div>";
    $headers  = 'MIME-Version: 1.0'."\r\n".'Content-type: text/html; charset=utf-8'."\r\n".'From: '.$sender."\r\n";
    
    // Send Mail
    if(mail($email, $subject, $message, $headers)) {
        // Password Hash Generator
        $hash = password_hash($password, PASSWORD_DEFAULT);
        
        include "config/db.php";
        $query = "insert into authuser values('$username','$email','$name','$category','$hash')";
        if(mysqli_query($con,$query)) header("Location: admin?users&add=success");
        else header("Location: admin?users&add=failed");
        mysqli_close($con);
        exit;
    } else {
        header("Location: admin?users&mail=failed");
        exit;
    }
}

## Update
if(isset($_POST['update1'])) {
    $username = $_POST['username'];
    
    include "config/db.php";
    $query = "select email, category from authuser where username='$username'";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $email = $row['email'];
        $category = $row['category'];
    } else {
        header("Location: admin?users&invalid=username");
        exit;
    }
    mysqli_close($con);
}
if(isset($_POST['update2'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $category = $_POST['category'];
            
    include "config/db.php";
    $query = "update authuser set email='$email', name='$name', category='$category' where username='$username'";
    if(mysqli_query($con,$query)) header("Location: admin?users&update=success");
    else header("Location: admin?users&update=failed");
    mysqli_close($con);
    exit;
}

## Delete
if(isset($_POST['delete1'])) {
    $username = $_POST['username'];
    
    include "config/db.php";
    $query = "select category from authuser where username='$username'";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) > 0) {
        null;
    } else {
        header("Location: admin?users&invalid=username");
        exit;
    }
}
if(isset($_POST['delete2'])) {
    $username = $_POST['username'];
            
    include "config/db.php";
    $query = "delete from authuser where username='$username'";
    if(mysqli_query($con,$query)) header("Location: admin?users&delete=success");
    else header("Location: admin?users&delete=failed");
    mysqli_close($con);
    exit;
}
?>

<div id="panel" class="card">
    <div class="tab">
        <button class="tablinks <?php if(!$_POST) echo "active"?>" onclick="action(event, 'users')">Users</button>
        <button class="tablinks" onclick="action(event, 'add')">Add</button>
        <button class="tablinks <?php if(isset($_POST['update1'])) echo "active"?>" onclick="action(event, 'update')">Update</button>
        <button class="tablinks <?php if(isset($_POST['delete1'])) echo "active"?>" onclick="action(event, 'delete')">Delete</button>
        <a href="admin" style="float:right"><button class="tablinks">✕</button></a>
    </div>

    <div id="users" class="tabcontent <?php if(!$_POST) echo "display"?>">
        <table>
            <tr><th>S.No</th><th>Name</th><th>Username</th><th>Email</th><th>Category</th></tr>
            <?php
            include "config/db.php";
            $sn = 0;
            $query = "select username, email, name, category from authuser";
            $result = mysqli_query($con, $query);
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    $sn = $sn + 1; echo "<tr><td>".$sn."</td><td>".$row['name']."</td><td>".$row['username']."</td>
                    <td class='break'>".$row['email']."</td><td>".$row['category']."</td></tr>";
                }
            }
            mysqli_close($con);
            ?>
        </table>
    </div>
    
    <div id="add" class="tabcontent">
    <center><form action="admin?users" method="post">
        <div class="table">
            <div class="col">
                <label for="username">Username<span>*</span></label>
                <input type="text" id="username" name="username" placeholder="Username" maxlength="20" required>
                
                <label for="name">Name<span>*</span></label>
                <input type="text" id="name" name="name" placeholder="Name" maxlength="24" required>
            </div>
            <div class="col">
                <label for="email">Email<span>*</span></label>
                <input type="text" id="email" name="email" placeholder="Email" maxlength="50" required>
                
                <label for="category">Category<span>*</span></label>
                <select id="category" name="category" required>
                    <option disabled selected value>Select category</option>
                    <option value="cashier">Cashier</option>
                    <option value="staff">Office Staff</option>
                    <option value="warden">Hostel Warden</option>
                </select>
            </div>
        </div>
        <input type="hidden" name="add">
        <input type="hidden" name="token" value="<?php echo $_SESSION['token']?>">
        <input style="width:100px;margin:0" type="reset" value="Clear">
        <input style="width:100px;margin:0" type="submit" value="Add">
        </center></form>
    </div>
    
    <div id="update" class="tabcontent <?php if(isset($_POST['update1'])) echo "display"?>">
    <center><form action="admin?users" method="post">
        <?php if(!isset($_POST['update1'])):?>
        <div class="table">
            <div class="col">
                <label for="username">Username<span>*</span></label>
                <input type="text" id="username" name="username" placeholder="Username" maxlength="20" required>
            </div>
            <div class="col2">
                <input type="hidden" name="update1">
                <input type="hidden" name="token" value="<?php echo $_SESSION['token']?>">
                <input style="width:100px;margin:0;margin-top:50px" type="submit" value="Submit">
            </div>
        </div>
        <?php elseif(isset($_POST['update1'])):?>
        <center><form action="admin?users" method="post">
        <div class="table">
            <div class="col">
                <label for="username">Username<span>*</span></label>
                <input type="text" id="username" name="username" value="<?php echo $username?>" placeholder="Username" maxlength="20" required readonly>
                
                <label for="name">Name<span>*</span></label>
                <input type="text" id="name" name="name" value="<?php echo $name?>" placeholder="Name" maxlength="24" required>
            </div>
            <div class="col">
                <label for="email">Email<span>*</span></label>
                <input type="text" id="email" name="email" value="<?php echo $email?>" placeholder="Email" maxlength="50" required>
            
            
                <label for="category">Category<span>*</span></label>
                <select id="category" name="category" required>
                    <option value="admin" <?php if($category=="admin") echo "selected"?>>Administrator</option>
                    <option value="cashier" <?php if($category=="cashier") echo "selected"?>>Cashier</option>
                    <option value="staff" <?php if($category=="staff") echo "selected"?>>Office Staff</option>
                    <option value="warden" <?php if($category=="warden") echo "selected"?>>Hostel Warden</option>
                </select>
            </div>
        </div>
        <a href="admin?users">Cancel</a>
        <input type="hidden" name="update2">
        <input type="hidden" name="token" value="<?php echo $_SESSION['token']?>">
        <input style="width:100px;margin:0" type="submit" value="Update">
        <?php endif;?>
    </center></form>
    </div>
    
    <div id="delete" class="tabcontent <?php if(isset($_POST['delete1'])) echo "display"?>">
    <center><form action="admin?users" method="post">
        <?php if(!isset($_POST['delete1'])):?>
        <div class="table">
            <div class="col">
                <label for="username">Username<span>*</span></label>
                <input type="text" id="username" name="username" placeholder="Username" maxlength="20" required>
            </div>
            <div class="col2">
                <input type="hidden" name="delete1">
                <input type="hidden" name="token" value="<?php echo $_SESSION['token']?>">
                <input style="width:100px;margin:0;margin-top:50px" type="submit" value="Submit">
            </div>
        </div>
        <?php elseif(isset($_POST['delete1'])):?>
        <center><form action="admin?users" method="post">
        <div class="table">
            <div class="col">
                <label for="username">Username<span>*</span></label>
                <input type="text" id="username" name="username" value="<?php echo $username?>" placeholder="Username" maxlength="20" required readonly>
            </div>
            <div class="col">
                <label style="margin-top:38px"><span>Confirm to delete <?php echo $username?></span></label>
            </div>
        </div>
        <a href="admin?users">Cancel</a>
        <input type="hidden" name="delete2">
        <input type="hidden" name="token" value="<?php echo $_SESSION['token']?>">
        <input style="width:100px;margin:0" type="submit" value="Confrim">
        <?php endif;?>
    </center></form>
    </div>
</div>