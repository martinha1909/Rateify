<?php
    include 'connection.php';
    include 'logic.php';
    
    $conn = connect();
    $result = searchArtist($conn, '88Glam');
    $no_of_plays = 0;
    if($result->num_rows > 0)
    {
      while($row = $result->fetch_assoc())
      {
        $song_id = $row['song_id'];
        $result2 = searchSong($conn, $song_id);
        while($row2 = $result2->fetch_assoc())
        {
          $no_of_plays += $row2['no_of_plays'];
        }
      }
    }
    echo $no_of_plays;

    // echo json_encode($output, JSON_PRETTY_PRINT);
    closeCon($conn);
?>