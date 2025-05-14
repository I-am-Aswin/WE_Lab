<?php
require '../includes/auth.php';
require '../includes/db.php';

if (!is_logged_in()) {
    header("Location: ../pages/login.php");
    exit();
}

$stmt = $pdo->query("SELECT * FROM questions ORDER BY RAND() LIMIT 5");
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

<body class="flex justify-center items-center min-h-screen">

    <div class="flex flex-col justify-center items-center pt-6 border border-gray-300 w-3/6 my-12">
    <h1 class="text-3xl font-bold mb-4">Quiz Time!</h1>
    
    <form action="result.php" method="post" class="flex flex-col items-center">

        <div class="p-8 flex flex-col gap-3">
            <?php foreach ($questions as $i => $q): ?>
            <div class="rounded px-4 py-4 border-b border-gray-300">
                <p class="font-semibold text-lg"> <span class="mr-2"><?= $i+1 ?>.</span> <?= htmlspecialchars($q['question_text']) ?></p>
                <div class="grid grid-cols-2 gap-2 mt-3 px-8">
                    <label class="text-gray-600"><input type="radio" name="answers[<?= $q['id'] ?>]" value="A" required> <?= htmlspecialchars($q['option_a']) ?></label>
                    <label class="text-gray-600"><input type="radio" name="answers[<?= $q['id'] ?>]" value="B"> <?= htmlspecialchars($q['option_b']) ?></label>
                    <label class="text-gray-600"><input type="radio" name="answers[<?= $q['id'] ?>]" value="C"> <?= htmlspecialchars($q['option_c']) ?></label>
                    <label class="text-gray-600"><input type="radio" name="answers[<?= $q['id'] ?>]" value="D"> <?= htmlspecialchars($q['option_d']) ?></label>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <button type="submit" class="bg-indigo-600 w-1/3 text-white font-bold text-lg px-5 py-3 mb-6 rounded hover:bg-indigo-700">Submit Answers</button>
    </form>
    </div>
</body>
</html>