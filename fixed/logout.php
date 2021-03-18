<?php
    setcookie("OASUSERID", "", time() - 28800);
    session_unset();
    session_destroy();
    header("Location: /oas");
    exit;
?>