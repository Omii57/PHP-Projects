<?php
include 'config.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $slotNumber = $_POST['slot_number'];
    $vehicleNumber = $_POST['vehicle_number'];
    $vehicleType = $_POST['vehicle_type'];
    $bookingDate = $_POST['booking_date'];
    $bookingTime = $_POST['booking_time'];
    $exitTime = $_POST['exit_time'];
    $paymentType = $_POST['payment_type'];

    $sql = "INSERT INTO slot (slot_number, vehicle_number, vehicle_type, booking_date, booking_time, exit_time) 
            VALUES ('$slotNumber', '$vehicleNumber', '$vehicleType', '$bookingDate', '$bookingTime', '$exitTime')";

    if (mysqli_query($conn, $sql)) {
        $bookingId = mysqli_insert_id($conn);
        
        $sql_payment = "INSERT INTO payment (booking_id, payment_type) VALUES ('$bookingId', '$paymentType')";
        
        if (mysqli_query($conn, $sql_payment)) {
            echo "<script>alert('Booking successful! Your slot is reserved.'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Error in processing payment!'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Error in booking! Please try again.'); window.history.back();</script>";
    }

    mysqli_close($conn);
} else {
    echo "<script>alert('Invalid request.'); window.history.back();</script>";
}
?>
