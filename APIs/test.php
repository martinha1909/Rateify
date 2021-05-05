<?php
    include 'connection.php';
    include 'logic.php';
    
    $conn = connect();
    $result = searchArtistAlbum($conn, "88Glam");
    $latest_albums = array();
    if($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc())
        {
            $result2 = searchAlbum($conn, $row['album_name']);
            $album_info = $result2->fetch_assoc();
            if($album_info['Published'] == 1)
                array_push($latest_albums, $album_info);
        }
    }
    for($i=0; $i < sizeof($latest_albums); $i++)
    {
        echo "name: " . $latest_albums[$i]["name"]. "<br>";
    }
    // increaseArtistRate($conn, 'Travis Scott');
        
        


    // echo json_encode($output, JSON_PRETTY_PRINT);
    closeCon($conn);
?>