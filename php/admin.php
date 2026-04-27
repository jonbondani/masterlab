<?php
session_start();

if (!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true)) {
  header('Location: /');
  exit;
}

include('header.php');
?>

<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h2 class="text-center mb-4">Admin Panel</h2>

      <?php
      include('serde.php');
      if (isset($_COOKIE['user_info'])) {
        $user_info = deser($_COOKIE['user_info']);
        
        if ($user_info === null) {
          echo "<h2>No tienes nada que hacer aquí</h2>";
          exit;
        }
        
        if ($user_info['is_admin'] == true) {
          echo "<h2>Hola: " . $user_info['username'] . "<br><br>Encantado de saludar al ADMINISTRADOR!!<h2>";
        } else {
          echo "<h2>No tienes nada que hacer aquí: " . $user_info['username'] . "<h2>";
        }
      } else {
        echo "<h2>No tienes nada que hacer aquí: " . $user_info['username'] . "<h2>";
      }
      ?>
    </div>
  </div>
</div>

<?php include('footer.php'); ?>
