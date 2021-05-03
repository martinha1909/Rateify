<?php
    session_start();
    
    if($_SESSION['sort_type'] == 1)
    {
        $_SESSION['sort_type'] = 4;
    }
    else
    {
        $_SESSION['sort_type'] = 1;
    }
    echo $_SESSION['sort_type'];
    header("Location: ../frontend/DisplayUserInvestments.php");
?>