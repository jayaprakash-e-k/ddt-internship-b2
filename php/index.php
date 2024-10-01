<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample</title>
</head>

<body>

    <form action="./login.php" method="POST">
        <h2>Login Form</h2>
        <input type="email" name="username" placeholder="Enter username">

        <br>

        <input type="password" name="pass" id="pass" placeholder="Enter password">

        <br>

        <button>Sign In</button>
    </form>

    <form action="./register.php" method="post">
        <h2>Register Form</h2>

        <input type="text" name="name" placeholder="Enter name" required>
        <br>

        <input type="email" name="username" placeholder="Enter username" required>
        <br>

        <input type="password" name="pass" id="pass" placeholder="Enter password" required>
        <br>

        <input type="password" name="cpass" id="cpass" placeholder="Enter confirm password" required>
        <br>

        <button>Sign Up</button>
    </form>

</body>

</html>