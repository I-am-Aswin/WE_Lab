<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login Page</title>

    <?php

        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $server="localhost:3306";
        $user="root";
        $password="";
        $db="we_lab";

        $conn = new mysqli($server, $user, $password, $db);

        if ($conn->connect_error) {
            die("Connection Success " . $conn->connect_error);
        }
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $UNAME = $_POST["username"];
            $MAIL = $_POST["email"];
            $PASS = $_POST["password"];


            $hashed_pass = password_hash($PASS, PASSWORD_BCRYPT);


            $ins_stmt = $conn->prepare("INSERT INTO users (user_name, email_id, password) VALUES (?, ?, ?)");
            $ins_stmt->bind_param("sss", $UNAME, $MAIL, $hashed_pass);
        }

    ?>

</head>
<body>

    <?php
            if( $_SERVER["REQUEST_METHOD"] == "POST") {
                echo '<div style="padding:1.5rem 2rem; border: 1px solid black; width: 60%; text-align: center;">';
                if ($ins_stmt->execute()) {
                    echo "<p>User Registered Successfully<p>";
                } else {
                    echo "<h2>User Registration Failed</p>";
                }
                echo "</div>";
                
                $ins_stmt->close();
            }
        ?>

    <form action="home.php" method="POST">
        <h3>Login Form</h3>

        <div>
            <label for="email">Email ID: </label>
            <input type="email" name="email" id="email" placeholder="Email ID"/>
        </div>

        <div>
            <label for="passwd">Password</label>
            <input type="password" name="password" id="passwd" placeholder="Password">
        </div>


        <input type="submit" value="Login">
    </form>
</body>
</html>