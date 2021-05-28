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
    <link rel="stylesheet" href="css/menu.css" id="theme-color">
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
            <ul class="list-group bg-dark">
                            <?php
                                if($_SESSION['display'] == 2 || $_SESSION['display'] == 0)
                                {
                                    echo '<li class="list-group-item-no-hover" style="border-color: white; border-bottom: 2px solid white;">
                                        <form action="../APIs/artist/DisplaySwitchArtist.php" method="post">';
                                    echo '<input name="display_type" type="submit" id="menu-style" style="border:1px white; background-color: transparent; color: #ff9100;" value="My Portfolio ->"';
                                    echo '</form>';
                                    echo '</li>';
                                }
                                else
                                {
                                    echo '<li class="list-group-item-no-hover">
                                        <form action="../APIs/artist/DisplaySwitchArtist.php" method="post">';
                                    echo '<input name="display_type" type="submit" id="abc-no-underline" style="font-weight: bold; border:1px transparent; background-color: transparent;" value="My Portfolio">';
                                    echo '</form>';
                                    echo '</li>';
                                }
                                if($_SESSION['display'] == 1)
                                {
                                    echo '<li class="list-group-item-no-hover" style="border-color: white; border-bottom: 2px solid white; border-top: 2px solid white;">
                                        <form action="../APIs/artist/DisplaySwitchArtist.php" method="post">';
                                    echo '<input name="display_type" type="submit" id="menu-style" style="border:1px orange; background-color: transparent; color: #ff9100;" value="Songs ->">';
                                    echo '</form>';
                                    echo '</li>';
                                }
                                else
                                {
                                    echo '<li class="list-group-item-no-hover">
                                        <form action="../APIs/artist/DisplaySwitchArtist.php" method="post">';
                                    echo '<input name="display_type" type="submit" id="abc-no-underline" style="font-weight: bold; border:1px transparent; background-color: transparent;" value="Songs">';
                                    echo '</form>';
                                    echo '</li>';
                                }
                                if($_SESSION['display'] == 3)
                                {
                                    echo '<li class="list-group-item-no-hover" style="border-color: white; border-bottom: 2px solid white; border-top: 2px solid white;">
                                        <form action="../APIs/artist/DisplaySwitchArtist.php" method="post">';
                                    echo '<input name="display_type" type="submit" id="menu-style" style="border:1px orange; background-color: transparent; color: #ff9100;" value="Albums/EPs ->">';
                                    echo '</form>';
                                    echo '</li>';
                                }
                                else
                                {
                                    echo '<li class="list-group-item-no-hover">
                                        <form action="../APIs/artist/DisplaySwitchArtist.php" method="post">';
                                    echo '<input name="display_type" type="submit" id="abc-no-underline" style="font-weight: bold;border:1px orange; background-color: transparent;" value="Albums/EPs">';
                                    echo '</form>';
                                    echo '</li>';
                                }
                                if($_SESSION['display'] == 4)
                                {
                                    echo '<li class="list-group-item-no-hover" style="border-color: white; border-bottom: 2px solid white; border-top: 2px solid white;">
                                        <form action="../APIs/artist/DisplaySwitchArtist.php" method="post">';
                                    echo '<input name="display_type" type="submit" id="menu-style" style="border:1px orange; background-color: transparent; color: #ff9100;" value="Post Something ->">';
                                    echo '</form>';
                                    echo '</li>';
                                }
                                else
                                {
                                    echo '<li class="list-group-item-no-hover">
                                        <form action="../APIs/artist/DisplaySwitchArtist.php" method="post">';
                                    echo '<input name="display_type" type="submit" id="abc-no-underline" style="font-weight: bold; border:1px orange; background-color: transparent;" value="Post Something">';
                                    echo '</form>';
                                    echo '</li>';
                                }
                                if($_SESSION['display'] == 5)
                                {
                                    echo '<li class="list-group-item-no-hover" style="border-color: white; border-bottom: 2px solid white; border-top: 2px solid white;">
                                        <form action="../APIs/artist/DisplaySwitchArtist.php" method="post">';
                                    echo '<input name="display_type" type="submit" id="menu-style" style="border:1px orange; background-color: transparent; color: #ff9100;" value="Account ->">';
                                    echo '</form>';
                                    echo '</li>';
                                }
                                else
                                {
                                    echo '<li class="list-group-item-no-hover">
                                        <form action="../APIs/artist/DisplaySwitchArtist.php" method="post">';
                                    echo '<input name="display_type" type="submit" id="abc-no-underline" style="font-weight: bold; border:1px orange; background-color: transparent;" value="Account">';
                                    echo '</form>';
                                    echo '</li>';
                                }
                                if($_SESSION['display'] == 6)
                                {
                                    echo '<li class="list-group-item-no-hover" style="border-color: white; border-bottom: 2px solid white; border-top: 2px solid white;">
                                        <form action="../APIs/artist/DisplaySwitchArtist.php" method="post">';
                                    echo '<input name="display_type" type="submit" id="menu-style" style="border:1px orange; background-color: transparent; color: #ff9100;" value="Settings ->">';
                                    echo '</form>';
                                    echo '</li>';
                                }
                                else
                                {
                                    echo '<li class="list-group-item-no-hover">
                                        <form action="../APIs/artist/DisplaySwitchArtist.php" method="post">';
                                    echo '<input name="display_type" type="submit" id="abc-no-underline" style="font-weight: bold; border:1px orange; background-color: transparent;" value="Settings">';
                                    echo '</form>';
                                    echo '</li>';
                                }
                                echo '<li class="list-group-item-no-hover">';
                                    echo '</li>';
                                echo '<li class="list-group-item-no-hover">';
                                    echo '</li>';
                                    echo '<li class="list-group-item-no-hover">';
                                    echo '</li>';
                                    echo '<li class="list-group-item-no-hover">';
                                    echo '</li>';
                                    echo '<li class="list-group-item-no-hover">';
                                    echo '</li>';
                                    echo '<li class="list-group-item-no-hover">';
                                    echo '</li>';
                                    echo '<li class="list-group-item-no-hover" style="padding-top: 52px;">';
                                    echo '</li>';
                                    echo '<li class="list-group-item-no-hover" style="border-bottom: 2px solid white;">';
                                    echo    '<a class="dropdown-item" id="dashboard-hover" style="background-color: transparent;" href="login.php">Log out</a>';
                                    echo '</li>';
                                    
                            ?>
                    

                </ul>
                <div class="col">
                <?php
                  if($_SESSION['display'] == 1)
                  {  
                    $result = searchSongByArtist($conn,$_SESSION['username']);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $songInfo = searchSong($conn, $row['song_id']);
                            if ($songInfo->num_rows > 0){
                                while($row2 = $songInfo->fetch_assoc())
                                {
                                    $artists_song_info[] = $row2;
                                }
                            }
                        }
                        $_SESSION['artists_songs'] = $artists_song_info;
                    }else{
                        $_SESSION['artists_songs'] = NULL;
                    }
                    echo '<table class="table">
                    <div class="col text-center">
                      </div>
                          <thead class="thead-orange">
                          <tr>
                              <th scope="col">#</th>
                              <th scope="col">Song</th>
                              <th scope="col">Album</th>
                              <th scope="col">Monthly Listeners</th>
                              <th scope="col">Total Plays</th>
                              <th scope="col">Status</th>
                          </tr>
                          </thead>';
                    echo '<tbody>
                    <form action="../APIs/artist/PublishSongConnection.php" method="post">';
                    if(!empty($_SESSION['artists_songs']))
                    {
                        $no_of_songs = count($_SESSION['artists_songs']);
                        $song_no = 0;
                        $id = 1;
                        while($no_of_songs > $song_no){
                            $song_name = $_SESSION['artists_songs'][$song_no]['name'];
                            $monthly_listeners = $_SESSION['artists_songs'][$song_no]['Monthly_Listeners'];
                            $no_of_plays = $_SESSION['artists_songs'][$song_no]['no_of_plays'];
                            $album_name = $_SESSION['artists_songs'][$song_no]['album_name'];
                            $song_id = $_SESSION['artists_songs'][$song_no]['id'];
                            $result = searchSong($conn, $song_id);
                            $published = $result->fetch_assoc();
                            if($published['Published'] == 0)
                                $_SESSION['status'] = "Not Published";
                            else
                                $_SESSION['status'] = "Published";
                            
                            
                            echo '<tr><th scope="row">'.$id.'</th>
                                  <td><input name = "song_id['.$song_id.']" type = "submit" id="abc" style="border:1px transparent; background-color: transparent; font-weight: bold;" aria-pressed="true" value = "'.$song_name.'" onclick = "window.location.href=window.location.href"></td>
                                  <td>'.$album_name.'</td><td>'.$monthly_listeners.'</td>
                                  <td>'.$no_of_plays.'</td>
                                  <td>'.$_SESSION['status'].'</td></tr>';
                            
                            $id++;
                            $song_no++;
                        }
                       
                    }
                      echo '</form>
                      </tbody>
                    </table>';
                    echo '<form action="../APIs/artist/AddSongOrAlbumConnection.php" method="post">
                            <input name = "add" type="submit" id="menu-style-invert" style=" border:1px orange; background-color: transparent;" value="+Add a song">
                          </form>';
                    echo '<form action="../APIs/artist/AddSongOrAlbumConnection.php" method="post">
                            <input name = "add" type="submit" id="menu-style-invert" style=" border:1px orange; background-color: transparent;" value="-Delete a song">
                          </form>';
                    if($_SESSION['add'] == 1)
                    {
                      if($_SESSION['notify'] == 1)
                      {
                        echo "<script>alert('Song created successfully');</script>";
                        $_SESSION['add'] = 0;
                      }
                      if($_SESSION['notify'] == 2)
                      {
                        echo "<script>alert('You already have this song!');</script>";
                        $_SESSION['add'] = 0;
                      }
                      $_SESSION['notify'] = 0;
                      echo '<div class="col text-center">
                              <h3> Add your song!</h3>
                            </div>';
                      echo '<form action="../APIs/artist/CreateSongArtistConnection.php" method="post">

                                  <!-- username field -->
                                  <div class="form-group">
                                    <label for="exampleInputEmail1" >Song Name</label>
                                    <input name = "song_name" type="text" class="form-control" id="signupUsername" aria-describedby="signupUsernameHelp" placeholder="Enter song name">
                                  </div>
              
                                  <div class="form-group">
                                    <label for="exampleInputPassword1" >Song Duration</label>
                                    <input name = "duration" type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter duration">
                                  </div>
              
                                  <!-- password field -->
                                  <div class="form-group">
                                    <label for="exampleInputPassword1" >Date</label>
                                    <input name = "date_created" type="date" class="form-control" id="exampleInputPassword1" placeholder="Enter date">
                                  </div>
              
                                  
              
              
                                  <!-- login button -->
                                  <!-- TODO: login button functionality-->
                                  <div class="col-md-8 col-12 mx-auto pt-5 text-center">
                                    <input type = "submit" class="btn btn-primary" role="button" aria-pressed="true" name = "button" value = "Create song" onclick="window.location.reload();">
                                  </div>
                              </form>';
                    }
                    else if($_SESSION['add'] == 3)
                    {
                      if($_SESSION['notify'] == 1)
                      {
                        echo "<script>alert('Song deleted successfully');</script>";
                        $_SESSION['add'] = 0;
                      }
                      if($_SESSION['notify'] == 2)
                      {
                        echo "<script>alert('Song not found');</script>";
                        $_SESSION['add'] = 0;
                      }
                      $_SESSION['notify'] = 0;
                      echo '<div class="col text-center">
                              <h3> Delete a song!</h3>
                            </div>';
                      echo '<form action="../APIs/artist/DeleteSongConnection.php" method="post">

                            <!-- username field -->
                            <div class="form-group">
                              <label for="exampleInputEmail1" >Song Name</label>
                              <input name = "song_name" type="text" class="form-control" id="signupUsername" aria-describedby="signupUsernameHelp" placeholder="Enter song name">
                            </div>
        
                            
        
        
                            <!-- login button -->
                            <!-- TODO: login button functionality-->
                            <div class="col-md-8 col-12 mx-auto pt-5 text-center">
                              <input type = "submit" class="btn btn-primary" role="button" aria-pressed="true" name = "button" value = "Delete!" onclick="window.location.reload();">
                            </div>
                        </form>';
                    }
                  }

                  //My portfolio
                  else if($_SESSION['display'] == 2 || $_SESSION['display'] == 0)
                  {
                    $_SESSION['add'] = 0;
                  }
                  else if($_SESSION['display'] == 3)
                  {
                    $result = searchArtistAlbum($conn,$_SESSION['username']);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $albumInfo = searchAlbum($conn, $row['album_name']);
                            if ($albumInfo->num_rows > 0){
                                while($row2 = $albumInfo->fetch_assoc())
                                {
                                    $artists_album_info[] = $row2;
                                }
                            }
                        }
                        $_SESSION['artists_albums'] = $artists_album_info;
                    }else{
                        $_SESSION['artists_albums'] = NULL;
                    }
                    echo'      <table class="table">
                              <thead>
                              <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Album Name</th>
                                  <th scope="col">No_of_Songs</th>
                                  <th scope="col">Duration</th>
                                  <th scope="col">Status</th>
                                  <th scope="col">Add songs</th>
                              </tr>
                              </thead>
                              <tbody>
                        ';
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
                                      <form action="../APIs/artist/PublishAlbumConnection.php" method="post">
                                      <td><input name = "album_name['.$album_name.']" type = "submit" id="abc" style="border:1px transparent; background-color: transparent; font-weight: bold;" role="button" aria-pressed="true" value = "'.$album_name.'" onclick = "window.location.href=window.location.href"></td>
                                      </form>
                                      <td>'.$no_of_songs.'</td>
                                      <td>'.$duration.'</td>
                                      <td>'.$status.'</td>
                                      <form action="../APIs/artist/AddSongToAlbum.php" method="post">
                                      <td><input name = "album_name['.$album_name.']" type = "submit" id="abc" style="border:1px transparent; background-color: transparent; font-weight: bold;" role="button" aria-pressed="true" value = "+" onclick = "window.location.href=window.location.href"></td></tr>
                                      </form>';
                                
                                $id++;
                                $album_no++;
                            }
                          
                        }
                        echo'    </form>
                            </tbody>
                          </table>';
                      echo '<form action="../APIs/artist/AddSongOrAlbumConnection.php" method="post">
                              <input name = "add" type="submit" id="menu-style-invert" style=" border:1px orange; background-color: transparent;" value="+Add an album">
                            </form>';
                      echo '<form action="../APIs/artist/AddSongOrAlbumConnection.php" method="post">
                              <input name = "add" type="submit" id="menu-style-invert" style=" border:1px orange; background-color: transparent;" value="-Delete an album">
                            </form>';
                      if($_SESSION['add'] == 5)
                      {
                        if($_SESSION['notify'] == 1)
                        {
                          // echo "<script>alert('Album created successfully');</script>";
                          $_SESSION['add'] = 0;
                        }
                        if($_SESSION['notify'] == 2)
                        {
                          // echo "<script>alert('You already have this album!');</script>";
                          $_SESSION['add'] = 0;
                        }
                        $_SESSION['notify'] = 0;
                        
                        //need to display list of songs that are not listed in the selected album
                        // $song_query = searchSongByArtist($conn, $_SESSION['username']);
                        // $all_songs = $song_query->fetch_assoc();
                        // $album_query = searchSongsInAlbum($conn, $_SESSION['album_to_add']);
                        // $all_songs_in_album = $album_query->fetch_assoc();
                        // echo '<table class="table">
                        //       <thead>
                        //       <tr>
                        //           <th scope="col">#</th>
                        //           <th scope="col">Song</th>
                        //           <th scope="col">Album</th>
                        //           <th scope="col">Duration</th>
                        //       </tr>
                        //       </thead>
                        //       <tbody>';
                      }
                      else if($_SESSION['add'] == 2)
                      {
                        if($_SESSION['notify'] == 1)
                        {
                          echo "<script>alert('Album created successfully');</script>";
                          $_SESSION['add'] = 0;
                        }
                        if($_SESSION['notify'] == 2)
                        {
                          echo "<script>alert('You already have this album!');</script>";
                          $_SESSION['add'] = 0;
                        }
                        $_SESSION['notify'] = 0;
                        echo '<div class="col text-center">
                                <h3> Add an album!</h3>
                              </div>';
                        echo '<form action="../APIs/artist/CreateAlbumArtistConnection.php" method="post">

                                <!-- username field -->
                                <div class="form-group">
                                  <label for="exampleInputEmail1" >Album Name</label>
                                  <input name = "album_name" type="text" class="form-control" id="signupUsername" aria-describedby="signupUsernameHelp" placeholder="Enter album name">
                                </div>
            
                                <div class="form-group">
                                  <label for="exampleInputPassword1" >Date Created</label>
                                  <input name = "date_created" type="date" class="form-control" id="exampleInputPassword1" placeholder="Enter date">
                                </div>
            
                                
            
            
                                <!-- login button -->
                                <!-- TODO: login button functionality-->
                                <div class="col-md-8 col-12 mx-auto pt-5 text-center">
                                  <input type = "submit" class="btn btn-primary" role="button" aria-pressed="true" name = "button" value = "Create!" onclick="window.location.reload();">
                                </div>
                            </form>';
                            
                      }
                      else if($_SESSION['add'] == 4)
                      {
                        if($_SESSION['notify'] == 1)
                        {
                          echo "<script>alert('Album deleted successfully');</script>";
                          $_SESSION['add'] = 0;
                        }
                        if($_SESSION['notify'] == 2)
                        {
                          echo "<script>alert('Album not found');</script>";
                          $_SESSION['add'] = 0;
                        }
                        $_SESSION['notify'] = 0;
                        echo '<div class="col text-center">
                                <h3> Delete an album!</h3>
                              </div>';
                        echo '<form action="../APIs/artist/DeleteAlbumConnection.php" method="post">

                                <div class="form-group">
                                  <label for="exampleInputEmail1" >Album Name</label>
                                  <input name = "album_name" type="text" class="form-control" id="signupUsername" aria-describedby="signupUsernameHelp" placeholder="Enter album name">
                                </div>
                                <div class="col-md-8 col-12 mx-auto pt-5 text-center">
                                  <input type = "submit" class="btn btn-primary" role="button" aria-pressed="true" name = "button" value = "Delete!" onclick="window.location.reload();">
                                </div>
                              </form>';
                      }
                  }
                  //Post something
                  else if($_SESSION['display'] == 4)
                  {
                    $_SESSION['add'] = 0;
                  }
                  //Account page
                  else if($_SESSION['display'] == 5)
                  {
                    $_SESSION['add'] = 0;
                  }
                  //Settings
                  else if($_SESSION['display'] == 6)
                  {
                    $_SESSION['add'] = 0;
                  }
                ?>
                </div>
              <!-- header -->


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