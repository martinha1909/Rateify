<?php
    session_start();
    include 'connection.php';
    include 'logic.php';    

    $conn = connect();
    $artist_name = $_POST['artist_name'];
    $_SESSION['searchedArtistName'] = $artist_name;
    $_SESSION['all_songs'] = array();
    $_SESSION['all_albums'] = array();
    $_SESSION['total_plays'] = 0;
    $_SESSION['notify'] = 0;

    if(!empty($artist_name) ){
        $result = searchArtistAlbum($conn, $artist_name);
        $result2 = searchArtist($conn, $artist_name);
        $result4 = searchArtistShares($conn, $artist_name);
        if($result2->num_rows > 0)
        {
            if($result4 -> num_rows > 0)
            {
                $share = $result4->fetch_assoc();
                $_SESSION['shares'] = $share['Shares'];
            }

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    array_push($_SESSION['all_albums'], $row);
                }
                // $_SESSION['song_results'] = $songs;
            }
            else
            {
                $_SESSION['song_results'] = NULL;
            }
            if($result2->num_rows > 0)
            {
                while($row2 = $result2->fetch_assoc())
                {
                    $s_id = $row2['song_id'];
                    $result3 = searchSong($conn, $s_id);
                    $row3 = $result3->fetch_assoc();
                    $_SESSION['total_plays'] += $row3['no_of_plays'];
                    array_push($_SESSION['all_songs'], $row2);
                }
            }
            header("Location: ../frontend/displaySearchSongs.php");
        }
        else
        {
            $_SESSION['notify'] = 2;
            header("Location: ../frontend/SearchSong.php");
        }
        // echo $_SESSION['total_plays'];
    }

 

    closeCon($conn); 


?>