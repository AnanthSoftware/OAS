<?php
    include_once("fixed/header.php");
    
    if($_GET) {
        echo "<div id='message'>";
        if(isset($_GET["username"]))
            echo "<h3>Login Failed</h3><h6>Invalid Username</h6><p>Try again!</p>";
        elseif(isset($_GET["password"]))
            echo "<h3>Login Failed</h3><h6>Wrong Password</h6><p>Try again!</p>";
        elseif(isset($_GET["category"]))
            echo "<h3>Login Failed</h3><h6>Invalid Category</h6><p>Try again!</p>";
        elseif(isset($_GET["cookie"]))
            echo "<h3>Access Denied</h3><h6>Cookie Expired</h6><p>Timeout.</p>";
        elseif(isset($_GET["session"]))
            echo "<h3>Access Denied</h3><h6>Session Expired</h6><p>Your session has expired due to inactivity.</p>";
        elseif(isset($_GET["illegal"]))
            echo "<h3>Access Denied</h3><h6>Illegal Entry</h6><p>Something went wrong.</p>";
        elseif(isset($_GET["token"]))
            echo "<h3>Access Denied</h3><h6>Token Error</h6><p>Token Mismatch.</p>";
        else
            echo "<h3>Access Denied</h3><h6>Something went wrong</h6><p>Unexpected error has occurred.</p>";
        echo "<form action='/oas' method='post'><center><input style='width:50%' type='submit' value='Exit'></center></form></div>";
    } else {
        echo "<div id='message'>
                <h3>Access Denied</h3><h6>Illegal entry</h6><p>Please login correct manner.</p>
              <form action='/oas' method='post'><center><input style='width:50%' type='submit' value='Exit'></center></form></div>";
    }
    
    include_once("fixed/footer.php");
?>