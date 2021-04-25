<?php
    session_start();
    include 'logic.php';
    include 'connection.php';
    $conn = connect();
    // $cad = $_SESSION['coins'] / (1+ $_SESSION['conversion_rate']);
    $_SESSION['notify'] = withdrawCoins($conn, $_SESSION['username'], $_SESSION['coins']);
    header("Location: ../frontend/SellCoinsView.php");
?>