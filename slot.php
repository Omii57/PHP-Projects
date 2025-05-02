<?php
session_start();
include 'config.php';

$slotNumber = isset($_GET['slot_number']) ? $_GET['slot_number'] : null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])) {
        $vehicleNumber = $_POST['vehicle_number'];
        $vehicleType = $_POST['vehicle_type'];
        $vehicleBrand = $_POST['vehicle_brand'];
        $bookingDate = $_POST['booking_date'];
        $bookingTime = $_POST['booking_time'];
        $exitTime = $_POST['exit_time'];
        $paymentType = $_POST['payment_type'];

        $startTime = strtotime($bookingTime);
        $endTime = strtotime($exitTime);
        $duration = ($endTime - $startTime) / 3600;
        $amount = $duration * 20;

        $checkSql = "SELECT * FROM slot WHERE booking_date = '$bookingDate' AND booking_time = '$bookingTime'";
        $result = mysqli_query($conn, $checkSql);

        if (mysqli_num_rows($result) > 0) {
            $popupMessage = "This time slot is already booked.";
        } else {
            $slotSql = "INSERT INTO slot (vehicle_number, vehicle_type, vehicle_brand, booking_date, booking_time, exit_time) 
                        VALUES ('$vehicleNumber', '$vehicleType', '$vehicleBrand', '$bookingDate', '$bookingTime', '$exitTime')";

            if (mysqli_query($conn, $slotSql)) {
                $bookingId = mysqli_insert_id($conn);

                $paymentSql = "INSERT INTO payment (booking_id, payment_amount, payment_type, payment_status) 
                               VALUES ('$bookingId', '$amount', '$paymentType', 'Pending')";

                if (mysqli_query($conn, $paymentSql)) {
                    header("Location: success.php?booking_id=$bookingId");
                    exit();
                } else {
                    $popupMessage = "Error processing payment.";
                }
            } else {
                $popupMessage = "Error booking slot.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parking Slot Booking</title>
    <link rel="stylesheet" href="slot.css">
</head>
<body>
    <main>
        <section id="book-slot" class="section">
            <div class="booking-form">
                <h3>Book a Parking Slot</h3>
                <form method="POST" action="slot.php">
                    <label for="slot_number">Slot Number</label>
                    <input type="text" id="slot_number" name="slot_number" value="<?php echo $slotNumber; ?>" readonly><br><br>

                    <label for="vehicle_number">Vehicle Number</label>
                    <input type="text" id="vehicle_number" name="vehicle_number" required><br><br>

                    <label for="vehicle_type">Vehicle Type</label>
                    <select id="vehicle_type" name="vehicle_type" required>
                        <option value="">Select Vehicle Type</option>
                        <option value="Car">Car</option>
                        <option value="Motorbike">Motorbike</option>
                        <option value="Truck">Truck</option>
                    </select><br><br>

                    <label for="vehicle_brand">Vehicle Brand</label>
                    <input type="text" id="vehicle_brand" name="vehicle_brand" required><br><br>

                    <label for="booking_date">Booking Date</label>
                    <input type="date" id="booking_date" name="booking_date" required><br><br>

                    <label for="booking_time">Booking Time</label>
                    <input type="time" id="booking_time" name="booking_time" required><br><br>

                    <label for="exit_time">Exit Time</label>
                    <input type="time" id="exit_time" name="exit_time" required><br><br>

                    <label for="payment_type">Payment Type</label>
                    <select id="payment_type" name="payment_type" required>
                        <option value="">Select Payment Type</option>
                        <option value="Cash">Cash</option>
                        <option value="Credit Card">Credit Card</option>
                        <option value="Debit Card">Debit Card</option>
                        <option value="Online">Online</option>
                    </select><br><br>

                    <button type="submit" name="submit">Book Slot</button>
                </form>
            </div>
        </section>
    </main>

    <script>
        <?php if (isset($popupMessage)): ?>
            alert("<?php echo $popupMessage; ?>");
        <?php endif; ?>
    </script>
</body>
</html>
