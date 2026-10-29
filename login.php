<?php
require_once "config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - MMS</title>
    
    <link href="https://jsdelivr.net" rel="stylesheet">
    
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <main class="form-signin">

        <div class="logo">B</div>

        <h2 class="mb-4">Please sign in</h2>

        <form action="loginlogic.php" method="POST">

            <input 
                type="text"
                name="username"
                class="form-control"
                placeholder="Username"
                required
            >

            <input 
                type="password"
                name="password"
                class="form-control"
                placeholder="Password"
                required
            >

            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" name="remember">
                    Remember me
                </label>
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit" name="submit>
                Sign in
            </button>

            <p class="mt-3">
                Don't have an account?
                <a href="index.php">Sign up</a>
            </p>

        </form>

    </main>

</body>
</html>
