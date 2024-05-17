<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-gray-500">
    <?php include("sidebar.php"); ?>


    <div class="container flex flex-col items-center min-h-screen ml-96">
        <div class="w-full px-4">
            <h1 class="text-3xl font-bold mb-6 text-center text-white">View Users</h1>
            <!-- Table displaying users -->
            <div class="overflow-x-auto shadow-md rounded-lg font-bold">
                <table class="w-full divide-y divide-gray-900">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">UserName</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <!-- php code for displaying details and the necessary buttons -->
                        <?php
                        include("connection.php");
                        $sql = "SELECT * FROM admins";
                        $result = mysqli_query($conn, $sql);

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td class='px-6 py-4 whitespace-nowrap'>" . $row["username"] . "</td>";
                            echo "<td class='px-6 py-4 whitespace-nowrap'>" . $row["email"] . "</td>";
                            echo "<td class='px-6 py-4 whitespace-nowrap'>
                                <button class='bg-blue-500 text-white px-3 py-1 rounded-md mr-2' onclick='openUpdateModal(\"" . $row["id"] . "\", \"" . $row["username"] . "\", \"" . $row["email"] . "\")'>Update</button>
                                <button class='bg-red-500 text-white px-3 py-1 rounded-md' onclick='openDeleteModal(\"" . $row["id"] . "\")'>Delete</button>
                                </td>";
                            echo "</tr>";
                        }

                        mysqli_close($conn);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Update Modal -->
    <div id="updateModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex flex-col items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Update User Info</h3>
                <form id="updateForm" action="update_user.php" method="POST">
                    <input type="hidden" id="updateUserId" name="id">
                    <div class="mt-2">
                        <label for="updateUsername" class="block text-sm font-medium text-gray-700">Username</label>
                        <input type="text" id="updateUsername" name="username" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div class="mt-2">
                        <label for="updateEmail" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="updateEmail" name="email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white">Update</button>
                        <button type="button" class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 mt-2 bg-gray-600 text-base font-medium text-white" onclick="closeUpdateModal()">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="deleteModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Delete User</h3>
                <p class="mt-2 text-sm text-gray-500">Are you sure you want to delete this user? This action cannot be undone.</p>
                <form id="deleteForm" action="delete_user.php" method="POST">
                    <input type="hidden" id="deleteUserId" name="id">
                    <div class="mt-4">
                        <button type="submit" class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Delete</button>
                        <button type="button" class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 mt-2 bg-gray-600 text-base font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500" onclick="closeDeleteModal()">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JS Code for opening and closing modals -->
    <script>
        function openUpdateModal(id, username, email) {
            document.getElementById('updateUserId').value = id;
            document.getElementById('updateUsername').value = username;
            document.getElementById('updateEmail').value = email;
            document.getElementById('updateModal').classList.remove('hidden');
        }

        function closeUpdateModal() {
            document.getElementById('updateModal').classList.add('hidden');
        }

        function openDeleteModal(id) {
            document.getElementById('deleteUserId').value = id;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>
    <!-- Include Toastify JS -->
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <?php 
    
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
