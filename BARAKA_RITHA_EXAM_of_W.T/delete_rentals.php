<?php
include('db_connection.php');

// Check if RentalID is set
if(isset($_REQUEST['RentalID'])) {
    $RentalID = $_REQUEST['RentalID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM rentals WHERE RentalID=?");
    $stmt->bind_param("i", $RentalID);
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
        <input type="hidden" name="RentalID" value="<?php echo $RentalID; ?>">
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
    echo "RentalID is not set.";
}

$connection->close();
?>
