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
        <div class="container">
            <h1>Welcome Here Is the new Toyota Prado 2024</h1>
            <div class="car-image">
                <img src="2024-toyota-land-cruiser-prado-002-tuqa.jpg" alt="Car">
            </div>
            <div class="car-details">
                <h2>Car Details</h2>
                <p>Brand: Toyota</p>
                <p>Model: Prado</p>
                <p>Year: 2024</p>
                <p>Mileage: 10,000 km</p>
                <p>Color: Blue</p>
                <ul>
                    <li>4-wheel drive</li>
                    <li>Air conditioning</li>
                    <li>Power steering</li>
                </ul>
            </div>
            <div class="car-price">
                <span>$25,000</span>
                $18,000
            </div>
            <div class="car-action">
                <button>Buy Now</button>
            </div>
        </div>

        <?php if (isset($_SESSION['message'])): ?>
            <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
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
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>
    </div>
</body>
</html>
