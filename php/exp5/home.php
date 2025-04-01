<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Home Page</title>

    <?php
        $users = array(
            array("uname"=>"user1", "pass"=>"1234"),
            array("uname"=>"user2", "pass"=>"5678"),
        );

        $uname = $_POST["username"];
        $pass = $_POST["password"];

        $flag=false;
        foreach( $users as $user ) {
            if( $user["uname"] == $uname && $user["pass"] == $pass) {
                $flag=true;
            }
        }
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