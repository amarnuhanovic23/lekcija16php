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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $movie_name = trim($_POST['movie_name'] ?? '');
    $movie_desc = trim($_POST['movie_desc'] ?? '');
    $movie_quality = trim($_POST['movie_quality'] ?? '');
    $movie_rating = $_POST['movie_rating'] ?? '';
    $movie_image = trim($_POST['movie_image'] ?? '');

    if (
        $movie_name === '' ||
        $movie_desc === '' ||
        $movie_quality === '' ||
        $movie_image === '' ||
        filter_var($movie_rating, FILTER_VALIDATE_INT) === false
    ) {
        die("Please enter valid movie details.");
    }

    $sql = "INSERT INTO movies 
            (movie_name, movie_desc, movie_quality, movie_rating, movie_image) 
            VALUES 
            (:movie_name, :movie_desc, :movie_quality, :movie_rating, :movie_image)";

    $stmt = $conn->prepare($sql);

    $stmt->execute([
        ':movie_name' => $movie_name,
        ':movie_desc' => $movie_desc,
        ':movie_quality' => $movie_quality,
        ':movie_rating' => $movie_rating,
        ':movie_image' => $movie_image
    ]);

    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Movie</title>
    <link href="https://jsdelivr.net" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5" style="max-width: 600px;">

        <h2>Add New Movie</h2>

        <form action="addMovie.php" method="POST">

            <input type="text"
                   name="movie_name"
                   class="form-control mb-3"
                   placeholder="Movie Name"
                   required>

            <textarea name="movie_desc"
                      class="form-control mb-3"
                      placeholder="Movie Description"
                      required></textarea>

            <input type="text"
                   name="movie_quality"
                   class="form-control mb-3"
                   placeholder="Movie Quality"
                   required>

            <input type="number"
                   name="movie_rating"
                   class="form-control mb-3"
                   placeholder="Movie Rating"
                   required>

            <input type="text"
                   name="movie_image"
                   class="form-control mb-3"
                   placeholder="Movie Image"
                   required>

            <button type="submit" class="btn btn-success">
                Save Movie
            </button>

            <a href="dashboard.php" class="btn btn-secondary">
                Back
            </a>

        </form>

    </div>

</body>
</html>
