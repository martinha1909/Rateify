    <?php
    session_start();
    $_SESSION['conversion_rate'] = -0.05;
    $_SESSION['coins'];
    $_SESSION['notify'];
    $_SESSION['cad'];
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
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <link rel="stylesheet" href="css/default.css" id="theme-color">
        <link rel="stylesheet" href="css/menu.css" id="theme-color">
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
    <div class="container-fluid py-6 p-auto" style = "position:relative; left:0px; bottom:28px;">
            <div class="row vh-md-50">
                <ul class="list-group col-2">
                    <li class="list-group-item" id="search-bar">
                        <form class="form-inline" action="../APIs/SearchSongsConnection.php" method="post">
                            <div class="search-box">
                                <input class="search-txt" name = "artist_name" type="search" aria-describedby="SearchSongHelp" placeholder="Enter Artist Name">
                                <a class="search-btn" href="#"><i class="fas fa-search"></i></a>
                            </div>
                        </form>
                    </li>
                            <?php
                                if($_SESSION['display'] == 2 || $_SESSION['display'] == 0)
                                {
                                    echo '<li class="list-group-item" style="border-color: orange; background-color: orange;">
                                        <form action="../APIs/DisplaySwitch.php" method="post">';
                                    echo '<input name="display_type" type="submit" id="menu-style" style="border:1px orange; background-color: transparent;" value="My Portfolio ->"';
                                    echo '</form>';
                                    echo '</li>';
                                }
                                else
                                {
                                    echo '<li class="list-group-item">
                                        <form action="../APIs/DisplaySwitch.php" method="post">';
                                    echo '<input name="display_type" type="submit" id="menu-style" style="border:1px transparent; background-color: transparent;" value="My Portfolio">';
                                    echo '</form>';
                                    echo '</li>';
                                }
                                if($_SESSION['display'] == 1)
                                {
                                    echo '<li class="list-group-item" style="border-color: orange; background-color: orange;">
                                        <form action="../APIs/DisplaySwitch.php" method="post">';
                                    echo '<input name="display_type" type="submit" id="menu-style" style="border:1px orange; background-color: transparent;" value="Top Invested Artists ->">';
                                    echo '</form>';
                                    echo '</li>';
                                }
                                else
                                {
                                    echo '<li class="list-group-item">
                                        <form action="../APIs/DisplaySwitch.php" method="post">';
                                    echo '<input name="display_type" type="submit" id="menu-style" style="border:1px transparent; background-color: transparent;" value="Top Invested Artists">';
                                    echo '</form>';
                                    echo '</li>';
                                }
                                if($_SESSION['display'] == 3)
                                {
                                    echo '<li class="list-group-item" style="border-color: orange; background-color: orange;">
                                        <form action="../APIs/DisplaySwitch.php" method="post">';
                                    echo '<input name="display_type" type="submit" id="menu-style" style="border:1px orange; background-color: transparent;" value="Buy Siliqas ->">';
                                    echo '</form>';
                                    echo '</li>';
                                }
                                else
                                {
                                    echo '<li class="list-group-item">
                                        <form action="../APIs/DisplaySwitch.php" method="post">';
                                    echo '<input name="display_type" type="submit" id="menu-style" style="border:1px orange; background-color: transparent;" value="Buy Siliqas">';
                                    echo '</form>';
                                    echo '</li>';
                                }
                                if($_SESSION['display'] == 4)
                                {
                                    echo '<li class="list-group-item" style="border-color: orange; background-color: orange;">
                                        <form action="../APIs/DisplaySwitch.php" method="post">';
                                    echo '<input name="display_type" type="submit" id="menu-style" style="border:1px orange; background-color: transparent;" value="Sell Siliqas ->">';
                                    echo '</form>';
                                    echo '</li>';
                                }
                                else
                                {
                                    echo '<li class="list-group-item">
                                        <form action="../APIs/DisplaySwitch.php" method="post">';
                                    echo '<input name="display_type" type="submit" id="menu-style" style="border:1px orange; background-color: transparent;" value="Sell Siliqas">';
                                    echo '</form>';
                                    echo '</li>';
                                }
                                if($_SESSION['display'] == 5)
                                {
                                    echo '<li class="list-group-item" style="border-color: orange; background-color: orange;">
                                        <form action="../APIs/DisplaySwitch.php" method="post">';
                                    echo '<input name="display_type" type="submit" id="menu-style" style="border:1px orange; background-color: transparent;" value="Account ->">';
                                    echo '</form>';
                                    echo '</li>';
                                }
                                else
                                {
                                    echo '<li class="list-group-item">
                                        <form action="../APIs/DisplaySwitch.php" method="post">';
                                    echo '<input name="display_type" type="submit" id="menu-style" style="border:1px orange; background-color: transparent;" value="Account">';
                                    echo '</form>';
                                    echo '</li>';
                                }
                                if($_SESSION['display'] == 6)
                                {
                                    echo '<li class="list-group-item" style="border-color: orange; background-color: orange;">
                                        <form action="../APIs/DisplaySwitch.php" method="post">';
                                    echo '<input name="display_type" type="submit" id="menu-style" style="border:1px orange; background-color: transparent;" value="Settings ->">';
                                    echo '</form>';
                                    echo '</li>';
                                }
                                else
                                {
                                    echo '<li class="list-group-item">
                                        <form action="../APIs/DisplaySwitch.php" method="post">';
                                    echo '<input name="display_type" type="submit" id="menu-style" style="border:1px orange; background-color: transparent;" value="Settings">';
                                    echo '</form>';
                                    echo '</li>';
                                }
                                
                            ?>
                    
                    <li class="list-group-item ">
                            <a class="dropdown-item" id="dashboard-hover" href="login.php">Log out</a>
                    </li>
                    

                </ul>
                            </div>
            </div>
        </section>
                

                <!-- header -->
        <section class="py-7 py-md-0 bg-dark" id="login">
            <div class="container" style = "position:relative; left:80px; bottom:670px;">
                <div class="row vh-md-100">
                <ul class="list-group col-12">
                <?php
                if($_SESSION['display'] == 1)
                echo '<table class="table">
                        <thead class="thead-orange">
                        <tr>
                            <th scope="col" class="bg-orange" id="href-hover" style="color: white;">#</th>
                            <th scope="col" class="bg-orange" id="href-hover" style="color: white;">Artist Name</th>
                            <th scope="col" class="bg-orange" id="href-hover" style="color: white;">Total shares bought</th>
                            <th scope="col" class="bg-orange" id="href-hover" style="color: white;">Price per share (q̶)</th>
                            <th scope="col" class="bg-orange" id="href-hover" style="color: white;">Rate</th>
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
                        else if($_SESSION['display'] == 2 || $_SESSION['display'] == 0)
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
                        else if($_SESSION['display'] == 3)
                        {
                            if($_SESSION['notify'] == 1)
                                echo "<script>alert('Siliqas bought successfully');</script>";
                            if($_SESSION['notify'] == 2)
                                echo "<script>alert('Card verfication failed');</script>";
                            $_SESSION['notify'] = 0;
                            echo '<section class="py-7 py-md-0 bg-dark" id="login">
                            <div class="container">
                                <div class="row vh-md-100">
                                    <div class="col-12 mx-auto my-auto text-center">
                                    <p class="navbar-light">Account Balance</p>
                                    <p>';
                            $conn = connect();
                            $result = getUserBalance($conn, $_SESSION['username']);
                            $balance = $result->fetch_assoc();
                            echo "Siliqas: ";
                            echo number_format((float)$balance['balance'], 2, '.', '');
                            echo '</p>
                            <p class="navbar-light">Current Rate</p>
                            <p>';
                                if($_SESSION['conversion_rate'] > 0)
                                    echo "+";
                                // else if($_SESSION['conversion_rate'] < 0)
                                //     echo "-";
                                echo $_SESSION['conversion_rate'];
                                echo "%";
                            echo '</p>
                                <form action="../APIs/CurrencyConnection.php" method="post">';
                                if($_SESSION['currency']==0)
                                {
                                    echo'
                                    <div class="select">
                                    <select name="currency" id="slct" onchange="this.form.submit()">
                                        <option selected disabled>Currency</option>
                                        <option value="USD">USD</option>
                                        <option value="CAD">CAD</option>
                                        <option value="EURO">EURO</option>
                                    </select>
                                    </div>';
                                }
                                else
                                {
                                    echo '<div class="select">
                                    <select name="currency" id="slct" onchange="this.form.submit()">
                                        <option selected disabled>'.$_SESSION['currency'].'</option>
                                        <option value="USD">USD</option>
                                        <option value="CAD">CAD</option>
                                        <option value="EURO">EURO</option>
                                    </select>
                                    </div>';
                                }
                                echo '</form>
                                <form action = "../APIs/BuyCoinsConnection.php" method = "post">
                                    <div class="form-group">';
                                        if($_SESSION['currency'] == 0)
                                            echo '<h5> Please choose a currency</h5>';
                                        else
                                        {
                                            echo '<h5>Enter Amount in '.$_SESSION['currency'].'</h5>
                                            <input type="text" name = "currency" style="border-color: white;" class="form-control form-control-sm" id="signupUsername" aria-describedby="signupUsernameHelp" placeholder="Enter amount">
                                            </div>
                                                <div class="navbar-light bg-dark" class="col-md-8 col-12 mx-auto pt-5 text-center">
                                                        <input type = "submit" class="btn btn-primary" role="button" aria-pressed="true" name = "button" value = "Check Conversion" onclick="window.location.reload();">
                                                    
                                                </div>
                                            </form>
                                            <p class="navbar navbar-expand-lg navbar-light bg-dark">Siliqas (q̶):';
                                                if($_SESSION['coins']!=0)
                                                {
                                                    echo $_SESSION['coins'];
                                                }
                                                else
                                                {
                                                    echo " ";
                                                    echo 0;
                                                }
                                            echo '</p>
                                            </form>
                                            <form action = "CardVerificationView.php" method = "post">
                                                <div class="navbar-light bg-dark" class="col-md-8 col-12 mx-auto pt-5 text-center">
                                                        <input type = "submit" class="btn btn-primary" role="button" aria-pressed="true" name = "button" value = "Buy this amount!" onclick="window.location.reload();">
                                                    
                                                </div>
                                                </form>';
                                            }
                                            echo'            </div>
                                                    </div>
                                                </div>
                                            </section>';
                        }
                        else if($_SESSION['display'] == 4)
                        {
                            if($_SESSION['notify'] == 1)
                                echo "<script>alert('Siliqas sold successfully');</script>";
                            if($_SESSION['notify'] == 2)
                                echo "<script>alert('Failed to sell Siliqas');</script>";
                            $_SESSION['notify'] = 0;
                            echo '<section class="py-7 py-md-0 bg-dark" id="login">
                            <div class="container">
                                <div class="row vh-md-100">
                                    <div class="col-12 mx-auto my-auto text-center">
                                    <p class="navbar-light bg-dark">Account Balance</p>
                                    <p>';
                                    $conn = connect();
                                    $result = getUserBalance($conn, $_SESSION['username']);
                                    $balance = $result->fetch_assoc();
                                    echo "Siliqas: ";
                                    echo $balance['balance'];
                                    echo '</p>
                                    <p class="navbar-light bg-dark">Current Rate</p>
                                    <p>';
                                    if($_SESSION['conversion_rate'] > 0)
                                        echo "+";
                                    echo $_SESSION['conversion_rate'];
                                    echo "%";
                                    echo '</p>
                                    <form action="../APIs/CurrencyConnection.php" method="post">';
                                    if($_SESSION['currency']==0)
                                    {
                                        echo'
                                        <div class="select">
                                        <select name="currency" id="slct" onchange="this.form.submit()">
                                            <option selected disabled>Currency</option>
                                            <option value="USD">USD</option>
                                            <option value="CAD">CAD</option>
                                            <option value="EURO">EURO</option>
                                        </select>
                                        </div>';
                                    }
                                    else
                                    {
                                        echo '<div class="select">
                                        <select name="currency" id="slct" onchange="this.form.submit()">
                                            <option selected disabled>'.$_SESSION['currency'].'</option>
                                            <option value="USD">USD</option>
                                            <option value="CAD">CAD</option>
                                            <option value="EURO">EURO</option>
                                        </select>
                                        </div>';
                                    }
                                    echo '</form>';
                                    if($_SESSION['currency'] == 0)
                                        echo '<h5>Please choose a currency</h5>';
                                    else
                                    {
                                                echo'<form action = "../APIs/SellCoinsConnection.php" method = "post">
                                                    <div class="form-group">
                                                        <h5>How many Siliqas are you exchanging?</h5>
                                                        <input type="text" name = "coins" style="border-color: white;" class="form-control form-control-sm" id="signupUsername" aria-describedby="signupUsernameHelp" placeholder="Enter Siliqas">
                                                        </div>
                                                    <div class="navbar-light bg-dark" class="col-md-8 col-12 mx-auto pt-5 text-center">
                                                            <input type = "submit" class="btn btn-primary" role="button" aria-pressed="true" name = "button" value = "Check Conversion" onclick="window.location.reload();">
                                                        
                                                    </div>
                                                </form>
                                                <p class="navbar navbar-expand-lg navbar-light bg-dark">'.$_SESSION['currency'].':'; 
                                                if($_SESSION['cad']!=0)
                                                {
                                                    if($_SESSION['currency'] == "EURO")
                                                        echo "€";
                                                    else
                                                        echo "$";
                                                    echo " ";
                                                    echo $_SESSION['cad'];
                                                }
                                                else
                                                {
                                                    if($_SESSION['currency'] == "EURO")
                                                        echo "€";
                                                    else
                                                        echo "$";
                                                    echo " ";
                                                    echo 0;
                                                }
                                                echo '</p>
                                                </form>
                                                <form action = "../APIs/WithdrawCoinsConnection.php" method = "post">
                                                    <div class="navbar-light bg-dark" class="col-md-8 col-12 mx-auto pt-5 text-center">
                                                            <input type = "submit" class="btn btn-primary" role="button" aria-pressed="true" name = "button" value = "Sell this amount!" onclick="window.location.reload();">
                                                        
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </section>';
                                    }
                        }
                        else if($_SESSION['display'] == 5)
                        {
                            if($_SESSION['notify'] == 3)
                                echo "<script>alert('Incorrect Password');</script>";
                            $_SESSION['notify'] = 0;
                            echo '<section class="py-7 py-md-0 bg-dark" id="login">
                            <div class="container">
                                <div class="row vh-md-100">
                                    <div class="col-12 mx-auto my-auto text-center">
                                        <h3 style="color: orange;">Verify your password to access personal page</h3>
                                        <form action="../APIs/PersonalPageConnection.php" method="post">
                                        <div class="form-group">
                                            <h5>Password</h5>
                                            <input name = "verify_password" type="password" style="border-color: white;" class="form-control form-control-sm" id="exampleInputPassword1" placeholder="Password">
                                        </div>
                                        <div class="col-md-8 col-12 mx-auto pt-5 text-center">
                                            <input type = "submit" class="btn btn-primary" role="button" aria-pressed="true" name = "button" value = "Verify" onclick="window.location.reload();">
                                        </div>
                                        </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </section>';
                        }
                        
                    ?> 
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