<?php
session_start();
function showTestiomonals(){

$servername = "162.241.244.59";
$username = "thewatm9_eni";
$password = "Polo1951,,,";
$dbname = "thewatm9_main";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT testimonialsTitle, testimonialsSummary, fullname, testimonialsCountry FROM testimonials";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "
<center>
        <div class=\"viewbox\">
            <h3>".$row['testimonialsTitle']."</h3> <br/> <br/>
            <p class=\"paragraf\">
                <img class=\"quotation1\" src=\"image/quotation_mark.png\" height=\"20px\" width=\"20px\">
                ".$row['testimonialsSummary']."
                <img class=\"quotation2\" src=\"image/quotation_mark2.png\" height=\"20px\" width=\"20px\">
            </p>
            <div class=\"rreshti_fundit\"> ¬".$row['fullname']." from ".$row['testimonialsCountry']." ¬ </div>
            <br/>
        </div>
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
    <title>The Watch Shop LLC</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="css/testimonials.css" rel="stylesheet">

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
            <div><img src="logo_90x90%20px.png" height="80px" width="80px"  style="float: left; margin-left: 50px;" ></div>
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

    </nav>

</div>
<div class="container main fill sell" style=" padding-left:0; padding-right:0;">
    <section class="testimonials_frame">
        <h2>Customer Testimonials </h2> <br/>

        <div class="mark">
            <a href="testimonials.php"><img src="image/leave.png" height="110px" width="130"></a>
        </div>
    <?php
    /**
     * Created by PhpStorm.
     * User: bezhani
     * Date: 24/10/2017
     * Time: 09:36
     */
    showTestiomonals();
    ?>



    </section>

<!--/container-->
</div>
</body>

<footer>
    <?php include "footer.php"?>
</footer>
</html>
