<?php
    session_start();
    $type = $_POST['display_type'];
    echo $type;
    if($type == "Top Invested Artists")
        $_SESSION['display'] = 1;
    else if($type == "My Portfolio")
        $_SESSION['display'] = 2;
    else if($type == "Buy Siliqas")
        $_SESSION['display'] = 3;
    else if($type == "Sell Siliqas")
        $_SESSION['display'] = 4;
    // echo $_SESSION['display'];
    header("Location: ../frontend/listener.php");
    
?>