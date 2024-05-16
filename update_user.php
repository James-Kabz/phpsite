<?php
session_start();
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userId = $_POST["user_id"];
    $username = $_POST["username"];
    $email = $_POST["email"];

    // Perform update operation in the database
    $sql = "UPDATE admins SET username=?, email=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $username, $email, $userId);
    
    if ($stmt->execute()) {
        $_SESSION['message'] = "User info updated successfully";
        header("Location: viewusers.php");
        exit();
    } else {
        $_SESSION['message'] = "Failed to update user info";
        header("Location: viewusers.php");
        exit();
    }

    $stmt->close();
}

mysqli_close($conn);
?>
