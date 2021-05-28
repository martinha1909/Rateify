<?php
    include 'connection.php';
    // include 'logic.php';
    

    $conn = connect();
    $album_name = "New Mania";
    $sql = "UPDATE song SET album_name = NULL WHERE album_name = '$album_name'";
    $conn->query($sql);
    // increaseArtistRate($conn, 'Travis Scott');
        
        


    // echo json_encode($output, JSON_PRETTY_PRINT);
    closeCon($conn);
?>