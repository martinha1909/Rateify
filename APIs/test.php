<?php
    include 'connection.php';
    include 'logic.php';
    
    $conn = connect();
    $all_shares = array();
    $result = searchAccountType($conn, 'artist');
    if($result->num_rows == 0)
    {
        echo '<h3> There are no artists to display </h3>';
    }
    else
    {
        while($row = $result->fetch_assoc())
        {
            array_push($all_shares, $row['Shares']);
        }
        $id = 1;
        rsort($all_shares);
        foreach($all_shares as $share)
        {
          $result2 = searchArtistByShare($conn, $share, 'artist');
          
          while($row = $result2->fetch_assoc())
          {
            if($id == 6)
              break;
            $result3 = searchArtistPricePerShare($conn, $row['username']);
            $row2 = $result3->fetch_assoc();
            echo "id: " . $id. " - Artist Name: " . $row["username"]. " - Shares " . $row["Shares"]. " - Price per share " .$row2['price_per_share']. "<br>";
            $id++;
          }
        }
        
        
    }

    // echo json_encode($output, JSON_PRETTY_PRINT);
    closeCon($conn);
?>