<?php
include('db_connection.php');

// Check if VehicleID is set
if(isset($_REQUEST['VehicleID'])) {
    $VehicleID = $_REQUEST['VehicleID'];
    
    $stmt = $connection->prepare("SELECT * FROM vehicles WHERE VehicleID=?");
    $stmt->bind_param("i", $VehicleID);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['VehicleID'];
        $y = $row['Make'];
        $z = $row['Model'];
        $a = $row['Year'];
        $b = $row['Type'];
        $c = $row['RentPerDay'];
        $d = $row['Available'];
    } else {
        echo "Vehicle not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record in vehicles Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update vehicles form -->
    <h2><u>Update Form for vehicles</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="VehicleID">VehicleID:</label>
        <input type="number" name="VehicleID" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <label for="Make">Make:</label>
        <input type="text" name="Make" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="Model">Model:</label>
        <input type="text" name="Model" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="Year">Year:</label>
        <input type="date" name="Year" value="<?php echo isset($a) ? $a : ''; ?>">
        <br><br>

        <label for="Type">Type:</label>
        <input type="text" name="Type" value="<?php echo isset($b) ? $b : ''; ?>">
        <br><br>

        <label for="RentPerDay">RentPerDay:</label>
        <input type="text" name="RentPerDay" value="<?php echo isset($c) ? $c : ''; ?>">
        <br><br>

        <label for="Available">Available:</label>
        <input type="text" name="Available" value="<?php echo isset($d) ? $d : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $VehicleID = $_POST['VehicleID'];
    $Make = $_POST['Make'];
    $Model = $_POST['Model'];
    $Year = $_POST['Year'];
    $Type = $_POST['Type'];
    $RentPerDay = $_POST['RentPerDay'];
    $Available = $_POST['Available'];
   
    // Update the vehicle in the database
    $stmt = $connection->prepare("UPDATE vehicles SET Make=?, Model=?, Year=?, Type=?, RentPerDay=?, Available=? WHERE VehicleID=?");
    $stmt->bind_param("sssdsdi", $Make, $Model, $Year, $Type, $RentPerDay, $Available, $VehicleID);
    $stmt->execute();
    
    // Redirect to vehicles.php
    header('Location: vehicles.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
