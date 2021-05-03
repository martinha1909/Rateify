<?php
  session_start();
  $_SESSION['profit'] = 0;
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Rateify - Artist</title>
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
    <div style = "position: absolute; top:200px; left: 20px;"class="container">
            
            <div class="col-12 mx-auto my-auto text-center">
            <div  class="col text-left">
                <a href="SearchSong.php"> <-Search Artist</a>
              </div>
              
                <div style = "position: absolute; left:130px; bottom: 20px;" class="col text-center">
                    <h1>Your shares with <?php echo $_SESSION['artist'];?> </h1>
                    
                </div>
                <div  style = "position: absolute;left:100px; top:60px;" class="col text-center">
                <p> Don't know who to invest? </p>
                <a href="TopInvestedArtists.php"> View top invested artist here</a>
              </div>
                 <!-- hyperlinks -->
             
            </div> 
            <div style = "position: absolute; top: 200px; left:100px;"class = "col text-center">
            <table style = "width: 1200px;" class="table">
                </div>
                    <thead>
                    <tr>
                        <th scope="col">No. shares you own</th>
                        <th scope="col">Artist</th>
                        <th scope="col">Current price per share</th>
                        <th scope="col">Selling profit per share</th>
                    </tr>
                    </thead>
                    <tbody>
              <!-- view song form -->

                  <?php
                    $_SESSION['profit'] = $_SESSION['per_share_price'] * $_SESSION['rate'];
                    $_SESSION['profit'] = $_SESSION['profit'] + $_SESSION['per_share_price'];
                    $rate = $_SESSION['rate'] * 100;
                    echo '<tr><th scope="row">'.$_SESSION['current_no_of_shares'].'</th><td>'.$_SESSION['artist'].'</td><td>Coins: '.$_SESSION['per_share_price'].'</td><td>Coins: '.$_SESSION['profit'].' ('.$rate.'%)</td></tr>';
                  ?>
              </tbody>
            </table> 
            <?php
              echo '<div><a href="RatingView.php"> +Buy more shares</a>.</div>';
              echo "<br>";
              echo '<div><a href="SellShares.php"> -Sell your shares</a>.</div>';
              echo "<br>";
            ?>
            </div>
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