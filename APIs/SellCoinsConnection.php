<?php
    session_start();
    $_SESSION['coins'] = $_POST['coins'];
    if(!empty($_SESSION['coins']) && is_numeric($_SESSION['coins']))
        {$_SESSION['cad'] = $_SESSION['coins'] * (1 - $_SESSION['conversion_rate']);}
    header("Location: ../frontend/listener.php");
?>