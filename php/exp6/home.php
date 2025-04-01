<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Home Page</title>

    <?php
        $server = "localhost:3306";
        $user = "root";
        $password = "";
        $db = "we_lab";

        $conn = new mysqli($server, $user, $password, $db);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $mail = $_POST["email"];
        $pass = $_POST["password"];

        $flag = false;
        $uname = "";

        $stmt = $conn->prepare("SELECT * FROM users WHERE email_id = ?");
        $stmt->bind_param("s", $mail);  

        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            if (password_verify($pass, $user['password'])) {
                $flag = true;
                $uname = $user['user_name'];
            }
        }

        $stmt->close();
        $conn->close();
    ?>
</head>
<body>

    <?php  
        if( ! $flag ) {
            echo "<div>
                <h2>Unauthorized User</h2>
                <a href=\"login.php\">Get Back to Login Page</a>
            </div>";
        } else {
            echo "<div>
                <h2>Welcome $uname</h2>
            </div>";
        }

    ?>
    
    
</body>
</html>