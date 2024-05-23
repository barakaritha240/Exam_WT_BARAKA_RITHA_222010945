<?php
include('db_connection.php');

// Check if a search term was provided
if (isset($_GET['query']) && !empty($_GET['query'])) {
    $searchTerm = $connection->real_escape_string($_GET['query']);
//customers(CustomerID, FirstName
    //feedback(feedback_id
    //insurance(InsuranceID
    //maintenance(MaintenanceID
    //payments(PaymentID, RentalID,Amount,PaymentDate,PaymentMethod
    //rentals( RentalID,
    //reservations(ReservationID
    //reviews(ReviewID, UserID,VehicleID,Rating,
    //vehicles(VehicleID, Make, Model,Year, Type, RentPerDay

    // Define the SQL queries to search across multiple tables
    $queries = [
        "customers" => "SELECT FirstName FROM customers WHERE FirstName LIKE '%$searchTerm%'",
        "feedback" => "SELECT feedback_id FROM feedback WHERE feedback_id LIKE '%$searchTerm%'",
        "insurance" => "SELECT InsuranceID FROM insurance WHERE InsuranceID LIKE '%$searchTerm%'",
        "maintenance" => "SELECT MaintenanceID FROM maintenance WHERE MaintenanceID LIKE '%$searchTerm%'",
        "rentals" => "SELECT RentalID FROM rentals WHERE RentalID LIKE '%$searchTerm%'",
        "reservations" => "SELECT ReservationID FROM reservations WHERE ReservationID LIKE '%$searchTerm%'",
        "payments" => "SELECT PaymentMethod FROM payments WHERE PaymentMethod LIKE '%$searchTerm%'",
        "reviews" => "SELECT Rating FROM reviews WHERE Rating LIKE '%$searchTerm%'",
        "vehicles" => "SELECT Type FROM vehicles WHERE Type LIKE '%$searchTerm%'",
    ];

    // Output search results
    echo "<h2><u>Search Results:</u></h2>";

    foreach ($queries as $table => $sql) {
        $result = $connection->query($sql);
        echo "<h3>Table of $table:</h3>";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>" . $row[array_keys($row)[0]] . "</p>";
            }
        } else {
            echo "<p>No results found in $table matching the search term: '$searchTerm'</p>";
        }
    }

    // Close the connection
    $connection->close();
} else {
    echo "<p>No search term was provided.</p>";
}
?>
