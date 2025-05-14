<?php require 'includes/auth.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Quiz App</title>
  <script src="https://cdn.tailwindcss.com "></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
  <div class="text-center">
    <h1 class="text-4xl font-bold text-blue-600 mb-6">Welcome to Quiz App</h1>
    <?php if (!is_logged_in()): ?>
      <a href="pages/register.php" class="bg-green-500 text-white px-4 py-2 rounded mr-2 hover:bg-green-600">Register</a>
      <a href="pages/login.php" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Login</a>
    <?php else: ?>
      <a href="pages/dashboard.php" class="bg-purple-500 text-white px-4 py-2 rounded hover:bg-purple-600">Go to Dashboard</a>
    <?php endif; ?>
  </div>
</body>
</html>