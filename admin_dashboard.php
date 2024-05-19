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
<body class="bg-black flex flex-col justify-between ">

    <?php include("sidebar.php");?>

    <!-- Main content -->
    <div class="mx-auto mt-5 px-40 py-36 shadow-lg shadow-gray-900 bg-gray-900">
        <h1 class="text-2xl font-bold mb-4 text-white">Post A Job</h1>
        <form method="post" action="post_job.php" class="">
            <div class="py-16">
                <label for="title" class="block text-gray-100 text-sm font-bold mb-2">Job Title</label>
                <input type="text" name="title" id="title" class="shadow appearance-none border rounded w-full py-5 px-10 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-100 text-sm font-bold mb-2">Description</label>
                <textarea name="description" id="description" class="shadow appearance-none border rounded w-full py-5 px-10 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
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
    <?php include("footer.php");?>
</body>
</html>

<?php $conn->close(); ?>
