<?php
session_start();
if (isset($_SESSION['id'])=='admin'){

    $servername = "162.241.244.59";
    $username = "thewatm9_eni";
    $password = "Polo1951,,,";
    $dbname = "thewatm9_main";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->query("SELECT * FROM tradepage WHERE -1");

        echo "<br/>";
        echo "<table style='border: 1px solid black;'>
            <thead>
            <td>First Name</td>
            <td>Last name</td>
            <td>phone</td>
            <td>Brand You Have</td>
            <td>Brand You Want</td>
            </thead><tbody>";

        foreach ($stmt as $rows) {
            $tradeId = $rows['tradeId'];
            $firstname = $rows['firstname'];
            $lastname = $rows['lastname'];
            $email = $rows['email'];
            $phone = $rows['phone'];
            $country = $rows['country'];
            $referredBy = $rows['referredBy'];
            $brandYouHave = $rows['brandYouHave'];
            $modelYouHave = $rows['modelYouHave'];
            $description = $rows['description'];
            $yourPrice = $rows['yourPrice'];
            $brandYouWant = $rows['brandYouWant'];
            $modelYouWant = $rows['modelYouWant'];
            $watchId = $rows['watchId'];

            echo " <div>

            <tr>
            <td>$firstname</td>
            <td>$lastname</td>
            <td>$phone</td>
            <td>$brandYouHave</td>
            <td>$brandYouWant</td>
            <td><a href='tradeSingleElement.php?tradeId=$tradeId'>View</a></td>
             </tr>";


        }
        echo "</tbody></table>";


    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;

}else{
}
?>

