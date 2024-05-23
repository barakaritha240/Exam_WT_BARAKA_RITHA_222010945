<?php
include('db_connection.php');

// Check if MaintenanceID is set
if(isset($_REQUEST['MaintenanceID'])) {
    $MaintenanceID = $_REQUEST['MaintenanceID'];
    
    $stmt = $connection->prepare("SELECT * FROM maintenance WHERE MaintenanceID=?");
    $stmt->bind_param("i", $MaintenanceID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['MaintenanceID'];
        $y = $row['VehicleID'];
        $z = $row['Description'];
        $a = $row['StartDate'];
        $b = $row['EndDate'];
        $c = $row['Cost']; // Corrected variable name
    } else {
        echo "Maintenance not found.";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Update Record in maintenance Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update maintenance form -->
    <h2><u>Update Form for maintenance</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="MaintenanceID">MaintenanceID:</label>
        <input type="number" name="MaintenanceID" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <label for="VehicleID">VehicleID:</label>
        <input type="number" name="VehicleID" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="Description">Description:</label>
        <input type="text" name="Description" value="<?php echo isset($z) ? $z : ''; ?>"> <!-- Corrected input name -->
        <br><br>

        <label for="StartDate">StartDate:</label>
        <input type="date" name="StartDate" value="<?php echo isset($a) ? $a : ''; ?>">
        <br><br>

        <label for="EndDate">EndDate:</label>
        <input type="date" name="EndDate" value="<?php echo isset($b) ? $b : ''; ?>"> <!-- Corrected input name -->
        <br><br>

        <label for="Cost">Cost:</label>
        <input type="text" name="Cost" value="<?php echo isset($c) ? $c : ''; ?>"> <!-- Corrected input name -->
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>


<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from maintenance
    $MaintenanceID = $_POST['MaintenanceID'];
    $VehicleID = $_POST['VehicleID'];
    $Description = $_POST['Description'];
    $StartDate = $_POST['StartDate'];
    $EndDate = $_POST['EndDate'];
    $Cost = $_POST['Cost']; // Corrected variable name
   
    // Update the maintenance in the database
    $stmt = $connection->prepare("UPDATE maintenance SET VehicleID=?, Description=?, StartDate=?, EndDate=?, Cost=? WHERE MaintenanceID=?");
    $stmt->bind_param("issssi", $VehicleID, $Description, $StartDate, $EndDate, $Cost, $MaintenanceID); // Corrected binding parameters
    $stmt->execute();
    
    // Redirect to maintenance.php
    header('Location: maintenance.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
