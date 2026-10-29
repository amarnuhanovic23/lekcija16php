<?php
require_once "config.php";
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register - MMS</title>

    <link href="https://jsdelivr.net" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <main class="form-signin">

        <div class="logo">B</div>

        <h2 class="mb-4">Register</h2>

        <form action="add.php" method="POST">

            <input 
                type="text"
                name="name"
                class="form-control"
                placeholder="Name"
                required
            >

            <input 
                type="text"
                name="username"
                class="form-control"
                placeholder="Username"
                required
            >

            <input 
                type="email"
                name="email"
                class="form-control"
                placeholder="Email"
                required
            >

            <input 
                type="password"
                name="password"
                class="form-control"
                placeholder="Password"
                required
            >

            <input 
                type="password"
                name="confirm_password"
                class="form-control"
                placeholder="Confirm Password"
                required
            >

            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" name="remember">
                    Remember me
                </label>
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit" name="submit">
                Sign Up
            </button>

            <p class="mt-3">
                Already have an account?
                <a href="login.php">Sign in</a>
            </p>

        </form>

    </main>

</body>
</html>
