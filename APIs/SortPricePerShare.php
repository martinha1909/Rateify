<?php
    session_start();
    if($_SESSION['sort_type'] == 3)
        $_SESSION['sort_type'] = 6;
    else
        $_SESSION['sort_type'] = 3;
    // echo $_SESSION['sort_type'];
    header("Location: ../frontend/DisplayUserInvestments.php");
?>