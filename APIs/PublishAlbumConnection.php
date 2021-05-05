<?php
    session_start();
    include 'connection.php';
    include 'logic.php';    

    $conn = connect();
    $album = key($_POST['album_name']);
    publishAlbum($conn, $album);

    header("Location: ../frontend/ArtistViewAlbums.php");
    closeCon($conn); 


?>