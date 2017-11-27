<?php
session_start();
if (isset($_SESSION['id'])=='admin'){

    $servername = "162.241.244.59";
    $username = "thewatm9_eni";
    $password = "Polo1951,,,";
    $dbname = "thewatm9_main";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
// set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// prepare sql and bind parameters
        $stmt = $conn->query("SELECT * FROM sellwatch WHERE -1");

        echo "<br/>";
        echo "<table style='border: 1px solid black;'>
            <thead>
            <td>Full Name</td>
            <td>Email</td>
            <td>phone</td>
            <td>Brand</td>
            <td>Model</td>
            <td>Price</td>
            <td>Picture</td>
            <td>Papers</td>
            <td>Last Service</td>
            <td>Comment</td>
            </thead><tbody>";

        foreach ($stmt as $rows) {
            $sellId = $rows['id'];
            $name = $rows['name'];
            $email = $rows['email'];
            $phone = $rows['phone'];
            $brand = $rows['brand'];
            $model = $rows['model'];
            $price = $rows['price'];
            $picture = $rows['picture'];
            $papers = $rows['papers'];
            $lastservice = $rows['lastservice'];
            $comments = $rows['comments'];

            echo " <div>

            <tr>
            <td>$name</td>
            <td>$email</td>
            <td>$phone</td>
            <td>$brand</td>
            <td>$model</td>
            <td>$price</td>
            <td><img src=\"sellWatchStorage/$picture\" style='height: 100px; width: 100px;' alt='No image available'></td>
            <td>$papers</td>
            <td>$lastservice</td>
            <td>$comments</td>
            <td><a href='sellSingleElement.php?sellId=$sellId'>View</a></td>
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

