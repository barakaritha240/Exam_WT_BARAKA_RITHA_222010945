<?php
include('db_connection.php');

// Check if ReservationID is set
if(isset($_REQUEST['ReservationID'])) {
    $ReservationID = $_REQUEST['ReservationID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM reservations WHERE ReservationID=?");
    $stmt->bind_param("i", $ReservationID);
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
        <input type="hidden" name="ReservationID" value="<?php echo $ReservationID; ?>">
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
    echo "ReservationID is not set.";
}

$connection->close();
?>
