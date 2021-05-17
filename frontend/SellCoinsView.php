<?php
  session_start();
  $_SESSION['conversion_rate'];
  $_SESSION['notify'];

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

<?php
  if($_SESSION['notify'] == 1)
    echo "<script>alert('Coins sold successfully');</script>";
  if($_SESSION['notify'] == 2)
    echo "<script>alert('Failed to sell coins');</script>";
  $_SESSION['notify'] = 0;
?>

<!--navigation-->
<section class="smart-scroll">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-md navbar-dark">
            <a class="navbar-brand heading-black" href="listener.php">
                Hassner
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
              

              <!-- hyperlinks -->
                <form action = "../APIs/SellCoinsConnection.php" method = "post">
                    <div class="form-group">
                        <h5>How many coins are you selling?</h5>
                        <input type="text" name = "coins" class="form-control form-control-sm" id="signupUsername" aria-describedby="signupUsernameHelp" placeholder="Enter coins">
                        </div>
                    <div style = "position: absolute;right: 450px; top:100px;" class="navbar-light bg-dark" class="col-md-8 col-12 mx-auto pt-5 text-center">
                            <input type = "submit" class="btn btn-primary" role="button" aria-pressed="true" name = "button" value = "Check Conversion" onclick='window.location.reload();'>
                        
                    </div>
                </form>
                <p style = "position: absolute;right:510px; top:180px;" class="navbar navbar-expand-lg navbar-light bg-dark">CAD: 
                    <?php
                        if($_SESSION['cad']!=0)
                        {
                            echo "$";
                            echo " ";
                            echo $_SESSION['cad'];
                        }
                        else
                        {
                            echo "$";
                            echo " ";
                            echo 0;
                        }
                        
                    ?>
                </p>
                </form>
                <form action = "../APIs/WithdrawCoinsConnection.php" method = "post">
                    <div style = "position: absolute;right: 450px; top:300px;" class="navbar-light bg-dark" class="col-md-8 col-12 mx-auto pt-5 text-center">
                            <input type = "submit" class="btn btn-primary" role="button" aria-pressed="true" name = "button" value = "Sell this amount!" onclick='window.location.reload();'>
                        
                    </div>
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