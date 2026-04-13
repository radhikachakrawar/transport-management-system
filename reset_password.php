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
    if (isset($_POST["password"]) && isset($_POST["confirm_password"]) && isset($_POST["token"])) {
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];
        $token = $_POST["token"];

        if ($password === $confirm_password) {
            // Retrieve email using the token
            $sql = "SELECT email FROM password_resets WHERE token = '$token' AND expiry > NOW()";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $email = $row['email'];
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Update password in users table
                $sql = "UPDATE users SET password = '$hashed_password' WHERE email = '$email'";
                if ($conn->query($sql) === TRUE) {
                    // Delete the token from password_resets table
                    $sql = "DELETE FROM password_resets WHERE token = '$token'";
                    $conn->query($sql);

                    echo "<script>alert('Your password has been successfully reset.');</script>";
                    header("Location: index.php");
                    exit();
                } else {
                    echo "<script>alert('Failed to update password.');</script>";
                }
            } else {
                echo "<script>alert('Invalid or expired token.');</script>";
            }
        } else {
            echo "<script>alert('Passwords do not match.');</script>";
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
    <title>Reset Password</title>
    <link rel="stylesheet" href="login-signup.css">
</head>
<body>
    <div class="container">
        <div class="form-container reset-password-container">
            <form action="reset_password.php" method="POST">
                <h1>Reset Password</h1>
                <span>Enter your new password</span>
                <input type="password" placeholder="New Password" name="password" id="password" required />
                <input type="password" placeholder="Confirm New Password" name="confirm_password" id="confirmPassword" required />
                <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>" />
                <button type="submit" name="reset_password">Reset Password</button>
            </form>
        </div>
    </div>
</body>
</html>
