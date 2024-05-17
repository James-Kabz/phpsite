<?php
session_start();
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"];

    $sql = "DELETE FROM admins WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "User deleted successfully";
        header("Location: viewusers.php");
        exit();
    } else {
        $_SESSION['message'] = "Failed to delete user";
        header("Location: viewusers.php");
        exit();
    }

    $stmt->close();
}

mysqli_close($conn);
?>
