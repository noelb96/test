<?php
session_start();

    $test = "null";
    $watchName = "null";
    $watchImage = "null";


    $servername = "162.241.244.59";
    $username = "thewatm9_eni";
    $password = "Polo1951,,,";
    $dbname = "thewatm9_main";


    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        echo("Connection failed: " . $conn->connect_error);
    }

    $msg = "";
    if (isset($_SESSION['watchIdArray'])) {
        $cartArray = $_SESSION['watchIdArray'];
        $cartArray = array_unique($cartArray);
        if (count($cartArray) == 0) {
            $msg = "You have not selected any items";
            echo $msg;
        } else {


            foreach ($cartArray as $key => $value) {

                $stmt = $conn->prepare('SELECT * FROM watchForSale WHERE watchId = ?');
                $stmt->bind_param('s', $value);

                $stmt->execute();

                $result = $stmt->get_result();

                if ($result->num_rows > 0) {

                    while ($row = $result->fetch_assoc()) {
                        $watchId = $row['watchId'];
                        $watchName = $row['watchName'];
                        $watchImage = $row['watchImage'];

                        echo "<p><a href='produkti.php?watchId=$watchId'><img src=\"$watchImage\" style='width: 50px; height: 50px; margin-left: 1%; margin-right: 5%;'/></a> $watchName <a href='removeCartElement.php?&key=$key' style='float: right;;'><button type=\"button\" class=\"close\">&times;</button></a></p>";

                    }
                }


            }
        }
    }
?>
