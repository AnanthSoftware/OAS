<?php 
if(isset($_POST['add'])) {
    
}
?>

<div id="panel" class="card">
    <div class="tab">
        <button class="tablinks <?php if(!$_POST) echo "active"?>" onclick="action(event, 'staff')">Staff</button>
        <button class="tablinks" onclick="action(event, 'add')">Add</button>
        <button class="tablinks <?php if(isset($_POST['update1'])) echo "active"?>" onclick="action(event, 'update')">Update</button>
        <button class="tablinks <?php if(isset($_POST['delete1'])) echo "active"?>" onclick="action(event, 'delete')">Delete</button>
        <a href="admin" style="float:right"><button class="tablinks">✕</button></a>
    </div>

    <div id="staff" class="tabcontent scroll <?php if(!$_POST) echo "display"?>">
       
    </div>
    
    <div id="add" class="tabcontent scroll">
    <center><form action="admin?staff" method="post" enctype="multipart/form-data">
        <div class="table">
            <div class="col">
                <label for="staffid">Staff ID<span>*</span></label>
                <input type="text" class="upper" id="staffid" name="staffid" placeholder="DEPTXXX" maxlength="8" required>
                
                <label for="categorySel">Category<span>*</span></label>
                <select name="category" id="categorySel" size="1" required>
                    <option value selected>Select Category</option>
                </select>
                
                <label for="departmentSel">Department<span>*</span></label>
                <select name="department" id="departmentSel" size="1" required>
                    <option value selected>Select Category First</option>
                </select>
                
                
                <label for="designationSel">Designation<span>*</span></label>
                <select nmae="designation" id="designationSel" size="1" required>
                    <option value selected>Select Department First</option>
                </select>
            </div>
            <div class="col"> 
                <label for="file">Photo</label><br>
                <img id="photo" height="156" width="117">
                <input type="file" style="padding-top:7px" id="file" name="file" onchange="show(this)">
                
                <label for="qualification">Qualification<span>*</span></label>
                <input type="text" id="qualification" name="qualification" placeholder="Qualification" maxlength="20" required>
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
            </div>
            <div class="col">
                <label for="email">Email<span>*</span></label>
                <input type="text" id="email" name="email" placeholder="Email" maxlength="50" required>
            </div>
        </div>
        <hr>
        <div class="table">
            <div class="col">
                <label for="doj">Date of Joining</label>
                <input type="date" id="doj" name="doj" required>
                
                <label for="status">Martial Status<span>*</span></label>
                <select name="status" id="status" onchange="statusChange()" required>
                    <option disabled selected>Select Martial Status</option>
                    <option value="MARRIED">MARRIED</option>
                    <option value="SINGLE">SINGLE</option>
                </select>
                
                <div id="status1" style="display:none">
                <label for="spouse" style="margin-top:6px">Spouse Name and Occupation<span>*</span></label>
                <textarea style="height:120px;margin-bottom:6px" row="4" id="spouse" name="spouse" placeholder="Spouse Name and Occupation" maxlength="256" required></textarea>
                </div>
            </div>
            <div class="col">
                <label for="exp">Previous Experience<span>*</span></label>
                <textarea style="height:120px;margin-bottom:6px" row="4" id="exp" name="exp" placeholder="Previous Experience" maxlength="256" required></textarea>
                
                <div id="status2" style="display:none">
                <label for="child" style="margin-top:6px">No of Children and their Status<span>*</span></label>
                <textarea style="height:120px;margin-bottom:6px" row="4" id="child" name="child" placeholder="No of Children and their Status" maxlength="256" required></textarea>
                </div>
            </div>
        </div>
        <hr>
        <div class="table">
            <div class="col">
                <label for="basic">Salary Basic<span>*</span></label>
                <input type="number" min="0" max="200000" id="basic" name="basic" placeholder="Salary Basic" required>
                
                <label for="da">DA<span>*</span></label>
                <input type="number" min="0" max="100000" value=0 id="da" name="da" onchange="totalSalary()" onkeyup="totalSalary()" required>
                
                <label for="gross">Gross Salary<span>*</span></label>
                <input type="text" id="gross" name="gross" placeholder="Gross Salary" required readonly>
                
                <label for="pf">PF<span>*</span></label>
                <input type="number" min="0" max="100000" id="pf" name="pf" placeholder="PF" required>
            </div>
            <div class="col">
                <label for="managed">Managed Basic<span>*</span></label>
                <input type="number" min="0" max="200000" value=0 id="managed" name="managed" onchange="totalSalary()" onkeyup="totalSalary()" required>
                
                <label for="hra">HRA<span>*</span></label>
                <input type="number" min="0" max="100000" value=0 id="hra" name="hra" onchange="totalSalary()" onkeyup="totalSalary()" required>
                
                <label for="ma" style="margin-top:82px">MA<span>*</span></label><br>
                <input type="number" min="0" max="1000" id="ma" name="ma" placeholder="MA" required>
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
    
    function statusChange() {
        var x = document.getElementById("status").value;
        if(x == "MARRIED") {
            document.getElementById("status1").style.display = "block";
            document.getElementById("status2").style.display = "block";
            $(document).ready(function() {
                $("#status1 :input").prop('disabled', false);
                $("#status2 :input").prop('disabled', false);
            });
        } else {
            document.getElementById("status1").style.display = "none";
            document.getElementById("status2").style.display = "none";
            $(document).ready(function() {
                $("#status1 :input").prop('disabled', true);
                $("#status2 :input").prop('disabled', true);
            });
        }
    }
    
    function totalSalary() {
        var s1 = parseInt(document.getElementById("managed").value);
        var s2 = parseInt(document.getElementById("da").value);
        var s3 = parseInt(document.getElementById("hra").value);
        document.getElementById("gross").value = s1 + s2 + s3;
    }
    
    var departmentObject = {
        "Teaching": {
            "CIVIL": ["Assistant Professor", "Associate Professor", "Professor"],
            "CSE": ["Assistant Professor", "Associate Professor", "Professor"],
            "ECE": ["Assistant Professor", "Associate Professor", "Professor"],
            "EEE": ["Assistant Professor", "Associate Professor", "Professor"],
            "IT": ["Assistant Professor", "Associate Professor", "Professor"],
            "MECH": ["Assistant Professor", "Associate Professor", "Professor"],
            "MBA": ["Assistant Professor", "Associate Professor", "Professor"],
            "MCA": ["Assistant Professor", "Associate Professor", "Professor"]
        }, "Non-Teaching": {
            "Administrative": ["Principal"],
            "Ministerial Staff": ["Staff", "Accountant"],
            "Physical Education": ["Staff"],
            "Library": ["Staff"],
            "Laboratory": ["Junior Assistant", "Assistant", "Technician"],
            "Other": ["Electrician"]
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
        var categorySel = document.getElementById("categorySel"),
        departmentSel = document.getElementById("departmentSel"),
        designationSel = document.getElementById("designationSel");
        for (var category in departmentObject) {
            categorySel.options[categorySel.options.length] = new Option(category, category);
        }
        categorySel.onchange = function () {
            departmentSel.length = 1;
            designationSel.length = 1;
            if (this.selectedIndex < 1) return;
            for (var department in departmentObject[this.value]) {
                departmentSel.options[departmentSel.options.length] = new Option(department, department);
            }
        }
        categorySel.onchange();
        departmentSel.onchange = function () {
            designationSel.length = 1;
            if (this.selectedIndex < 1) return;
            var designation = departmentObject[categorySel.value][this.value];
            for (var i = 0; i < designation.length; i++) {
                designationSel.options[designationSel.options.length] = new Option(designation[i], designation[i]);
            }
        }
        
        
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