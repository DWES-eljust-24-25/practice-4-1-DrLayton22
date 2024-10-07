<?php
session_start();

function showTable(array $data, ?array $header = null): void
{
  echo '<table class="table table-bordered">';

  // Cabecera
  if ($header) {
    echo '<thead>';
    echo '<tr style="background-color: #f8f9fa;">'; // Cambiar el color de fondo
    foreach ($header as $h) {
      echo '<th>' . htmlspecialchars($h) . '</th>';
    }
    echo '</tr>';
    echo '</thead>';
  }

  echo '<tbody>';

  // Filas
  foreach ($data as $row) {
    echo '<tr>';
    foreach ($row as $key => $value) {
      if ($key === 'id') {
        // Añadir botón Edit/View
        echo '<td><a href="contact_form.php?id=' . htmlspecialchars($value) . '" class="btn btn-warning btn-sm">Edit/View</a></td>';
      } else {
        echo '<td>' . htmlspecialchars($value) . '</td>';
      }
    }
    echo '</tr>';
  }

  echo '</tbody>';
  echo '</table>';
}



function validateField(string $field): bool
{
  return !empty(trim($field));
}

function validatePhone(string $phone): bool
{
  // Expresión regular para validar un número de teléfono (puede personalizarse según la región)
  return preg_match('/^[0-9]{9,15}$/', $phone);
}

function validateEmail(string $email): bool
{
  return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function validateContact(array $data): array
{
  $errors = [];

  // Validar nombre
  if (!validateField($data['first_name'])) {
    $errors[] = 'First name is required.';
  }

  // Validar apellido
  if (!validateField($data['surname'])) {
    $errors[] = 'Surname is required.';
  }

  // Validar fecha de nacimiento (se asume correcta ya que es un campo de tipo "date")

  // Validar teléfono
  if (!validatePhone($data['phone'])) {
    $errors[] = 'Phone number is invalid. It should contain only digits and be between 9-15 digits long.';
  }

  // Validar email
  if (!validateEmail($data['email'])) {
    $errors[] = 'Invalid email format.';
  }

  return $errors;
}
