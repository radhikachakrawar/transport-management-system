<?php
session_start();

// Database connection parameters
$servername = "localhost";
$db_username = "root";
$db_password = ""; // Leave blank if there is no password
$dbname = "transportation_ms"; // Database name

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reset_password'])) {
    if (isset($_POST["reset_email"])) {
        $email = htmlspecialchars($_POST["reset_email"]);
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $token = bin2hex(random_bytes(50)); // Generate a random token
            $expiry = date("Y-m-d H:i:s", strtotime('+1 hour')); // Set token expiry time

            // Insert token into the database
            $sql = "INSERT INTO password_resets (email, token, expiry) VALUES ('$email', '$token', '$expiry')";
            if ($conn->query($sql) === TRUE) {
                $resetLink = "http://transporataionms.com/reset_password.php?token=$token";
                $subject = "Password Reset Request";
                $message = "Click on the following link to reset your password: $resetLink";
                $headers = "From: no-reply@transporataionms.com";

                if (mail($email, $subject, $message, $headers)) {
                    echo "<script>alert('A password reset link has been sent to your email.');</script>";
                } else {
                    echo "<script>alert('Failed to send email.');</script>";
                }
            } else {
                echo "<script>alert('Failed to insert token into database.');</script>";
            }
        } else {
            echo "<script>alert('Email not found');</script>";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="login-signup.css">
    <style>
        .forgot-password-container{
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container forgot-password-container">
            <form action="forgot_password.php" method="POST">
                <h1>Reset Password</h1>
                <span>Enter your email to reset your password</span>
                <input type="email" placeholder="Email" name="reset_email" id="resetEmail" required />
                <button type="submit" name="reset_password">Reset Password</button>
            </form>
        </div>
    </div>
</body>
</html>
