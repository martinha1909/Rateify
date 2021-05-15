<?php
  session_start();
  $_SESSION['conversion_rate'];
  $_SESSION['coins'] = 0;
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Rateify - Search Songs</title>
    <meta name="description"
          content="Rateify is a music service that allows users to rate songs"/>

    <!--Inter UI font-->
    <link href="https://rsms.me/inter/inter-ui.css" rel="stylesheet">

    <!--vendors styles-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">

    <!-- Bootstrap CSS / Color Scheme -->
    <link rel="stylesheet" href="css/default.css" id="theme-color">
</head>
<body>

<!--navigation-->
<section class="smart-scroll">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-md navbar-dark">
            <a class="navbar-brand heading-black" href="index.php">
                Rateify
            </a>
            <p style = "position: absolute;right:0px; top:0px;" class="navbar-light bg-dark">Account Balance</p>
            <p style = "position: absolute;right:20px; top:26px;">
                <?php
                    include '../APIs/logic.php';
                    include '../APIs/connection.php';
                    $conn = connect();
                    $result = getUserBalance($conn, $_SESSION['username']);
                    $balance = $result->fetch_assoc();
                    echo "Coins: ";
                    echo $balance['balance'];
                ?>
            </p>
            <p style = "position: absolute;right:165px; top:0px;" class="navbar-light bg-dark">Current Rate</p>
            <p style = "position: absolute;right:190px; top:26px;">
                <?php
                    if($_SESSION['conversion_rate'] > 0)
                        echo "+";
                    echo $_SESSION['conversion_rate'];
                        echo "%";
                ?>
            </p>
            <button class="navbar-toggler navbar-toggler-right border-0" type="button" data-toggle="collapse"
                    data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span data-feather="grid"></span>
            </button>
            
        </nav>
    </div>
</section>

<!-- listener functionality -->
<section class="py-7 py-md-0 bg-hero" id="login">
    <div class="container">
        <div class="row vh-md-100">
            <div class="col-12 mx-auto my-auto text-center">
            <div  class="col text-left">
                <a href="listener.php"> <-Your page</a>
              </div>
              
            <div style = "position: absolute; left:50px; top: -200px;" class="col text-center">
                    <h1>Your shares with <?php echo $_SESSION['artist'];?> </h1>
                    
                </div>
                <div  style = "position: absolute;left:30px; top:-100px;" class="col text-center">
                <p> Don't know who to invest? </p>
                <a href="TopInvestedArtists.php"> View top invested artist here</a>
              </div>

              <table class="table" style = "position:absolute; top: 50px;">
                    <thead>
                    <tr>
                    <th scope="col">No. shares you own</th>
                        <th scope="col">Artist</th>
                        <th scope="col">Current price per share</th>
                        <th scope="col">Selling profit per share</th>
                        <th scope="col">Shares Available</th>
                    </tr>
                    </thead>
                    <tbody>
              <!-- view song form -->
              <?php
                    $result = searchArtistUserShares($conn, $_SESSION['username'], $_SESSION['artist']);
                    $shares_bought = 0;
                    if($result->num_rows > 0)
                    {
                        $_SESSION['current_no_of_shares'] = $result->fetch_assoc();
                        $shares_bought = $_SESSION['current_no_of_shares']['no_of_share_bought'];
                    }
                    else
                        $shares_bought = 0;
                    $result2 = getArtistShares($conn, $_SESSION['artist']);
                    $result3 = searchArtistShares($conn, $_SESSION['artist']);
                    $total_shares_bought = $result3->fetch_assoc();
                    $share_distributed = $result2->fetch_assoc();
                    $_SESSION['shares_available'] = $share_distributed['Share_Distributed'] - $total_shares_bought['Shares'];
                    $_SESSION['profit'] = $_SESSION['per_share_price'] * $_SESSION['rate'];
                    $_SESSION['profit'] = $_SESSION['profit'] + $_SESSION['per_share_price'];
                    $rate = $_SESSION['rate'] * 100;
                    echo '<tr><th scope="row">'.$shares_bought.'</th><td>'.$_SESSION['artist'].'</td><td>Coins: '.$_SESSION['per_share_price'].'</td><td>Coins: '.$_SESSION['profit'].' ('.$rate.'%)</td><td>'.$_SESSION['shares_available'].'</td></tr>';
                  ?>
              </tbody>
            </table>
            <div style = "position: absolute; top: 170px; left: 500px;">
                <?php
                $result = searchArtistShares($conn, $_SESSION['artist']);
                $result2 = getArtistShares($conn, $_SESSION['artist']);
                $share_distributed = $result2->fetch_assoc();
                $no_shares_left = $result->fetch_assoc();
                if($no_shares_left['Shares'] != $share_distributed['Share_Distributed'])
                {
                    echo '<div><a href="RatingView.php"> +Buy more shares</a></div>';
                    echo "<br>";
                }
                if($shares_bought > 0)
                {
                    echo '<div><a href="SellShares.php"> -Sell your shares</a></div>';
                    echo "<br>";
                }
                
                ?>
                <a class= "nav-link page-scroll" href="#New_releases" class="btn btn-primary d-inline-flex flex-row align-items-center" role="button" aria-pressed="true">
                        <!--It loss the green background, but it scrolls to the bottom of the page now (or we can make it go to the signup page automatically)-->
                        ↓ New Releases
                    </a>
            </div>
            </div>
        </div>
    </div>
</section>
<section class="py-5 top-right bottom-left" id="New_releases">
<a class= "nav-link page-scroll" href="#singles" class="btn btn-primary d-inline-flex flex-row align-items-center" role="button" aria-pressed="true" style = "position:absolute; right: 250px; top: 725px;">
    Singles
</a>
<a class= "nav-link page-scroll" href="#albums" class="btn btn-primary d-inline-flex flex-row align-items-center" role="button" aria-pressed="true" style = "position:absolute; right: 150px; top: 725px;">
    Albums
</a>
<a class= "nav-link page-scroll" href="#posts" class="btn btn-primary d-inline-flex flex-row align-items-center" role="button" aria-pressed="true" style = "position:absolute; right: 50px; top: 725px;">
    Posts
</a>
    <div>
            <h2><?php echo $_SESSION['artist'];?> New Releases</h2>
            <h3 id="singles">Latest Singles</h3>
            <table class="table">
                    <?php
                        $result = searchArtistSingles($conn, $_SESSION['artist']);
                        if(sizeof($result) > 0)
                        {
                            echo '
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Plays</th>
                                <th scope="col">Duration</th>
                                <th scope="col">Date</th>
                            </tr>
                            </thead>
                            <tbody>';
                            $id = 1;
                            for($i=0; $i<sizeof($result); $i++)
                            {
                                echo '<tr><th scope="row">'.$id.'</th>
                                    <td>'.$result[$i]['name'].'</td>
                                    <td>'.$result[$i]['no_of_plays'].'</td>
                                    <td>'.$result[$i]['duration'].'</td>
                                    <td>'.$result[$i]['date_created'].'</td></tr>';
                                $id++;
                            }
                            echo '</tbody>';
                        }
                        else
                            echo '<h6>No new releases</h6>';
                    ?>
            </table>

            <h4 id="albums">Latest Albums</h4>
            <table class="table">
            <?php
                $result = searchArtistAlbum($conn, $_SESSION['artist']);
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
                if(sizeof($latest_albums) > 0)
                {
                    echo '
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Songs</th>
                            <th scope="col">Duration</th>
                            <th scope="col">Date</th>
                        </tr>
                        </thead>
                        <tbody>';
                    $id = 1;
                    for($i=0; $i < sizeof($latest_albums); $i++)
                    {
                        $songs_in_album = array();
                        $result2 = searchSongsInAlbum($conn, $latest_albums[$i]['name']);
                        while($row2 = $result2->fetch_assoc())
                        {
                            $result3 = searchSong($conn, $row2['song_id']);
                            while($song_name = $result3 -> fetch_assoc())
                            {
                                if($song_name['Published'] == 1)
                                    array_push($songs_in_album, $song_name['name']);
                            }
                        }   
                        if(sizeof($songs_in_album) > 0)
                        {
                            echo '<tr><th scope="row">'.$id.'</th>
                                <td>'.$latest_albums[$i]['name'].'</td>
                                <td><ul class="list-group">';
                            for($j=0; $j < sizeof($songs_in_album); $j++)
                                echo '<li class="list-group-item list-group-item-dark">'.$songs_in_album[$j].'</li>';
                            echo '</ul></td>
                                <td>'.$latest_albums[$i]['duration'].'</td>
                                <td>'.$latest_albums[$i]['date_created'].'</td></tr>';
                            $id++;
                        }
                        else
                        {
                            echo '<tr><th scope="row">'.$id.'</th>
                                    <td>'.$latest_albums[$i]['name'].'</td>
                                    <td></td>
                                    <td>'.$latest_albums[$i]['duration'].'</td>
                                    <td>'.$latest_albums[$i]['date_created'].'</td></tr>';
                                $id++;
                        }
                    }
                }
                else
                    echo '<h6>No new releases</h6>';
            ?>
            </table>

            <h4 id="posts">Latest Posts</h4>
            <table class="table">
                <?php
                    echo '<h6>No new releases</h6>';
                ?>
            </table>
    </div>
</section>

<!--scroll to top-->
<div class="scroll-top">
    <i class="fa fa-angle-up" aria-hidden="true"></i>
</div>


<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.7.3/feather.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>