<?php
require '../includes/auth.php';
require '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    if ($stmt->execute([$username, $email, $password])) {
        echo "<script>alert('Registration successful'); window.location.href='../pages/login.php'</script>";
    } else {
        echo "<p class='text-red-500'>Error registering user.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="flex items-center justify-center min-h-screen">

    <form method="POST" class="flex flex-col gap-6 justify-center items-center px-8 py-12 border border-gray-300 rounded-lg">
        <h2 class="text-2xl font-bold mb-4">Register</h2>
        
        <input type="text" name="username" placeholder="Username" required class="w-full border p-2 mb-2 rounded"/>
        <input type="email" name="email" placeholder="Email" required class="w-full border p-2 mb-2 rounded"/>
        <input type="password" name="password" placeholder="Password" required class="w-full border p-2 mb-2 rounded"/>
        <button type="submit" class="w-full bg-indigo-500 text-white py-2 rounded hover:bg-indigo-700">Register</button>
        <p class="mt-2 text-sm">Already have an account? <a href="login.php" class="text-indigo-600">Login</a></p>
    </form>

</body>
</html>