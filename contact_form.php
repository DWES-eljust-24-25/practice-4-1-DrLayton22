<?php
require_once __DIR__ . '/functions.php';
$contacts = require_once __DIR__ . '/data.php';

// Variables para el encabezado
$title = 'Contact Form';
$header = 'Contact Form';
$author = 'Rubén Bonilla';

include 'header.php'; // Incluir el archivo de encabezado

$errors = [];
$contactData = null;

// Verificar si se ha proporcionado un ID a través de GET para editar un contacto
if (isset($_GET['id'])) {
  $id = (int)$_GET['id'];
  foreach ($contacts as $contact) {
    if ($contact['id'] === $id) {
      $contactData = $contact;
      break;
    }
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Obtener los datos del formulario
  $id = $_POST['id'];
  $title = $_POST['title'] ?? 'Mr.';
  $first_name = $_POST['first_name'];
  $surname = $_POST['surname'];
  $birthdate = $_POST['birthdate'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $type = isset($_POST['type']) ? $_POST['type'] : [];

  // Validar los datos del formulario
  $formData = [
    'first_name' => $first_name,
    'surname' => $surname,
    'birthdate' => $birthdate,
    'phone' => $phone,
    'email' => $email,
  ];

  $errors = validateContact($formData);

  // Si no hay errores, redirigir a checkdata.php
  if (empty($errors)) {
    $_SESSION['contact_data'] = [
      'id' => $id,
      'title' => $title,
      'first_name' => $first_name,
      'surname' => $surname,
      'birthdate' => $birthdate,
      'phone' => $phone,
      'email' => $email,
      'type' => $type
    ];
    header('Location: checkdata.php');
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Form</title>
  <!-- Optional: Link Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container mt-5">
    <!-- Mostrar errores -->
    <?php if (!empty($errors)): ?>
      <div class="alert alert-danger">
        <ul>
          <?php foreach ($errors as $error): ?>
            <li><?= htmlspecialchars($error) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <form action="" method="POST">
      <!-- ID (readonly) -->
      <div class="mb-3">
        <label for="id" class="form-label">ID</label>
        <input type="text" id="id" name="id" class="form-control" value="<?= htmlspecialchars($contactData['id'] ?? '') ?>" readonly>
      </div>

      <!-- Title -->
      <div class="mb-3">
        <label for="title" class="form-label">Title</label><br>
        <input type="radio" id="mr" name="title" value="Mr." <?= (isset($contactData) && $contactData['title'] == 'Mr.') ? 'checked' : '' ?>> Mr.
        <input type="radio" id="mrs" name="title" value="Mrs." <?= (isset($contactData) && $contactData['title'] == 'Mrs.') ? 'checked' : '' ?>> Mrs.
        <input type="radio" id="miss" name="title" value="Miss" <?= (isset($contactData) && $contactData['title'] == 'Miss') ? 'checked' : '' ?>> Miss
      </div>

      <!-- First Name -->
      <div class="mb-3">
        <label for="first_name" class="form-label">First Name</label>
        <input type="text" id="first_name" name="first_name" class="form-control" value="<?= htmlspecialchars($contactData['name'] ?? '') ?>">
      </div>

      <!-- Surname -->
      <div class="mb-3">
        <label for="surname" class="form-label">Surname</label>
        <input type="text" id="surname" name="surname" class="form-control" value="<?= htmlspecialchars($contactData['surname'] ?? '') ?>">
      </div>

      <!-- Birthdate -->
      <div class="mb-3">
        <label for="birthdate" class="form-label">Birthdate</label>
        <input type="date" id="birthdate" name="birthdate" class="form-control" value="<?= htmlspecialchars($contactData['birthdate'] ?? '') ?>">
      </div>

      <!-- Phone -->
      <div class="mb-3">
        <label for="phone" class="form-label">Phone</label>
        <input type="text" id="phone" name="phone" class="form-control" value="<?= htmlspecialchars($contactData['phone'] ?? '') ?>">
      </div>

      <!-- Email -->
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="text" id="email" name="email" class="form-control" value="<?= htmlspecialchars($contactData['email'] ?? '') ?>">
      </div>

      <!-- Type (Checkboxes) -->
      <div class="mb-3">
        <label for="type" class="form-label">Type</label><br>
        <input type="checkbox" name="type[]" value="favorite" <?= (isset($contactData) && $contactData['favourite']) ? 'checked' : '' ?>> Favorite
        <input type="checkbox" name="type[]" value="important" <?= (isset($contactData) && $contactData['important']) ? 'checked' : '' ?>> Important
        <input type="checkbox" name="type[]" value="archived" <?= (isset($contactData) && $contactData['archived']) ? 'checked' : '' ?>> Archived
      </div>

      <!-- Buttons -->
      <?php if (isset($contactData)): ?>
        <button type="submit" name="update" class="btn btn-secondary">Update</button>
      <?php else: ?>
        <button type="submit" name="save" class="btn btn-primary">Save</button>
      <?php endif; ?>
      <button type="button" class="btn btn-danger" onclick="window.location.href='contact_list.php'">Cancel</button>
      <!-- <button type="submit" name="delete" class="btn btn-danger">Delete</button> -->
    </form>
  </div>
</body>
<?php include 'footer.php'; // Incluir el archivo de pie de página 
?>

</html>