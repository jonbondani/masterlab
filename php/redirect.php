<?php
$allowed = [
    'index.php',
    'login.php',
    'profile.php',
    'car_details.php',
    'search.php'
];

$url = $_GET['url'] ?? 'index.php';

if (in_array($url, $allowed)) {
    header("Location: $url");
} else {
    header("Location: index.php"); // fallback seguro
}
exit;

if (isset($_GET['url'])) {
  $url = $_GET['url'];

  header("Location: $url");
  exit;
} else {
  echo "<p>No se proporcionó ninguna URL para redirigir.</p>";
}
