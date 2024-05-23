<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="mystyle.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MAINTENANCE Page</title>
  <style>
    /* Normal link */
    a {
      padding: 10px;
      color: white;
      background-color: yellow;
      text-decoration: none;
      margin-right: 15px;
    }

    /* Visited link */
    a:visited {
      color: purple;
    }
    /* Unvisited link */
    a:link {
      color: brown; /* Changed to lowercase */
    }
    /* Hover effect */
    a:hover {
      background-color: white;
    }

    /* Active link */
    a:active {
      background-color: red;
    }

    /* Extend margin left for search button */
    button.btn {
      margin-left: 15px; /* Adjust this value as needed */
      margin-top: 4px;
    }
    /* Extend margin left for search button */
    input.form-control {
      margin-left: 1200px; /* Adjust this value as needed */

      padding: 8px;
     
    }
  </style>

  <!-- JavaScript validation and content load for insert data-->
        <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>
        
  </head>

  <header>

<body bgcolor="dimgray">
  <form class="d-flex" role="search" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
    <img src="./image/th..jpg" width="90" height="60" alt="Logo">
 </li>
   <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./customers.php">customers</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./feedback.php">feedback</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./insurance.php">insurance</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./maintenance.php">maintenance</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./payments.php">payments</a>
  
    <li style="display: inline; margin-right: 10px;"><a href="./rentals.php">rentals</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./reservations.php">reservations</a>
  </li>
  <li style="display: inline; margin-right: 10px;"><a href="./reviews.php">reviews</a>
  </li>
  
  <li style="display: inline; margin-right: 10px;"><a href="./vehicles.php">vehicles</a>
  </li>
   
   
  
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>
        <a href="logout.php">Logout</a>
      </div>
    </li><br><br>
    
    
  </ul>

</header>
<section>
   <h1><u>maintenance  Form</u></h1>

<form method="post" onsubmit="return confirmInsert();">


    <label for="MaintenanceID">MaintenanceID:</label>
    <input type="number" id="driver_id" name="driver_id" required><br><br>

    <label for="VehicleID">VehicleID:</label>
    <input type="number" id="user_id" name="user_id" required><br><br>

    <label for="Description">Description:</label>
    <input type="text" id="license_number" name="license_number" required><br><br>

    <label for="StartDate">StartDate:</label>
    <input type="DATE" id="car_model" name="car_model" required><br><br>

    <label for="EndDate">EndDate:</label>
    <input type="DATE" id="capacity" name="capacity" required><br><br>

    <label for="Cost">Cost:</label>
    <input type="number" id="capacity" name="capacity" required><br><br>


    <input type="submit" name="add" value="Insert">
</form>

<?php
include('db_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO maintenance(MaintenanceID, VehicleID, Description,StartDate, EndDate, Cost) VALUES (?, ?, ?, ?, ?,? )");
    $stmt->bind_param("issss", $MaintenanceID, $VehicleID, $Description, $StartDate, $EndDate, Cost);
    // Set parameters and execute
    $MaintenanceID = $_POST['driver_id'];
    $VehicleID = $_POST['user_id'];
    $Description = $_POST['license_number'];
    $StartDate= $_POST['car_model'];
    $EndDate = $_POST['capacity'];
    $Cost = $_POST['capacity'];

    if ($stmt->execute() == TRUE) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$connection->close();
?>






<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>maintenance TABLE</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <center><h2>maintenance Table</h2></center>
    <table border="3">
        <tr>
            <th>MaintenanceID</th>
            <th>VehicleID</th> <!-- corrected closing tag -->
            <th>Description</th>
            <th>StartDate</th>
            <th>EndDate</th>
            <th> Cost </th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
<?php
include('db_connection.php');

// Prepare SQL query to retrieve all maintenance
$sql = "SELECT * FROM maintenance";
$result = $connection->query($sql);

// Check if there are any maintenance
if ($result->num_rows > 0) {
    // Output data for each row
    while ($row = $result->fetch_assoc()) {
        $MaintenanceID = $row['MaintenanceID']; // Fetch the MaintenanceID
        echo "<tr>

    
            <td>" . $row['MaintenanceID'] . "</td>
            <td>" . $row['VehicleID'] . "</td>
            <td>" . $row['Description'] . "</td>
            <td>" . $row['StartDate'] . "</td>
            <td>" . $row['EndDate'] . "</td>
             <td>" . $row['Cost'] . "</td>
            <td><a style='padding:4px' href='delete_maintenance.php?MaintenanceID=$MaintenanceID'>Delete</a></td> 
            <td><a style='padding:4px' href='update_maintenance.php?MaintenanceID=$MaintenanceID'>Update</a></td> 
        </tr>";
    }

} else {
    echo "<tr><td colspan='8'>No data found</td></tr>"; // corrected colspan
}
// Close the database connection
$connection->close();
?>
    </table>
</body>

</section>
 
<footer>
  <center> 
   <b><h2>UR CBE BIT &copy, 2024 &reg, Designer by:BARAKA RITHA</h2></b>
  </center>
</footer>
  
</body>
</html>

