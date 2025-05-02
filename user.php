<?php
session_start();
include 'config.php';

$sql = "SELECT * FROM user";
$result = mysqli_query($conn, $sql);

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
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; text-align: center;">

    <div style="max-width: 900px; margin: 20px auto; background: #fff; padding: 20px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); border-radius: 8px;">
        <h2 style="color: #333;">User Report</h2>

        <table border="1" style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <thead>
                <tr style="background-color: #007bff; color: white;">
                    <th style="padding: 10px; border: 1px solid #ddd;">ID</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Username</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Email</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Phone</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Date Joined</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr style='background-color: #f9f9f9;'>";
                        echo "<td style='padding: 10px; border: 1px solid #ddd;'>" . $row['id'] . "</td>";
                        echo "<td style='padding: 10px; border: 1px solid #ddd;'>" . $row['name'] . "</td>";
                        echo "<td style='padding: 10px; border: 1px solid #ddd;'>" . $row['email'] . "</td>";
                        echo "<td style='padding: 10px; border: 1px solid #ddd;'>" . $row['mobile'] . "</td>";
                        echo "<td style='padding: 10px; border: 1px solid #ddd;'>" . $row['date_joined'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' style='padding: 10px;'>No results found</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <button onclick="window.location.href='admin.php'" 
            style="margin-top: 20px; padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px;">
            Back
        </button>

    </div>

</body>
</html>
