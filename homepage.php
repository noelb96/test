<?php
session_start();
?>
<html lang="en">
<head>
    <title>The Watch Shop LLC</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="css/homepageCss.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body style="background-image: url(background2.jpg); height:100%;">
<div class="top">

    <nav class="navbar navbar-inverse" role="navigation">
        <div class="container nopad">
            <div class="try"></div>
            <div><img src="logo_90x90%20px.png" height='80px' width="80px"  style="float: left; margin: 0 0 0 50px;" ></div>

            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a class="right" href="#">Home</a>
                    </li>
                    <li>
                        <a class="right" href="sellpage.php">Sell your watch</a>
                    </li>
                    <li>
                        <a class="right" href="tradepage.php">Watch trading</a>
                    </li>
                    <li>
                        <a class="right" href="allWatch.php">Watch for sale</a>
                    </li>
                    <li>
                        <a class="right" href="show_testimonials.php">Testimonials</a>
                    </li>
                    <li>
                        <a class="right" href="#Contact">Contact</a>
                    </li>
                    <?php if (isset($_SESSION['userId'])){
                        echo "  <li>
                        <a class=\"right\" href=\"logout.php\">Logout</a>
                    </li>";
                    }else{echo "  <li>
                        <a class=\"right\" href=\"login.php\">Log in</a>
                    </li>";}
                    ?>
                </ul>
            </div>


        </div>

    </nav>
</div>

<div class="container main fill">

    <div class="row">
        <a href="sellpage.php">
            <div class="col-lg-3 col-md-3 col-sm-6 selection fill" id="col-1">
                <div>Sell</div>
                <div>Your Watch</div>
                <div><img class="images" src="marker.png"/></div>
            </div>
        </a>
        <a href="tradepage.php">
            <div class="col-lg-3 col-md-3 col-sm-6 selection  fill " id="col-2">
                <div>Watch</div>
                <div>TRADING</div>
                <div><img class="images" src="marker.png"/></div>

            </div>
        </a>
        <a href="allWatch.php">
            <div class="col-lg-3 col-md-3 col-sm-6 selection  fill" id="col-3">
                <div>Watches</div>
                <div>for SALE</div>
                <div><img class="images" src="marker.png"/></div>
            </div>
        </a>
        <a href="show_testimonials.php">
            <div class="col-lg-3 col-md-3 col-sm-6 selection  fill" id="col-4">
                <div>TESTIMONIALS</div>
                <div>&amp Reviews</div>
                <div><img class="images" src="marker.png"/></div>
            </div>
        </a>
    </div>
</div>

</body>


<footer>
    <a name="Contact"></a>
    <?php
    include('footer.php');
    ?>

</footer>
</html>
