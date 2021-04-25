<?php
    session_start();
    include 'connection.php';
    include 'logic.php';

    $conn = connect();
    $selling_share = $_POST['share'];
    $profit = ($_SESSION['per_share_price'] + $_SESSION['profit']) * $selling_share;
    $artist = $_SESSION['artist'];
    $result = searchArtistUserShares($conn, $_SESSION['username'], $artist);
    if($result->num_rows > 0)
    {
        $_SESSION['notify'] = sellShares($conn, $_SESSION['username'], $artist, $selling_share, $profit);
        header("Location: ../frontend/SellShares.php");
    }
    else
    {
        $_SESSION['notify'] = 2;
        header("Location: ../frontend/SellShares.php");
    }
    // $_SESSION['notify'] = sellShares($conn, $_SESSION['username'], $_SESSION[''])

?>