<?php
// Database connection parameters
$servername = "localhost"; // Change this if your database is hosted elsewhere
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$database = "Horror_Review";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch review data
$sql = "SELECT Full_Name, Book_Title, Query FROM review";

// Execute the query
$result = $conn->query($sql);

// Check if there are any results
if ($result->num_rows > 0) {
    // Initialize an empty array to store review data
    $reviews = array();

    // Fetch review data row by row
    while($row = $result->fetch_assoc()) {
        // Add each review data to the reviews array
        $reviews[] = $row;
    }

    // Convert the reviews array to JSON format
    $json_reviews = json_encode($reviews);

    // Set the appropriate headers to indicate JSON content
    header('Content-Type: application/json');

    // Output the JSON data
    echo $json_reviews;
} else {
    // No reviews found
    echo json_encode(array('message' => 'No reviews found'));
}

// Close the connection
$conn->close();
?>
