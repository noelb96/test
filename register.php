<?php
$error = "";
$uname = "";
$firstname = "";
$lastname = "";
$email = "";
$address = "";

$servername = "162.241.244.59";
$username = "thewatm9_eni";
$password = "Polo1951,,,";
$dbname = "thewatm9_main";

if (isset($_REQUEST['submit'])) {

    try {

        //regex for password username and email

        $uname = $_REQUEST['username'];
        $pass = $_REQUEST['password'];
        $confpass = $_REQUEST['confpass'];
        $firstname = $_REQUEST['firstname'];
        $lastname = $_REQUEST['lastname'];
        $email = $_REQUEST['email'];
        $address = $_REQUEST['address'];

        if ($firstname == "" || $lastname == "" || $email == "" || $pass == "" || $confpass == "" || $uname == "" || $address == "") {
            $error .= "Please fill out all the fields.<br/>";
        } else {

            $uppercasePass = preg_match('@[A-Z]@', $pass);
            $lowercasePass = preg_match('@[a-z]@', $pass);
            $numberPass = preg_match('@[0-9]@', $pass);
            $lenPass = strlen($pass);
            $lowercaseUsername = preg_match('@[a-z]@', $uname);

            if (!$uppercasePass || !$lowercasePass || !$numberPass || $lenPass < 8) {
                $error .= "Password must be longer than 8 characters, must contain at least one upper case, one lower case and a numeric.<br/>";
            } else {
                if (!$lowercaseUsername) {
                    $error .= "Username must contain only lower case characters.<br/>";
                } else {

                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $error .= "Invalid email.<br/>";

                    } else {

                        if ($pass == $confpass) {

                            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                            // set the PDO error mode to exception
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $pass = md5($pass);
                            // prepare sql and bind parameters
                            $stmt = $conn->prepare("INSERT INTO user (username, password, firstname, lastname, email, address) VALUES (:username, :password, :firstname, :lastname, :email, :address)");

                            $stmt->bindParam(':username', $uname);
                            $stmt->bindParam(':password', $pass);
                            $stmt->bindParam(':firstname', $firstname);
                            $stmt->bindParam(':lastname', $lastname);
                            $stmt->bindParam(':email', $email);
                            $stmt->bindParam(':address', $address);

                            $stmt->execute();
                        } else {
                            $error = "Your password did not match";
                        }

                        if ($error == "" || $error == null)
                        {
                            header("Location: login.php");
                        }

                    }
                }
            }
        }
    }
    catch
    (PDOException $e)
    {
        $error = "Error: " . $e->getMessage();
    }
    $conn = null;
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
<div class="container main fill">



        <div class="col-lg-4 col-md-4 col-sm-6 "></div>



        <div class="col-lg-4 col-md-4 col-sm-6" style="margin-top: 5%">

            <form method="post" action="register.php">
                <table>
                    <tr><td>First Name </td><td><input type="text" value="<?=$firstname?>" name="firstname"/></td></tr>
                    <tr><td>Last Name </td><td><input type="text" value="<?=$lastname?>" name="lastname"/></td></tr>
                    <tr><td>Username </td><td><input type="text" value="<?=$uname?>" name="username"/></td></tr>
                <tr><td>Password </td><td><input type="password" name="password"/></td></tr>
                <tr><td>Confirm password </td><td><input type="password" name="confpass"/></td></tr>
                <tr><td>Email </td><td><input type="text" value="<?=$email?>" name="email"/></td></tr>
                <tr><td>Address </td><td><input type="text" value="<?=$address?>" name="address"/></td></tr>
                <tr><td colspan="2"><input type="submit" value="submit" name="submit"></td></tr>
                </table>
            </form>

            <?php echo $error?>
        </div>


        <div class="col-lg-4 col-md-4 col-sm-6"></div>

</div>

</body>
</html>
