<?php
require_once "includes/database.php";

session_start();

//May I even visit this page?
if (!isset($_SESSION['loggedInUser'])) {
    header("Location: login.php");
    exit;
}

$query = "SELECT * FROM users";
$result = mysqli_query($db, $query)
or die('Error '.mysqli_error($db).' with query '.$query);

$users = [];
while($row = mysqli_fetch_assoc($result))
{
    $users[] = $row;
}

mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reservering Systeem</title>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
<h1>Afspraken</h1>
<a href="create.php">Maak een nieuwe afspraak</a>
<hr/>
<table>
    <thead>
    <tr>
        <th>id</th>
        <th>Voornaam</th>
        <th>Achternaam</th>
        <th>E-mail</th>
        <th>Reservering</th>
        <th>Extra Informatie</th>
        <th>Verwijder Reservering</th>
        <th>Reservering Aanpassen</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <td colspan="6">&copy; de Reserveringen</td>
    </tr>
    </tfoot>
    <tbody>
<tr>
    <?php
    foreach ($users as $reserveringen) { ?>
            <tr>
        <td><?= $reserveringen['id'] ?></td>
        <td><?= $reserveringen['first_name']?></td>
        <td><?= $reserveringen['last_name']?></td>
        <td><?= $reserveringen['email']?></td>
        <td><?= $reserveringen['reservering_data']?></td>
        <td><a href="details.php?index=<?= $reserveringen['id']?>">Toelichting Reservering</a></td>
        <td><a href="delete.php?index=<?= $reserveringen['id']; ?>">Verwijder Reservering</a></td>
        <td><a href="edit.php?index=<?= $reserveringen['id']; ?>">Reservering Aanpassen</a></td>
            </tr>
    <?php } ?>
<p><a href="logout.php">Uitloggen</a>
</ul>
</body>
</html>