<?php
session_start();
include 'config.php';

$searchQuery = '';
$searchTerm = '';

if (isset($_POST['search'])) {
    $searchTerm = $_POST['search'];
    $searchQuery = " WHERE payment_id LIKE '%$searchTerm%' OR booking_id LIKE '%$searchTerm%' OR payment_type LIKE '%$searchTerm%' OR payment_status LIKE '%$searchTerm%'";
}

$sql = "SELECT * FROM payment" . $searchQuery;
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Report</title>
    <link rel="stylesheet" href="user_report.css">
</head>
<body>
    <div class="container">
        <h2>Payment Report</h2>
        <form method="POST" action="">
            <input type="text" name="search" placeholder="Search Payment ID, Booking ID, Type, or Status" value="<?php echo $searchTerm; ?>">
            <button type="submit">Search</button>
        </form>

        <table border="1">
            <thead>
                <tr>
                    <th>Payment ID</th>
                    <th>Booking ID</th>
                    <th>Amount</th>
                    <th>Payment Type</th>
                    <th>Payment Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>" . $row['payment_id'] . "</td>
                            <td>" . $row['booking_id'] . "</td>
                            <td>₹" . $row['payment_amount'] . "</td>
                            <td>" . $row['payment_type'] . "</td>
                            <td>" . $row['payment_status'] . "</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php mysqli_close($conn); ?>
