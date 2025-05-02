<?php
session_start();
include 'config.php';

$sql = "SELECT * FROM slot";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Report</title>
    <link rel="stylesheet" href="user_report.css">
</head>
<body>
    <h2>Booking Data</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>Vehicle Number</th>
                <th>Vehicle Type</th>
                <th>Vehicle Brand</th>
                <th>Booking Date</th>
                <th>Booking Time</th>
                <th>Exit Time</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['booking_id'] . "</td>";
                    echo "<td>" . $row['vehicle_number'] . "</td>";
                    echo "<td>" . $row['vehicle_type'] . "</td>";
                    echo "<td>" . $row['vehicle_brand'] . "</td>";
                    echo "<td>" . $row['booking_date'] . "</td>";

                    echo "<td>" . $row['booking_time'] . "</td>";

                    echo "<td>" . $row['exit_time'] . "</td>";

                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No data available</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <button onclick="window.location.href='admin.php'" 
            style="margin-top: 20px; padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px;">
            Back
        </button>
</body>
</html>