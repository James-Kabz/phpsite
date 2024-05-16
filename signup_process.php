<?php
session_start();

include("connection.php");
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $_SESSION['message'] = "All fields are required.";
        header("Location: signup_form.php");
        exit();
    }

    if ($password !== $confirm_password) {
        $_SESSION['message'] = "Passwords do not match.";
        header("Location: signup_form.php");
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO admins (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        $_SESSION['message'] = "SQL error: " . $conn->error;
        header("Location: signup_form.php");
        exit();
    }

    $stmt->bind_param("sss", $username, $email, $hashed_password);

    if ($stmt->execute()) {
        $_SESSION['message'] = "New user created successfully";
        header("Location: login_form.php");
        exit();
    } else {
        $_SESSION['message'] = "New user not created successfully: " . $stmt->error;
        header("Location: signup_form.php");
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
