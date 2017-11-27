<?php
include_once ("send.php");

session_start();
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

    $name = $row['watchName'];
    $modelno = $row['modelNo'];
}
}
}else{
    header("Location: allWatch.php");
}
if (isset($_REQUEST['submit']))
{
    $fullname = $_REQUEST['name'];
    $offer = $_REQUEST['offer'];
    $email = $_REQUEST['email'];
    $country = $_REQUEST['country'];
    $phone = $_REQUEST['phone'];
    $payment = $_REQUEST['payment'];

//    sendMail($email, $name, $offer, $phone);
    mail($email, "Enquiry for ".$name, $fullname." ".$offer, 'From: "Noel Boci" <noelboci.nb@gmail.com>');
}

?>
<html>
<head>
    <title>The Watch Shop LLC</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="css/inquire.css" rel="stylesheet">

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
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>

    </nav>
</div>

<div class="container main fill sell">
    <div class="col-lg-5 col-md-5 col-sm-5 fill">
    <img  class="foto_produktit" src="image/omega.png" alt="Omega Watch" style='height="460px" width="460px"' >
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 fill" style="margin-left:70px;">

        <div class="pershkrimi">
            <p> <?=$name;?></p>
            <p class="model_nr"> <?=$modelno?></p>
        </div>

        <form action="inquire.php?watchId=<?=$_GET['watchId']?>" method="post" id="forma">
            <h3>Fill the required information and tell us your offer</h3>
            <div class="table_container">
            <table>
                <tr>
                    <td><input type="text" name="name" Placeholder=" Name Surname *" required></td>
                    <td><input type="text" name="offer" Placeholder=" Your Offer *" required></td>
                </tr>
                <tr>
                    <td><input type="text" name="email" Placeholder=" Email *" required></td>
                    <td><input type="text" name="country" Placeholder=" Country *" required></td>
                </tr>
                <tr>
                    <td><input type="text" name="phone" Placeholder=" Phone *" required></td>
                    <td><input type="text" name="payment" Placeholder=" Payment *" required></td>
                </tr>


            </table>


                <input type="submit" name="submit" class="button" type="button"/>
             </div>
        </form>

    </div>

    </div>
</body>


<footer>
    <?php include 'footer.php'?>
</footer>

</html>