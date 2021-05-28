<?php
    session_start();
    $_SESSION['add'] = $_POST['add'];
    if($_SESSION['add'] == "+Add a song")
        $_SESSION['add'] = 1;
    else if($_SESSION['add'] == "+Add an album")
        $_SESSION['add'] = 2;
    else if($_SESSION['add'] == "-Delete a song")
        $_SESSION['add'] = 3;
    else if($_SESSION['add'] == "-Delete an album")
        $_SESSION['add'] = 4;
    header("Location: ../../frontend/artist.php");
?>