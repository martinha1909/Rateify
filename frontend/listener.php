    <?php
    session_start();
    $_SESSION['conversion_rate'] = -0.05;
    $_SESSION['coins'] = 0;
    $_SESSION['cad'] = 0;
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
            <nav class="navbar navbar-expand-md navbar-dark bg-orange d-flex justify-content-between">
                <a id = "href-hover" style = "background: transparent;" class="navbar-brand" href="#" onclick='window.location.reload();'>
                    HASSNER
                </a>

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
    <section class="py-7 py-md-0 bg-dark" id="login">
        <div class="container">
            <div class="row vh-md-100">
                <ul class="list-group col-2" style="position: absolute; left:0px; top: 68px;">
                    <li class="list-group-item" id="search-bar">
                        <form class="form-inline" action="../APIs/SearchSongsConnection.php" method="post">
                            <div class="search-box">
                                <input class="search-txt" name = "artist_name" type="search" aria-describedby="SearchSongHelp" placeholder="Enter Artist Name">
                                <a class="search-btn" href="#"><i class="fas fa-search"></i></a>
                            </div>
                        </form>
                    </li>
                    <li class="list-group-item">
                        <form action="../APIs/DisplaySwitch.php" method="post">
                            <input name="display_type" type="submit" id="menu-style" style="border:1px transparent; background-color: transparent;" value="Top Invested Artists">
                        </form>
                    </li>
                    <li class="list-group-item">
                        <form action="../APIs/DisplaySwitch.php" method="post">
                            <input name="display_type" type="submit" style="border:1px transparent; background-color: transparent;" id="menu-style" value="My Portfolio">
                        </form>
                    </li>
                    <li class="list-group-item">
                        <a class="dropdown-item" id="dashboard-hover" href="BuyCoinsView.php">Buy Siliqas</a>
                    </li>
                    <li class="list-group-item ">
                        <a class="dropdown-item" id="dashboard-hover" href="SellCoinsView.php">Sell Siliqas</a>
                    </li>
                    <li class="list-group-item ">
                        <a class="dropdown-item" id="dashboard-hover" href="#">Account</a>
                    </li>
                    <li class="list-group-item ">
                        <a class="dropdown-item" id="dashboard-hover" href="#">Settings</a>
                    </li>
                    <li class="list-group-item ">
                            <a class="dropdown-item" id="dashboard-hover" href="login.php">Log out</a>
                    </li>
                    

                </ul>

                

                <!-- header -->
                
                <?php
                if($_SESSION['display'] == 1)
                echo '<table class="table">
                        <thead class="thead-orange">
                        <tr>
                            <th scope="col" class="bg-orange" id="href-hover" style="color: white">#</th>
                            <th scope="col" class="bg-orange" id="href-hover" style="color: white">Artist Name</th>
                            <th scope="col" class="bg-orange" id="href-hover" style="color: white">Total shares bought</th>
                            <th scope="col" class="bg-orange" id="href-hover" style="color: white">Price per share (q̶)</th>
                            <th scope="col" class="bg-orange" id="href-hover" style="color: white">Rate</th>
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
                                                <td><input name = "artist_name['.$users[$i].']" type = "submit" id="abc" style="border:1px transparent; background-color: transparent;" role="button" aria-pressed="true" value = "'.$users[$i].'"></td></td>
                                                <td style="color: white">'.$all_shares[$i].'</td>
                                                <td style="color: white">'.$row2['price_per_share'].'</td>';
                                    if($rate['rate'] > 0)
                                        echo '<td class="increase">+'.$rate['rate'].'%</td></tr>';
                                    else if($rate['rate'] == 0)
                                        echo '<td>'.$rate['rate'].'%</td></tr>';
                                    else
                                        echo '<td class="decrease">'.$rate['rate'].'%</td></tr>';       
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
                            <th scope="col" class="bg-orange">#</th>
                            <form action="../APIs/SortArtists.php">
                                <th scope="col" class="bg-orange"><input type = "submit" id="href-hover" style="border:1px transparent; background-color: transparent; color: white;" role="button" aria-pressed="true" value = "Artist" onclick="window.location.reload();">';
                            if($_SESSION['sort_type'] == 1)
                                echo "↑";
                            else if($_SESSION['sort_type'] == 4)
                                echo "↓";
                            else
                                echo "";
                            echo '</th>
                                </form>
                                <form action="../APIs/SortShares.php">
                                    <th scope="col" class="bg-orange"><input type = "submit" id="href-hover" style="border:1px transparent; background-color: transparent; color: white;" role="button" aria-pressed="true" value = "Shares bought" onclick="window.location.reload();">';
                            if($_SESSION['sort_type'] == 2)
                                echo "↑";
                            else if($_SESSION['sort_type'] == 5)
                                echo "↓";
                            else
                                echo "";
                            echo '</th>
                                </form>
                                <form action = "../APIs/SortPricePerShare.php">
                                    <th scope="col" class="bg-orange"><input type = "submit" id="href-hover" style="border:1px transparent; background-color: transparent; color: white;" role="button" aria-pressed="true" value = "Price per share (q̶)" onclick="window.location.reload();">';
                            if($_SESSION['sort_type'] == 3)
                                echo "↑";
                            else if($_SESSION['sort_type'] == 6)
                                echo "↓";
                            else
                                echo "";

                            echo '</th>
                                </form>
                                <form action = "../APIs/SortRates.php">
                                    <th scope="col" class="bg-orange"><input type = "submit" id="href-hover" style="border:1px transparent; background-color: transparent; color: white;" role="button" aria-pressed="true" value = "Rate" onclick="window.location.reload();">';
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
                                echo '<form action="../APIs/SongDisplayUser.php" method="post">';
                                for($i=0; $i<sizeof($all_artists); $i++)
                                {
                                    echo '<tr><th scope="row">'.$id.'</th><td><input name = "artist_name['.$all_artists[$i].']" type = "submit" id="abc" style="border:1px transparent; background-color: transparent;" role="button" aria-pressed="true" value = "'.$all_artists[$i].'"></td><td>'.$all_shares_bought[$i].'</td><td>'.$all_price_per_share[$i].'</td>';
                                    if($all_rates[$i] > 0)
                                        echo '<td class="increase">+'.$all_rates[$i].'%</td></tr>';
                                    else if($all_rates[$i] == 0)
                                        echo '<td>'.$all_rates[$i].'%</td></tr>';
                                    else
                                        echo '<td class="decrease">'.$all_rates[$i].'%</td></tr>';
                                    $id++;
                                }
                                echo '</form>';
                            }
                            echo '</tbody>
                                </table>';
                        }
                        
                    ?> 
                    
                </tbody>
                </table>
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
    <script src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <script src="js/scripts.js"></script>
    </body>
    </html>