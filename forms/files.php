<?php
    $admitno = $_GET["files"];
    $path = "documents/".$admitno;
    
    if(!is_dir($path)) mkdir($path);
    $count = 0;
    $files = "<table><tr><th>Documents</th><th>Actions</th><tr>";
    if($handle = opendir($path)) {
        while (false !== ($file = readdir($handle))) {
            if($file != "." && $file != "..") {
                $count += 1;
                $files .= "<tr><td>$file</td><td>
                        <a target='_blank' href='".$path."/".$file."'>View</a>
                        <a style='background:red' href='?document&files=$admitno&delete=$file'>Delete</a>
                    </td></tr>";
            }
        }
        closedir($handle);
    }
    if($count == 0) $files .= "<tr><td colspan=2><center>No Documents</center></td></tr>";
    $files .= "</table>";
    
## Upload
if(isset($_POST['upload'])) {
    if(file_exists($_FILES["file"]["tmp_name"])) 
        move_uploaded_file($_FILES["file"]["tmp_name"], $path."/".basename($_FILES['file']['name']));
    header("Location: staff?document&files=$admitno");
    exit;
}

## Delete
if(isset($_GET['delete'])) {
    if(unlink($path."/".$_GET['delete'])) {
        header("Location: staff?document&files=$admitno");
        exit; 
    }
}
?>

<div id="panel" class="card">
    <div style="padding:20px">
        <form action="<?php $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data"><center>
        <h2>Files</h2>
        <div class="table">
            <div class="col">
                <label for="file">Upload<span>*</span></label>
                <input type="file" id="file" name="file" required>
            </div>
            <div class="col">
                <input type="hidden" name="upload">
                <input type="hidden" name="token" value="<?php echo $_SESSION['token']?>">
                <input style="width:100px;margin:0;margin-top:30px" type="submit" value="Submit">
                <a href="staff?document">Exit</a>
            </div>
        </div>
        </center></form>
        <div class="table" style="padding:20px">
            <?php echo $files?>
        </div>
    </div>
</div>