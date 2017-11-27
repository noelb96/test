<?php
session_start();
if (isset($_SESSION['id'])=='admin') {

    $servername = "162.241.244.59";
    $username = "thewatm9_eni";
    $password = "Polo1951,,,";
    $dbname = "thewatm9_main";

    if (isset($_REQUEST['addWatch'])) {
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
// set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// prepare sql and bind parameters
            $stmt = $conn->prepare("INSERT INTO watchForSale (watchImage, watchName, watchDescription, watchPrice, watchAmount, specCollections, specCondition, specBrand, specMovement, specWaterRes, specGender, specWarranty, colorDial, colorStrap, materialCase, materialBand, productionId, modelNo) VALUES (:watchImage, :watchName, :watchDescription, :watchPrice, :watchAmount, :specCollections, :specCondition, :specBrand, :specMovement, :specWaterRes, :specGender, :specWarranty, :colorDial, :colorStrap, :materialCase, :materialBand, :productionId, :modelNo)");

            $stmt->bindValue(":watchImage", $_REQUEST['watchImage'], PDO::PARAM_STR);
            $stmt->bindValue(":watchName", $_REQUEST['watchName'], PDO::PARAM_STR);
            $stmt->bindValue(":watchDescription", $_REQUEST['watchDescription'], PDO::PARAM_STR);
            $stmt->bindValue(":watchPrice", $_REQUEST['watchPrice'], PDO::PARAM_STR);
            $stmt->bindValue(":watchAmount", $_REQUEST['watchAmount'], PDO::PARAM_STR);
            $stmt->bindValue(":specCollections", $_REQUEST['specCollections'], PDO::PARAM_STR);
            $stmt->bindValue(":specCondition", $_REQUEST['specCondition'], PDO::PARAM_STR);
            $stmt->bindValue(":specBrand", $_REQUEST['specBrand'], PDO::PARAM_STR);
            $stmt->bindValue(":specMovement", $_REQUEST['specMovement'], PDO::PARAM_STR);
            $stmt->bindValue(":specWaterRes", $_REQUEST['specWaterRes'], PDO::PARAM_STR);
            $stmt->bindValue(":specGender", $_REQUEST['specGender'], PDO::PARAM_STR);
            $stmt->bindValue(":specWarranty", $_REQUEST['specWarranty'], PDO::PARAM_STR);
            $stmt->bindValue(":colorDial", $_REQUEST['colorDial'], PDO::PARAM_STR);
            $stmt->bindValue(":colorStrap", $_REQUEST['colorStrap'], PDO::PARAM_STR);
            $stmt->bindValue(":materialCase", $_REQUEST['materialCase'], PDO::PARAM_STR);
            $stmt->bindValue(":materialBand", $_REQUEST['materialBand'], PDO::PARAM_STR);
            $stmt->bindValue(":productionId", $_REQUEST['productionId'], PDO::PARAM_INT);
            $stmt->bindValue(":modelNo", $_REQUEST['modelNo'], PDO::PARAM_STR);

            $stmt->execute();

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;

    } else {
    }
}
?>
<html>
<head></head>
<body>
<center>
    <form method="post" action="adminAddWatch.php">
        <p><label>Watch Image: <input type="text" name="watchImage" required/> </label></p>
        <p><label>Watch Name: <input type="text" name="watchName" required/> </label></p>
        <p><label>Watch Description: <input type="text" name="watchDescription" required/> </label></p>
        <p><label>Watch Price: <input type="text" name="watchPrice" required/> </label></p>
        <p><label>Watch Amount: <input type="text" name="watchAmount" required/> </label></p>
        <p>Specification</p><hr/>
        <p><label>Collection: <input type="text" name="specCollections" required/> </label></p>
        <p><label>Condition: <input type="text" name="specCondition" required/> </label></p>
        <p><label>Brand: <input type="text" name="specBrand" required/> </label></p>
        <p><label>Movement: <input type="text" name="specMovement" required/> </label></p>
        <p><label>Water Resistant: <input type="text" name="specWaterRes" required/> </label></p>
        <p><label>Gender: <input type="text" name="specGender" required/> </label></p>
        <p><label>Warranty: <input type="text" name="specWarranty" required/> </label></p>
        <p>Colors</p><hr/>
        <p><label>Dial Color: <input type="text" name="colorDial" required/> </label></p>
        <p><label>Strap Color: <input type="text" name="colorStrap" required/> </label></p>
        <p>Materials</p><hr/>
        <p><label>Case Type: <input type="text" name="materialCase" required/> </label></p>
        <p><label>Case Type: <input type="text" name="materialBand" required/> </label></p>
        <p>Production Codes:</p>
        <p><label>Id Code: <input type="text" name="productionId" required/> </label></p>
        <p><label>Model No: <input type="text" name="modelNo" required/> </label></p>

        <p><input type="submit" name="addWatch" value="Submit"></p>
    </form>
</center>
</body>
</html>

