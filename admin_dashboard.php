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
<body class="bg-gray-300">

    <?php include("sidebar.php");?>

    <!-- Main content -->
    <div class="container mx-auto mt- px-4">
        <h1 class="text-2xl font-bold mb-4">Admin Dashboard</h1>

        <!-- Post a Job Section -->
        <h2 class="text-xl">Post a Job</h2>
        <form method="post" action="post_job.php" class="mt-4">
            <div class="mb-4">
                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Job Title</label>
                <input type="text" name="title" id="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                <textarea name="description" id="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
            </div>
            <button type="submit" name="post_job" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Post Job</button>
        </form>
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
