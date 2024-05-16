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
      <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    include('sidebar.php');
    ?>
  
 <div class="main-content flex flex-col min-h-screen">
        <?php
        include('topnav.php');
        ?>
        <div class="container mx-auto p-6">
            <h1 class="text-3xl font-bold mb-6 text-center">Welcome! Here Is the new Toyota Prado 2024</h1>
            <div class="car-image flex justify-center mb-6">
                <img src="2024-toyota-land-cruiser-prado-002-tuqa.jpg" alt="Car" class="rounded-lg shadow-lg">
            </div>
            <div class="car-details bg-white p-6 rounded-lg shadow-lg mb-6">
                <h2 class="text-2xl font-semibold mb-4">Car Details</h2>
                <p><span class="font-bold">Brand:</span> Toyota</p>
                <p><span class="font-bold">Model:</span> Prado</p>
                <p><span class="font-bold">Year:</span> 2024</p>
                <p><span class="font-bold">Mileage:</span> 10,000 km</p>
                <p><span class="font-bold">Color:</span> Blue</p>
                <ul class="list-disc list-inside mt-4">
                    <li>4-wheel drive</li>
                    <li>Air conditioning</li>
                    <li>Power steering</li>
                </ul>
            </div>
            <div class="car-price text-center bg-white p-6 rounded-lg shadow-lg mb-6">
                <span class="text-xl line-through">$25,000</span>
                <span class="text-2xl font-bold text-green-500 ml-4">$18,000</span>
            </div>
            <div class="car-action text-center">
                <button class="bg-blue-500 text-white px-6 py-2 rounded-lg shadow-lg hover:bg-blue-600 transition duration-300">Buy Now</button>
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
