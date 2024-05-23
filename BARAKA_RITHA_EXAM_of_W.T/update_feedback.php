<?php
include('db_connection.php');

// Check if feedback_id is set
if(isset($_REQUEST['feedback_id'])) {
    $feedback_id = $_REQUEST['feedback_id'];
    
    $stmt = $connection->prepare("SELECT * FROM feedback WHERE feedback_id=?");
    $stmt->bind_param("i", $feedback_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['feedback_id'];
        $y = $row['RentalID'];
        $z = $row['rating'];
        $a = $row['comment'];
        $b = $row['feedback_date'];
    } else {
        echo "Feedback not found.";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Update Record in feedback Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update feedback form -->
    <h2><u>Update Form for feedback</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="feedback_id">Feedback ID:</label>
        <input type="number" name="feedback_id" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <label for="RentalID">Rental ID:</label>
        <input type="number" name="RentalID" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="rating">Rating:</label>
        <input type="text" name="rating" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="comment">Comment:</label>
        <input type="text" name="comment" value="<?php echo isset($a) ? $a : ''; ?>">
        <br><br>

        <label for="feedback_date">Feedback Date:</label>
        <input type="date" name="feedback_date" value="<?php echo isset($b) ? $b : ''; ?>">
        <br><br>
    
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>


<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from feedback
    $feedback_id = $_POST['feedback_id'];
    $RentalID = $_POST['RentalID'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];
    $feedback_date = $_POST['feedback_date'];
   
    // Update the feedback in the database
    $stmt = $connection->prepare("UPDATE feedback SET RentalID=?, rating=?, comment=?, feedback_date=? WHERE feedback_id=?");
    $stmt->bind_param("issss", $RentalID, $rating, $comment, $feedback_date, $feedback_id);
    $stmt->execute();
    
    // Redirect to feedback.php
    header('Location: feedback.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
