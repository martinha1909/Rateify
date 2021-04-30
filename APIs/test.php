<?php
    include 'connection.php';
    include 'logic.php';
    
    $conn = connect();
    increaseArtistPricePerShare($conn, 'Travis Scott');
    // increaseArtistRate($conn, 'Travis Scott');
        
        


    // echo json_encode($output, JSON_PRETTY_PRINT);
    closeCon($conn);
?>