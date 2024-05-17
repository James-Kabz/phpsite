<?php
include("connection.php");
session_start();
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
            $_SESSION["username"] = $username;
            $_SESSION["role"] = $row["role"];
            $_SESSION['message'] = "Login successful! Welcome $username.";
            
            if ($row["role"] == 'admin') {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: user_dashboard.php");
            }
            exit();
        } else {
            $_SESSION['message'] = "Invalid password!";
            header("Location: login_form.php");
        }
    } else {
        $_SESSION['message'] = "User not found!";
        header("Location: login_form.php");
    }
}

$conn->close();
?>
