<?php
  session_start();
?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=divice-width, initial-scale=1.0">
  <title><?php echo $_SESSION['username'];?> Page</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <link rel="stylesheet" href="css/app.css" type="text/css">
  <link rel="stylesheet" href="css/default.css" type="text/css">
</head>
<body>
    <header class="smart-scroll">
        <div class="container-xxl">
            <nav class="navbar navbar-expand-md navbar-dark bg-orange d-flex justify-content-between">
                <a id = "href-hover" style = "background: transparent;" class="navbar-brand" href="listener.php" onclick='window.location.reload();'>
                    HASSNER
                </a>
        </div>
    </header>
  <main>
    <section class="top-card">
      <img src="Images/account.png" alt="user picture">
      <div class="menu-icon">
        <div class="menu item1"></div>
        <div class="menu item2"></div>
      </div>
      <div class="name">
        <p><?php echo $_SESSION['username'];?></p>
      </div>
    </section>

    <section class="middle-card">
      <h1 class="fade-in-text" id="h1-sm">About</h1>
      <p>Write Something.</p>
    </section>
    <section class="middle-card">
      <h1 class="fade-in-text" id="h1-sm">Email Address</h1>
      <p style="color: #ff9100"><?php 
        include '../APIs/logic.php';
        include '../APIs/connection.php';
        $conn = connect();
        $result = searchAccount($conn, $_SESSION['username']);
        $account_info = $result->fetch_assoc();
        $chars = str_split($account_info['email']);
        echo '<p>';
        $i = 0;
        foreach($chars as $char)
        {
          if($i == 0 || $i == sizeof($chars)-1)
            echo $char;
          else
           echo '*';
          $i++;
        }
        echo '</p>';
      ?><a href="../APIs/EditEmail.php" id="icon-btn"><i class="fa fa-edit"></i></a>
      <?php
      if($_SESSION['edit'] == 2)
      {
        echo '<form action="../APIs/EditEmailConnection.php" method="post">';
        echo '<div class="form-group">
          <input type="text" name = "email_edit" class="form-control form-control-sm" style="border-color: white;" id="signupUsername" aria-describedby="signupUsernameHelp" placeholder="Enter new email address">
        </div>';
        echo '<div class="col-md-8 col-12 mx-auto pt-5 text-center">
        <input type = "submit" class="my_btn edit-btn" role="button" aria-pressed="true" name = "button" value = "Save">  
    </div>';
        echo '</form>';
      }
      ?>
    </section>
    <section class="middle-card">
      <h1 class="fade-in-text" id="h1-sm">Country/Region</h1>
      <p>Canada</p>
    </section>
    <section class="middle-card">
      <h1 class="fade-in-text" id="h1-sm">Username</h1>
      <p><?php echo $_SESSION['username'];?></p>
    </section>
    <section class="middle-card">
      <h1 class="fade-in-text" id="h1-sm">Password</h1>
      <p><?php 
        $chars = str_split($account_info['password']);
        echo '<p>';
        $i = 0;
        foreach($chars as $char)
        {
          if($i == 0 || $i == sizeof($chars)-1)
            echo $char;
          else
           echo '*';
          $i++;
        }
        echo '</p>';
      ?> <a href="../APIs/EditPassword.php" id="icon-btn"><i class="fa fa-edit"></i></a>
      <?php
      if($_SESSION['edit'] == 1)
      {
        echo '<form action="../APIs/EditPasswordConnection.php" method="post">';
        echo '<div class="form-group">
          <input type="password" name = "pwd_edit" class="form-control form-control-sm" style="border-color: white;" id="signupUsername" aria-describedby="signupUsernameHelp" placeholder="Enter new password">
        </div>';
        echo '<div class="col-md-8 col-12 mx-auto pt-5 text-center">
        <input type = "submit" class="my_btn edit-btn" role="button" aria-pressed="true" name = "button" value = "Save">  
    </div>';
        echo '</form>';
      }
      
      ?>
    </section>

    <footer>
      <h1 class="fade-in-text" id="h1-sm">Contact</h1>
      <a href="#" class="social-icon facebook"><i class="fab fa-facebook-f"></i></a>
      <a href="#" class="social-icon twitter"><i class="fab fa-twitter"></i></a>
      <a href="#" class="social-icon google"><i class="fab fa-google"></i></a>
      <a href="#" class="social-icon github"><i class="fab fa-github"></i></a>
      <a href="#" class="social-icon linkedin"><i class="fab fa-linkedin"></i></a>

      <section class="links">
        <address>By: <a href="https://github.com/Jean-carje" target="_blank">Jean Estevez</a></address>
        <address>Image by: <a href="https://pixabay.com/es/users/pexels-2286921/">Pexels</a></address>
      </section>
    </footer>
  </main>
<script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
</body>