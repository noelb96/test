<?php
session_start();
if (isset($_GET['tradeId'])){
    $tradeId = $_GET['tradeId'];


    $servername = "162.241.244.59";
    $username = "thewatm9_eni";
    $password = "Polo1951,,,";
    $dbname = "thewatm9_main";


    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        echo("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare('SELECT firstname, lastname, email, phone, country, referredBy, brandYouHave, modelYouHave, description, yourPrice, brandYouWant, modelYouWant, watchId FROM tradepage WHERE tradeId = ?');
    $stmt->bind_param('s', $sellId);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
            echo "<center> - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
            echo " - Email: " . $row["email"]. "<br> - Phone: " . $row["phone"]. "<br>";
            echo " - Country: " . $row["country"]. "<br> - Referred By: " . $row["referredBy"]. "<br>";
            echo " - Brand You Have: " . $row["brandYouHave"]. "<br> - Model You Have: " . $row["modelYouHave"]. "<br>";
            echo " - Description: " . $row["description"]. "<br> - Your price:" . $row["yourPrice"]. "<br>";
            echo " - Brand You want: " . $row["brandYouWant"]. " <br> - Model You Want:" . $row["modelYouWant"]. "<br>";
            echo " - Watch Id: " . $row["watchId"]. "</center><br>";
        }
    } else {
        echo "0 results";
    }
    $conn->close();
}
?>