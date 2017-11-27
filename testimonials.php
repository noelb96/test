<?php
if (isset($_REQUEST['submit'])) {


    $servername = "162.241.244.59";
    $username = "thewatm9_eni";
    $password = "Polo1951,,,";
    $dbname = "thewatm9_main";

    try {

        $testimonialsTitle = $_REQUEST['testimonialsTitle'];
        $testimonialsFullName = $_REQUEST['fullname'];
        $testimonialsEmail = $_REQUEST['testimonialsEmail'];
        $testimonialsPhone = $_REQUEST['testimonialsPhone'];
        $testimonialsAbout = $_REQUEST['testimonialsAbout'];
        $testimonialsSummary = $_REQUEST['testimonialsSummary'];
        $testimonialsCountry = $_REQUEST['testimonialsCountry'];
        $testiomonialsCity = $_REQUEST['testimonialsCity'];




        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // prepare sql and bind parameters
        $stmt = $conn->prepare("INSERT INTO testimonials (testimonialsTitle, fullname, testimonialsEmail, testimonialsPhone, testimonialsAbout, testimonialsSummary, testimonialsCountry, testiomonialsCity) 
VALUES (:testimonialsTitle, :fullname, :testimonialsEmail, :testimonialsPhone, :testimonialsAbout, :testimonialsSummary, :testimonialsCountry, :testiomonialsCity)");

        $stmt->bindParam(':testimonialsTitle', $testimonialsTitle);
        $stmt->bindParam(':fullname', $testimonialsFullName);
        $stmt->bindParam(':testimonialsEmail', $testimonialsEmail);
        $stmt->bindParam(':testimonialsPhone', $testimonialsPhone);
        $stmt->bindParam(':testimonialsAbout', $testimonialsAbout);
        $stmt->bindParam(':testimonialsSummary', $testimonialsSummary);
        $stmt->bindParam(':testimonialsCountry', $testimonialsCountry);
        $stmt->bindParam(':testiomonialsCity', $testiomonialsCity);


        $stmt->execute();
    }

    catch
    (PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
}
?>
<html>
<head>
    <title>Testimonials</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="css/testimonials.css" rel="stylesheet">
    <link href="css/footer.css" rel="stylesheet">
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
            <div><img src="logo_50%20px.png" style="float: left"></div>
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

        <!-- /.container -->
    </nav>
</div>

<div class="container main fill sell">
    <div>
        <div class="col-lg-4 col-md-4 col-sm-4 ">
            <br/>
            <br/>
            <br/>

            <ul style="list-style-type: none">
                <li>Panerai</li>
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

            </ul>

        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 fill">
            <h1>Create Your Testimonial</h1>
            <br/>



            <form action="testimonials.php" method="post" id="forma">
                <table>

                    <tr>
                        <td><label><div class="r1">Title * </div><input type="text" name="testimonialsTitle" required></label></td>
                    </tr>
                    <tr>
                        <td><label><div class="r1">Full Name </div><input type="text" name="fullname" required></label></td>
                    </tr>
                    <tr>
                        <td><label><div class="r1">Email  </div><input type="text" name="testimonialsEmail" ></label></td>
                    </tr>
                    <tr>
                        <td><label><div class="r1">Phone Number  </div><input type="tel" name="testimonialsPhone" ></label></td>
                    </tr> <tr>
                        <td><label><div class="r1">About Your Watch</div><input type="text" name="testimonialsAbout" ></label></td>
                    </tr>
                    <tr>
                       <td> <label class="r1">Summary </label></td>
                    </tr><tr>
                    <td><textarea rows="10" cols="68" name="testimonialsSummary" form="forma" placeholder="" style="margin-bottom:20px;"> </textarea></td>
                    </tr>
                    <tr>
                      <td>  <label class="r1">Your Address </label></td></tr>
                    <tr>
                        <td><label><div class="r1">Country</div><input type="text" name="testimonialsCountry" ></label></td>
                    </tr>
                    <tr>
                        <td><label><div class="r1">City</div><input type="text" name="testimonialsCity" ></label></td>
                        </tr>
                </table>



                  <center>  <input type="submit" name="submit" value="submit"/></center>
                <br/>
                <br/>
            </form>
        </div>
    </div>

</div>
</body>

<footer>
    <?php include 'footer.php' ?>
</footer>
</html>