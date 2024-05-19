<?php
include("connection.php");
session_start();
if ($_SESSION["role"] != 'admin') {
    header("Location: user_dashboard.php");
    exit();
}

// applicants with their job applications
$sql = "SELECT applications.id, applications.username, applications.application_text, jobs.title 
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
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-gray-500 min-h-screen flex flex-col">

    <?php include("sidebar.php");?>

    <!-- display applicants -->
    <div class="content mx-auto mt-10 px-4">
        <h1 class="text-4xl font-bold mb-6 text-gray-200">Applicants</h1>
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
                            <!-- <td>                    <form action="delete_application.php" method="post" onsubmit="return confirm('Are you sure you want to delete this job?');">
                        <input type="hidden" name="id" value="<?php echo $applicant['id']; ?>">
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Delete
                        </button>
                    </form></td> -->
                            
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php include("footer.php");?>
    
</body>
</html>

<?php $conn->close(); ?>
