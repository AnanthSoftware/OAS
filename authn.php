<?php
if($_POST) {
    if(isset($_POST['username'], $_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        include "config/db.php";
        
        // Prepare our SQL, preparing the SQL statement will prevent SQL injection.
        if ($stmt = $con->prepare('SELECT name, category, password FROM authuser WHERE username = ?')) {
            // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
            $stmt->bind_param('s', $_POST['username']);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $stmt->bind_result($name, $category, $password);
                $stmt->fetch();
                if (password_verify($_POST['password'], $password)) {
                    session_start();
                    session_regenerate_id();
                    
                    $_SESSION['OASUSERID'] = md5($_POST['username']);
                    setcookie("OASUSERID", md5($_POST['username']), time() + 28800);
                    
                    $_SESSION['username'] = $_POST['username'];
                    
                    $_SESSION['name'] = $name;
                    $_SESSION['category'] = $category;
                    
                    $_SESSION['token'] = bin2hex(random_bytes(16));
                    
                    if($category == "admin") {
                        header("Location: admin");
                        exit;
                    } elseif($category == "cashier") {
                        header("Location: cashier");
                        exit;
                    } elseif($category == "staff") {
                        header("Location: staff");
                        exit;
                    } elseif($category == "warden") {
                        header("Location: warden");
                        exit;
                    } else {
                        session_unset();
                        session_destroy();
                        setcookie("OASUSERID", "", time() - 28800);
                        
                        header("Location: error?category");
                        exit;
                    }
                } else {
                    header("Location: error?password");
                    exit;
                }
            } else {
                header("Location: error?username");
                exit;
            }
            $stmt->close();
        }
    } else {
        header("Location: error");
        exit;
    }
} else {
    header("Location: error");
    exit;
}
?>