<?php
session_start();
$error = "";

if (isset($_SESSION['userId']))
{

if (isset($_REQUEST['submit'])) {


    $servername = "162.241.244.59";
    $username = "thewatm9_eni";
    $password = "Polo1951,,,";
    $dbname = "thewatm9_main";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
// set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// prepare sql and bind parameters
        $stmt = $conn->query("SELECT * FROM user WHERE -1");


        $uname = $_REQUEST['username'];
        $pass = $_REQUEST['password'];


        foreach ($stmt as $rows) {

           $user = $rows['username'];
           $passQuery = $rows['password'];

           if ($user == $uname && $passQuery == md5($pass)) {
               $_SESSION['userId'] = $rows['userId'];
               header("Location: homepage.php");
               $error = "logged"; //redirect to homepage and open session
           }else
               {
                   $error = "not logged"; //re-enter data
               }


//            if ($user == $_REQUEST['username'] && $passQuery == $_REQUEST['password']) {
//                $error = "logged";
//            }else{
//                $error = "not logged";
//            }
        }


    } catch (PDOException $e) {
        $error = "Error: " . $e->getMessage();
    }
    $conn = null;
}
}else
    {
        header("Location: homepage.php");
    }
?>
<html>
<head> <title>The Watch Shop LLC</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="css/homepageCss.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body style="background-color: white;">
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
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>

        <!-- /.container -->
    </nav>
</div>
<div class="container main fill" style="margin-top: 100px;">



    <div class="col-lg-4 col-md-4 col-sm-6 "></div>



    <div class="col-lg-4 col-md-4 col-sm-6" style="margin-top: 5%">

        <form method="post" action="login.php">
            <table>
                <tr><td>Username </td><td><input type="text" name="username"/></td></tr>
                <tr><td>Password </td><td><input type="password" name="password"/></td></tr>

                <tr><td colspan="2"><input type="submit" value="submit" name="submit"></td></tr>
            </table>
        </form>

        <?php echo $error?>
    </div>


    <div class="col-lg-4 col-md-4 col-sm-6"></div>

</div>

</body>
</html>

