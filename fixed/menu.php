<div style="height:22px"></div>
<div id="menu">
    <?php
        $year = date("Y") - 2000;
        if(date("m") > 5) $year += 1;
        $acyear = "20".($year-1)."-".$year;
    ?>
    <div class="acyear">
        <span>ACADEMIC YEAR: <?php echo $acyear?></span>
    </div>
    <?php if($_SESSION['category'] == "admin"):?>
        <a href="?users"><button<?php if(isset($_GET['users'])) echo " class='active'"?>>Users</button></a>
        <a href="?admissions"><button<?php if(isset($_GET['admissions'])) echo " class='active'"?>>Admissions</button></a>
        <a href="?staff"><button<?php if(isset($_GET['staff'])) echo " class='active'"?>>Staff</button></a>
    <?php elseif($_SESSION['category'] == "cashier"):?>
        <a href="?pay"><button<?php if(isset($_GET['pay'])) echo " class='active'"?>>Pay</button></a>
    <?php elseif($_SESSION['category'] == "staff"):?>
        <a href="?document"><button<?php if(isset($_GET['document'])) echo " class='active'"?>>Document</button></a>
    <?php elseif($_SESSION['category'] == "warden"):?>
        <a href="?entry"><button<?php if(isset($_GET['entry'])) echo " class='active'"?>>Entry</button></a>
    <?php endif;?>
    <a style="float:right" href="?logout"><button>Logout</button></a>
    <a style="float:right" href="?profile"><button<?php if(isset($_GET['profile'])) echo " class='active'"?>>Profile</button></a>
    <a style="float:right" href=""><button>Refresh</button></a>
</div>