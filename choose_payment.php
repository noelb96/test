<?php
session_start();
?>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="css/produkti.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
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

</body>

<?php
$servername = "162.241.244.59";
$username = "thewatm9_eni";
$password = "Polo1951,,,";
$dbname = "thewatm9_main";

if (isset($_SESSION['watchIdArray'])) {
    $cartArray = $_SESSION['watchIdArray'];
    $cartArray = array_unique($cartArray);
    if (count($cartArray) == 0) {
        $msg = "You have not selected any items";
        echo $msg;
    } else {

        $servername = "162.241.244.59";
        $username = "thewatm9_eni";
        $password = "Polo1951,,,";
        $dbname = "thewatm9_main";


        $price = 0;

        $conn = new mysqli($servername, $username, $password, $dbname);


        echo "<div class=\"bcontainer main fill sell\">";
        foreach ($cartArray as $key => $value) {

            $stmt = $conn->prepare('SELECT * FROM watchForSale WHERE watchId = ?');
            $stmt->bind_param('s', $value);

            $stmt->execute();

            $result = $stmt->get_result();

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {

                    $watchId = $row['watchId'];
                    $price += $row['watchPrice'];
                    $_SESSION['price'] = $price;


                    echo "<div class='col-lg-3 col-md-3 col-sm-6'>
    <img  class=\"foto_produktit\" src=\"image/omega.png\" alt=\"Omega Watch\" style='height=\"460px\" width=\"460px\"' >
    <div class=\"pershkrimi\">
    <p> ".$row['watchName']." </p>
    <p class=\"model_nr\"> ".$row['modelNo']."</p>
    <p class=\"cmimi\"> $".$row['watchPrice']." </p>
    </div>
    </div>";
                }

                }
        }
                echo " <a href=\"#\"><button class=\"button\"> Buy by PayPal </button></a>
                    <a href=\"payment/charge-credit-card.php\"><button class=\"button\">Buy by Credit Card</button ></a></div>";

    }
}else if (isset($_GET['watchId'])) {
    $watchId = $_GET['watchId'];

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        echo("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare('SELECT * FROM watchForSale WHERE watchId = ?');
    $stmt->bind_param('s', $watchId);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {

            $watchId = $_GET['watchId'];
            $_SESSION['price'] = $row['watchPrice'];


            echo "<center>
    <div class=\"bcontainer main fill sell\">
    <img  class=\"foto_produktit\" src=\"image/omega.png\" alt=\"Omega Watch\" style='height=\"460px\" width=\"460px\"' >
    <div class=\"pershkrimi\">
    <p> ".$row['watchName']." </p>
    <p class=\"model_nr\"> ".$row['modelNo']."</p>
    <p class=\"cmimi\"> $".$row['watchPrice']." </p>
     <a href=\"#\"><button class=\"button\" type=\"button\"> Buy by PayPal </button></a>
     <a href=\"payment/charge-credit-card.php?watchId=$watchId\"><button class=\"button\" type=\"button\"> Buy by Credit Card </button></a>
    </div>
    </div>
        </center>   
           ";
        }
    } else {
        echo "0 results";
    }
    $conn->close();

} else {
    echo "You have not selected any watch or an error occurred";
}
?>
</html>
