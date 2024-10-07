<?php
session_start();

if (!isset($_SESSION['contact_data'])) {
  header('Location: contact_form.php');
  exit;
}

$contact = $_SESSION['contact_data'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Data</title>
</head>

<body>
  <h1>No errors!</h1>
  <p>ID: <?= htmlspecialchars($contact['id']) ?></p>
  <p>Title: <?= htmlspecialchars($contact['title']) ?></p>
  <p>First Name: <?= htmlspecialchars($contact['first_name']) ?></p>
  <p>Surname: <?= htmlspecialchars($contact['surname']) ?></p>
  <p>Birthdate: <?= htmlspecialchars($contact['birthdate']) ?></p>
  <p>Phone: <?= htmlspecialchars($contact['phone']) ?></p>
  <p>Email: <?= htmlspecialchars($contact['email']) ?></p>
  <p>Type: <?= htmlspecialchars(implode(', ', $contact['type'])) ?></p>
</body>

</html>