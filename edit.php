<?php
session_start();

require_once "config.php";

if (
    !isset($_SESSION['id']) ||
    $_SESSION['is_admin'] != '1'
) {
    header("Location: login.php");
    exit();
}

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    die("Invalid movie ID.");
}

$sql = "SELECT * FROM movies WHERE id = :id";

$stmt = $conn->prepare($sql);

$stmt->execute([
    ':id' => $id
]);

$movie = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$movie) {
    die("Movie not found.");
}

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
    <title>Edit Movie</title>
    <link href="https://jsdelivr.net" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5" style="max-width: 600px;">

        <h2>Edit Movie</h2>

        <form action="update.php" method="POST">

            <input type="hidden" 
                   name="id" 
                   value="<?php echo e($movie['id']); ?>">

            <label>Movie Name</label>
            <input type="text"
                   name="movie_name"
                   class="form-control mb-3"
                   value="<?php echo e($movie['movie_name']); ?>"
                   required>

            <label>Description</label>
            <textarea name="movie_desc" 
                      class="form-control mb-3" 
                      required><?php echo e($movie['movie_desc']); ?></textarea>

            <label>Quality</label>
            <input type="text"
                   name="movie_quality"
                   class="form-control mb-3"
                   value="<?php echo e($movie['movie_quality']); ?>"
                   required>

            <label>Rating</label>
            <input type="number"
                   name="movie_rating"
                   class="form-control mb-3"
                   value="<?php echo e($movie['movie_rating']); ?>"
                   required>

            <label>Image</label>
            <input type="text"
                   name="movie_image"
                   class="form-control mb-3"
                   value="<?php echo e($movie['movie_image']); ?>"
                   required>

            <button type="submit" class="btn btn-primary">
                Save Changes
            </button>

            <a href="dashboard.php" class="btn btn-secondary">
                Cancel
            </a>

        </form>

    </div>

</body>
</html>
