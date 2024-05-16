<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-gray-100">
    <?php include('sidebar.php'); ?>
    <div class="main-content flex flex-col min-h-screen">
        <?php include('topnav.php'); ?>
        <div class="container mx-auto p-6">
            <div class=" flex justify-center mb-6">
                <img src="mana.jpeg" alt="About Us Image" class="max-w-xs md:max-w-md rounded-lg shadow-lg">
            </div>
            <div class="about-text bg-white p-6 rounded-lg shadow-lg">
                <h1 class="text-3xl font-bold mb-4">About us</h1>
                <h5 class="text-xl font-semibold mb-2">CUSTOMER SERVICE <span class="text-green-500">& SATISFACTION</span></h5>
                <p class="text-gray-700 leading-relaxed">The history of cars is long, and there are many types that can be classified as “standard” or “luxury”. Cars have become a large part of our culture and everyday life too; they have taken on an entirely different meaning from what they originally were.</p>
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
