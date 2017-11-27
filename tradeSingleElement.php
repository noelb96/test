<?php
session_start();
if (isset($_GET['tradeId'])){
    $tradeId = $_GET['tradeId'];


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

    $sql = "SELECT firstname, lastname, email, phone, country, referredBy, brandYouHave, modelYouHave, description, yourPrice, brandYouWant, modelYouWant, watchId FROM tradepage WHERE tradeId=".$_GET['tradeId'];
    $result = $conn->query($sql);

    $stmt = $conn->prepare('SELECT firstname, lastname, email, phone, country, referredBy, brandYouHave, modelYouHave, description, yourPrice, brandYouWant, modelYouWant, watchId FROM tradepage WHERE tradeId = ?');
    $stmt->bind_param('s', $sellId);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // output data of each row
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