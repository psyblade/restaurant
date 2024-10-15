<?php
// Database connection
$servername = "localhost";
$username = "root"; // Change if necessary
$password = ""; // Change if necessary
$dbname = "restaurant";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $datetime = $_POST['datetime'];
    $people = $_POST['people'];
    $special_request = $_POST['special_request'];

    // Set default status
    $status = 'pending';

    // Insert data into booking table, including the status
    $sql = "INSERT INTO booking (name, email, date_time, people, special_request, status)
            VALUES ('$name', '$email', '$datetime', $people, '$special_request', '$status')";

    if ($conn->query($sql) === TRUE) {
        echo "Booking successful!";
        header("Location: index.html"); // Change to your main page URL
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
