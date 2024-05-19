<?php
include("connection.php");
session_start();

if ($_SESSION["role"] != 'admin') {
    header("Location: user_dashboard.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['job_id'])) {
    $job_id = intval($_POST['job_id']);
    
    // Delete related applications
    // $stmt = $conn->prepare("DELETE FROM applications WHERE job_id = ?");
    // $stmt->bind_param("i", $job_id);
    // $stmt->execute();
    // // $stmt->close();

    // Prepare the SQL delete statement for the job
    $stmt = $conn->prepare("DELETE FROM jobs WHERE job_id = ?");
    $stmt->bind_param("i", $job_id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Job deleted successfully.";
    } else {
        $_SESSION['message'] = "Failed to delete job.";
    }

    $stmt->close();
}

$conn->close();

// Redirect back to jobs_posted.php
header("Location: jobs_posted.php");
exit();
?>
