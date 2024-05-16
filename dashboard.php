<?php
session_start();

$session_timeout = 900;


function isAuthenticated() {
    global $session_timeout;
    if (isset($_SESSION['user_id']) && isset($_SESSION['last_activity'])) {
        if ((time() - $_SESSION['last_activity']) < $session_timeout) {
            $_SESSION['last_activity'] = time(); 
            return true;
        } else {
            session_unset();
            session_destroy();
        }
    }
    return false;
}

if (!isAuthenticated()) {
    header("Location: login_form.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Toastify CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    include('sidebar.php');
    ?>
  
    <div class="main-content">
    <?php
    include('topnav.php');
    ?>  
    </div>
</body>
</html>
