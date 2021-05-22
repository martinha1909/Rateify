<?php
  session_start();
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

    <!-- Bootstrap CSS / Color Scheme -->
    <link rel="stylesheet" href="css/default.css" id="theme-color">
</head>
<body>

<!--navigation-->
<section class="smart-scroll">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-md navbar-dark bg-orange">
            <a id="href-hover" class="navbar-brand heading-black" href="listener.php">
                HASSNER
            </a>
            <p class="navbar-light">Account Balance</p>
            <p>
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
            <p class="navbar-light">Current Rate</p>
            <p>
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
<section class="py-7 py-md-0 bg-dark" id="login">
    <div class="container">
        <div class="row vh-md-100">
            <div class="col-12 mx-auto my-auto text-center">
              
              <div class="col text-center">
              <h1> Search Results for <?php echo $_SESSION['searchedArtistName'];?> </h1>
              </div>

              <!-- hyperlinks -->
              <div class="col text-left">
                <a href="listener.php"> <- Front page</a>
              </div>

              <table class="table">
              <div  style = "top: 15px;" class="col text-center">
                </div>
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Artist Name</th>
                        <th scope="col">No. of albums</th>
                        <th scope="col">No. of songs</th>
                        <th scope="col">Total no. of plays</th>
                        <th scope="col">Total shares bought</th>
                    </tr>
                    </thead>
                    <tbody>
              <!-- view song form -->
              <form action="../APIs/SongDisplayUser.php" method="post">
                  <?php
                    $conn = connect();
                    $id = 1;
                    $no_of_albums = sizeof($_SESSION['all_albums']);
                    $no_of_songs = sizeof($_SESSION['all_songs']);
                    $total_plays = $_SESSION['total_plays'];
                    echo '<tr><th scope="row">'.$id.'</th><td><input name = "artist_name['.$_SESSION['searchedArtistName'].']" type = "submit" id="abc" style="border:1px transparent; background-color: transparent; color: white; role="button" aria-pressed="true" value = "'.$_SESSION['searchedArtistName'].'"></td><td>'.$no_of_albums.'</td><td>'.$no_of_songs.'</td><td>'.$total_plays.'</td><td>'.$_SESSION['shares'].'</tr>';
                  ?> 
                  </form>
              </tbody>
            </table>
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