<?php
if (isset($_GET['sellId'])){
    $sellId = $_GET['sellId'];


    $servername = "162.241.244.59";
    $username = "thewatm9_eni";
    $password = "Polo1951,,,";
    $dbname = "thewatm9_main";

// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
    if ($conn->connect_error) {
        echo("Connection failed: " . $conn->connect_error);
    }


    $stmt = $conn->prepare('SELECT * FROM sellwatch WHERE id = ?');
    $stmt->bind_param('s', $sellId);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<center> - Name: " . $row["name"]. "<br>";
            echo " - Email: " . $row["email"]. "<br> - Phone: " . $row["phone"]. "<br>";
            echo " - Brand: " . $row["brand"]. "<br> - Model: " . $row["model"]. "<br>";
            echo " - Price: " . $row["price"]. "<br> - Papers: " . $row["papers"]. "<br>";
            echo " - Last Service: " . $row["lastservice"]. "<br> - Comments:" . $row["comments"]. "<br><br>";
            echo " <img src=\"sellWatchStorage/".$row["picture"]."\" style='height: 500px; width: 500px;' alt='No image available'></center><br>";
        }
    } else {
        echo "0 results";
    }
    $conn->close();
}
?>