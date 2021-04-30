<?php
  session_start();
  $_SESSION['conversion_rate'];
  $_SESSION['coins'] = 0;
  $_SESSION['cad'] = 0;
  $_SESSION['profit'] = 0;
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
                HASSNER
            </a>
            <p style = "position: absolute;right:0px; top:0px;" class="navbar-light bg-dark">Account Balance</p>
            <p style = "position: absolute;right:40px; top:26px;">
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
              
              <div class="col text-center">
              <h1> <?php echo $_SESSION['username'];?> investments</h1>
              </div>

              <!-- hyperlinks -->
              <div class="col text-center">
                <a href="listener.php"> <- Return to user page</a>
              </div>

              <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Artist Name</th>
                        <th scope="col">Shares bought</th>
                        <th scope="col">Price per share (Coins)</th>
                        <th scope="col">Rate</th>
                    </tr>
                    </thead>
                    <tbody>
              <!-- view song form -->
                  <?php
                    // include '../APIs/logic.php';
                    // include '../APIs/connection.php';
                    $conn = connect();
                    $result = searchUsersInvestment($conn, $_SESSION['username']);
                    $all_profits = 0;
                    if($result->num_rows == 0)
                    {
                        echo '<h3> No results </h3>';
                    }
                    else
                    {
                        $id = 1;
                        while($row = $result->fetch_assoc())
                        {
                            $artist_name = $row['artist_username'];
                            $shares_bought = $row['no_of_share_bought'];
                            $result2 = searchArtistPricePerShare($conn, $artist_name);
                            $result3 = searchArtistRate($conn, $artist_name);
                            $rate = $result3->fetch_assoc();
                            $rate['rate'] = $rate['rate'] * 100;
                            $all_profits += $rate['rate'];
                            $row2 = $result2->fetch_assoc();
                            echo '<tr><th scope="row">'.$id.'</th><td>'.$artist_name.'</td><td>'.$shares_bought.'</td><td>'.$row2['price_per_share'].'</td>';
                            if($rate['rate'] > 0)
                                echo '<td>+'.$rate['rate'].'%</td></tr>';
                            else
                                echo '<td>'.$rate['rate'].'%</td></tr>';
                            $id++;
                        }
                        
                    }
                  ?>
                <form action = "BuyCoinsView.php" method = "post">
                    <div style = "position: absolute;right:400px; top:400px;" class="navbar-light bg-dark" class="col-md-8 col-12 mx-auto pt-5 text-center">
                            <input type = "submit" class="btn btn-primary" role="button" aria-pressed="true" name = "button" value = "Buy coins!">
                        
                    </div>
                </form>
                <form action = "SellCoinsView.php" method = "post">
                    <div style = "position: absolute;right:600px; top:400px;" class="navbar-light bg-dark" class="col-md-8 col-12 mx-auto pt-5 text-center">
                            <input type = "submit" class="btn btn-primary" role="button" aria-pressed="true" name = "button" value = "Sell coins!">
                        
                    </div>
                </form>
              </tbody>
            </table>
            </div>
        </div>
    </div>
</section>
<section class="smart-scroll">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-md navbar-dark">
            <p style = "position: absolute;right:300px; top:0px;" class="navbar-light bg-dark">All Shares Profit</p>
            <p style = "position: absolute;right:350px; top:26px;">
                <?php
                    if($all_profits > 0)
                        echo "+";
                    echo $all_profits;
                    echo "%";
                ?>
            </p> 
        </nav>
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