<?php
    session_start();
    $_SESSION['sort_type'] = 2;
    header("Location: ../frontend/DisplayUserInvestments.php");
?>