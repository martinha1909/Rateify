<?php
  session_start();
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
              <h1> View my albums. </h1>
              </div>

              <!-- hyperlinks -->
              <div class="col text-center">
                <a href="artist.php"> Return to action page</a>.
              </div>

              <!-- view song form -->
              <table class="table">
                <div  style = "top: 15px;" class="col text-center">
                    <h6>*Click on Album Name to toggle publicity*</h6>
                </div>
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Album Name</th>
                        <th scope="col">No_of_Songs</th>
                        <th scope="col">Duration</th>
                        <th scope="col">Status</th>
                    </tr>
                    </thead>
                    <tbody>
              <!-- view song form -->

              <!--NEED TO EDIT WHERE THIS GOES WHEN CLICKING ALBUM NAME-->
              <form action="../APIs/PublishAlbumConnection.php" method="post">
                  <?php
                    include '../APIs/logic.php';
                    include '../APIs/connection.php';
                    $conn = connect();
                    if(!empty($_SESSION['artists_albums']))
                    {
                        $no_of_albums = count($_SESSION['artists_albums']);
                        $album_no = 0;
                        $id = 1;
                        while($no_of_albums > $album_no){
                            $duration = $_SESSION['artists_albums'][$album_no]['duration'];
                            $no_of_songs = $_SESSION['artists_albums'][$album_no]['no_of_songs'];
                            $album_name = $_SESSION['artists_albums'][$album_no]['name'];
                            $result = searchAlbum($conn, $album_name);
                            $published = $result->fetch_assoc();
                            if($published['Published'] == 0)
                                $status = "Not Published";
                            else
                                $status = "Published";
                            
                            
                            echo '<tr><th scope="row">'.$id.'</th>
                                  <td><input name = "album_name['.$album_name.']" type = "submit" style="border:1px solid black; background-color: transparent; color: white; role="button" aria-pressed="true" value = "'.$album_name.'" onclick = "window.location.href=window.location.href"></td>
                                  <td>'.$no_of_songs.'</td>
                                  <td>'.$duration.'</td>
                                  <td>'.$status.'</td></tr>';
                            
                            $id++;
                            $album_no++;
                        }
                       
                    }
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