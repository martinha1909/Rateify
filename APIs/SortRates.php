<?php
    session_start();
    $_SESSION['sort_type'] = 0;
    echo $_SESSION['sort_type'];
    header("Location: ../frontend/DisplayUserInvestments.php");
?>