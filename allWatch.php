<?php
session_start();


function showWatch(){

$servername = "162.241.244.59";
$username = "thewatm9_eni";
$password = "Polo1951,,,";
$dbname = "thewatm9_main";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
    if (isset($_SESSION['watchIdArray']))
    {
        $cartArray = $_SESSION['watchIdArray'];

        if (isset($cartArray)) {
            $cartArray = array_unique($cartArray);
//            print_r($cartArray);
            foreach ($cartArray as $key => $value) {
//                echo $value;


            }
        }
    }

    $i=0;



    // Create connection


    $sql = "SELECT watchId ,watchImage, watchName, watchDescription, watchPrice, watchAmount FROM watchForSale";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {

            $watchId = $row['watchId'];

            echo "<center><div class=\"col-lg-3 col-md-3 col-sm-6\">
                <a href='produkti.php?watchId=".$row["watchId"]."'> <img src=".$row["watchImage"]." style='margin: 50px 10px 10px 10px;width: 200px; height: 200px;'/></a><br/>
                ".$row['watchName']."<br/>
                ".$row['watchDescription']."<br/>
                Price ".$row['watchPrice']."$ <br/><br/>
                <button class='button$i' value='$i' onclick='cartAjax($i, $watchId)' name='addCart'>Add to cart</button>
                ";
            $i++;
            echo "</div>
           </center>
           ";
        }
    } else {
        echo "0 results";
    }
    $conn->close();
}
?>
<html>
<head>
<!--   nuk njef fare scriptin si ajax.. hutohet qe te $ po a e ke linkun e jquery e kam.. po e kam posht....../-->
    <title>The Watch Shop LLC</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="css/lista.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script>
      function cartAjax(inc,id) {
          console.log(inc);
          console.log(id);
      //    var i=document.getElementsByClassName('button'+inc).val();
            //console.log(i);
            $.ajax({
                type: "POST",
                url: "cart.php",
                data: { i: inc ,
                id:id
                }
            }).done(function( msg ) {
               $('#addToCartDiv').html(msg);
               // alert( "Data Saved: " + msg );
            });
        }
    </script>

</head>
<body>
<div class="top">
    <!-- Navigation -->
    <nav class="navbar navbar-inverse" role="navigation">
        <div class="container nopad">
            <div class="try"></div>
            <div><img src="logo_90x90%20px.png" height='80px' width="80px"  style="float: left; margin: 0 0 0 50px;" ></div>
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
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
            <!-- /.navbar-collapse -->
        </div>

        <!-- /.container -->
    </nav>
</div>

<div class="container main fill">
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

    $msg = "";
    if (isset($_SESSION['watchIdArray'])) {
        $cartArray = $_SESSION['watchIdArray'];
        $cartArray = array_unique($cartArray);
        if (count($cartArray) == 0) {
            $msg = "You have not selected any items";
            echo $msg;
        } else {


            foreach ($cartArray as $key => $value) {

                $sql = "SELECT * FROM watchForSale WHERE watchId =" . $value;
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
// output data of each row
                    while ($row = $result->fetch_assoc()) {
                        $watchId = $row['watchId'];
                        $watchName = $row['watchName'];
                        $watchImage = $row['watchImage'];

                        echo "<p><a href='produkti.php?watchId=$watchId'><img src=\"$watchImage\" style='width: 50px; height: 50px; margin-left: 1%; margin-right: 5%;'/></a> $watchName <a href='removeCartElement.php?&key=$key' style='float: right;;'><button type=\"button\" class=\"close\">&times;</button></a></p>";

                    }
                }


            }
        }
    }
    echo "</div>
            <div class=\"modal-footer\">
            <a href='clearCart.php' style='float: left;'><button type=\"button\" class=\"btn btn-default\">Clear cart</button></a>
                <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>
            </div>
        </div>

    </div>
</div>";
    ?>
    <div>
        <div class="col-lg-3 col-md-3 col-sm-3 ">
            <h2>Brands we buy</h2>
            <br/>
            <ul style="list-style-type: none">
                <li>Paner</li>
                <hr/>
                <li>Rolex</li>
                <hr/>
                <li>Audemars Piguet</li>
                <hr/>
                <li>Hublot</li>
                <hr/>
                <li>Breitling</li>
                <hr/>
                <li>Omega</li>
                <hr/>
                <li>Cartier</li>
                <hr/>
                <li>IWC</li>
                <hr/>
            </ul>
        </div>


        <div class="col-lg-9 col-md-9 col-sm-6 fill">


            <button id='myBtn' class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"> Shopping Bag </button>
            <?php
            showWatch();

            ?>

            <div id="addToCartDiv"></div>
        </div>

    </div>
</div>


</body>
<footer style="height:220px;">

    <?php include 'footer.php' ?>
</footer>

</html>


