<?php
header("Content-Security-Policy: default-src 'self'; style-src 'self' https://cdn.jsdelivr.net 'unsafe-inline'; script-src 'self' https://cdn.jsdelivr.net; connect-src 'self' https://cdn.jsdelivr.net https://cdn.cochesviejunos.es; object-src 'none';");
header("X-Frame-Options: DENY");
header("X-Content-Type-Options: nosniff");
header("Strict-Transport-Security: max-age=31536000; includeSubDomains");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Coches Viejunos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/styles.css">
  <style>
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand" href="index.php">
        <img src="imgs/logo.png" alt="Coches Viejunos" width="250">
      </a>
      <div class="ms-auto">
        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true):
                  $usernameLink = isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>
          <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
              Bienvenido, <?= $usernameLink ?>
            </button>
            <ul class="dropdown-menu" aria-labelledby="userMenu">
              <li><a class="dropdown-item" href="profile.php?username=<?= $usernameLink ?>">Mi Perfil</a></li>
              <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            </ul>
          </div>
        <?php else: ?>
          <?php if ($_SERVER['PHP_SELF'] !== '/login.php'): ?>
            <a href="login.php" class="btn btn-login">Iniciar Sesión</a>
          <?php endif; ?>
        <?php endif; ?>
      </div>
    </div>
  </nav>
