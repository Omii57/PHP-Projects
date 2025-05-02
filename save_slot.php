<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['slot_number'], $_POST['booking_id'])) {
    $slotNumber = $_POST['slot_number'];
    $bookingId = $_POST['booking_id'];

    $sql = "INSERT INTO parking_slot (slot_number, booking_id) VALUES ('$slotNumber', '$bookingId')";

    if (mysqli_query($conn, $sql)) {
        echo "Slot $slotNumber has been reserved with Booking ID $bookingId!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    echo "Slot Reserved.";
}
?>
