<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="mystyle.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CUSTOMERS Page</title>
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
   <h1><u>CUSTOMERS Form</u></h1>

<form method="post" onsubmit="return confirmInsert();">
    <label for="CustomerID">CustomerID:</label>
    <input type="number" id="PaymentID" name="PaymentID" required><br><br>

    <label for="FirstName">RFirstName:</label>
    <input type="text" id="RentalID" name="RentalID" required><br><br>

    <label for="LastName">LastName:</label>
    <input type="text" id="Amount" name="Amount" required><br><br>

    <label for="Address">Address:</label>
    <input type="text" id="PaymentDate" name="PaymentDate" required><br><br>

   
    <label for="gend">Gender:</label>
        <select name="gend" id="gend">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select><br><br>

    <input type="submit" name="add" value="Insert">
</form>


<?php
include('db_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO customers(CustomerID, FirstName,LastName,Address,Gender) VALUES (?, ?, ?, ?, ?)");
    $stfmt->bind_param("issss", $CustomerID, $FirstName, $LastName, $Address, $Gender);
    // Set parameters and execute
    $CustomerID = $_POST['PaymentID'];
    $FirstName = $_POST['user_id'];
    $LastName = $_POST['license_number'];
    $Address= $_POST['car_model'];
    $Gender = $_POST['capacity'];


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
    <title>customers TABLE</title>
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
    <center><h2>customers Table</h2></center>
    <table border="3">
        <tr>
            <th>CustomerID</th>
            <th>FirstName</th> <!-- corrected closing tag -->
            <th>LastName</th>
            <th>Address</th>
            <th>Gender</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
<?php
include('db_connection.php');

// Prepare SQL query to retrieve all customers
$sql = "SELECT * FROM customers";
$result = $connection->query($sql);

// Check if there are any customers
if ($result->num_rows > 0) {
    // Output data for each row
    while ($row = $result->fetch_assoc()) {
        $CustomerID = $row['CustomerID']; // Fetch the CustomerID
        echo "<tr>

    
            <td>" . $row['CustomerID'] . "</td>
            <td>" . $row['FirstName'] . "</td>
            <td>" . $row['LastName'] . "</td>
            <td>" . $row['Address'] . "</td>
            <td>" . $row['Gender'] . "</td>
            <td><a style='padding:4px' href='delete_customers.php?CustomerID=$CustomerID'>Delete</a></td> 
            <td><a style='padding:4px' href='update_customers.php?CustomerID=$CustomerID'>Update</a></td> 
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

