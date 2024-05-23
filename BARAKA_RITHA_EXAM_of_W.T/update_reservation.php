<?php
include('db_connection.php');

// Check if ReservationID is set
if(isset($_REQUEST['ReservationID'])) {
    $ReservationID = $_REQUEST['ReservationID'];
    
    $stmt = $connection->prepare("SELECT * FROM reservations WHERE ReservationID=?");
    $stmt->bind_param("i", $ReservationID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['ReservationID'];
        $y = $row['UserID'];
        $z = $row['VehicleID'];
        $a = $row['ReservationDate'];
        $b = $row['Status'];
    } else {
        echo "Reservation not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record in reservations Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update reservations form -->
    <h2><u>Update Form for reservations</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="ReservationID">ReservationID:</label>
        <input type="number" name="ReservationID" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <label for="UserID">UserID:</label>
        <input type="number" name="UserID" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="VehicleID">VehicleID:</label>
        <input type="number" name="VehicleID" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="ReservationDate">ReservationDate:</label>
        <input type="date" name="ReservationDate" value="<?php echo isset($a) ? $a : ''; ?>">
        <br><br>

        <label for="Status">Status:</label>
        <input type="text" name="Status" value="<?php echo isset($b) ? $b : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from reservations
    $ReservationID = $_POST['ReservationID'];
    $UserID = $_POST['UserID'];
    $VehicleID = $_POST['VehicleID'];
    $ReservationDate = $_POST['ReservationDate'];
    $Status = $_POST['Status'];
   
    // Update the reservations in the database
    $stmt = $connection->prepare("UPDATE reservations SET UserID=?, VehicleID=?, ReservationDate=?, Status=? WHERE ReservationID=?");
    $stmt->bind_param("issss", $UserID, $VehicleID, $ReservationDate, $Status, $ReservationID); // corrected binding parameters
    $stmt->execute();
    
    // Redirect to reservations.php
    header('Location: reservations.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
