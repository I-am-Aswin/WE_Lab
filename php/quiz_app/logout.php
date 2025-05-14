<?php

    $_SESSION=[];
    session_unset();
    session_destroy();

    setcookie(session_name(), '', time() - 3600, '/', '', false, true);

    header("location: pages/login.php");
    die();
    
?>