<?php
include('db_connection.php');

// Check if VehicleID is set
if(isset($_POST['VehicleID'])) {
    $VehicleID = $_POST['VehicleID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM vehicles WHERE VehicleID=?");
    $stmt->bind_param("i", $VehicleID);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Record</title>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this record?");
        }
    </script>
</head>
<body>
    <form method="post" onsubmit="return confirmDelete();">
        <input type="hidden" name="VehicleID" value="<?php echo htmlspecialchars($VehicleID); ?>">
        <input type="submit" value="Delete">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($stmt->execute()) {
            echo "Record deleted successfully.";
        } else {
            echo "Error deleting data: " . $stmt->error;
        }
    }
    ?>
</body>
</html>

<?php
    $stmt->close();
} else {
    echo "VehicleID is not set.";
}

$connection->close();
?>
