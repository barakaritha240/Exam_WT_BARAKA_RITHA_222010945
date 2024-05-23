<?php
include('db_connection.php');

// Check if CustomerID is set
if(isset($_REQUEST['CustomerID'])) {
    $CustomerID = $_REQUEST['CustomerID'];
    
    $stmt = $connection->prepare("SELECT * FROM customers WHERE CustomerID=?");
    $stmt->bind_param("i", $CustomerID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['CustomerID'];
        $y = $row['FirstName'];
        $z = $row['LastName'];
        $a = $row['Address'];
        $b = $row['Gender'];
    } else {
        echo "Customers not found.";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Update Record in customers Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update customers form -->
    <h2><u>Update Form for customers</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="CustomerID">CustomerID:</label>
        <input type="number" name="CustomerID" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <label for="FirstName">FirstName:</label>
        <input type="text" name="FirstName" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="LastName">LastName:</label>
        <input type="text" name="LastName" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="Address">Address:</label>
        <input type="text" name="Address" value="<?php echo isset($a) ? $a : ''; ?>">
        <br><br>

        <label for="Gender">Gender:</label>
        <input type="text" name="Gender" value="<?php echo isset($b) ? $b : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from customers
    $CustomerID = $_POST['CustomerID'];
    $FirstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $Address = $_POST['Address'];
    $Gender = $_POST['Gender'];
   
    // Update the customer in the database
    $stmt = $connection->prepare("UPDATE customers SET FirstName=?, LastName=?, Address=?, Gender=? WHERE CustomerID=?");
    $stmt->bind_param("ssssi", $FirstName, $LastName, $Address, $Gender, $CustomerID);
    $stmt->execute();
    
    // Redirect to customers.php
    header('Location: customers.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
