<?php
    session_start();
    $currency = $_POST['currency'];
    if(!empty($currency) && is_numeric($currency))
    {
        $_SESSION['coins'] = $currency * (1 + $_SESSION['conversion_rate']);
        if($_SESSION['currency'] == "USD")
            $_SESSION['coins'] = $_SESSION['coins'] * 0.83;
        else if($_SESSION['currency'] == "EURO")
            $_SESSION['coins'] = $_SESSION['coins'] * 0.68;
        
    }

    header("Location: ../frontend/listener.php");
?>