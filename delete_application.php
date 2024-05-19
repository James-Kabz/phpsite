<?php
include("connection.php");
session_start();

if ($_SESSION["role"] != 'admin') {
    header("Location: user_dashboard.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    
    // Delete related applications
    $stmt = $conn->prepare("DELETE FROM applications WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    // $stmt->close();


    if ($stmt->execute()) {
        $_SESSION['message'] = "Application deleted successfully.";
    } else {
        $_SESSION['message'] = "Failed to delete application.";
    }

    $stmt->close();
}

$conn->close();

// Redirect back to jobs_posted.php
header("Location: applicants.php");
exit();
?>
