<?php
require '../includes/auth.php';
require '../includes/db.php';

if (!is_logged_in()) {
    header("Location: ../pages/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
  <div class="bg-white p-6 rounded shadow-md w-96 text-center">
    <h2 class="text-2xl font-bold mb-4">Welcome!</h2>
    <a href="quiz.php" class="block bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">Start Quiz</a>
    <a href="../logout.php" class="block mt-4 text-red-500">Logout</a>
  </div>
</body>
</html>