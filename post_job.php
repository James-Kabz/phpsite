<?php
include("connection.php");
session_start();
if ($_SESSION["role"] != 'admin') {
    header("Location: user_dashboard.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $posted_by = $_SESSION["username"];

    $sql = "INSERT INTO jobs (title, description, posted_by) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $title, $description, $posted_by);
    $stmt->execute();
    $stmt->close();

    $_SESSION['message'] = "Job posted successfully!";
    header("Location: admin_dashboard.php");
    exit();
}
?>
