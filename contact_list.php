<?php
$contacts = require_once __DIR__ . '/data.php';
require_once __DIR__ . '/functions.php';

// Variables para el encabezado
$title = 'Contact List';
$header = 'Contact List';
$author = 'Rubén Bonilla';

$tablenames = ['ID', 'Title', 'First Name', 'Surname', 'Birthdate', 'Phone', 'Email', 'Favorite', 'Important', 'Archived'];


include 'header.php'; // Incluir el archivo de encabezado
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact List</title>
  <!-- Optional: Link Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container mt-5">
    <a href="contact_form.php" class="btn btn-success mb-3">Create New Contact</a>

    <?php showTable($contacts, $tablenames); ?>

  </div>

</body>
<?php include 'footer.php'; // Incluir el archivo de pie de página 
?>

</html>