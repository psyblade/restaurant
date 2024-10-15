<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <link rel="stylesheet" href="admin.css">
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
    </style>
</head>
<body>
    <h2>Booking</h2>
    <a href="index.html">Back</a>
    <table>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Date & Time</th>
            <th>No of People</th>
            <th>Special Request</th>
            <th>Status</th>
            <th>Action</th> <!-- New Action Column -->
        </tr>
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

        // SQL query to fetch booking data
        $sql = "SELECT id, name, email, date_time, people, special_request, status FROM booking";
        $result = $conn->query($sql);

        // Check for query execution
        if (!$result) {
            die("Query failed: " . $conn->error);
        }

        // Initialize serial number
        $serialNumber = 1;

        // Check if any results were returned
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$serialNumber."</td>"; // Serial number
                echo "<td>".$row["name"]."</td>";
                echo "<td>".$row["email"]."</td>";
                echo "<td>".$row["date_time"]."</td>"; 
                echo "<td>".$row["people"]."</td>"; 
                echo "<td>".$row["special_request"]."</td>";
                echo "<td>".$row["status"]."</td>"; // Display the status
                
                // Action buttons
                echo "<td>
                        <form style='display:inline;' action='update_status.php' method='POST'>
                            <input type='hidden' name='id' value='".$row["id"]."'>
                            <button type='submit' class='tick-button'>✔️</button>
                        </form>
                        <form style='display:inline;' action='edit_booking.php' method='GET'>
                            <input type='hidden' name='id' value='".$row["id"]."'>
                            <button type='submit' class='button'>Edit</button>
                        </form>
                        <form style='display:inline;' action='delete_booking.php' method='POST' onsubmit='return confirm(\"Are you sure you want to delete this booking?\");'>
                            <input type='hidden' name='id' value='".$row["id"]."'>
                            <button type='submit' class='delete-button'>Delete</button>
                        </form>
                      </td>";
                echo "</tr>";
                $serialNumber++;
            }
        } else {
            echo "<tr><td colspan='8'>No booking found</td></tr>"; // Updated colspan
        }

        // Close connection
        $conn->close();
        ?>
    </table>
</body>
</html>
