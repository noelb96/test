<?php
session_start();


function sellWatchFromCart()
{

    $sum = 0;

    $servername = "162.241.244.59";
    $username = "thewatm9_eni";
    $password = "Polo1951,,,";
    $dbname = "thewatm9_main";


    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        echo("Connection failed: " . $conn->connect_error);
    }

    $msg = "";
    $item = "";
    if (isset($_SESSION['watchIdArray'])) {
        $cartArray = $_SESSION['watchIdArray'];
        $cartArray = array_unique($cartArray);
        if (count($cartArray) == 0) {
            $msg = "You have not selected any items";
            echo $msg;
        } else {

            $size = count($cartArray);
            if ($size == 1){ $item = "Item"; }
            else{ $item = count($cartArray)." items"; }

            echo "<div class=\"col-lg-6 col-md-6 col-sm-6\">";

            echo "<table style='width: 100%;'><tr style='background-color: black; color: white; height: 25px;'><td colspan='1'>$item</td><td colspan='2'>Model No</td><td></td><td colspan='4'>Product</td><td></td><td></td><td></td><td></td>  <td colspan='1'>Price</td><td colspan='1'></td></tr>";
            foreach ($cartArray as $key => $value) {

                $stmt = $conn->prepare('SELECT * FROM watchForSale WHERE watchId = ?');
                $stmt->bind_param('s', $value);

                $stmt->execute();

                $result = $stmt->get_result();

                if ($result->num_rows > 0) {

                    while ($row = $result->fetch_assoc()) {
                        $watchId = $row['watchId'];
                        $modelNo = $row['modelNo'];
                        $watchName = $row['watchName'];
                        $watchImage = $row['watchImage'];
                        $watchPrice = $row['watchPrice'];

                        $sum += $watchPrice;


                        echo "<tr style='border: 2px solid black'><td><a href='produkti.php?watchId=$watchId'><img src=\"$watchImage\" style='width: 50px; height: 50px; margin-left: 1%; margin-right: 5%;'/></a></td><td colspan='2'>$modelNo</td><td></td> <td colspan='4'>$watchName</td><td></td><td></td><td></td><td></td>  <td>$watchPrice</td> <td><a href='removeCartElement.php?&key=$key' style='float: right;;'></td></tr>";

                    }


                }

            }

            echo "
</table></div>";
            echo "<div class=\"col-lg-3 col-md-3 col-sm-6\"><table>
            <tr>
                <td>Summary</td>

            </tr>

            <tbody>
            <tr>
<td>Subtotal: $sum</td>
            </tr>
            </tbody>
        </table>
        
    <a href=\"choose_payment.php?watchId=" . $watchId . "\"><button class=\"button\" type=\"button\"> Purchase </button></a>
    </div>";

        }
    }
}

?>
<html>
<head>
    <title>The Watch Shop LLC</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        ul.nav{
            float: right;
            position: relative;
        }
        .right{
            margin-right:10px;
            margin-top: 15px;
        }

        td
        {
            margin: 10px;
            font-size: 15px;
        }


        @media screen and (max-width: 768px) {

            .navbar .navbar-collapse{
                float: left;
                margin-left: 5px;
            }
            .row img{
                float: right;
            }
        }
    </style>
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
<div class="container">
    <div class="col-lg-1 col-md-1 col-sm-0">

    </div>


        <?php sellWatchFromCart();?>


    <div class="col-lg-1 col-md-1 col-sm-0">

    </div>


</div>


</body>
</html>
