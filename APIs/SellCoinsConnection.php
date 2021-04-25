<?php
    session_start();
    $_SESSION['coins'] = $_POST['coins'];
    $_SESSION['cad'] = $_SESSION['coins'] * (1 - $_SESSION['conversion_rate']);
    header("Location: ../frontend/SellCoinsView.php");
?>