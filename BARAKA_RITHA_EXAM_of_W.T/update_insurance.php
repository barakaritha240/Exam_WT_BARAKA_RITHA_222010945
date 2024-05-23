<?php
include('db_connection.php');

// Check if InsuranceID is set
if(isset($_REQUEST['InsuranceID'])) {
    $InsuranceID = $_REQUEST['InsuranceID'];
    
    $stmt = $connection->prepare("SELECT * FROM insurance WHERE InsuranceID=?");
    $stmt->bind_param("i", $InsuranceID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['InsuranceID'];
        $y = $row['VehicleID'];
        $z = $row['Provider'];
        $a = $row['PolicyNumber'];
        $b = $row['ExpirationDate'];
    } else {
        echo "Insurance not found.";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Update Record in insurance Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update insurance form -->
    <h2><u>Update Form for insurance</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="InsuranceID">InsuranceID:</label>
        <input type="number" name="InsuranceID" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <label for="VehicleID">VehicleID:</label>
        <input type="number" name="VehicleID" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="Provider">Provider:</label>
        <input type="text" name="Provider" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="PolicyNumber">PolicyNumber:</label>
        <input type="text" name="PolicyNumber" value="<?php echo isset($a) ? $a : ''; ?>">
        <br><br>

        <label for="ExpirationDate">ExpirationDate:</label>
        <input type="date" name="ExpirationDate" value="<?php echo isset($b) ? $b : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>


<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from insurance
    $InsuranceID = $_POST['InsuranceID'];
    $VehicleID = $_POST['VehicleID'];
    $Provider = $_POST['Provider'];
    $PolicyNumber = $_POST['PolicyNumber'];
    $ExpirationDate = $_POST['ExpirationDate'];
   
    // Update the insurance in the database
    $stmt = $connection->prepare("UPDATE insurance SET VehicleID=?, Provider=?, PolicyNumber=?, ExpirationDate=? WHERE InsuranceID=?");
    $stmt->bind_param("issss", $VehicleID, $Provider, $PolicyNumber, $ExpirationDate, $InsuranceID);
    $stmt->execute();
    
    // Redirect to insurance.php
    header('Location: insurance.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
