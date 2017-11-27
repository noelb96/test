<?php
session_start();

function showWatchById()
{
    $servername = "162.241.244.59";
    $username = "thewatm9_eni";
    $password = "Polo1951,,,";
    $dbname = "thewatm9_main";
    if (isset($_GET['watchId'])) {
// Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM watchForSale WHERE watchId =" . $_GET['watchId'];
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $pic = $row['watchImage'];
                echo "
    <div class=\"bcontainer main fill sell\">
    <img  class=\"foto_produktit\" src=\"$pic\" alt=\"Omega Watch\" style='height=\"460px\" width=\"460px\"' >
    <img  class=\"cart\" src=\"image/cart.png\">
    <div class=\"pershkrimi\">
    <p> " . $row['watchName'] . " </p>
    <p class=\"model_nr\"> " . $row['modelNo'] . "</p>
    <p class=\"cmimi\"> $" . $row['watchPrice'] . " </p>
    <a href=\"choose_payment.php?watchId=" . $row["watchId"] . "\"><button class=\"button\" type=\"button\"> Purchase </button></a>
     <a href='inquire.php?watchId=" . $row["watchId"] . "'><button class=\"button2\" type=\"button\"> Make an Offer </button></a> 
    <button id='myBtn' class=\"button3\" type=\"button\" data-toggle=\"modal\" data-target=\"#myModal\"> Add to Shopping Bag </button>
   </div>
   <div  style='padding-left=\"50px\"'>
   <h3 style='padding-left=\"50px\"'>About the Watch</h3>
      <p class=\"aboutwatch\">" . $row['aboutwatch'] . "</p>
      </div>
            <div class=\"container mail fill\">
            

            </div>
            <ul class=\"items-data\" style=\"list-style-type: none\">
            <h3>Specifications</h3>
           <li>
            <span>Collection:</span>
            <span class=\"data-field\">" . $row['specCollections'] . " </span> </li>

             <li>
            <span>Condition:</span>
            <span class=\"data-field\">" . $row['specCondition'] . " </span> </li>

            <li>
            <span>Brand:</span>
            <span class=\"data-field\">" . $row['specBrand'] . "</span> </li>

            <li>
            <span>Movement:</span>
            <span class=\"data-field\">" . $row['specMovement'] . "</span> </li>

            <li>
            <span>Water Resistance:</span>
            <span class=\"data-field\">" . $row['specWaterRes'] . "</span> </li>

            <li>
            <span>Gender:</span>
            <span class=\"data-field\">" . $row['specGender'] . "</span> </li>

            <li>
            <span>Warranty:</span>
            <span class=\"data-field\">" . $row['specWarranty'] . "</span> </li>

        </ul>

    <!--   COLORS  -->

        <ul class=\"items-data\" style=\"list-style-type: none\">
            <h3>Colors</h3>
            <li>
                 <span>Dial Color: </span>
                 <span class=\"data-field\">" . $row['colorDial'] . "</span> </li>

            <li>
                <span>Strap Color: </span>
                <span class=\"data-field\">" . $row['colorStrap'] . "</span>
            </li>
        <br/>

    <!--    MATERIALS  -->


            <h3>Materials</h3>
            <li>
                <span>Case Type</span>
                <span class=\"data-field\">" . $row['materialCase'] . "</span>
            </li>

            <li>
                <span>Band Type</span>
                <span class=\"data-field\">" . $row['materialBand'] . "</span>
            </li>

        </ul>
        <!--     PRODUCTION CODES-->

        <ul class=\"items-data\" style=\"list-style-type: none\">
            <h3>Production Codes</h3>
            <li>
                <span>ID Code: </span>
                <span class=\"data-field\">" . $row['productionId'] . "</span>
            </li>
             <li>
                <span>Model No. : </span>
                <span class=\"data-field\">" . $row['modelNo'] . "</span>
            </li>

        </ul>
        </div>
           </body>
";
            }
        } else {
            echo "0 results";
        }
        $conn->close();

    } else {
        echo "You have not selected any watch or an error occurred";
    }
}

?>
<html>
<head>
    <title>The Watch Shop LLC</title>
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
    <!-- Navigation -->
    <nav class="navbar navbar-inverse" role="navigation">
        <div class="container nopad">
            <div class="try"></div>
            <div><img src="logo250.png" height="80px" width="80px" style="float: left; margin-left: 50px;"></div>
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a class="right" href="homepage.php">Home</a>
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
                        <a class="right" href="#">Contact</a>
                    </li>
                    <?php if (isset($_SESSION['userId'])) {
                        echo "  <li>
                        <a class=\"right\" href=\"logout.php\">Logout</a>
                    </li>";
                    } else {
                        echo "  <li>
                        <a class=\"right\" href=\"login.php\">Log in</a>
                    </li>";
                    }
                    ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>

    </nav>

</div>
<?php

$test = "null";
$watchName = "null";
$watchImage = "null";


$servername = "162.241.244.59";
$username = "thewatm9_eni";
$password = "Polo1951,,,";
$dbname = "thewatm9_main";


$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



echo "<div class=\"modal fade\" id=\"myModal\" role=\"dialog\">
    <div class=\"modal-dialog\">

        <!-- Modal content-->
        <div class=\"modal-content\">
            <div class=\"modal-header\">
                <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                <h4 class=\"modal-title\">Your Cart</h4>
            </div>
            <div class=\"modal-body\">";

if (isset($_SESSION['watchIdArray'])) {
    $cartArray = $_SESSION['watchIdArray'];
    $cartArray = array_unique($cartArray);
    foreach ($cartArray as $key => $value) {

        $sql = "SELECT * FROM watchForSale WHERE watchId =" . $value;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
// output data of each row
            while ($row = $result->fetch_assoc()) {
                $watchName = $row['watchName'];
                $watchImage = $row['watchImage'];

                echo "<p> $watchName <img src=\"$watchImage\" style='width: 50px; height: 50px';/></p>";
            }
        }


    }
}
            echo "</div>
            <div class=\"modal-footer\">
                <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>
            </div>
        </div>

    </div>
</div>";

?>

<?php showWatchById(); ?>

</html>