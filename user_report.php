<?php
session_start();

// Include the database connection
include 'config.php';

// Initialize variables for the search query and results
$searchQuery = '';
$searchTerm = '';

// Check if a search term is provided
if (isset($_POST['search'])) {
    $searchTerm = $_POST['search'];
    $searchQuery = " WHERE name LIKE '%$searchTerm%' OR email LIKE '%$searchTerm%' OR mobile LIKE '%$searchTerm%'";
}

// Fetch the user data from the database
$sql = "SELECT * FROM user" . $searchQuery;
$result = mysqli_query($conn, $sql);

// Check for errors in the query
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Report</title>
    <link rel="stylesheet" href="user_report.css">
</head>
<body>
    <div class="container">
        <h2>User Report</h2>
        <form method="POST" action="user_report.php">
            <input type="text" name="search" placeholder="Search user by name, email, or mobile" value="<?php echo $searchTerm; ?>">
            <button type="submit">Search</button>
        </form>

        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Date Joined</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Check if there are any results
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['mobile'] . "</td>";
                        echo "<td>" . $row['date_joined'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No results found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
