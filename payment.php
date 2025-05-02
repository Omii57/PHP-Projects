<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['payment_id'])) {
    $paymentId = $_POST['payment_id'];
    $updateQuery = "UPDATE payment SET payment_status = 'Paid' WHERE payment_id = '$paymentId'";
    mysqli_query($conn, $updateQuery);
}

$sql = "SELECT * FROM payment";
$result = mysqli_query($conn, $sql);

echo "<div style='width: 80%; margin: auto; font-family: Arial, sans-serif;'>
        <h2 style='text-align: center; color: #333;'>Payment Report</h2>
        <table border='1' style='width: 100%; border-collapse: collapse; text-align: left;'>
            <tr style='background: #f4f4f4;'>
                <th style='padding: 10px; border: 1px solid #ccc;'>Payment ID</th>
                <th style='padding: 10px; border: 1px solid #ccc;'>Booking ID</th>
                <th style='padding: 10px; border: 1px solid #ccc;'>Amount</th>
                <th style='padding: 10px; border: 1px solid #ccc;'>Payment Type</th>
                <th style='padding: 10px; border: 1px solid #ccc;'>Payment Status</th>
                <th style='padding: 10px; border: 1px solid #ccc;'>Action</th>
            </tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td style='padding: 10px; border: 1px solid #ccc;'>" . $row['payment_id'] . "</td>
            <td style='padding: 10px; border: 1px solid #ccc;'>" . $row['booking_id'] . "</td>
            <td style='padding: 10px; border: 1px solid #ccc;'>₹" . $row['payment_amount'] . "</td>
            <td style='padding: 10px; border: 1px solid #ccc;'>" . $row['payment_type'] . "</td>
            <td style='padding: 10px; border: 1px solid #ccc;'>" . $row['payment_status'] . "</td>
            <td style='padding: 10px; border: 1px solid #ccc; text-align: center;'>";
    if ($row['payment_status'] != 'Paid') {
        echo "<form method='POST'>
                <input type='hidden' name='payment_id' value='" . $row['payment_id'] . "'>
                <button type='submit' style='background: #28a745; color: white; border: none; padding: 8px 12px; cursor: pointer;'>Mark as Paid</button>
              </form>";
    }
    echo "</td></tr>";
}

echo "</table>
      <div style='text-align: center; margin-top: 20px;'>
          <a href='admin.php' style='display: inline-block; background: #007bff; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px;'>Back</a>
      </div>
    </div>";

mysqli_close($conn);
?>
