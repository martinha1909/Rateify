<?php
  session_start();
  $_SESSION['status'] = 0;
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

    <!-- Bootstrap CSS / Color Scheme -->
    <link rel="stylesheet" href="css/default.css" id="theme-color">
</head>
<body class="bg-dark">

<!--navigation-->
<section class="smart-scroll">
    <div class="container-xxl">
        <nav class="navbar navbar-expand-md navbar-dark bg-orange">
            <a id = "href-hover" class="navbar-brand heading-black" href="#">
                HASSNER
            </a>
            <p class="navbar-light bg-dark">Shares Distributed</p>
            <p>
                <?php
                    include '../APIs/logic.php';
                    include '../APIs/connection.php';
                    $conn = connect();
                    $result = getArtistShares($conn, $_SESSION['username']);
                    $_SESSION['artist_distributed'] = $result->fetch_assoc();
                    echo $_SESSION['artist_distributed']['Share_Distributed'];
                ?>
            </p>
            <div class="col text-right">
                <a href="../APIs/IncreaseSharesDistributed.php" onclick='window.location.reload();'>+</a>
            </div>
            <div class="col text-right">
                <a href="../APIs/DecreaseSharesDistributed.php" onclick='window.location.reload();'>-</a>
            </div>
            <p class="navbar-light bg-dark">Available Shares</p>
            <p>
                <?php
                   $result2 = searchArtistShares($conn, $_SESSION['username']);
                   $artist_share = $result2->fetch_assoc();
                   $unbought = $_SESSION['artist_distributed']['Share_Distributed'] - $artist_share['Shares'];
                   echo $unbought;
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
<section id="login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mx-auto my-auto text-center">

              <!-- header -->

              <div class="col-md-8 col-12 mx-auto pt-5 text-center">
                <form action="../APIs/DisplayArtistSongsConnection.php" method="post">
                  <input type = "submit" class="btn btn-primary" role="button" aria-pressed="true" value = "Songs">
                </form>
              </div>

              <div class="col-md-8 col-12 mx-auto pt-5 text-center">
                <form action="../APIs/DisplayArtistAlbumsConnection.php" method="post">
                  <input type = "submit" class="btn btn-primary" role="button" aria-pressed="true" value = "Albums/EP">
                </form>
              </div>

              <div class="col-md-8 col-12 mx-auto pt-5 text-center">
                <a href="CreateSongView.php" class="btn btn-primary" role="button" aria-pressed="true">
                  Add Song(s)
                </a>
              </div>

              <div class="col-md-8 col-12 mx-auto pt-5 text-center">
                <a href="CreateAlbumView.php" class="btn btn-primary" role="button" aria-pressed="true">
                  Add Album(s)
                </a>
              </div>

              <!-- logout button-->
              <div class="col-md-8 col-12 mx-auto pt-5 text-center">
                <a href="ArtistWritePost.php" class="btn btn-primary" role="button" aria-pressed="true">
                  Add post(s)
                </a>
              </div>

              <div class="col-md-8 col-12 mx-auto pt-5 text-center">
              <a class="dropdown-item" id="dashboard-hover" style="background-color: transparent;" href="login.php">Log out</a>
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