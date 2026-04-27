<?php
include('header.php');

if (isset($_GET['year']) && isset($_GET['kilometers']) && isset($_GET['condition'])) {
  $year = intval($_GET['year']);
  if ($year < 1900 || $year > date("Y")) {
    echo "<div class='container my-5'>
            <div class='alert alert-danger text-center'>
                Año no válido. Por favor, ingrese un año entre 1900 y " . date("Y") . ".
            </div>
          </div>";
    include('footer.php');
    exit();
  }
  $kilometers = intval($_GET['kilometers']);
  $condition = $_GET['condition'];

  $command = "expr 10000 - " . $year;
  if ($condition == 'malo') {
    $command .= " - 1000";
  } elseif ($condition == 'regular') {
    $command .= " - 500";
  }

  $valuation = shell_exec($command);


  echo "<div class='container my-5'>
            <h3>Valor estimado: € $valuation</h3>
            <div class='alert alert-warning text-center mt-3'>
                Advertencia, nuestra valoración no es vinculante y se trata de una estimación hecha <b>con la calculadora del sistema</b>.
            </div>
          </div>";
}

include('footer.php');

