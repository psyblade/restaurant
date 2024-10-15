<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restaurant";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    // Delete the booking
    $sql = "DELETE FROM booking WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Booking deleted successfully!";
    } else {
        echo "Error deleting booking: " . $conn->error;
    }
}

// Redirect back to admin page after deleting
header("Location: admin.php");
exit();

// Close connection
$conn->close();
?>
