<?php
  session_start();
  $_SESSION['conversion_rate'] = -0.05;
  $_SESSION['coins'] = 0;
  $_SESSION['sort_type'] = 0;
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Rateify - Listener</title>
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
              
              <div style = "position: absolute;right:793px; top:-50px;" class="col text-center">
              <h1> Hello <?php echo $_SESSION['username'] ?>!</h1>
              </div>

              <!-- header -->
            
              <div style = "position: absolute;right:-750px; top:-300px;" class="col text-center">
                <h5>drop down menu</h5>
              </div>

              <div style = "position: absolute;right:1000px; top:50px;" class="col-md-8 col-12 mx-auto pt-5 text-center">
                <a href="listenerSongs.php" class="btn btn-primary" role="button" aria-pressed="true">
                  Invest
                </a>
              </div>

              <div style = "position: absolute;right:1040px; top:0px;" class="col-md-8 col-12 mx-auto pt-5 text-center">
              <form action="DisplayUserInvestments.php" method="post">
              <input type = "submit" class="btn btn-secondary" role="button" aria-pressed="true" value = "My investments">
              </form>

              </div>

              <form action="../APIs/SearchSongsConnection.php" method="post">
                    <!-- Search field -->
                    <div style="position: absolute; right: 450px; top: -300px;" class="form-group">
                      <input name = "artist_name" type="search" class="form-control" id="SongName" aria-describedby="SearchSongHelp" placeholder="Enter Artist Name">
                    </div>
                    
                   
                </form>

                <div style="position: absolute; right: 325px; top: -410px;" class="col-md-6 box">
                        <div class="icon-box box-secondary">
                            <div class="icon-box-inner">
                                <span data-feather="search" width="35" height="35"></span>
                            </div>
                        </div>

              <!-- logout button-->
              <div style = "position: absolute;right:-300px; top:-50px;" class="col-md-8 col-12 mx-auto pt-5 text-center">
                <a href="index.php" class="btn btn-danger" role="button" aria-pressed="true">
                  Logout
                </a>
              </div>
              
            </div>
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