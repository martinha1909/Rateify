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
              <h1> Top 5 invested artists</h1>
              </div>

              <!-- hyperlinks -->
              <div class="col text-center">
                <a href="listener.php"> <- Return to user page</a>
              </div>

              <table class="table">
              <div  style = "top: 15px;" class="col text-center">
                <h6>*Click on Artist Name To Invest*</h6>
                </div>
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Artist Name</th>
                        <th scope="col">Total shares bought</th>
                        <th scope="col">Price per share</th>
                    </tr>
                    </thead>
                    <tbody>
              <!-- view song form -->
              <form action="../APIs/SongDisplayUser.php" method="post">
                  <?php
                    include '../APIs/logic.php';
                    include '../APIs/connection.php';
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
                                if($id == 5)
                                break;
                                $result3 = searchArtistPricePerShare($conn, $row['username']);
                                $row2 = $result3->fetch_assoc();
                                echo '<tr><th scope="row">'.$id.'</th>
                                            <td><input name = "artist_name['.$row['username'].']" type = "submit" style="border:1px solid black; background-color: transparent; color: white; role="button" aria-pressed="true" value = "'.$row['username'].'"></td></td>
                                            <td>'.$row['Shares'].'</td>
                                            <td>$'.$row2['price_per_share'].'</td></tr>';
                                $id++;
                            }
                        }
                        // <input name = "artist_name['.$_SESSION['searchedArtistName'].']" type = "submit" style="border:1px solid black; background-color: transparent; color: white; role="button" aria-pressed="true" value = "'.$_SESSION['searchedArtistName'].'"></td>
                        
                    }
                            // echo '<tr><th scope="row">'.$id.'</th>
                            //             <td>'.$artist_name.'</td>
                            //             <td>'.$shares_bought.'</td>
                            //             <td>$'.$row2['price_per_share'].'</td></tr>';
                        
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