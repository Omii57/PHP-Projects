<?php
session_start();

$totalSpots = 100;
$availableSpots = 50;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Parking System</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #333;
            padding: 10px 20px;
        }
        .logo {
            display: flex;
            align-items: center;
        }
        .logo img {
            height: 50px;
            margin-right: 10px;
        }
        .logo h1 {
            color: white;
            font-size: 24px;
        }
        nav {
            flex-grow: 1;
            display: flex;
            justify-content: flex-end;
        }
        nav ul {
            list-style: none;
            display: flex;
            gap: 10px;
            padding: 0;
            margin: 0;
        }
        nav ul li {
            display: inline;
        }
        nav ul li a {
            color: white;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 3px;
            transition: background 0.3s;
        }
        nav ul li a:hover {
            background-color: #555;
        }
        .logout-btn {
            background-color: red;
            padding: 8px 12px;
            border-radius: 3px;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="images/logo.png" alt="Parking System Logo" />
            <h1>Vehicle Parking System</h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="parking_slot.php">Slot</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php" class="logout-btn">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="welcome">
            <div class="dashboard">
                <h2>Welcome to the Vehicle Parking System</h2>
                <p>Select parking slot, register your vehicle, and more.</p>
            </div>
        </section>

        <section id="slot" class="section">
            <div class="parking-info">
                <h3>Parking Availability</h3>
                <p>We have a total of 15 parking spots.</p>
            </div>
        </section>

        <section id="profile" class="section">
            <div class="profile-info">
            </div>
        </section>
    </main>
</body>
</html>
