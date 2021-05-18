<?php
  session_start();
  $_SESSION['conversion_rate'] = -0.05;
  $_SESSION['coins'] = 0;
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>HASSNER - INVESTOR</title>
    <meta name="description"
          content="Rateify is a music service that allows users to rate songs"/>

    <!--Inter UI font-->
    <link href="https://rsms.me/inter/inter-ui.css" rel="stylesheet">

    <!-- Bootstrap CSS / Color Scheme -->
    <link rel="stylesheet" href="css/default.css" id="theme-color">
</head>
<body>

<!--navigation-->

<header class="smart-scroll">
    <div class="container-xxl">
        <nav class="navbar navbar-expand-md navbar-dark bg-secondary d-flex justify-content-between">
            <a style = "color: orange;" class="navbar-brand heading-black" href="#" onclick='window.location.reload();'>
                HASSNER
            </a>
            <form class="form-inline" action="../APIs/SearchSongsConnection.php" method="post">
                      <input class="form-control mr-sm-2" name = "artist_name" type="search" id="SongName" aria-describedby="SearchSongHelp" placeholder="Enter Artist Name">
                </form>

                <?php
                    include '../APIs/logic.php';
                    include '../APIs/connection.php';
                    $conn = connect();
                    $result = getUserBalance($conn, $_SESSION['username']);
                    $balance = $result->fetch_assoc();
                ?>
            <button class="navbar-toggler navbar-toggler-right border-0" type="button" data-toggle="collapse"
                    data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span data-feather="grid"></span>
            </button>
            
        </nav>
    </div>
</header>


<!-- listener functionality -->
<section class="py-7 py-md-0 bg-orange" id="login">
    <div class="container">
        <div class="row vh-md-100">

              <div class="col-md-12">
              <h1> Hello <?php echo $_SESSION['username'] ?>!</h1>
              </div>

              <!-- header -->
            <div class="col-md-12">
              <div class="btn-group">
                <button class="btn btn-primary btn-lg dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $_SESSION['username'] ?>
                </button>
                <div class="dropdown-menu">
                    <p class="dropdown-item">Coins: <?php echo $balance['balance'];?></p>
                    <a class="dropdown-item" href="BuyCoinsView.php">Buy Coins</a>
                    <a class="dropdown-item" href="SellCoinsView.php">Sell Coins</a>
                    <a class="dropdown-item" href="#">Account</a>
                    <a class="dropdown-item" href="#">Settings</a>
                    <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="login.php">Log out</a>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                 <div class="col-md-12">    
                    <form action = "../APIs/DisplaySwitch.php" method = "post">
                        <input name = "display_type" type = "submit" class = "btn btn-secondary" role="button" aria-pressed="true" value = "Top Invested Artists" onclick='window.location.reload();'></td>
                    </form>
                </div>
              </div>
            </div>
            <div class="col-md-12">
                    <form action = "../APIs/DisplaySwitch.php" method = "post">
                        <input name = "display_type" type = "submit" class = "btn btn-secondary" role="button" aria-pressed="true" value = "My Portfolio" onclick='window.location.reload();'></td>
                    </form>

              </div>
            <?php
             if($_SESSION['display'] == 1)
             echo '<table class="table">
              <div  style = "top: 15px;" class="col text-center">
                <h6>*Click on Artist Name To Invest*</h6>
                </div>
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Artist Name</th>
                        <th scope="col">Total shares bought</th>
                        <th scope="col">Price per share (Coins)</th>
                        <th scope="col">Rate</th>
                    </tr>
                    </thead>
                    <tbody>';
                    if($_SESSION['display'] == 1)
                    {
                        echo '<form action="../APIs/SongDisplayUser.php" method="post">';
                        // include '../APIs/logic.php';
                        // include '../APIs/connection.php';
                        $conn = connect();
                        $all_shares = array();
                        $users = array();
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
                                array_push($users, $row['username']);
                            }
                            
                            $i;
                            $key;
                            $key2;
                            $j;
                            for($i=1; $i<sizeof($all_shares); $i++)
                            {
                                $key = $all_shares[$i];
                                $key2 = $users[$i];
                                $j = $i-1;
                                while($j >= 0 && $all_shares[$j] < $key)
                                {
                                    $all_shares[($j+1)] = $all_shares[$j];
                                    $users[($j+1)] = $users[$j];
                                    $j = $j-1;
                                }
                                $all_shares[($j+1)] = $key;
                                $users[($j+1)] = $key2;
                            }
                            $id = 1;
                            for($i=0; $i<sizeof($all_shares); $i++)
                            {
                                if($id == 6)
                                    break;
                                $result3 = searchArtistPricePerShare($conn, $users[$i]);
                                $result4 = searchArtistRate($conn, $users[$i]);
                                $rate = $result4->fetch_assoc();
                                $rate['rate'] = $rate['rate'] * 100;
                                $row2 = $result3->fetch_assoc();
                                // echo '<tr><th scope="row">'.$id.'</th>
                                //             <td><input name = "artist_name['.$users[$i].']" type = "submit" style="border:1px solid black; background-color: transparent; color: white; role="button" aria-pressed="true" value = "'.$users[$i].'"></td></td>
                                //             <td>'.$all_shares[$i].'</td>
                                //             <td>'.$row2['price_per_share'].'</td>
                                //             <td>'.$rate['rate'].'%</td></tr>';
                                echo '<tr><th scope="row">'.$id.'</th>
                                            <td><input name = "artist_name['.$users[$i].']" type = "submit" style="border:1px transparent; background-color: transparent; color: white; role="button" aria-pressed="true" value = "'.$users[$i].'"></td></td>
                                            <td>'.$all_shares[$i].'</td>
                                            <td>'.$row2['price_per_share'].'</td>';
                                if($rate['rate'] > 0)
                                    echo '<td>+'.$rate['rate'].'%</td></tr>';
                                else
                                    echo '<td>'.$rate['rate'].'%</td></tr>';
                                            
                                $id++;
                            }
                            
                        }
                        echo '</form>';
                    }
                    else
                    {
                        echo '<table class="table">
                        <thead>
                        <tr>
                        <th scope="col">#</th>
                        <form action="../APIs/SortArtists.php">
                            <th scope="col"><input type = "submit" style="border:1px transparent; background-color: transparent; color: white;" role="button" aria-pressed="true" value = "Artist" onclick="window.location.reload();">';
                        if($_SESSION['sort_type'] == 1)
                            echo "↑";
                        else if($_SESSION['sort_type'] == 4)
                            echo "↓";
                        else
                            echo "";
                        echo '</th>
                            </form>
                            <form action="../APIs/SortShares.php">
                                <th scope="col"><input type = "submit" style="border:1px transparent; background-color: transparent; color: white;" role="button" aria-pressed="true" value = "Shares bought" onclick="window.location.reload();">';
                        if($_SESSION['sort_type'] == 2)
                            echo "↑";
                        else if($_SESSION['sort_type'] == 5)
                            echo "↓";
                        else
                            echo "";
                        echo '</th>
                            </form>
                            <form action = "../APIs/SortPricePerShare.php">
                                <th scope="col"><input type = "submit" style="border:1px transparent; background-color: transparent; color: white;" role="button" aria-pressed="true" value = "Price per share (Coins)" onclick="window.location.reload();">';
                        if($_SESSION['sort_type'] == 3)
                            echo "↑";
                        else if($_SESSION['sort_type'] == 6)
                            echo "↓";
                        else
                            echo "";

                        echo '</th>
                            </form>
                            <form action = "../APIs/SortRates.php">
                                <th scope="col"><input type = "submit" style="border:1px transparent; background-color: transparent; color: white;" role="button" aria-pressed="true" value = "Rate" onclick="window.location.reload();">';
                        if($_SESSION['sort_type'] == 0)
                            echo "↑";
                        else if($_SESSION['sort_type'] == 7)
                            echo "↓";
                        else
                            echo "";
                        echo '</th>
                            </form>
                            </tr>
                            </thead>
                            <tbody>';
                        $conn = connect();
                        $result = searchUsersInvestment($conn, $_SESSION['username']);
                        $all_profits = 0;
                        $all_rates = array();
                        $all_price_per_share = array();
                        $all_shares_bought = array();
                        $all_artists = array();
                        if($result->num_rows == 0)
                        {
                            echo '<h3> No results </h3>';
                        }
                        else
                        {
                            while($row = $result->fetch_assoc())
                            {
                                $artist_name = $row['artist_username'];
                                array_push($all_shares_bought, $row['no_of_share_bought']);
                                array_push($all_artists, $artist_name);
                                $result2 = searchArtistPricePerShare($conn, $artist_name);
                                $result3 = searchArtistRate($conn, $artist_name);
                                $rate = $result3->fetch_assoc();
                                $rate['rate'] = $rate['rate'] * 100;
                                $all_profits += $rate['rate'];
                                array_push($all_rates, $rate['rate']);
                                $row2 = $result2->fetch_assoc();
                                array_push($all_price_per_share, $row2['price_per_share']);
                            }
                            if($_SESSION['sort_type']!=0)
                            {
                                if($_SESSION['sort_type'] == 1)
                                {
                                    $i;
                                    $key;
                                    $key2;
                                    $j;
                                    for($i=1; $i<sizeof($all_artists); $i++)
                                    {
                                        $key = $all_artists[$i];
                                        $key2 = $all_shares_bought[$i];
                                        $key3 = $all_rates[$i];
                                        $key4 = $all_price_per_share[$i];
                                        $j = $i-1;
                                        while($j >= 0 && $all_artists[$j] < $key)
                                        {
                                            $all_artists[($j+1)] = $all_artists[$j];
                                            $all_shares_bought[($j+1)] = $all_shares_bought[$j];
                                            $all_rates[($j+1)] = $all_rates[$j];
                                            $all_price_per_share[($j+1)] = $all_price_per_share[$j];
                                            $j = $j-1;
                                        }
                                        $all_artists[($j+1)] = $key;
                                        $all_shares_bought[($j+1)] = $key2;
                                        $all_rates[($j+1)] = $key3;
                                        $all_price_per_share[($j+1)] = $key4;
                                    }
                                }
                                else if($_SESSION['sort_type'] == 2)
                                {
                                    $i;
                                    $key;
                                    $key2;
                                    $j;
                                    for($i=1; $i<sizeof($all_shares_bought); $i++)
                                    {
                                        $key = $all_shares_bought[$i];
                                        $key2 = $all_artists[$i];
                                        $key3 = $all_rates[$i];
                                        $key4 = $all_price_per_share[$i];
                                        $j = $i-1;
                                        while($j >= 0 && $all_shares_bought[$j] < $key)
                                        {
                                            $all_shares_bought[($j+1)] = $all_shares_bought[$j];
                                            $all_artists[($j+1)] = $all_artists[$j];
                                            $all_rates[($j+1)] = $all_rates[$j];
                                            $all_price_per_share[($j+1)] = $all_price_per_share[$j];
                                            $j = $j-1;
                                        }
                                        $all_shares_bought[($j+1)] = $key;
                                        $all_artists[($j+1)] = $key2;
                                        $all_rates[($j+1)] = $key3;
                                        $all_price_per_share[($j+1)] = $key4;
                                    }
                                }
                                else if($_SESSION['sort_type'] == 3)
                                {
                                    $i;
                                    $key;
                                    $key2;
                                    $j;
                                    for($i=1; $i<sizeof($all_price_per_share); $i++)
                                    {
                                        $key = $all_price_per_share[$i];
                                        $key2 = $all_artists[$i];
                                        $key3 = $all_rates[$i];
                                        $key4 = $all_shares_bought[$i];
                                        $j = $i-1;
                                        while($j >= 0 && $all_price_per_share[$j] < $key)
                                        {
                                            $all_price_per_share[($j+1)] = $all_price_per_share[$j];
                                            $all_artists[($j+1)] = $all_artists[$j];
                                            $all_rates[($j+1)] = $all_rates[$j];
                                            $all_shares_bought[($j+1)] = $all_shares_bought[$j];
                                            $j = $j-1;
                                        }
                                        $all_price_per_share[($j+1)] = $key;
                                        $all_artists[($j+1)] = $key2;
                                        $all_rates[($j+1)] = $key3;
                                        $all_shares_bought[($j+1)] = $key4;
                                    }
                                }
                                else if($_SESSION['sort_type'] == 4)
                                {
                                    $i;
                                    $key;
                                    $key2;
                                    $j;
                                    for($i=1; $i<sizeof($all_artists); $i++)
                                    {
                                        $key = $all_artists[$i];
                                        $key2 = $all_shares_bought[$i];
                                        $key3 = $all_rates[$i];
                                        $key4 = $all_price_per_share[$i];
                                        $j = $i-1;
                                        while($j >= 0 && $all_artists[$j] > $key)
                                        {
                                            $all_artists[($j+1)] = $all_artists[$j];
                                            $all_shares_bought[($j+1)] = $all_shares_bought[$j];
                                            $all_rates[($j+1)] = $all_rates[$j];
                                            $all_price_per_share[($j+1)] = $all_price_per_share[$j];
                                            $j = $j-1;
                                        }
                                        $all_artists[($j+1)] = $key;
                                        $all_shares_bought[($j+1)] = $key2;
                                        $all_rates[($j+1)] = $key3;
                                        $all_price_per_share[($j+1)] = $key4;
                                    }
                                }
                                else if($_SESSION['sort_type'] == 5)
                                {
                                    $i;
                                    $key;
                                    $key2;
                                    $j;
                                    for($i=1; $i<sizeof($all_shares_bought); $i++)
                                    {
                                        $key = $all_shares_bought[$i];
                                        $key2 = $all_artists[$i];
                                        $key3 = $all_rates[$i];
                                        $key4 = $all_price_per_share[$i];
                                        $j = $i-1;
                                        while($j >= 0 && $all_shares_bought[$j] > $key)
                                        {
                                            $all_shares_bought[($j+1)] = $all_shares_bought[$j];
                                            $all_artists[($j+1)] = $all_artists[$j];
                                            $all_rates[($j+1)] = $all_rates[$j];
                                            $all_price_per_share[($j+1)] = $all_price_per_share[$j];
                                            $j = $j-1;
                                        }
                                        $all_shares_bought[($j+1)] = $key;
                                        $all_artists[($j+1)] = $key2;
                                        $all_rates[($j+1)] = $key3;
                                        $all_price_per_share[($j+1)] = $key4;
                                    }
                                }
                                else if($_SESSION['sort_type'] == 6)
                                {
                                    $i;
                                    $key;
                                    $key2;
                                    $j;
                                    for($i=1; $i<sizeof($all_price_per_share); $i++)
                                    {
                                        $key = $all_price_per_share[$i];
                                        $key2 = $all_artists[$i];
                                        $key3 = $all_rates[$i];
                                        $key4 = $all_shares_bought[$i];
                                        $j = $i-1;
                                        while($j >= 0 && $all_price_per_share[$j] > $key)
                                        {
                                            $all_price_per_share[($j+1)] = $all_price_per_share[$j];
                                            $all_artists[($j+1)] = $all_artists[$j];
                                            $all_rates[($j+1)] = $all_rates[$j];
                                            $all_shares_bought[($j+1)] = $all_shares_bought[$j];
                                            $j = $j-1;
                                        }
                                        $all_price_per_share[($j+1)] = $key;
                                        $all_artists[($j+1)] = $key2;
                                        $all_rates[($j+1)] = $key3;
                                        $all_shares_bought[($j+1)] = $key4;
                                    }
                                }
                                else if ($_SESSION['sort_type'] == 7)
                                {
                                    $i;
                                    $key;
                                    $key2;
                                    $j;
                                    for($i=1; $i<sizeof($all_rates); $i++)
                                    {
                                        $key = $all_rates[$i];
                                        $key2 = $all_artists[$i];
                                        $key3 = $all_shares_bought[$i];
                                        $key4 = $all_price_per_share[$i];
                                        $j = $i-1;
                                        while($j >= 0 && $all_rates[$j] > $key)
                                        {
                                            $all_rates[($j+1)] = $all_rates[$j];
                                            $all_artists[($j+1)] = $all_artists[$j];
                                            $all_shares_bought[($j+1)] = $all_shares_bought[$j];
                                            $all_price_per_share[($j+1)] = $all_price_per_share[$j];
                                            $j = $j-1;
                                        }
                                        $all_rates[($j+1)] = $key;
                                        $all_artists[($j+1)] = $key2;
                                        $all_shares_bought[($j+1)] = $key3;
                                        $all_price_per_share[($j+1)] = $key4;
                                    }
                                }
                            }
                            else
                            {
                                $i;
                                $key;
                                $key2;
                                $j;
                                for($i=1; $i<sizeof($all_rates); $i++)
                                {
                                    $key = $all_rates[$i];
                                    $key2 = $all_artists[$i];
                                    $key3 = $all_shares_bought[$i];
                                    $key4 = $all_price_per_share[$i];
                                    $j = $i-1;
                                    while($j >= 0 && $all_rates[$j] < $key)
                                    {
                                        $all_rates[($j+1)] = $all_rates[$j];
                                        $all_artists[($j+1)] = $all_artists[$j];
                                        $all_shares_bought[($j+1)] = $all_shares_bought[$j];
                                        $all_price_per_share[($j+1)] = $all_price_per_share[$j];
                                        $j = $j-1;
                                    }
                                    $all_rates[($j+1)] = $key;
                                    $all_artists[($j+1)] = $key2;
                                    $all_shares_bought[($j+1)] = $key3;
                                    $all_price_per_share[($j+1)] = $key4;
                                }
                            }
                            $id = 1;
                            for($i=0; $i<sizeof($all_artists); $i++)
                            {
                                echo '<tr><th scope="row">'.$id.'</th><td>'.$all_artists[$i].'</td><td>'.$all_shares_bought[$i].'</td><td>'.$all_price_per_share[$i].'</td>';
                                if($all_rates[$i] > 0)
                                    echo '<td>+'.$all_rates[$i].'%</td></tr>';
                                else
                                    echo '<td>'.$all_rates[$i].'%</td></tr>';
                                $id++;
                            }
                        }
                        echo '</tbody>
                            </table>';
                    }
                    
                  ?> 
                  
              </tbody>
            </table>

                <div class="col-md-12">
                        <div class="icon-box box-secondary">
                            <div class="icon-box-inner">
                                <span data-feather="search" width="35" height="35"></span>
                            </div>
                        </div>        
            </div>
        </div>
    </div>
</section>

<!--scroll to top-->
<div class="scroll-top">
    <i class="fa fa-angle-up" aria-hidden="true"></i>
</div>

<?php
    $_SESSION['display'] = 0;
?>


<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.7.3/feather.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>