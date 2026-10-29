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

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: dashboard.php");
    exit();
}

$id = filter_var(
    $_POST['id'] ?? null,
    FILTER_VALIDATE_INT
);

if (!$id) {
    die("Invalid movie ID.");
}

$sql = "DELETE FROM movies WHERE id = :id";

$stmt = $conn->prepare($sql);

$stmt->execute([
    ':id' => $id
]);

header("Location: dashboard.php");
exit();
?> 