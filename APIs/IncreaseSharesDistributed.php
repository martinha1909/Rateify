<?php
    session_start();
    include 'logic.php';
    include 'connection.php';
    $conn = connect();
    increaseArtistDistributedShare($conn, $_SESSION['username']);
    header("Location: ../frontend/artist.php");

?>