<?php
include("connection.php");
session_start();
if ($_SESSION["role"] != 'admin') {
    header("Location: user_dashboard.php");
    exit();
}

// Fetch jobs
$result = $conn->query("SELECT * FROM jobs");
$jobs = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-gray-400">

    <?php include("sidebar.php");?>

    <!-- Main content -->
    <div class="content">
        <!-- Display Jobs -->
        <h2 class="text-6xl text-gray-200 mt-8">Jobs Posted</h2>
        <ul class="mt-4 text-gray-300">
            <?php foreach ($jobs as $job): ?>
                <li class="mb-4">
                    <h3 class="text-3xl text-green-500 font-bold"><?php echo htmlspecialchars($job['title']); ?></h3>
                    <p class="font-bold text-2xl"><?php echo htmlspecialchars($job['description']); ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- Include Toastify JS -->
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <?php
    // Display Toastify message if there is one
    if (isset($_SESSION['message'])): ?>
        <script>
            Toastify({
                text: "<?php echo $_SESSION['message']; ?>",
                duration: 3000,
                gravity: "top",
                position: 'right',
                backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                stopOnFocus: true
            }).showToast();
        </script>
        <?php 
        unset($_SESSION['message']); 
    endif; ?>
</body>
</html>

<?php $conn->close(); ?>
