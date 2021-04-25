<?php
    session_start();
    $cad = $_POST['cad'];
    $_SESSION['coins'] = $cad * (1 + $_SESSION['conversion_rate']);
    header("Location: ../frontend/BuyCoinsView.php");
?>