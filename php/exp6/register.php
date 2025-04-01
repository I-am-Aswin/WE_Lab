<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login Page</title>
</head>
<body>
    

    <form action="login.php" method="POST">

        <h3>Registration Form</h3>

        <div>
            <label for="username">UserName: </label>
            <input type="text" name="username" id="username" placeholder="UserName"/>
        </div>

        <div>
            <label for="email">Email ID : </label>
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