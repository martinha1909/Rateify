<?php
    session_start();
    if($_SESSION['sort_type'] == 0)
    {
        $_SESSION['sort_type'] = 7;
    }
    else
        $_SESSION['sort_type'] = 0;
    // echo $_SESSION['sort_type'];
    header("Location: ../frontend/DisplayUserInvestments.php");
?>