<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  header('Location: login.php');
  exit;
}

include('db.php');
$db = db_connect();

$username = $_GET['username'];

if ($username !== $_SESSION['username']) {
  $username = $_SESSION['username'];
}
$query = $db->query('SELECT * FROM users WHERE username = "' . $username . '"');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $newDescription = $_POST['description'];
  $newWeather = $_POST['weather'];
  $db->query('UPDATE users SET description = "' . $newDescription . '" WHERE username = "' . $username . '"');
  $db->query('UPDATE users SET weather = "' . $newWeather . '" WHERE username = "' . $username . '"');
  header("Location: success.php");
  exit;
}

include('header.php');

if ($query->num_rows === 0) {
  echo '<div class="container my-5"><p>No se encontraron datos para este usuario.</p></div>';
  include('footer.php');
  exit;
}

$user = $query->fetch_assoc();
$weather = htmlspecialchars($user['weather'], ENT_QUOTES, 'UTF-8');

?>


<div class="container my-5">
  <div class="row">
    <div class="col-md-3 text-center">
      <img src="imgs/users/<?php echo $user['image']; ?>" alt="Foto de perfil" class="img-fluid rounded">
    </div>
    <div class="col-md-4">
      <h2>Perfil de <?php echo $user['name']; ?></h2>
      <ul class="list-unstyled">
        <li><strong>Nombre de usuario:</strong> <?php echo $user['username']; ?></li>
        <li><strong>Correo:</strong> <?php echo $user['email']; ?></li>
        <li><strong>Dirección:</strong> <?php echo $user['address']; ?></li>
        <li><strong>Descripción:</strong> <?php echo $user['description']; ?></li>
      </ul>
    </div>
    <div class="col-md-4">
      <div style="margin-top: 15px;"><strong>API Key:</strong> <?php echo $user['apikey']; ?></div>
      <div style="margin-top: 15px; margin-bottom: 15px;"><strong>Weather URL:</strong><?php echo $weather; ?></div>
      <h5>Cambiar valores</h5>
      <form action="profile.php?username=<?php echo $username; ?>" method="post">
        <div class="form-group mb-3">
          <label>Descripción</label>
          <textarea class="form-control" id="description" name="description" required><?php echo $user['description']; ?></textarea>
          <label>Weather API Url</label>
          <textarea class="form-control" id="weather" name="weather" required><?php echo $weather; ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
      </form>
    </div>
  </div>
</div>

<?php
include('footer.php');
?>
