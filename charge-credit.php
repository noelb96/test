<?php
require 'payment/vendor/autoload.php';
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
echo "<body>
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
</body>";
?>
<html>
<head>

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
