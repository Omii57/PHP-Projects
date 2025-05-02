<?php
session_start();
include 'config.php';

$searchQuery = '';
$searchTerm = '';

if (isset($_POST['search'])) {
    $searchTerm = $_POST['search'];
    $searchQuery = " WHERE s.vehicle_number LIKE '%$searchTerm%' OR s.vehicle_type LIKE '%$searchTerm%' OR s.vehicle_brand LIKE '%$searchTerm%' OR s.booking_date LIKE '%$searchTerm%' OR s.booking_time LIKE '%$searchTerm%' OR s.exit_time LIKE '%$searchTerm%' OR p.payment_type LIKE '%$searchTerm%'";
}

$sql = "SELECT s.*, p.payment_amount, p.payment_type 
        FROM slot s 
        LEFT JOIN payment p ON s.booking_id = p.booking_id" . $searchQuery;

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Report</title>
    <link rel="stylesheet" href="user_report.css">
</head>
</head>
<body>
    <div class="container">
        <h2>Booking Report</h2>
        <form method="POST" action="booking_report.php">
            <input type="text" name="search" placeholder="Search by vehicle number, type, brand, or date" value="<?php echo $searchTerm; ?>">
            <button type="submit">Search</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Vehicle Number</th>
                    <th>Vehicle Type</th>
                    <th>Vehicle Brand</th>
                    <th>Booking Date</th>
                    <th>Booking Time</th>
                    <th>Exit Time</th>
                    <th>Payment Type</th>
                    <th>Amount</th>
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
                        echo "<td>" . ($row['payment_type'] ? $row['payment_type'] : 'Not Paid') . "</td>";
                        echo "<td>₹" . ($row['payment_amount'] ? number_format($row['payment_amount'], 2) : '0.00') . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No results found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
