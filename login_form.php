<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <form action="login_process.php" method="POST">
        <legend>LOG IN</legend>
        <label>Username</label>
        <br>
        <input type="text" name="username" required />
        <br>
        <label>Password</label>
        <br>
        <input type="password" name="password" required />
        <br>
        <br>
        <br>
        <input type="submit" name="reg" value="LOGIN" />
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
    <?php unset($_SESSION['message']);?>
<?php endif; ?>
</body>
</html>
