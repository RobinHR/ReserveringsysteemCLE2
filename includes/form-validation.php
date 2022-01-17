<?php

$errors = [];
if ($first_name == "") {
    $errors['Voornaam'] = 'Voornaam cannot be empty';
}
if ($last_name == "") {
    $errors['Achternaam'] = 'Achternaam cannot be empty';
}
if ($email == "") {
    $errors['E-mail'] = 'E-mail cannot be empty';
}
if ($reservering_data == "") {
    $errors['Reservering'] = 'Reservering cannot be empty';
}
