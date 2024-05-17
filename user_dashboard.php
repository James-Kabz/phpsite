<?php
include("connection.php");
session_start();
if ($_SESSION["role"] != 'user') {
    header("Location: admin_dashboard.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["apply_job"])) {
    $job_id = $_POST["job_id"];
    $application_text = $_POST["application_text"];
    $username = $_SESSION["username"];

    $sql = "INSERT INTO applications (job_id, username, application_text) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $job_id, $username, $application_text);
    $stmt->execute();
    $stmt->close();

    $_SESSION['message'] = "Application submitted successfully!";
    header("Location: user_dashboard.php");
    exit();
}

$jobs = $conn->query("SELECT * FROM jobs")->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Include Toastify CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10 px-4 md:px-10 lg:px-20">
        <h1 class="text-2xl font-bold mb-6">Welcome</h1>

    <div class="float-right">
        <form action="logout.php" method="POST">
        <button type="submit" class="bg-red-500 hover:bg-red-700 px-4 py-2 rounded-md text-white">Logout</button>
        </form>
    </div>
    <br>
    <br>
        <h2 class="text-4xl mt-5">Here's are the Available Jobs</h2>
        <ul class="mt-5 space-y-6">
            <?php foreach ($jobs as $job): ?>
                <li class="border-b py-6">
                    <h3 class="text-lg font-bold text-blue-700"><?php echo htmlspecialchars($job['title']); ?></h3>
                    <p class="text-gray-700 mt-2"><?php echo htmlspecialchars($job['description']); ?></p>
                    <form method="post" class="mt-4">
                        <input type="hidden" name="job_id" value="<?php echo $job['job_id']; ?>">
                        <textarea name="application_text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Your application" required></textarea>
                        <button type="submit" name="apply_job" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-2">Apply</button>
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
        unset($_SESSION['message']); // Clear the message after displaying it
    endif; ?>
</body>
</html>

<?php $conn->close(); ?>
