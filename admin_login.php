<?php
session_start();

// Hardcoded admin credentials for simplicity
$admin_username = 'admin';
$admin_password = 'password123';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check credentials
    if ($username === $admin_username && $password === $admin_password) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: admin_dashboard.php');
        exit();
    } else {
        $error = 'Invalid username or password.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - HerVoice Rwanda</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body
    class="font-sans leading-relaxed bg-gradient-to-br from-violet-900 to-violet-950 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-3xl shadow-2xl w-96 border border-violet-200">
        <div class="text-center mb-6">
            <h2 class="text-3xl font-bold text-violet-900 mb-2">Admin Login</h2>
            <p class="text-gray-600">HerVoice Rwanda</p>
        </div>

        <?php if (isset($error)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
                <p class="font-semibold">❌ <?php echo $error; ?></p>
            </div>
        <?php endif; ?>

        <form method="POST" action="" class="space-y-4">
            <div>
                <label for="username" class="block text-violet-900 font-semibold mb-2">Username</label>
                <input type="text" name="username" id="username" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-violet-500 focus:outline-none bg-gray-50">
            </div>
            <div>
                <label for="password" class="block text-violet-900 font-semibold mb-2">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-violet-500 focus:outline-none bg-gray-50">
            </div>
            <button type="submit"
                class="w-full bg-gradient-to-r from-violet-600 to-violet-800 text-white font-bold py-3 rounded-full hover:shadow-lg transform hover:-translate-y-1 transition duration-300">
                Login
            </button>
        </form>

        <div class="text-center mt-6">
            <a href="index.php" class="text-violet-600 hover:text-violet-800 text-sm hover:underline">← Back to Home</a>
        </div>
    </div>
</body>

</html>