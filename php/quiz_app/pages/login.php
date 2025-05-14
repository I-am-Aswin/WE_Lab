<?php
require '../includes/auth.php';
require '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['username'];
        header("Location: ../index.php");
        exit();
    } else {
        echo "<script>alert('Invalid credentials')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Login</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="flex items-center justify-center min-h-screen">

    <form method="POST" class="flex flex-col gap-6 justify-center items-center px-8 py-12 border border-gray-300 rounded-lg">
        <h2 class="text-2xl font-bold mb-4">Login</h2>
        <input type="email" name="email" placeholder="Email" required class="w-full border p-2 mb-2 rounded"/>
        <input type="password" name="password" placeholder="Password" required class="w-full border p-2 mb-2 rounded"/>
        <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700">Login</button>
        <p class="mt-2 text-sm">Don't have an account? <a href="register.php" class="text-indigo-600">Register</a></p>
    </form>
    
</body>
</html>