<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <link rel="stylesheet" href="admin.css">

</head>
<body>
    <h2>Booking</h2>
    <a href="index.html">Back</a>
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

// Fetch booking details for editing
$id = $_GET['id'];
$sql = "SELECT * FROM booking WHERE id = $id";
$result = $conn->query($sql);
$booking = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Update booking details
    $name = $_POST['name'];
    $email = $_POST['email'];
    $date_time = $_POST['date_&_time'];
    $people = $_POST['people'];
    $special_request = $_POST['special_request'];

    $update_sql = "UPDATE booking SET name='$name', email='$email', date_time='$date_time', people=$people, special_request='$special_request' WHERE id=$id";

    if ($conn->query($update_sql) === TRUE) {
        echo "Booking updated successfully!";
        header("Location: admin.php");
        exit();
    } else {
        echo "Error updating booking: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Booking</title>
    <style>
        /* Basic styling for the table */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
            color: black;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .button {
            background-color: #007bff; /* Blue background for Edit */
            color: white; /* White text */
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
            margin-right: 5px;
            margin-left: 5px;
        }
        .tick-button {
            background-color: #28a745; /* Green background for Done */
            color: white; /* White text */
        }
        .delete-button {
            background-color: #dc3545;
            color: white; /* White text */
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
            margin-right: 5px;
        }
		
		#formContainer {
			display: flex;
			justify-content: center; /* Horizontal centering */
			align-items: center;     /* Vertical centering */
		}
		
		input {
			height:30px;
			width:280px;
			margin-bottom:8px;
		}
		
		textarea {
			height:200px;
			width:280px;
			margin-bottom:8px;
		}
    </style>
</head>
<body>
    <h2>Edit Booking</h2>
	<div id="formContainer">
		<form method="POST">
			<label>Name:</label><br>
			<input type="text" name="name" value="<?php echo $booking['name']; ?>" required><br>
			<label>Email:</label><br>
			<input type="email" name="email" value="<?php echo $booking['email']; ?>" required><br>
			<label>Date & Time:</label><br>
			<input type="datetime-local" name="date_time" value="<?php echo date('Y-m-d\TH:i', strtotime($booking['date_time'])); ?>" required><br>
			<label>No of People:</label><br>
			<input type="number" name="people" value="<?php echo $booking['people']; ?>" required><br>
			<label>Special Request:</label><br>
			<textarea name="special_request"><?php echo $booking['special_request']; ?></textarea><br>
			<br><br>
			<input type="submit" value="Update">
		</form>
	</div>
    <a href="admin.php">Back</a>
</body>
</html>
