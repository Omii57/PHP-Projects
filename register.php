<?php
session_start();

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['register'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $password = $_POST['password'];
        $confirm_password = $_POST['c_password'];


        
    $sql = "INSERT INTO user (name, email, mobile , password,c_password) VALUES ('$name', '$email', '$mobile', '$password','$confirm_password')";
    if ($result = mysqli_query($conn, $sql)) {
        $popupMessage = "Register successful!";
        $popupType = "success";  // Set type to success for the successful registration
        echo "<script>
            alert('$popupMessage');
            window.location.href = 'login.php';
        </script>";
    }  
    else {
        $popupMessage = "Invalid email or password!";
        $popupType = "error";
    }
}

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="login.css">
    <script src="script.js" defer></script>
</head>
<body>
    <div class="login-container">
        <h2>Register</h2>
        <form action="register.php" method="POST">
            <div class="input-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="mobile">Mobile</label>
                <input type="text" id="mobile" name="mobile" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="input-group">
                <label for="c_password">Confirm Password</label>
                <input type="password" id="c_password" name="c_password" required>
            </div>
            <button type="submit" name="register">Register</button>
        </form>

        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
<script>
        <?php if ($popupMessage != ""): ?>
           
            if ("<?php echo $popupType; ?>" === "success") 
            {
                alert("<?php echo $popupMessage; ?>"); 

            
            }


        <?php endif; ?>

    </script>

</html>
