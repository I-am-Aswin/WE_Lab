<?php
require '../includes/auth.php';
require '../includes/db.php';

if (!is_logged_in()) {
    header("Location: ../pages/login.php");
    exit();
}

$stmt = $pdo->query("SELECT * FROM questions ORDER BY RAND() LIMIT 10");
$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Quiz Time</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-100 p-6">

    <h1 class="text-3xl font-bold mb-4">Quiz Time!</h1>
    
    <form action="result.php" method="post">
        <?php foreach ($questions as $i => $q): ?>
        <div class="bg-white p-4 rounded shadow mb-4">
            <p class="font-semibold"><?= $i+1 ?>. <?= htmlspecialchars($q['question_text']) ?></p>
            <label class="block mt-2"><input type="radio" name="answers[<?= $q['id'] ?>]" value="A" required> <?= htmlspecialchars($q['option_a']) ?></label>
            <label class="block mt-2"><input type="radio" name="answers[<?= $q['id'] ?>]" value="B"> <?= htmlspecialchars($q['option_b']) ?></label>
            <label class="block mt-2"><input type="radio" name="answers[<?= $q['id'] ?>]" value="C"> <?= htmlspecialchars($q['option_c']) ?></label>
            <label class="block mt-2"><input type="radio" name="answers[<?= $q['id'] ?>]" value="D"> <?= htmlspecialchars($q['option_d']) ?></label>
        </div>
        <?php endforeach; ?>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Submit Answers</button>
    </form>
</body>
</html>