<?php
require 'includes/auth.php';
require 'includes/db.php';

if (!is_logged_in()) {
    header("Location: pages/login.php");
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

<body class="flex justify-center items-center min-h-screen min-w-screen">

    <div class="flex flex-row h-full items-center justify-between px-16 py-12 w-1/2 min-h-2/3 border border-gray-300">
        <div class="flex flex-col items-center justify-center gap-6 h-full p-10">

            <div class="bg-gray-400 rounded-full w-[7rem] h-[7rem]"></div>

            <h2 class="text-4xl font-bold"><?php echo $_SESSION['user_name'] ?></h2>
            <h4 class="text-xl"> 
                <span class="font-bold">Average Score : </span>

                <?php
                    $stmt = $pdo->prepare("SELECT AVG(score) as score FROM scores WHERE user_id = ?");
                    $stmt->execute([$_SESSION['user_id']]);
                    $avg = $stmt->fetch();

                    if( $avg ) {
                        echo $avg['score'];
                    } else {
                        echo "0";
                    }
                ?>
            </h4>

            <a href="logout.php" class="bg-red-600 decoration-none hover:bg-red-700 text-white px-5 py-3 rounded-lg shadow-sm font-bold text-md">Logout</a>
        </div>

        <div class="flex flex-col items-center justify-between gap-8 p-10 h-full border-l border-gray-300 w-1/2">
            <p class="text-3xl font-bold">Quiz App</p>
            <p class="text-lg"> <span class="font-bold">Questions : </span> 05</p>
            <p class="text-lg -mt-6"> <span class="font-bold">Duration : </span> Indefinite</p>
            <a href="pages/quiz.php" class="bg-indigo-600 decoration-none hover:bg-indigo-700 text-white px-5 py-3 rounded-lg shadow-sm font-bold text-md">Start Quiz</a>
        </div>
    </div>

</body>
</html>