<?php
session_start();
include 'config.php';

$totalBookingsQuery = "SELECT COUNT(*) AS total_bookings FROM payment";
$result = mysqli_query($conn, $totalBookingsQuery);
$row = mysqli_fetch_assoc($result);
$totalBookings = $row['total_bookings'];

$totalRevenueQuery = "SELECT SUM(payment_amount) AS total_revenue FROM payment";
$resultRevenue = mysqli_query($conn, $totalRevenueQuery);
$rowRevenue = mysqli_fetch_assoc($resultRevenue);
$totalRevenue = $rowRevenue['total_revenue'] ?? 0;

$pendingPaymentsQuery = "SELECT COUNT(*) AS pending_payments FROM payment WHERE payment_status = 'pending'";
$resultPending = mysqli_query($conn, $pendingPaymentsQuery);
$rowPending = mysqli_fetch_assoc($resultPending);
$totalPendingPayments = $rowPending['pending_payments'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Vehicle Parking System</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="admin-container">
        <div class="sidebar">
            <div class="logo">
                <h2>Parking System</h2>
            </div>
            <ul class="menu">
                <li><a href="#">Dashboard</a></li>
                <li><a href="user.php">Users</a></li>
                <li><a href="booking.php">Bookings</a></li>
                <li><a href="payment.php">Payments</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" onclick="toggleDropdown()">Reports <span class="caret"></span></a>
                    <ul class="dropdown-menu" id="reportDropdown">
                        <li><a href="user_report.php">User Report</a></li>
                        <li><a href="booking_report.php">Booking Report</a></li>
                        <li><a href="payment_report.php">Payment Report</a></li>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="main-content">
            <header>
                <div class="navbar">
                    <div class="welcome-msg">
                        <p>Welcome, Admin!</p>
                    </div>
                </div>
                <div class="logout-btn">
                    <a href="logout.php">Logout</a>
                </div>
            </header>

            <section class="overview">
                <h2>Dashboard Overview</h2>
                <div class="overview-cards">
                    <div class="card">
                        <h3>Total Bookings</h3>
                        <p><?php echo $totalBookings; ?></p>
                    </div>
                    <div class="card">
                        <h3>Total Revenue</h3>
                        <p>₹ <?php echo number_format($totalRevenue, 2); ?></p>
                    </div>
                    <div class="card">
                        <h3>Pending Payments</h3>
                        <p><?php echo $totalPendingPayments; ?></p>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>
</html>
