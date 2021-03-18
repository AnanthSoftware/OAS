<?php 
if(isset($_POST['add'])) {
    $admitno = $_POST['admitno'];
    $regno = $_POST['regno'];
    $branch = $_POST['branch'];
    
    if(file_exists($_FILES["file"]["tmp_name"]))
        $photo = "photos/" . $admitno . '.' . pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
    else
        $photo = "";
        
    $status = $_POST['status'];
    $batch = $_POST['batch'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $father = $_POST['father'];
    $mother = $_POST['mother'];
    
    $address = $_POST['address'];
    $village = $_POST['village'];
    $taluk = $_POST['taluk'];
    $district = $_POST['district'];
    $pincode = $_POST['pincode'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    
    $aadhaar = $_POST['aadhaar'];
    $pan = $_POST['pan'];
    $nationality = $_POST['nationality'];
    $religion = $_POST['religion'];
    $community = $_POST['community'];
    $caste = $_POST['caste'];
    
    $phno = $_POST['phno'];
    $email = $_POST['email'];
    $gphno = $_POST['gphno'];
    $gemail = $_POST['gemail'];
    
    $oldregno = $_POST['oldregno'];
    $institute = $_POST['institute'];
    $mop = $_POST['mop'];
    $yop = $_POST['yop'];
    $m1 = $_POST['m1'];
    $m2 = $_POST['m2'];
    $m3 = $_POST['m3'];
    $m4 = 0; $m5 = 0; $m6 = 0; $m7 = 0; $m8 = 0; $outof = "-"; $cutof = "-";
    if(isset($_POST['m4'])) $m4 = $_POST['m4'];
    if(isset($_POST['m5'])) $m5 = $_POST['m5'];
    if(isset($_POST['m6'])) $m6 = $_POST['m6'];
    if(isset($_POST['m7'])) $m7 = $_POST['m7'];
    if(isset($_POST['m8'])) $m8 = $_POST['m8'];
    if(isset($_POST['outof'])) $outof = $_POST['outof'];
    if(isset($_POST['cutof'])) $cutof = $_POST['cutof'];
    $total = $_POST['total'];
    $percent = $_POST['percent'];
    
    $tutionfee = $_POST['tutionfee'];
    $bookfee = $_POST['bookfee'];
    $busfee = $_POST['busfee'];
    $hostelrent = $_POST['hostelrent'];
    $otherfee = $_POST['otherfee'];
    $totalfee = $_POST['totalfee'];
    
    $acyear = $_POST['acyear'];
    $doj = $_POST['doj'];
    $scheme = $_POST['scheme'];
    $category = $_POST['category'];
    $group = $_POST['group'];
    $hostel = $_POST['hostel'];
    $firstgrad = $_POST['firstgrad'];
    $refer = $_POST['refer'];
    $referby = "-"; $agent = "-";
    if(isset($_POST['referby'])) $referby = $_POST['referby'];
    if(isset($_POST['agent'])) $agent = $_POST['agent'];
    
    $count = 0;
    include "config/db.php";
    
    if($regno == null)
        $query1 = "insert into studetails values('$admitno',NULL,'$branch','$photo','$status','$batch','$fname','$lname','$dob','$gender','$father','$mother')";
    else
        $query1 = "insert into studetails values('$admitno','$regno','$branch','$photo','$status','$batch','$fname','$lname','$dob','$gender','$father','$mother')";
    
    $query2 = "insert into stuaddress values('$admitno','$address','$village','$taluk','$district','$pincode','$state','$country')";
    $query3 = "insert into stuidentity values('$admitno','$aadhaar','$pan','$nationality','$religion','$community','$caste')";
    $query4 = "insert into stucontact values('$admitno','$phno','$email','$gphno','$gemail')";
    $query5 = "insert into stuhistory values('$admitno','$oldregno','$institute',$mop,$yop,$m1,$m2,$m3,$m4,$m5,$m6,$m7,$m8,'$outof','$cutof','$total','$percent')";
    $query6 = "insert into stufeestruct values('$admitno','$tutionfee','$bookfee','$busfee','$hostelrent','$otherfee','$totalfee')";
    $query7 = "insert into stuadmission values('$admitno','$acyear','$doj','$scheme','$category','$group','$hostel','$firstgrad','$refer','$referby','$agent')";
    
    $query8 = "insert into stufeepend values('$admitno',1,'$tutionfee','$bookfee','$busfee','$hostelrent','$otherfee','$totalfee')";
    $query9 = "insert into stufeepend values('$admitno',2,'$tutionfee','$bookfee','$busfee','$hostelrent','$otherfee','$totalfee')";
    $query10 = "insert into stufeepend values('$admitno',3,'$tutionfee','$bookfee','$busfee','$hostelrent','$otherfee','$totalfee')";
    $query11 = "insert into stufeepend values('$admitno',4,'$tutionfee','$bookfee','$busfee','$hostelrent','$otherfee','$totalfee')";
            
    if(file_exists($_FILES["file"]["tmp_name"])) move_uploaded_file($_FILES["file"]["tmp_name"], $photo);
            
    if(mysqli_query($con,$query1)) $count += 1;
    if(mysqli_query($con,$query2)) $count += 1;
    if(mysqli_query($con,$query3)) $count += 1;
    if(mysqli_query($con,$query4)) $count += 1;
    if(mysqli_query($con,$query5)) $count += 1;
    if(mysqli_query($con,$query6)) $count += 1;
    if(mysqli_query($con,$query7)) $count += 1;
            
    if(mysqli_query($con,$query8)) $count += 1;
    if(mysqli_query($con,$query9)) $count += 1;
    if(mysqli_query($con,$query10)) $count += 1;
    if(mysqli_query($con,$query11)) $count += 1;
             
    if($count == 11) header("Location: admin?admissions&add=success");
    else header("Location: admin?admissions&add=failed");
    mysqli_close($con);
    exit;
}
?>

<div id="panel" class="card">
    <div class="tab">
        <button class="tablinks <?php if(!$_POST) echo "active"?>" onclick="action(event, 'admissions')">Admissions</button>
        <button class="tablinks" onclick="action(event, 'add')">Add</button>
        <button class="tablinks <?php if(isset($_POST['update1'])) echo "active"?>" onclick="action(event, 'update')">Update</button>
        <button class="tablinks <?php if(isset($_POST['delete1'])) echo "active"?>" onclick="action(event, 'delete')">Delete</button>
        <a href="admin" style="float:right"><button class="tablinks">✕</button></a>
    </div>

    <div id="admissions" class="tabcontent scroll <?php if(!$_POST) echo "display"?>">
       <table>
            <tr><th>Admission No</th><th>Register No</th><th>Name</th><th>Branch</th><th>Status</th><th>Batch</th></tr>
            <?php
            include "config/db.php";
            $query = "select admitno, regno, branch, fname, lname, status, batch from studetails";
            $result = mysqli_query($con, $query);
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr><td>".$row['admitno']."</td><td>".$row['regno']."</td><td class='break'>".$row['fname']." ".$row['lname']."</td>
                    <td>".$row['branch']."</td><td>".$row['status']."</td><td>".$row['batch']."</td></tr>";
                }
            }
            mysqli_close($con);
            ?>
        </table>
    </div>
    
    <div id="add" class="tabcontent scroll">
      <center><form action="admin?admissions" method="post" enctype="multipart/form-data">
        <div class="table">
            <div class="col">
                <label for="admitno">Admission Number<span>*</span></label>
                <input type="text" class="upper" id="admitno" name="admitno" placeholder="YYDEPTXXX" maxlength="20" required>
                
                <label for="regno">Register Number</label>
                <input type="text" id="regno" name="regno" placeholder="XXXXXXXXXXXX" maxlength="12">
                
                <label for="branch">Branch</label>
                <select name="branch" id="branch">
                    <option disabled selected>Select Branch</option>
                    <option value="CIVIL">CIVIL</option>
                    <option value="CSE">CSE</option>
                    <option value="ECE">ECE</option>
                    <option value="EEE">EEE</option>
                    <option value="IT">IT</option>
                    <option value="MECH">MECH</option>
                    <option value="MBA">MBA</option>
                    <option value="MCA">MCA</option>
                </select>
                
                <label for="status">Status<span>*</span></label>
                <select name="status" id="status" requied>
                    <option disabled selected>Select Status</option>
                    <option value="WAITING">WAITING</option>
                    <option value="PURSUING">PURSUING</option>
                    <option value="DISCONTINUED">DISCONTINUED</option>
                    <option value="PASSEDOUT">PASSED OUT</option>
                </select>
            </div>
            <div class="col"> 
                <label for="file">Photo</label><br>
                <img id="photo" height="156" width="117">
                <input type="file" style="padding-top:7px" id="file" name="file" onchange="show(this)">
                
                <label for="batch">Batch<span>*</span></label>
                <input type="text" id="batch" name="batch" placeholder="YYYY-YY" maxlength="7" required>
            </div>
        </div>
        <hr>
        <div class="table">
            <div class="col">
                <label for="fname">First Name<span>*</span></label>
                <input type="text" class="upper" id="fname" name="fname" placeholder="First Name" maxlength="20" required>
                
                <label for="dob">Date of birth<span>*</span></label>
                <input type="date" id="dob" name="dob" required>
                
                <label for="father">Father Name<span>*</span></label>
                <input type="text" class="upper" id="father" name="father" placeholder="Father Name" maxlength="24" required>
            </div>
            <div class="col">
                <label for="lname">Last Name (Initial)<span>*</span></label>
                <input type="text" class="upper" id="lname" name="lname" placeholder="Last Name" maxlength="4" required>
                
                <br><label for="gender">Gender<span>*</span></label><br>
                <div style="margin:13px 0 20px 0">
                    <input type="radio" id="male" name="gender" value="MALE" required><label for="male"> Male&emsp;&ensp;</label>
                    <input type="radio" id="female" name="gender" value="FEMALE"><label for="female"> Female&emsp;&ensp;</label>
                    <input type="radio" id="other" name="gender" value="OTHER"><label for="other"> Other</label><br>
                </div>
                
                <label for="mother">Mother Name<span>*</span></label>
                <input type="text" class="upper" id="mother" name="mother" placeholder="Mother Name" maxlength="24" required>
            </div>
        </div>
        <hr>
        <div class="table">
            <div class="col">
                <label for="aadhaar">Aadhaar Number<span>*</span></label>
                <input type="text" id="aadhaar" name="aadhaar" placeholder="Aadhaar Number" maxlength="12" required>
                
                <label for="nationality">Nationality<span>*</span></label>
                <select name="nationality" id="nationality" required>
                    <option disabled selected value>Select Nationality</option>
                    <option value="Indian">Indian</option>
                    <option value="Other">Other</option>
                </select>
                
                <label for="community">Community<span>*</span></label>
                <select name="community" id="community" required>
                    <option disabled selected value>Select Community</option>
                    <option value="OC">OC</option>
                    <option value="BC">BC</option>
                    <option value="MBC">MBC</option>
                    <option value="SC">SC</option>
                    <option value="SCA">SCA</option>
                    <option value="ST">ST</option>
                </select>
            </div>
            <div class="col">
                <label for="pan">PAN</label>
                <input type="text" class="upper" id="pan" name="pan" placeholder="PAN" maxlength="10">
                
                <label for="religion">Religion<span>*</span></label>
                <select name="religion" id="religion" size="1" required>
                    <option disabled selected value>Select Religion</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Muslim">Muslim</option>
                    <option value="Christian">Christian</option>
                </select>
                <label for="caste">Caste<span>*</span></label>
                <input type="text" id="caste" name="caste" placeholder="Caste" maxlength="30" required>
            </div>
        </div>
        <hr>
        <div class="table">
            <div class="col">
                <label for="address">Address (Door No, Street)<span>*</span></label>
                <textarea style="height:120px;margin-bottom:6px" row="4" id="address" name="address" placeholder="Address" maxlength="128" required></textarea>
                
                <label for="countrySel">Country<span>*</span></label>
                <select name="country" id="countrySel" size="1" required>
                    <option value selected>Select Country</option>
                </select>
                
                <label for="districtSel">District<span>*</span></label>
                <select name="district" id="districtSel" size="1" required>
                    <option value selected>Select State First</option>
                </select>
            </div>
            <div class="col">
                <label for="village">Village/Town<span>*</span></label>
                <input type="text" id="village" name="village" placeholder="Village/Town" maxlength="20" required>
                
                <label for="taluk">Taluk<span>*</span></label>
                <input type="text" id="taluk" name="taluk" placeholder="Taluk" maxlength="20" required>
                
                <label for="stateSel">State<span>*</span></label>
                <select name="state" id="stateSel" size="1" required>
                    <option value selected>Select Country First</option>
                </select>
            
                <label for="pin">Pin code<span>*</span></label>
                <input type="number" min="100000" max="999999" id="pin" name="pincode" placeholder="Pincode" required>
            </div>
        </div>
        <hr>
        <div class="table">
            <div class="col">
                <label for="phno">Phone Number<span>*</span></label>
                <input type="text" id="phno" name="phno" placeholder="Phone Number" maxlength="10" required>
                
                <label for="gphno">Guardian Phone Number<span>*</span></label>
                <input type="text" id="gphno" name="gphno" placeholder="Guardian Phone Number" maxlength="10" required>
            </div>
            <div class="col">
                <label for="email">Email<span>*</span></label>
                <input type="text" id="email" name="email" placeholder="Email" maxlength="50" required>
                
                <label for="gemail">Guardian Email</label>
                <input type="text" id="gemail" name="gemail" placeholder="Guardian Email" maxlength="50">
            </div>
        </div>
        <hr>
        <div class="table">
            <div class="col">
                <label for="acyear">Academic Year<span>*</span></label>
                <input type="text" id="acyear" name="acyear" onkeyup="acYear()" placeholder="Academic Year" maxlength="4" required>
                
                <label for="scheme">Scheme<span>*</span></label>
                <select id="scheme" name="scheme" required>
                    <option disabled selected value>Select Scheme</option>
                    <option value="FIRST YEAR ENGG">FIRST YEAR ENGG</option>
                    <option value="LATERAL ENTRY">LATERAL ENTRY</option>
                    <option value="PG">PG</option>
                </select>
                
                <label for="group">Group<span>*</span></label>
                <select id="group" name="group" onchange="groupChange()" required>
                    <option disabled selected value>Select Group</option>
                    <option value="ACADEMIC">ACADEMIC</option>
                    <option value="VOCATIONAL">VOCATIONAL</option>
                    <option value="DIPLOMA">DIPLOMA</option>
                    <option value="DEGREE">DEGREE</option>
                </select>
            </div>
            <div class="col">
                <label for="doj">Date of Joinning<span>*</span></label>
                <input type="date" id="doj" name="doj" required>
                
                <label for="category">Category<span>*</span></label>
                <select id="category" name="category" required>
                    <option disabled selected value>Select category</option>
                    <option value="GOVT">GOVT</option>
                    <option value="MGT">MGT</option>
                    <option value="LAPSED">LAPSED</option>
                </select>
            </div>
        </div>
        
        <div id="block1" style="display:none">
        <div class="table">
            <div class="col">
                <label for="oldregno">Register Number<span>*</span></label>
                <input type="text" id="oldregno" name="oldregno" placeholder="Register Number" maxlength="10" required>
                
                <label for="mop">Month of Passing<span>*</span></label>
                <input type="number" min="1" max="12" id="mop" name="mop" placeholder="Month of Passing" required>
                
                <label for="m11">Mark in Maths<span>*</span></label>
                <input type="number" min="0" max="100" value=0 id="m11" name="m1" onchange="calcTotal()" onkeyup="calcTotal()" required>
                
                <label for="m13">Mark in Chemistry<span>*</span></label>
                <input type="number" min="0" max="100" value=0 id="m13" name="m3" onchange="calcTotal()" onkeyup="calcTotal()" required>
                
                <label for="cutof1">Cut of Marks<span>*</span></label>
                <input type="text" id="cutof1" name="cutof" value="0" required readonly>
                
                <label for="total1">Total<span>*</span></label>
                <input type="number" step="0.01" min="0" max="600" id="total1" name="total" placeholder="Total" required>
            </div>
            <div class="col">
                <label for="institute">Last Institution<span>*</span></label>
                <input type="text" id="institute" name="institute" placeholder="Last Institution" maxlength="50" required>
                
                <label for="yop">Year of Passing<span>*</span></label>
                <input type="number" min="2000" max="2100" id="yop" name="yop" placeholder="Year of Passing" required>
                
                <label for="m12">Mark in Physics<span>*</span></label>
                <input type="number" min="0" max="200" value=0 id="m12" name="m2" onchange="calcTotal()" onkeyup="calcTotal()" required>
                
                <label for="outof1">Total out of 300<span>*</span></label>
                <input type="text" id="outof1" name="outof" value="0" required readonly>
                
                <label style="margin-top:82px" for="percent1">Percentage<span>*</span></label>
                <input type="number" step="0.01" min="0" max="100" id="percent1" name="percent" placeholder="Percentage" required>
            </div>
        </div>
        </div>
        
        <div id="block2" style="display:none">
        <div class="table">
            <div class="col">
                <label for="oldregno">Register Number<span>*</span></label>
                <input type="text" id="oldregno" name="oldregno" placeholder="Register Number" maxlength="10" required>
                
                <label for="mop">Month of Passing<span>*</span></label>
                <input type="number" min="1" max="12" id="mop" name="mop" placeholder="Month of Passing" required>
                
                <label for="m21">Mark in Maths<span>*</span></label>
                <input type="number" min="0" max="100" value=0 id="m21" name="m1" onchange="calcTotal()" onkeyup="calcTotal()" required>
                
                <label for="m23">Mark in Lab<span>*</span></label>
                <input type="number" min="0" max="200" value=0 id="m23" name="m3" onchange="calcTotal()" onkeyup="calcTotal()" required>
                
                <label for="cutof2">Cut of Marks<span>*</span></label>
                <input type="text" id="cutof2" name="cutof" value="0" required readonly>
                
                <label for="total2">Total<span>*</span></label>
                <input type="number" step="0.01" min="0" max="600" id="total2" name="total" placeholder="Total" required>
            </div>
            <div class="col">
                <label for="institute">Last Institution<span>*</span></label>
                <input type="text" id="institute" name="institute" placeholder="Last Institution" maxlength="50" required>
                
                <label for="yop">Year of Passing<span>*</span></label>
                <input type="number" min="2000" max="2100" id="yop" name="yop" placeholder="Year of Passing" required>
                
                <label for="m22">Mark in Theory<span>*</span></label>
                <input type="number" min="0" max="100" value=0 id="m22" name="m2" onchange="calcTotal()" onkeyup="calcTotal()" required>
                
                <label for="outof2">Total out of 400<span>*</span></label>
                <input type="text" id="outof2" name="outof" value="0" required readonly>
                
                <label style="margin-top:82px" for="percent2">Percentage<span>*</span></label>
                <input type="number" step="0.01" min="0" max="100" id="percent2" name="percent" placeholder="Percentage" required>
            </div>
        </div>
        </div>
        
        <div id="block3" style="display:none">
        <div class="table">
            <div class="col">
                <label for="oldregno">Register Number<span>*</span></label>
                <input type="text" id="oldregno" name="oldregno" placeholder="Register Number" maxlength="10" required>
                
                <label for="mop">Month of Passing<span>*</span></label>
                <input type="number" min="1" max="12" id="mop" name="mop" placeholder="Month of Passing" required>
                
                <label for="m31">Mark obtained in Semester 1<span>*</span></label>
                <input type="number" min="0" max="100" value=0 id="m31" name="m1" onchange="calcTotal()" onkeyup="calcTotal()" required>
                
                <label for="m33">Mark obtained in Semester 3<span>*</span></label>
                <input type="number" min="0" max="100" value=0 id="m33" name="m3" onchange="calcTotal()" onkeyup="calcTotal()" required>
                
                <label for="m35">Mark obtained in Semester 5<span>*</span></label>
                <input type="number" min="0" max="100" value=0 id="m35" name="m5" onchange="calcTotal()" onkeyup="calcTotal()" required>
                
                <label for="total3">Total<span>*</span></label>
                <input type="text" id="total3" name="total" value="0" required readonly>
            </div>
            <div class="col">
                <label for="institute">Last Institution<span>*</span></label>
                <input type="text" id="institute" name="institute" placeholder="Last Institution" maxlength="50" required>
                
                <label for="yop">Year of Passing<span>*</span></label>
                <input type="number" min="2000" max="2100"  id="yop" name="yop" placeholder="Year of Passing" required>
                
                <label for="m32">Mark obtained in Semester 2<span>*</span></label>
                <input type="number" min="0" max="100" value=0 id="m32" name="m2" onchange="calcTotal()" onkeyup="calcTotal()" required>
                
                <label for="m34">Mark obtained in Semester 4<span>*</span></label>
                <input type="number" min="0" max="100" value=0 id="m34" name="m4" onchange="calcTotal()" onkeyup="calcTotal()" required>
                
                <label for="m36">Mark obtained in Semester 6<span>*</span></label>
                <input type="number" min="0" max="100" value=0 id="m36" name="m6" onchange="calcTotal()" onkeyup="calcTotal()" required>
                
                <label for="percent3">Percentage<span>*</span></label>
                <input type="text" id="percent3" name="percent" value="0" required readonly>
            </div>
        </div>
        </div>
        
        <div id="block4" style="display:none">
        <div class="table">
            <div class="col">
                <label for="oldregno">Register Number<span>*</span></label>
                <input type="text" id="oldregno" name="oldregno" placeholder="Register Number" maxlength="10" required>
                
                <label for="mop">Month of Passing<span>*</span></label>
                <input type="number" min="1" max="12" id="mop" name="mop" placeholder="Month of Passing" required>
                
                <label for="m41">Mark obtained in Semester 1<span>*</span></label>
                <input type="number" min="0" max="100" value=0 id="m41" name="m1" onchange="calcTotal()" onkeyup="calcTotal()" required>
                
                <label for="m43">Mark obtained in Semester 3<span>*</span></label>
                <input type="number" min="0" max="100" value=0 id="m43" name="m3" onchange="calcTotal()" onkeyup="calcTotal()" required>
                
                <label for="m45">Mark obtained in Semester 5<span>*</span></label>
                <input type="number" min="0" max="100" value=0 id="m45" name="m5" onchange="calcTotal()" onkeyup="calcTotal()" required>
                
                <label for="m47">Mark obtained in Semester 7<span>*</span></label>
                <input type="number" min="0" max="100" value=0 id="m47" name="m7" onchange="calcTotal()" onkeyup="calcTotal()" required>
                
                <label for="total4">Total<span>*</span></label>
                <input type="text" id="total4" name="total" value="0" required readonly>
            </div>
            <div class="col">
                <label for="institute">Last Institution<span>*</span></label>
                <input type="text" id="institute" name="institute" placeholder="Last Institution" maxlength="50" required>
                
                <label for="yop">Year of Passing<span>*</span></label>
                <input type="number" min="2000" max="2100"  id="yop" name="yop" placeholder="Year of Passing" required>
                
                <label for="m42">Mark obtained in Semester 2<span>*</span></label>
                <input type="number" min="0" max="100" value=0 id="m42" name="m2" onchange="calcTotal()" onkeyup="calcTotal()" required>
                
                <label for="m44">Mark obtained in Semester 4<span>*</span></label>
                <input type="number" min="0" max="100" value=0 id="m44" name="m4" onchange="calcTotal()" onkeyup="calcTotal()" required>
                
                <label for="m46">Mark obtained in Semester 6<span>*</span></label>
                <input type="number" min="0" max="100" value=0 id="m46" name="m6" onchange="calcTotal()" onkeyup="calcTotal()" required>
                
                <label for="m48">Mark obtained in Semester 8<span>*</span></label>
                <input type="number" min="0" max="100" value=0 id="m48" name="m8" onchange="calcTotal()" onkeyup="calcTotal()" required>
                
                <label for="percent4">Percentage<span>*</span></label>
                <input type="text" id="percent4" name="percent" value="0" required readonly>
            </div>
        </div>
        </div>
        
        <hr>
        <div class="table">
            <div class="col">
                <label for="tutionfee">Tution Fee<span>*</span></label>
                <input type="number" min="0" max="200000" value=0 id="tutionfee" name="tutionfee" onchange="totalFee()" onkeyup="totalFee()" required>
                
                <label for="busfee">Bus Fee</label>
                <input type="number" min="0" max="100000" value=0 id="busfee" name="busfee" onchange="totalFee()" onkeyup="totalFee()" required>
        
                <label for="otherfee">Other Fee</label>
                <input type="number" min="0" max="100000" value=0 id="otherfee" name="otherfee" onchange="totalFee()" onkeyup="totalFee()" required>
            </div>
            <div class="col">
                <label for="bookfee">Book Fee</label>
                <input type="number" min="0" max="100000" value=0 id="bookfee" name="bookfee" onchange="totalFee()" onkeyup="totalFee()" required>
                
                <label for="hostelrent">Hostel Rent</label>
                <input type="number" min="0" max="100000" value=0 id="hostelrent" name="hostelrent" onchange="totalFee()" onkeyup="totalFee()" required>
                
                <label for="totalfee">Total Fee<span>*</span></label>
                <input type="text" id="totalfee" value="0" name="totalfee" required readonly>
            </div>
        </div>
        <hr>
        <div class="table">
            <div class="col">
                <label for="hostel">Hostel<span>*</span></label>
                <select id="hostel" name="hostel" required>
                    <option disabled selected value>Select Hostel</option>
                    <option value="YES">YES</option>
                    <option value="NO">NO</option> 
                </select>
                
                <label for="refer">Refered<span>*</span></label>
                <select id="refer" name="refer" onchange="referChange()" required>
                    <option disabled selected value>Select Refered</option>
                    <option value="YES">YES</option>
                    <option value="NO">NO</option>
                </select>
                
                <div id="refer1" style="display:none">
                <label for="agent">Name of the Staff/Agent<span>*</span></label>
                <input type="text" id="agent" name="agent" placeholder="Name of the Staff/Agent" maxlength="20" required>
                </div>
            </div>
            <div class="col">
                <label for="firstgrad">First Graduate<span>*</span></label>
                <select id="firstgrad" name="firstgrad" required>
                    <option disabled selected value>Select First Graduate</option>
                    <option value="YES">YES</option>
                    <option value="NO">NO</option>  
                </select>
                
                <div id="refer2" style="display:none">
                <label for="referby">Refered By<span>*</span></label>
                <input type="text" id="referby" name="referby" placeholder="Refered By" maxlength="10" required>
                </div>
            </div>
        </div>
        
        <input type="hidden" name="add">
        <input type="hidden" name="token" value="<?php echo $_SESSION['token']?>">
        <input style="width:100px;margin:0" type="reset" value="Clear">
        <input style="width:100px;margin:0" type="submit" value="Add">
        </center></form>
        <br>
    </div>
    
    <div id="update" class="tabcontent">
    </div>
    
    <div id="delete" class="tabcontent">
    </div>
    
    <script src="assets/jquery.js"></script>
    <script>
    function show(input) {
        var validExtensions = ['jpg','png','jpeg'];
        var fileName = input.files[0].name;
        var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
        if ($.inArray(fileNameExt, validExtensions) == -1) {
            input.type = ''
            input.type = 'file'
            $('#photo').attr('src',"");
            alert("Only these file types are accepted : "+validExtensions.join(', '));
        }
        else {
            if (input.files && input.files[0]) {
                var filerdr = new FileReader();
                filerdr.onload = function (e) {
                    $('#photo').attr('src', e.target.result);
                }
                filerdr.readAsDataURL(input.files[0]);
            }
        }
    }
    
    function groupChange() {
        var x = document.getElementById("group").value;
        if(x == "ACADEMIC") {
            document.getElementById("block1").style.display = "block";
            $(document).ready(function() {
                $("#block1 :input").prop('disabled', false);
                $("#block2 :input").prop('disabled', true);
                $("#block3 :input").prop('disabled', true);
                $("#block4 :input").prop('disabled', true);
            });
        } else {
            document.getElementById("block1").style.display = "none";
        }
        
        if(x == "VOCATIONAL") {
            document.getElementById("block2").style.display = "block";
            $(document).ready(function() {
                $("#block1 :input").prop('disabled', true);
                $("#block2 :input").prop('disabled', false);
                $("#block3 :input").prop('disabled', true);
                $("#block4 :input").prop('disabled', true);
            });
        } else {
            document.getElementById("block2").style.display = "none";
        }
        
        if(x == "DIPLOMA") {
            document.getElementById("block3").style.display = "block";
            $(document).ready(function() {
                $("#block1 :input").prop('disabled', true);
                $("#block2 :input").prop('disabled', true);
                $("#block3 :input").prop('disabled', false);
                $("#block4 :input").prop('disabled', true);
            });
        } else {
            document.getElementById("block3").style.display = "none";
        }
        
        if(x == "DEGREE") {
            document.getElementById("block4").style.display = "block";
            $(document).ready(function() {
                $("#block1 :input").prop('disabled', true);
                $("#block2 :input").prop('disabled', true);
                $("#block3 :input").prop('disabled', true);
                $("#block4 :input").prop('disabled', false);
            });
        } else {
            document.getElementById("block4").style.display = "none";
        }
    }
    
    function referChange() {
        var x = document.getElementById("refer").value;
        if(x == "YES") {
            document.getElementById("refer1").style.display = "block";
            document.getElementById("refer2").style.display = "block";
            $(document).ready(function() {
                $("#refer1 :input").prop('disabled', false);
                $("#refer2 :input").prop('disabled', false);
            });
        } else {
            document.getElementById("refer1").style.display = "none";
            document.getElementById("refer2").style.display = "none";
            $(document).ready(function() {
                $("#refer1 :input").prop('disabled', true);
                $("#refer2 :input").prop('disabled', true);
            });
        }
    }
    
    function totalFee() {
        var f1 = parseInt(document.getElementById("tutionfee").value);
        var f2 = parseInt(document.getElementById("bookfee").value);
        var f3 = parseInt(document.getElementById("busfee").value);
        var f4 = parseInt(document.getElementById("hostelrent").value);
        var f5 = parseInt(document.getElementById("otherfee").value);
        document.getElementById("totalfee").value = f1 + f2 + f3 + f4 + f5;
    }
    
    function calcTotal() {
        if(document.getElementById("group").value == "ACADEMIC") {
            var m1 = parseInt(document.getElementById("m11").value);
            var m2 = parseInt(document.getElementById("m12").value);
            var m3 = parseInt(document.getElementById("m13").value);
            document.getElementById("cutof1").value = (m1 / 2) + (m2 / 4) + (m3 / 4);
            document.getElementById("outof1").value = m1 + m2 + m3;
        } else if(document.getElementById("group").value == "VOCATIONAL") {
            var m1 = parseInt(document.getElementById("m21").value);
            var m2 = parseInt(document.getElementById("m22").value);
            var m3 = parseInt(document.getElementById("m23").value);
            document.getElementById("cutof2").value = (m1 / 2) + (m2 / 4) + (m3 / 8);
            document.getElementById("outof2").value = m1 + m2 + m3;
        } else if(document.getElementById("group").value == "DIPLOMA") {
            var m1 = parseInt(document.getElementById("m31").value);
            var m2 = parseInt(document.getElementById("m32").value);
            var m3 = parseInt(document.getElementById("m33").value);
            var m4 = parseInt(document.getElementById("m34").value);
            var m5 = parseInt(document.getElementById("m35").value);
            var m6 = parseInt(document.getElementById("m36").value);
            document.getElementById("total3").value = m1 + m2 + m3 + m4 + m5 + m6;
            document.getElementById("percent3").value = (m1 + m2 + m3 + m4 + m5 + m6) / 6;
        } else if(document.getElementById("group").value == "DEGREE") {
            var m1 = parseInt(document.getElementById("m41").value);
            var m2 = parseInt(document.getElementById("m42").value);
            var m3 = parseInt(document.getElementById("m43").value);
            var m4 = parseInt(document.getElementById("m44").value);
            var m5 = parseInt(document.getElementById("m45").value);
            var m6 = parseInt(document.getElementById("m46").value);
            var m7 = parseInt(document.getElementById("m47").value);
            var m8 = parseInt(document.getElementById("m48").value);
            document.getElementById("total4").value = m1 + m2 + m3 + m4 + m5 + m6 + m7 + m8;
            document.getElementById("percent4").value = (m1 + m2 + m3 + m4 + m5 + m6 + m7 + m8) / 8;
        }
    }
    
    function acYear() {
        var year = document.getElementById("acyear").value
        if (year.length == 4) {
            var year = parseInt(year.substring(2,4));
            var acyear = "20" + year + "-" + (year+1);
            document.getElementById("acyear").value = acyear;
        }
    }

    var stateObject = {
        "India": {
            "Andhra Pradesh (AP)": ["Anantapur", "Chittoor", "East Godavari", "Guntur", "Krishna", "Kurnool", "Prakasam", "Srikakulam", "Sri Potti Sriramulu Nellore", "Visakhapatnam", "Vizianagaram", "West Godavari", "YSR District, Kadapa (Cuddapah)"],
            "Arunachal Pradesh (AR)" : ["Anjaw", "Changlang", "Dibang Valley", "East Kameng", "East Siang", "Kamle", "Kra Daadi", "Kurung Kumey", "Lepa Rada", "Lohit", "Longding", "Lower Dibang Valley", "Lower Siang", "Lower Subansiri", "Namsai", "Pakke Kessang", "Papum Pare", "Shi Yomi", "Siang", "Tawang", "Tirap", "Upper Siang", "Upper Subansiri", "West Kameng","West Siang"],
            "Assam (AS)": ["Baksa", "Barpeta", "Biswanath", "Bongaigaon", "Cachar", "Charaideo", "Chirang", "Darrang", "Dhemaji", "Dhubri", "Dibrugarh", "Dima Hasao (North Cachar Hills)", "Goalpara", "Golaghat", "Hailakandi", "Hojai", "Jorhat", "Kamrup", "Kamrup Metropolitan", "Karbi Anglong", "Karimganj", "Kokrajhar", "Lakhimpur", "Majuli", "Morigaon", "Nagaon", "Nalbari", "Sivasagar", "Sonitpur", "South Salamara-Mankachar", "Tinsukia", "Udalguri", "West Karbi Anglong"],
            "Bihar (BR)": ["Araria", "Arwal", "Aurangabad", "Banka", "Begusarai", "Bhagalpur", "Bhojpur", "Buxar", "Darbhanga", "East Champaran (Motihari)", "Gaya", "Gopalganj"],
            "Chhattisgarh (CG)": ["Balod", "Baloda Bazar", "Balrampur", "Bastar", "Bemetara", "Bijapur", "Bilaspur", "Dantewada (South Bastar)", "Dhamtari", "Durg", "Gariyaband"],
            "Delhi": ["New Delhi", "North West Delhi", "North Delhi", "West Delhi"],
            "Goa (GA)": ["North Goa", "South Goa"],
            "Gujarat (GJ)": ["Ahmedabad", "Amreli", "Anand", "Aravalli", "Banaskantha (Palanpur)", "Bharuch","Bhavnagar", "Botad", "Chhota Udepur", "Dahod", "Dangs (Ahwa)", "Devbhoomi Dwarka", "Gandhinagar", "Gir Somnath", "Jamnagar", "Junagadh", "Kachchh", "Kheda (Nadiad)", "Mahisagar", "Mehsana", "Morbi", "Narmada (Rajpipla)", "Navsari", "Panchmahal (Godhra)", "Patan", "Porbandar", "Rajkot", "Sabarkantha (Himmatnagar)", "Surat", "Surendranagar", "Tapi (Vyara)", "Vadodara", "Valsad"],
            "Haryana (HR)": ["Ambala", "Bhiwani", "Charkhi Dadri", "Faridabad", "Fatehabad", "Gurugram (Gurgaon)", "Hisar", "Jhajjar", "Jind", "Kaithal", "Karnal", "Kurukshetra", "Mahendragarh", "Nuh", "Palwal", "Panchkula", "Panipat", "Rewari", "Rohtak", "Sirsa", "Sonipat", "Yamunanagar"],
            "Himachal Pradesh (HP)": ["Bilaspur", "Chamba", "Hamirpur", "Kangra", "Kinnaur", "Kullu", "Lahaul & Spiti", "Mandi", "Shimla", "Sirmaur", "Solan", "Una"],
            "Jammu and Kashmir (JK)": ["Anantnag", "Bandipore", "Baramulla", "Jammu", "Kathua", "Kishtwar", "Kulgam", "Kupwara", "Samba", "Shopian", "Srinagar", "Udhampur"],
            "Jharkhand (JH)": ["Bokaro", "Chatra", "Deoghar", "Dhanbad", "Dumka", "East Singhbhum", "Garhwa", "Giridih", "Godda", "Gumla", "Hazaribag"],
            "Karnataka (KA)": ["Bagalkot", "Ballari (Bellary)", "Belagavi (Belgaum)", "Bengaluru (Bangalore) Rural", "Bengaluru (Bangalore) Urban", "Bidar", "Chamarajanagar", "Chikballapur", "Chikkamagaluru (Chikmagalur)"],
            "Kerala (KL)": ["Alappuzha", "Ernakulam", "Idukki", "Kannur", "Kasaragod", "Kollam", "Kottayam", "Kozhikode", "Malappuram", "Palakkad", "Pathanamthitta", "Thiruvananthapuram", "Thrissur", "Wayanad"],
            "Madhya Pradesh (MP)": ["Agar Malwa", "Alirajpur", "Anuppur", "Ashoknagar", "Balaghat", "Barwani", "Betul","Bhind", "Bhopal", "Burhanpur", "Chhatarpur", "Chhindwara", "Damoh", "Datia", "Dewas", "Dhar", "Dindori", "Guna", "Gwalior", "Harda", "Harda", "Indore"],
            "Maharashtra (MH)": ["Ahmednagar", "Akola", "Amravati", "Aurangabad", "Beed", "Bhandara", "Buldhana", "Chandrapur", "Dhule", "Gadchiroli", "Gondia", "Hingoli", "Jalgaon", "Jalna", "Kolhapur", "Latur","Mumbai City", "Mumbai Suburban", "Nagpur", "Nanded", "Nandurbar", "Nashik", "Osmanabad", "Palghar", "Parbhani", "Pune", "Raigad", "Ratnagiri", "Sangli", "Satara", "Sindhudurg", "Solapur", "Thane", "Wardha", "Washim", "Yavatmal"],
            "Manipur (MN)": ["Bishnupur", "Chandel", "Churachandpur", "Imphal East", "Imphal West"],
            "Meghalaya (ML)": ["East Garo Hills", "East Jaintia Hills", "East Khasi Hills", "North Garo Hills", "Ri Bhoi", "South Garo Hills", "South West Garo Hills", "South West Khasi Hills", "West Garo Hills", "West Jaintia Hills", "West Khasi Hills"],
            "Mizoram (MZ)": ["Aizawl", "Champhai", "Kolasib", "Lawngtlai", "Lunglei", "Mamit", "Saiha", "Serchhip"],
            "Odisha(OR)": ["Angul", "Balangir", "Balasore", "Bargarh", "Bhadrak", "Boudh", "Cuttack", "Deogarh", "Dhenkanal", "Gajapati", "Ganjam"],
            "Pondicherry (PY)": ["Karaikal", "Mahe", "Puducherry", "Yanam"],
            "Punjab (PB)": ["Amritsar", "Barnala", "Bathinda", "Faridkot", "Fatehgarh Sahib","Fazilka", "Ferozepur", "Gurdaspur", "Hoshiarpur"],
            "Rajasthan (RJ)": ["Sawai Madhopur", "Sikar", "Sirohi", "Sri Ganganagar", "Tonk", "Udaipur"],
            "Sikkim (SK)": ["East Sikkim", "North Sikkim", "South Sikkim", "West Sikkim"],
            "Tamil Nadu (TN)": ["Ariyalur", "Chengalpattu", "Chennai", "Coimbatore", "Cuddalore", "Dharmapuri", "Dindigul", "Erode", "Kallakurichi", "Kanchipuram", "Kanyakumari", "Karur", "Krishnagiri", "Madurai", "Nagapattinam", "Namakkal", "Nilgiris", "Perambalur", "Pudukkottai", "Ramanathapuram", "Ranipet", "Salem", "Sivaganga", "Tenkasi", "Thanjavur", "Theni", "Thoothukudi (Tuticorin)", "Tiruchirappalli", "Tirunelveli", "Tirupathur", "Tiruppur",  "Tiruvallur", "Tiruvarur", "Vellore", "Viluppuram", "Virudhunagar"],
            "Telangana (TS)": ["Sangareddy", "Siddipet", "Suryapet", "Vikarabad", "Wanaparthy", "Warangal (Rural)", "Warangal (Urban)", "Yadadri Bhuvanagiri"],
            "Tripura (TR)": ["Dhalai", "Gomati"],
            "Uttar Pradesh (UP)": ["Saharanpur", "Sambhal (Bhim Nagar)", "Sant Kabir Nagar", "Shahjahanpur", "Shamali (Prabuddh Nagar)", "Shravasti", "Siddharth Nagar", "Sitapur", "Sonbhadra", "Sultanpur", "Unnao", "Varanasi"],
            "Uttarakhand (UK)": ["Almora", "Bageshwar", "Chamoli", "Champawat", "Dehradun", "Haridwar"],
            "West Bengal (WB)": ["Alipurduar", "Bankura", "Birbhum", "Cooch Behar", "Dakshin Dinajpur (South Dinajpur)", "Darjeeling", "Hooghly", "Howrah"]
        }
    }
    
    window.onload = function () {
        clock();
        var countrySel = document.getElementById("countrySel"),
        stateSel = document.getElementById("stateSel"),
        districtSel = document.getElementById("districtSel");
        for (var country in stateObject) {
            countrySel.options[countrySel.options.length] = new Option(country, country);
        }
        countrySel.onchange = function () {
            stateSel.length = 1;
            districtSel.length = 1;
            if (this.selectedIndex < 1) return;
            for (var state in stateObject[this.value]) {
                stateSel.options[stateSel.options.length] = new Option(state, state);
            }
        }
        countrySel.onchange();
        stateSel.onchange = function () {
            districtSel.length = 1;
            if (this.selectedIndex < 1) return;
            var district = stateObject[countrySel.value][this.value];
            for (var i = 0; i < district.length; i++) {
                districtSel.options[districtSel.options.length] = new Option(district[i], district[i]);
            }
        }
    }
    </script>
</div>