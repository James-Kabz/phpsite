<?php
include("connection.php");
session_start();
if ($_SESSION["role"] != 'admin') {
    header("Location: user_dashboard.php");
    exit();
}

// Fetch applicants with their job titles
$sql = "SELECT applications.username, applications.application_text, jobs.title 
        FROM applications 
        JOIN jobs ON applications.job_id = jobs.job_id";
$result = $conn->query($sql);
$applicants = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Applicants</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <?php include("sidebar.php");?>

    <!-- Main content -->
    <div class="flex-1 content mx-auto mt-10 px-4">
        <h1 class="text-4xl font-bold mb-6 text-gray-800">Applicants</h1>
        <div class="bg-white shadow-md rounded-lg p-6">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-blue-600 text-left text-xs font-semibold text-white uppercase tracking-wider">Username</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-blue-600 text-left text-xs font-semibold text-white uppercase tracking-wider">Job Title</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-blue-600 text-left text-xs font-semibold text-white uppercase tracking-wider">Application Text</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($applicants as $applicant): ?>
                        <tr class="bg-gray-50 hover:bg-gray-100 transition duration-200">
                            <td class="px-5 py-5 border-b border-gray-200 text-3xl text-gray-700 font-extrabold"><?php echo htmlspecialchars($applicant['username']); ?></td>
                            <td class="px-5 py-5 border-b border-gray-200 text-2xl text-gray-700 font-bold"><?php echo htmlspecialchars($applicant['title']); ?></td>
                            <td class="px-5 py-5 border-b border-gray-200 text-xl text-gray-700 font-semibold"><?php echo htmlspecialchars($applicant['application_text']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <footer class="bg-gray-800 text-white text-center py-4">
        © 2023 Your Company. All rights reserved.
    </footer>
    
</body>
</html>

<?php $conn->close(); ?>
