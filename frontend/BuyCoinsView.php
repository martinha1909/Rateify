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

    <!-- Bootstrap CSS / Color Scheme -->
    <link rel="stylesheet" href="css/default.css" id="theme-color">
</head>
<body>

<?php
  if($_SESSION['notify'] == 1)
    echo "<script>alert('Coins bought successfully');</script>";
  if($_SESSION['notify'] == 2)
    echo "<script>alert('Card verfication failed');</script>";
  $_SESSION['notify'] = 0;
?>

<!--navigation-->
<section class="smart-scroll">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-md navbar-dark bg-orange">
            <a class="navbar-brand heading-black" href="listener.php" style = "color: white;">
                Hassner
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
<section class="py-7 py-md-0 bg-dark" id="login">
    <div class="container">
        <div class="row vh-md-100">
            <div class="col-12 mx-auto my-auto text-center">
            <p class="navbar-light">Account Balance</p>
            <p>
                <?php
                    include '../APIs/logic.php';
                    include '../APIs/connection.php';
                    $conn = connect();
                    $result = getUserBalance($conn, $_SESSION['username']);
                    $balance = $result->fetch_assoc();
                    echo "Siliqas: ";
                    echo number_format((float)$balance['balance'], 2, '.', '');
                ?>
            </p>
            <p class="navbar-light">Current Rate</p>
            <p>
                <?php
                    if($_SESSION['conversion_rate'] > 0)
                        echo "+";
                    // else if($_SESSION['conversion_rate'] < 0)
                    //     echo "-";
                    echo $_SESSION['conversion_rate'];
                    echo "%";
                ?>
            </p>

                <form action = "../APIs/BuyCoinsConnection.php" method = "post">
                    <div class="form-group">
                        <h5>Enter Amount in Canadian Dollars</h5>
                        <input type="text" name = "cad" class="form-control form-control-sm" id="signupUsername" aria-describedby="signupUsernameHelp" placeholder="Enter cad">
                        </div>
                    <div class="navbar-light bg-dark" class="col-md-8 col-12 mx-auto pt-5 text-center">
                            <input type = "submit" class="btn btn-primary" role="button" aria-pressed="true" name = "button" value = "Check Conversion" onclick='window.location.reload();'>
                        
                    </div>
                </form>
                <p class="navbar navbar-expand-lg navbar-light bg-dark">Siliqas (q̶): 
                    <?php
                        if($_SESSION['coins']!=0)
                        {
                            echo $_SESSION['coins'];
                        }
                        else
                        {
                            echo " ";
                            echo 0;
                        }
                        
                    ?>
                </p>
                </form>
                <form action = "CardVerificationView.php" method = "post">
                    <div class="navbar-light bg-dark" class="col-md-8 col-12 mx-auto pt-5 text-center">
                            <input type = "submit" class="btn btn-primary" role="button" aria-pressed="true" name = "button" value = "Buy this amount!" onclick='window.location.reload();'>
                        
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