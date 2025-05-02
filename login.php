<?php
session_start();
include 'config.php';

$popupMessage = "";
$popupType = "";

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT id, email FROM user WHERE email = '$email' AND password = '$password'"; 
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];

        $popupMessage = "Login successful!";
        $popupType = "success";

        echo "<script>
            alert('$popupMessage');
            window.location.href = 'index.php';
        </script>";
        exit();
    } else {
        $popupMessage = "Invalid email or password!";
        $popupType = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form id="loginForm" action="login.php" method="POST">
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>" required />
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required />
            </div>
            <button type="submit" name="submit">Login</button>
        </form>

        <p>Don't have an account? <a href="register.php">Register here</a></p>
        <p><strong>Admin?</strong> <a href="admin_login.php" class="admin-link">Login as Admin</a></p>
    </div>
    
    <script>
        <?php if ($popupMessage != ""): ?>
            alert("<?php echo $popupMessage; ?>");
        <?php endif; ?>
    </script>

</body>
</html>
