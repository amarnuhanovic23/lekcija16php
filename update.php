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

    $id = filter_var(
        $_POST['id'] ?? null,
        FILTER_VALIDATE_INT
    );

    $movie_name = trim($_POST['movie_name'] ?? '');
    $movie_desc = trim($_POST['movie_desc'] ?? '');
    $movie_quality = trim($_POST['movie_quality'] ?? '');
    $movie_rating = $_POST['movie_rating'] ?? '';
    $movie_image = trim($_POST['movie_image'] ?? '');

    if (
        !$id ||
        $movie_name === '' ||
        $movie_desc === '' ||
        $movie_quality === '' ||
        $movie_image === '' ||
        filter_var($movie_rating, FILTER_VALIDATE_INT) === false
    ) {
        die("Invalid movie details.");
    }

    $sql = "UPDATE movies
            SET movie_name = :movie_name,
                movie_desc = :movie_desc,
                movie_quality = :movie_quality,
                movie_rating = :movie_rating,
                movie_image = :movie_image
            WHERE id = :id";

    $stmt = $conn->prepare($sql);

    $stmt->execute([
        ':id' => $id,
        ':movie_name' => $movie_name,
        ':movie_desc' => $movie_desc,
        ':movie_quality' => $movie_quality,
        ':movie_rating' => $movie_rating,
        ':movie_image' => $movie_image
    ]);

    header("Location: dashboard.php");
    exit();

} else {
    header("Location: dashboard.php");
    exit();
}
?> 