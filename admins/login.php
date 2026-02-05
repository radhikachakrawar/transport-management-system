<?php
session_start();

$servername = "localhost:3307";
$db_username = "root";
$db_password = "";
$dbname = "transportation_ms";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

   $stmt = $conn->prepare(
    "SELECT id, username FROM admins WHERE BINARY username = ? AND BINARY password = ?"
);
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$stmt->store_result();

    if ($stmt->num_rows === 1) {

        $stmt->bind_result($id, $admin_username);
        $stmt->fetch();

        $_SESSION['admin_loggedin'] = true;
        $_SESSION['admin_id'] = $id;
        $_SESSION['admin_username'] = $admin_username;


        header("Location: admin1/index.php");
        exit();
    } else {
        $error = "Invalid username or password";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
        }
        .login-container {
            width: 350px;
            margin: 100px auto;
        }
        .login-form {
            background: #fff;
            padding: 25px;
            border-radius: 6px;
            box-shadow: 0 0 10px rgba(0,0,0,.1);
        }
        .input-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input {
            width: 100%;
            padding: 8px;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="login-form">
        <h2>Admin Login</h2>

        <?php if ($error): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" required>
            </div>

            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit">Login</button>
        </form>
    </div>
</div>

</body>
</html>
