<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="mystyle.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>VEHICLES Page</title>
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
   <h1><u>VEHICLES  Form</u></h1>

<form method="post" onsubmit="return confirmInsert();">


    <label for="VehicleID">VehicleID:</label>
    <input type="number" id="driver_id" name="driver_id" required><br><br>

    <label for="Make">Make:</label>
    <input type="text" id="user_id" name="user_id" required><br><br>

    <label for="Model">Model:</label>
    <input type="text" id="license_number" name="license_number" required><br><br>

    <label for="Year">Year:</label>
    <input type="DATE" id="car_model" name="car_model" required><br><br>

    <label for="Type">Type:</label>
    <input type="text" id="capacity" name="capacity" required><br><br>

    <label for="RentPerDay">RentPerDay:</label>
    <input type="number" id="capacity" name="capacity" required><br><br>

    <label for="Available">Available:</label>
    <input type="number" id="capacity" name="capacity" required><br><br>

 <input type="submit" name="add" value="Insert">
</form>

<?php
include('db_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO vehicles(VehicleID, Make, Model,Year, Type, RentPerDay, Available ) VALUES (?, ?, ?, ?, ?,?,?)");
    $stfmt->bind_param("isssssss", $VehicleID, $Make, $Model, $Year, $Type, $RentPerDay, $Available);
    // Set parameters and execute
    $VehicleID = $_POST['driver_id'];
    $Make = $_POST['user_id'];
    $Model = $_POST['license_number'];
    $Year= $_POST['car_model'];
    $Type = $_POST['capacity'];
    $RentPerDay = $_POST['capacity'];
    $Available = $_POST['capacity'];

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
    <title>vehicles TABLE</title>
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
    <center><h2>vehicles Table</h2></center>
    <table border="3">
        <tr>
            <th>VehicleID</th>
            <th>Make</th> <!-- corrected closing tag -->
            <th>Model</th>
            <th>Year</th>
            <th>Type</th>
            <th>RentPerDay</th>
            <th> Available</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
<?php
include('db_connection.php');

// Prepare SQL query to retrieve all vehicles
$sql = "SELECT * FROM vehicles";
$result = $connection->query($sql);

// Check if there are any vehicles
if ($result->num_rows > 0) {
    // Output data for each row
    while ($row = $result->fetch_assoc()) {
        $VehicleID = $row['VehicleID']; // Fetch the VehicleID
        echo "<tr>

    
            <td>" . $row['VehicleID'] . "</td>
            <td>" . $row['Make'] . "</td>
            <td>" . $row['Model'] . "</td>
            <td>" . $row['Year'] . "</td>
            <td>" . $row['Type'] . "</td>
             <td>" . $row['RentPerDay'] . "</td>
             <td>" . $row['Available'] . "</td>
            <td><a style='padding:4px' href='delete_vehicles.php?VehicleID=$VehicleID'>Delete</a></td> 
            <td><a style='padding:4px' href='update_vehicles.php?VehicleID=$VehicleID'>Update</a></td> 
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

