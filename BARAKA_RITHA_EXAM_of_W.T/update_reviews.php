<?php
include('db_connection.php');

// Check if ReviewID is set
if(isset($_REQUEST['ReviewID'])) {
    $ReviewID = $_REQUEST['ReviewID'];
    
    $stmt = $connection->prepare("SELECT * FROM reviews WHERE ReviewID=?");
    $stmt->bind_param("i", $ReviewID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['ReviewID'];
        $y = $row['UserID'];
        $z = $row['VehicleID'];
        $a = $row['Rating'];
        $b = $row['Comment'];
        $c = $row['DatePosted']; // Corrected variable name
    } else {
        echo "Review not found."; // Corrected error message
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Update Record in reviews Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update reviews form -->
    <h2><u>Update Form for reviews</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="ReviewID">ReviewID:</label>
        <input type="number" name="ReviewID" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <label for="UserID">UserID:</label>
        <input type="number" name="UserID" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="VehicleID">VehicleID:</label>
        <input type="number" name="VehicleID" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="Rating">Rating:</label>
        <input type="number" name="Rating" value="<?php echo isset($a) ? $a : ''; ?>">
        <br><br>

        <label for="Comment">Comment:</label>
        <input type="text" name="Comment" value="<?php echo isset($b) ? $b : ''; ?>">
        <br><br>

        <label for="DatePosted">DatePosted:</label>
        <input type="date" name="DatePosted" value="<?php echo isset($c) ? $c : ''; ?>"> <!-- Corrected variable name -->
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>


<?php
if(isset($_POST['up'])) {
    
    $UserID = $_POST['UserID'];
    $VehicleID = $_POST['VehicleID'];
    $Rating = $_POST['Rating'];
    $Comment = $_POST['Comment'];
    $DatePosted = $_POST['DatePosted'];
   
    // Update the reviews in the database
    $stmt = $connection->prepare("UPDATE reviews SET UserID=?, VehicleID=?, Rating=?, Comment=?, DatePosted=? WHERE ReviewID=?");
    $stmt->bind_param("iiissi", $UserID, $VehicleID, $Rating, $Comment, $DatePosted, $ReviewID); // Corrected binding parameters
    $stmt->execute();
    
    // Redirect to reviews.php
    header('Location: reviews.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
