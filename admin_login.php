<?php
session_start();
include 'config.php';

$popupMessage = "";

if (isset($_POST['submit'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Query to check if the admin email and password match
    $sql = "SELECT email, password FROM admin WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        $_SESSION['admin_email'] = $email;

        echo "<script>
            alert('Login successful!');
            window.location.href = 'admin.php';
        </script>";
        exit();
    } else {
        $popupMessage = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <form id="loginForm" action="admin_login.php" method="POST">
            <div class="input-group">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" required />
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required />
            </div>
            <button type="submit" name="submit">Login</button>
        </form>
        <?php if (!empty($popupMessage)): ?>
            <p style="color: red; text-align: center;"><?php echo $popupMessage; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
