<?php
    session_start();
    if($_SESSION['sort_type'] == 2)
    {
        $_SESSION['sort_type'] = 5;
    }
    else
        $_SESSION['sort_type'] = 2;
    header("Location: ../frontend/DisplayUserInvestments.php");
?>