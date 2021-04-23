<?php
    session_start();
    include 'logic.php';
    include 'connection.php';
    $conn = connect();
    $share = $_POST['share'];
    $result = searchArtistUserShares($conn, $_SESSION['username'], $_SESSION['artist']);
    $_SESSION['notify'] = 0;
    if($result->num_rows > 0)
    {
        $row = $result->fetch_assoc();
        $result2 = searchAccount($conn, $_SESSION['artist']);
        $row2 = $result2->fetch_assoc();
        $artist_total_shares = $row2['Shares'] + $share;
        $total_shares_bought = $share + $row['no_of_share_bought'];
        $_SESSION['notify'] = increaseSharesBought($conn, $_SESSION['username'], $_SESSION['artist'], $total_shares_bought);
        addSharesToArtist($conn, $_SESSION['artist'], $artist_total_shares);
    }
    else
    {
        $result2 = searchAccount($conn, $_SESSION['artist']);
        if($result2->num_rows > 0)
        {
            $row2 = $result2->fetch_assoc();
            $_SESSION['notify'] = addSharesBought($conn, $_SESSION['username'], $_SESSION['artist'], $share);
            $total_shares_bought = $share + $row2['Shares'];
            addSharesToArtist($conn, $_SESSION['artist'], $total_shares_bought);
        }
        else
            $_SESSION['notify'] = 2;
        
    }
    header("Location: ../frontend/RatingView.php");
?>

 