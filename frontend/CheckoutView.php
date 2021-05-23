<?php
  session_start();
?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=divice-width, initial-scale=1.0">
  <title><?php echo $_SESSION['username'];?> Page</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <link rel="stylesheet" href="css/checkout.css" type="text/css">
  <link rel="stylesheet" href="css/default.css" type="text/css">
</head>
<body class="bg-dark">
    <header class="smart-scroll">
        <div class="container-xxl">
            <nav class="navbar navbar-expand-md navbar-dark bg-orange d-flex justify-content-between">
                <a id = "href-hover" style = "background: transparent;" class="navbar-brand" href="listener.php" onclick='window.location.reload();'>
                    HASSNER
                </a>
        </div>
    </header>
    <h1>Responsive Checkout Form</h1>
<div class="row">
  <div class="col-75">
    <div class="container">
      <form action="/action_page.php">
      
        <div class="row">
          <div class="col-50">
            <h3>Billing Address</h3>
            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="fname" name="firstname" placeholder="Full Name">
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email" placeholder="john@example.com">
            <label for="adr"><i class="fas fa-map-marker-alt"></i> Address</label>
            <input type="text" id="adr" name="address" placeholder="542 W. 15th Street">
            <label for="city"><i class="fas fa-location-arrow"></i> City</label>
            <input type="text" id="city" name="city" placeholder="New York">

            <div class="row">
              <div class="col-50">
                <label for="state"><i class="fas fa-archway"></i> State</label>
                <input type="text" id="state" name="state" placeholder="NY">
              </div>
              <div class="col-50">
                <label for="zip"><i class="fas fa-align-justify"></i> Zip</label>
                <input type="text" id="zip" name="zip" placeholder="10001">
              </div>
            </div>
          </div>

          <div class="col-50">
            <h3>Payment</h3>
            <label for="fname">Accepted Cards</label>
            <div class="icon-container">
              <i class="fab fa-cc-visa fa-2x"></i>
              <i class="fab fa-cc-amex fa-2x"></i>
              <i class="fab fa-cc-mastercard fa-2x"></i>
              <i class="fab fa-cc-paypal fa-2x"></i>
            </div>
            <label for="cname">Name on Card</label>
            <input type="text" id="cname" name="cardname" placeholder="John More Doe">
            <label for="ccnum">Credit card number</label>
            <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
            <label for="expmonth">Exp Month</label>
            <input type="text" id="expmonth" name="expmonth" placeholder="September">
            <div class="row">
              <div class="col-50">
                <label for="expyear">Exp Year</label>
                <input type="text" id="expyear" name="expyear" placeholder="2018">
              </div>
              <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="352">
              </div>
            </div>
          </div>
          
        </div>
        <label>
          <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
        </label>
        <input type="submit" value="Continue to checkout" class="btn btn-primary">
      </form>
    </div>
  </div>
  <div class="col-25">
    <div class="container">
      <h4 style="color: #ff9100;">Cart <span class="price" style="color:white;"><?php 
      echo "(q̶): ";
      echo $_SESSION['coins']; ?></b></span></h4>
      <p><a><?php echo $_SESSION['currency']; ?></a> <span class="price"><?php
      if($_SESSION['currency'] == "USD" || $_SESSION['currency'] == "CAD") 
        echo "$";
      else if($_SESSION['currency'] == "EURO")
        echo "€";
      echo$_SESSION['siliqas'];
      ?></span></p>
      <p><a>Fees (2%)</a> <span class="price"><?php 
      if($_SESSION['currency'] == "USD" || $_SESSION['currency'] == "CAD") 
        echo "$";
      else if($_SESSION['currency'] == "EURO")
        echo "€";
        $fees = $_SESSION['siliqas']*0.02;
        echo $fees;
      ?></span></p>
      <hr>
      <p>Total <span class="price" style="color: white;"><b><?php 
        if($_SESSION['currency'] == "USD" || $_SESSION['currency'] == "CAD") 
            echo "$";
        else if($_SESSION['currency'] == "EURO")
            echo "€";
        $total = $fees + $_SESSION['siliqas'];
        echo $total;
      ?></b></span></p>
    </div>
  </div>
</div>
<script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.7.3/feather.min.js"></script>
</body>