<?php
session_start();

$hostname = "localhost";
$db_username = "root";
$db_password = "1234";
$database = "admin_db";

$conn = new mysqli($hostname, $db_username, $db_password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM admins WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $username;
            $_SESSION['last_activity'] = time(); 
            $_SESSION['message'] = "Login successful! Welcome $username.";
            header("Location: welcome.php");
            exit();
        } else {
            $_SESSION['message'] = "Invalid password!";
            header("Location: login_form.php");
            exit();
        }
    } else {
        $_SESSION['message'] = "User not found!";
        header("Location: login_form.php");
        exit();
    }
}

$conn->close();
?>
