<?php
include('db_connection.php');

// Check if PaymentID is set
if(isset($_REQUEST['PaymentID'])) {
    $PaymentID = $_REQUEST['PaymentID'];
    
    $stmt = $connection->prepare("SELECT * FROM payments WHERE PaymentID=?");
    $stmt->bind_param("i", $PaymentID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['PaymentID'];
        $y = $row['RentalID'];
        $z = $row['Amount'];
        $a = $row['PaymentDate'];
        $b = $row['PaymentMethod'];
    } else {
        echo "Payment not found.";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Update Record in payments Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update payments form -->
    <h2><u>Update Form for payments</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="PaymentID">PaymentID:</label>
        <input type="number" name="PaymentID" value="<?php echo isset($x) ? $x : ''; ?>"> <!-- Corrected input name -->
        <br><br>

        <label for="RentalID">RentalID:</label>
        <input type="number" name="RentalID" value="<?php echo isset($y) ? $y : ''; ?>"> <!-- Corrected input name -->
        <br><br>

        <label for="Amount">Amount :</label>
        <input type="text" name="Amount" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="PaymentDate">PaymentDate:</label>
        <input type="date" name="PaymentDate" value="<?php echo isset($a) ? $a : ''; ?>">
        <br><br>

        <label for="PaymentMethod">PaymentMethod:</label>
        <input type="text" name="PaymentMethod" value="<?php echo isset($b) ? $b : ''; ?>"> <!-- Corrected input name -->
        <br><br>


    
        
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>


<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from payments
    $PaymentID = $_POST['PaymentID'];
    $RentalID = $_POST['RentalID'];
    $Amount = $_POST['Amount'];
    $PaymentDate = $_POST['PaymentDate'];
    $PaymentMethod = $_POST['PaymentMethod']; // Corrected variable name
   
    // Update the payments in the database
    $stmt = $connection->prepare("UPDATE payments SET RentalID=?, Amount=?, PaymentDate=?, PaymentMethod=? WHERE PaymentID=?");
    $stmt->bind_param("isssi", $RentalID, $Amount, $PaymentDate, $PaymentMethod, $PaymentID); // Corrected binding parameters
    $stmt->execute();
    
    // Redirect to payments.php
    header('Location: payments.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
