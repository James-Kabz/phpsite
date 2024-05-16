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
    <div class="container">
        <h2>Registration Form</h2>
        <form action="signup_process.php" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Enter username" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Enter Email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter Password" required>
                <label for="password">Confirm Password</label>
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            </div>
            <input type="submit" value="Sign Up">
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
