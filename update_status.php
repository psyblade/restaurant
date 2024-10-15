<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restaurant";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    // Update the status of the booking
    $sql = "UPDATE booking SET status='Done' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Status updated successfully!";
    } else {
        echo "Error updating status: " . $conn->error;
    }
}

// Redirect back to admin page after updating
header("Location: admin.php");
exit();

// Close connection
$conn->close();
?>
