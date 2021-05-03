<?php
    session_start();
    $_SESSION['sort_type'] = 3;
    echo $_SESSION['sort_type'];
    header("Location: ../frontend/DisplayUserInvestments.php");
?>