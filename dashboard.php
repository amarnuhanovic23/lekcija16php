<?php
session_start();

require_once "config.php";

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$isAdmin = ($_SESSION['is_admin'] == '1');

$usersSql = "SELECT id, name, username, email, is_admin FROM users ORDER BY id DESC";

$users = [];

if ($isAdmin) {
    $stmt = $conn->query($usersSql);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$moviesSql = "SELECT * FROM movies ORDER BY id DESC";

$movies = $conn->query($moviesSql)->fetchAll(PDO::FETCH_ASSOC);

function e($value) {
    return htmlspecialchars(
        (string)$value,
        ENT_QUOTES,
        'UTF-8'
    );
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - MMS</title>
    <link href="https://jsdelivr.net" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard.php">Movie Management System</a>
            <div class="d-flex align-items-center gap-3">
                <span class="text-white">
                    Welcome, <?php echo e($_SESSION['username']); ?>!
                </span>
                <a href="logout.php" class="btn btn-outline-light">Sign Out</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        
        <h2>Dashboard</h2>
        <p>Welcome to Movie Management System!</p>

        <?php if ($isAdmin): ?>
            
            <h3 class="mt-5">Users</h3>
            
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?php echo e($user['id']); ?></td>
                                <td><?php echo e($user['name']); ?></td>
                                <td><?php echo e($user['username']); ?></td>
                                <td><?php echo e($user['email']); ?></td>
                                <td>
                                    <?php 
                                    echo $user['is_admin'] == '1' 
                                        ? 'Admin' 
                                        : 'User'; 
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        <?php endif; ?>

        <div class="d-flex justify-content-between align-items-center mt-5 mb-3">
            <h3>Movies</h3>
            <?php if ($isAdmin): ?>
                <a href="add.php" class="btn btn-success">Add Movie</a>
            <?php endif; ?>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Movie Name</th>
                        <th>Description</th>
                        <th>Quality</th>
                        <th>Rating</th>
                        <th>Image</th>
                        <?php if ($isAdmin): ?>
                            <th>Actions</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($movies as $movie): ?>
                        <tr>
                            <td><?php echo e($movie['id']); ?></td>
                            <td><?php echo e($movie['movie_name']); ?></td>
                            <td><?php echo e($movie['movie_desc']); ?></td>
                            <td><?php echo e($movie['movie_quality']); ?></td>
                            <td><?php echo e($movie['movie_rating']); ?></td>
                            <td><?php echo e($movie['movie_image']); ?></td>
                            
                            <?php if ($isAdmin): ?>
                                <td>
                                    <a href="edit.php?id=<?php echo e($movie['id']); ?>" class="btn btn-warning btn-sm">
                                        Update
                                    </a>
                                    
                                    <form action="delete.php" method="POST" class="d-inline" onsubmit="return confirm('Delete this movie?');">
                                        <input type="hidden" name="id" value="<?php echo e($movie['id']); ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>

</body>
</html>
