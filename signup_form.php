<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
      <link rel="stylesheet" href="style.css">
   <script>
        function validateForm() {
            var username = document.forms["signupForm"]["username"].value;
            var email = document.forms["signupForm"]["email"].value;
            var password = document.forms["signupForm"]["password"].value;
            var confirmPassword = document.forms["signupForm"]["confirm_password"].value;

            if (username == "" || email == "" || password == "" || confirmPassword == "") {
                alert("All fields must be filled out");
                return false;
            }

            if (password !== confirmPassword) {
                alert("Passwords do not match");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="container max-w-md mx-auto p-6 bg-white rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-center">Registration Form</h2>
        <form action="signup_process.php" method="POST" class="space-y-4">
            <div class="form-group">
                <label for="username" class="block text-sm font-medium text-gray-700">Username:</label>
                <input type="text" id="username" name="username" placeholder="Enter username" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>
            <div class="form-group">
                <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                <input type="email" id="email" name="email" placeholder="Enter Email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>
            <div class="form-group">
                <label for="password" class="block text-sm font-medium text-gray-700">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter Password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>
            <div class="form-group">
                <label for="confirm_password" class="block text-sm font-medium text-gray-700">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Sign Up" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 cursor-pointer">
            </div>
        </form>
    </div>

    <?php if (isset($_SESSION['message'])): ?>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        Toastify({
            text: "<?php echo $_SESSION['message']; ?>",
            duration: 5000,
            gravity: "top",
            position: 'right',
            backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
            stopOnFocus: true
        }).showToast();
    </script>
    <?php unset($_SESSION['message']); ?>
    <?php endif; ?>
</body>
</html>