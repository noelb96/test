<?php
session_start();

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

            $watchId = $_GET['watchId'];
            $_SESSION['price'] = $row['watchPrice'];


            echo "<center>
    <div class=\"bcontainer main fill sell\">
    <img  class=\"foto_produktit\" src=\"image/omega.png\" alt=\"Omega Watch\" style='height=\"460px\" width=\"460px\"' >
    <div class=\"pershkrimi\">
    <p> ".$row['watchName']." </p>
    <p class=\"model_nr\"> ".$row['modelNo']."</p>
    <p class=\"cmimi\"> $".$row['watchPrice']." </p>
     <a href=\"#\"><button class=\"button\" type=\"button\"> Buy by PayPal </button></a>
     <a href=\"payment/charge-credit-card.php?watchId=$watchId\"><button class=\"button\" type=\"button\"> Buy by Credit Card </button></a>
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
?>