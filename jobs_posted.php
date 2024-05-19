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
    <title>Jobs Posted</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-gray-500 flex flex-col justify-between">

    <?php include("sidebar.php");?>

    <!-- Main content -->
    <div class="content bg-gray-500 flex-1 p-8 overflow-auto">
        <!-- Display Jobs -->
        <h2 class="text-6xl text-gray-200 mt-8">Jobs Posted</h2>
        <ul class="mt-4 text-gray-300">
            <?php foreach ($jobs as $job): ?>
                <li class="mb-4 flex justify-between items-center bg-gray-800 p-4 rounded">
                    <div>
                        <h3 class="text-3xl text-green-500 font-bold"><?php echo htmlspecialchars($job['title']); ?></h3>
                        <p class="font-bold text-2xl"><?php echo htmlspecialchars($job['description']); ?></p>
                    </div>
                    <form action="delete_job.php" method="post" onsubmit="return confirm('Are you sure you want to delete this job?');">
                        <input type="hidden" name="job_id" value="<?php echo $job['job_id']; ?>">
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Delete
                        </button>
                    </form>
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
    <?php include("footer.php");?>
</body>
</html>

<?php $conn->close(); ?>
