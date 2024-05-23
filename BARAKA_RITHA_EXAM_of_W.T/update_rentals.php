<?php
include('db_connection.php');

// Check if RentalID is set
if(isset($_REQUEST['RentalID'])) {
    $RentalID = $_REQUEST['RentalID'];
    
    $stmt = $connection->prepare("SELECT * FROM rentals WHERE RentalID=?");
    $stmt->bind_param("i", $RentalID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['RentalID'];
        $y = $row['UserID'];
        $z = $row['VehicleID'];
        $a = $row['StartDate'];
        $b = $row['EndDate'];
        $c = $row['TotalAmount']; // Corrected variable name
    } else {
        echo "Rental not found."; // Corrected error message
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Update Record in rentals Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update rentals form -->
    <h2><u>Update Form for rentals</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="RentalID">RentalID:</label>
        <input type="number" name="RentalID" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <label for="UserID">UserID:</label>
        <input type="number" name="UserID" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="VehicleID">VehicleID:</label>
        <input type="text" name="VehicleID" value="<?php echo isset($z) ? $z : ''; ?>"> <!-- Corrected input name -->
        <br><br>

        <label for="StartDate">StartDate:</label>
        <input type="date" name="StartDate" value="<?php echo isset($a) ? $a : ''; ?>"> <!-- Corrected input name -->
        <br><br>

        <label for="EndDate">EndDate:</label>
        <input type="date" name="EndDate" value="<?php echo isset($b) ? $b : ''; ?>"> <!-- Corrected input name -->
        <br><br>

        <label for="TotalAmount">TotalAmount:</label>
        <input type="text" name="TotalAmount" value="<?php echo isset($c) ? $c : ''; ?>"> <!-- Corrected input name -->
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>


<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $RentalID = $_POST['RentalID'];
    $UserID = $_POST['UserID'];
    $VehicleID = $_POST['VehicleID'];
    $StartDate = $_POST['StartDate'];
    $EndDate = $_POST['EndDate'];
    $TotalAmount = $_POST['TotalAmount']; // Corrected variable name
   
    // Update the rentals in the database
    $stmt = $connection->prepare("UPDATE rentals SET UserID=?, VehicleID=?, StartDate=?, EndDate=?, TotalAmount=? WHERE RentalID=?");
    $stmt->bind_param("issssi", $UserID, $VehicleID, $StartDate, $EndDate, $TotalAmount, $RentalID); // Corrected binding parameters
    $stmt->execute();
    
    // Redirect to rentals.php
    header('Location: rentals.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
