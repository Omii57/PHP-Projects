<?php
session_start();
include 'config.php';

$popupMessage = "";
$popupType = "success";
$amount = 0;

if (isset($_GET['booking_id'])) {
    $bookingId = $_GET['booking_id'];

    $sql = "SELECT  s.booking_id,s.vehicle_number, s.vehicle_type, s.vehicle_brand, 
                   s.booking_date, s.booking_time, s.exit_time, p.payment_amount
            FROM slot s 
            JOIN payment p ON s.booking_id = p.booking_id
            WHERE s.booking_id = '$bookingId'";

    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
      
        $vehicleNumber = $row['vehicle_number'];
        $vehicleType = $row['vehicle_type'];
        $vehicleBrand = $row['vehicle_brand'];
        $bookingDate = $row['booking_date'];
        $bookingTime = $row['booking_time'];
        $exitTime = $row['exit_time'];
        $amount = $row['payment_amount']; 

        $popupMessage = "Slot Booked Successfully!";
        $popupType = "success";
    } else {
        $popupMessage = "Booking not found!";
        $popupType = "error";
    }
} else {
    $popupMessage = "Invalid request!";
    $popupType = "error";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <link rel="stylesheet" href="slot.css">
</head>
<body>
    <main>
        <section id="confirmation" class="section">
            <div class="confirmation-message">
                <h3><?php echo $popupMessage; ?></h3>
                <div class="<?php echo $popupType; ?>-alert">
                    <?php
                    if ($popupType == 'success') {
                        echo "<p>Your parking slot has been successfully booked.</p>";
                        echo "<p><strong>Vehicle Number:</strong> $vehicleNumber</p>";
                        echo "<p><strong>Vehicle Type:</strong> $vehicleType</p>";
                        echo "<p><strong>Vehicle Brand:</strong> $vehicleBrand</p>";
                        echo "<p><strong>Booking Date:</strong> $bookingDate</p>";
                        echo "<p><strong>Booking Time:</strong> $bookingTime</p>";
                        echo "<p><strong>Exit Time:</strong> $exitTime</p>";
                        echo "<p><strong>Amount to Pay:</strong> ₹$amount</p>";
                    } else {
                        echo "<p>Something went wrong. Please try again later.</p>";
                    }
                    ?>
                </div>
                <a href="index.php" class="back-btn">Go back to Home page</a>
            </div>
        </section>
    </main>
</body>
</html>
