<?php
include('db_connection.php');

// Check if InsuranceID ID is set
if(isset($_REQUEST['InsuranceID'])) {
    $InsuranceID = $_REQUEST['InsuranceID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM insurance WHERE InsuranceID=?");
    $stmt->bind_param("i", $InsuranceID);
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
        <input type="hidden" name="InsuranceID" value="<?php echo $InsuranceID; ?>">
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
    echo "InsuranceID is not set.";
}

$connection->close();
?>
