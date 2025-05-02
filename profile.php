<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT name, email, mobile, password FROM user WHERE id = $user_id";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "User not found!";
    exit();
}

if (isset($_POST['update_password'])) {
    $new_password = $_POST['new_password'];
    
    $update_sql = "UPDATE user SET password = '$new_password', c_password = '$new_password' WHERE id = $user_id";

    if (mysqli_query($conn, $update_sql)) {
        echo "<script>alert('Password updated successfully!');</script>";
        $user['password'] = $new_password; // Update password in session for UI consistency
    } else {
        echo "<script>alert('Error updating password!');</script>";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="profile.css">
</head>
<body>

    <div class="profile-container">
        <h2>User Profile</h2>
        <div class="profile-details">
            <p><strong>Name:</strong> <?php echo $user['name']; ?></p>
            <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
            <p><strong>Phone:</strong> <?php echo $user['mobile']; ?></p>
            <form method="POST" action="">
                <label for="new_password"><strong>Update Password:</strong></label>
                <input type="text" id="new_password" name="new_password" value="<?php echo $user['password']; ?>" required>
                <button type="submit" name="update_password" class="update-btn">Update Password</button>
            </form>
        </div>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>

</body>
</html>
