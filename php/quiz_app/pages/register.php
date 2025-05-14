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

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <form method="POST" class="bg-white p-6 rounded shadow-md w-96">
        <h2 class="text-2xl font-bold mb-4">Register</h2>
        
        <input type="text" name="username" placeholder="Username" required class="w-full border p-2 mb-2 rounded"/>
        <input type="email" name="email" placeholder="Email" required class="w-full border p-2 mb-2 rounded"/>
        <input type="password" name="password" placeholder="Password" required class="w-full border p-2 mb-2 rounded"/>
        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">Register</button>
        <p class="mt-2 text-sm">Already have an account? <a href="login.php" class="text-blue-500">Login</a></p>
    </form>

</body>
</html>