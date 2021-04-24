<?php
    session_start();
    include 'connection.php';
    include 'logic.php';

    $conn = connect();
    $selling_share = $_POST['share'];
    $artist = $_POST['artist'];
    $result = searchArtistUserShares($conn, $_SESSION['username'], $artist);
    if($result->num_rows > 0)
    {
        $_SESSION['notify'] = sellShares($conn, $_SESSION['username'], $artist, $selling_share);
        header("Location: ../frontend/SellShares.php");
    }
    else
    {
        $_SESSION['notify'] = 2;
        header("Location: ../frontend/SellShares.php");
    }
    // echo $_SESSION['notify'];
    // $_SESSION['notify'] = sellShares($conn, $_SESSION['username'], $_SESSION[''])

?>