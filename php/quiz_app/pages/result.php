<?php
require '../includes/auth.php';
require '../includes/db.php';

if (!is_logged_in() || !isset($_POST['answers'])) {
    header("Location: dashboard.php");
    exit();
}

$answers = $_POST['answers'];
$score = 0;

foreach ($answers as $question_id => $selected) {
    $stmt = $pdo->prepare("SELECT correct_answer FROM questions WHERE id = ?");
    $stmt->execute([$question_id]);
    $correct = $stmt->fetchColumn();
    if ($correct === $selected) {
        $score++;
    }
}

$stmt = $pdo->prepare("INSERT INTO scores (user_id, score) VALUES (?, ?)");
$stmt->execute([$_SESSION['user_id'], $score]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Result</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-6 rounded shadow-md text-center">
        <h1 class="text-3xl font-bold mb-4">Your Score</h1>
        <p class="text-2xl"><?= $score ?>/<?= count($answers) ?></p>
        <a href="dashboard.php" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Back to Dashboard</a>
    </div>

</body>
</html>