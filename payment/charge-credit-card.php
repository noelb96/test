<?php
require 'vendor/autoload.php';
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

define("AUTHORIZENET_LOG_FILE","phplog");

session_start();
$price = $_SESSION['price'];

if (isset($_REQUEST['buy-submit-button'])){
// Common setup for API credentials
    $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
    $merchantAuthentication->setName("5C27peTJ");
    $merchantAuthentication->setTransactionKey("5Z394kC6hPQDxk3B");
    $refId = 'ref' . time();

// Create the payment data for a credit card
    $creditCard = new AnetAPI\CreditCardType();
    $creditCard->setCardNumber($_REQUEST["card-number"]); //5437232617571550 real card //4111111111111111 test card //get card number here
    $creditCard->setExpirationDate($_REQUEST["expyear"]."-".$_REQUEST["expmonth"]); // get card valid date
    $paymentOne = new AnetAPI\PaymentType();
    $paymentOne->setCreditCard($creditCard);

// Create a transaction
    $transactionRequestType = new AnetAPI\TransactionRequestType();
    $transactionRequestType->setTransactionType("authCaptureTransaction");
    $transactionRequestType->setAmount($price);
    $transactionRequestType->setPayment($paymentOne);
    $request = new AnetAPI\CreateTransactionRequest();
    $request->setMerchantAuthentication($merchantAuthentication);
    $request->setRefId($refId);
    $request->setTransactionRequest($transactionRequestType);
    $controller = new AnetController\CreateTransactionController($request);
    $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);

    if ($response != null) {
        $tresponse = $response->getTransactionResponse();
        if (($tresponse != null) && ($tresponse->getResponseCode() == "1")) {
            echo "Charge Credit Card AUTH CODE : " . $tresponse->getAuthCode() . "\n";
            echo "Charge Credit Card TRANS ID  : " . $tresponse->getTransId() . "\n";
        } else {
            echo "Charge Credit Card ERROR :  Invalid response\n";
        }
    } else {
        echo "Charge Credit Card Null response returned";
    }


}


$servername = "162.241.244.59";
$username = "thewatm9_eni";
$password = "Polo1951,,,";
$dbname = "thewatm9_main";

if (isset($_GET['watchId'])) {
    $watchId = $_GET['watchId'];
// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare('SELECT * FROM watchForSale WHERE watchId = ?');
    $stmt->bind_param('s', $watchId);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $watchImage = $row['watchImage'];
            echo "<body>
<div class=\"top\">
    <!-- Navigation -->
    <nav class=\"navbar navbar-inverse\" role=\"navigation\">
        <div class=\"container nopad\">
            <div class=\"try\"></div>
            <div><img src=\"logo_90x90%20px.png\" height='80px' width=\"80px\"  style=\"float: left; margin: 0 0 0 50px;\" ></div>
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class=\"navbar-header\">
                <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#bs-example-navbar-collapse-1\">
                    <span class=\"sr-only\">Toggle navigation</span>
                    <span class=\"icon-bar\"></span>
                    <span class=\"icon-bar\"></span>
                    <span class=\"icon-bar\"></span>
                </button>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">
                <ul class=\"nav navbar-nav\">
                    <li>
                        <a class=\"right\" href=\"../homepage.php\">Home</a>
                    </li>
                    <li>
                        <a class=\"right\" href=\"../sellpage.php\">Sell your watch</a>
                    </li>
                    <li>
                        <a class=\"right\" href=\"../tradepage.php\">Watch trading</a>
                    </li>
                    <li>
                        <a class=\"right\" href=\"../allWatch.php\">Watch for sale</a>
                    </li>
                    <li>
                        <a class=\"right\" href=\"../show_testimonials.php\">Testimonials</a>
                    </li>
                    <li>
                        <a class=\"right\" href=\"#Contact\">Contact</a>
                    </li>";
                    if (isset($_SESSION['userId'])){
                        echo "<li><a class=\"right\" href=\"../logout.php\">Logout</a></li>";
                    }else{echo " <li><a class=\"right\" href=\"../login.php\">Log in</a></li>";}
                    echo "
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>

        <!-- /.container -->
    </nav>
</div>

    <div class=\"bcontainer main fill sell\">
    <div class=\"col-lg-1 col-md-1 col-sm-0\"></div>
    <div class=\"col-lg-4 col-md-4 col-sm-6\">
    <center>
    <img  class=\"foto_produktit\" src=\"../$watchImage\" alt=\"Omega Watch\" style='height=\"460px\" width=\"460px\"' >
    <div class=\"pershkrimi\">
    <p> ".$row['watchName']." </p>
    <p class=\"model_nr\"> ".$row['modelNo']."</p>
    <p class=\"cmimi\"> $".$row['watchPrice']." </p>
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
echo "
<div class=\"col-lg-4 col-md-4 col-sm-6\">
<center>
<form id=\"buy-form\" method=\"post\" action=\"\">

    <p class=\"form-label\">First Name:</p>
    <input class=\"text\" id=\"first-name\" name=\"firstname\" spellcheck=\"false\"></input>

    <p class=\"form-label\">Last Name:</p>
    <input class=\"text\" id=\"last-name\" name=\"last-name\" spellcheck=\"false\"></input>

    <p class=\"form-label\">Email Address:</p>
    <input class=\"text\" id=\"email\" name=\"email\" spellcheck=\"false\"></input>

    <p class=\"form-label\">Credit Card Number:</p>
    <input class=\"text\" id=\"card-number\" name=\"card-number\" autocomplete=\"off\"></input>

    <p class=\"form-label\">Expiration Date:</p>
    <select id=\"expiration-month\" name=\"expmonth\">
        <option value=\"1\">January</option>
        <option value=\"2\">February</option>
        <option value=\"3\">March</option>
        <option value=\"4\">April</option>
        <option value=\"5\">May</option>
        <option value=\"6\">June</option>
        <option value=\"7\">July</option>
        <option value=\"8\">August</option>
        <option value=\"9\">September</option>
        <option value=\"10\">October</option>
        <option value=\"11\">November</option>
        <option value=\"12\">December</option>
    </select>


       ";
echo "<select id=\"expiration-year\" name=\"expyear\">";
    $yearRange = 20;
    $thisYear = date('Y');
    $startYear = ($thisYear + $yearRange);

    foreach (range($thisYear, $startYear) as $year)
    {
        if ( $year == $thisYear) {
            print '<option value='.$year.' selected="selected">' . $year . '</option>';
        } else {
            print '<option value='.$year.'>' . $year . '</option>';
        }
    }
    echo "</select>

    <p class=\"form-label\">CVC:</p>
    <input class=\"text\" id=\"card-security-code\" name=\"cvc\" autocomplete=\"off\"></input>

    <input name=\"buy-submit-button\" type=\"submit\" value=\"Place This Order »\"></input>
</form>
</center>
</div>
</div> 
</body>";
?>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="../css/lista.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!--    <script src="buy-controller.js"></script>-->
    <script>
        $(document).ready(function()
        {
            $('#buy-form').submit(function(event)
            {
                // immediately disable the submit button to prevent double submits
                $('#buy-submit-button').attr("disabled", "disabled");

                var fName = $('#first-name').val();
                var lName = $('#last-name').val();
                var email = $('#email').val();
                var cardNumber = $('#card-number').val();
                var cardCVC = $('#card-security-code').val();

                // First and last name fields: make sure they're not blank
                if (fName === "") {
                    alert("Please enter your first name.");
                    return;
                }
                if (lName === "") {
                    alert("Please enter your last name.");
                    return;
                }

                // Validate the email address:
                var emailFilter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if (email === "") {
                    alert("Please enter your email address.");
                    return;
                } else if (!emailFilter.test(email)) {
                    alert("Your email address is not valid.");

                }

                // Stripe will validate the card number and CVC for us, so just make sure they're not blank
                if (cardNumber === "") {
                    alert("Please enter your card number.");

                }
                if (cardCVC === "") {
                    alert("Please enter your card security code.");

                }

            });
        });


    </script>
</head>
</html>
