<?php
/** @var mysqli $db */

//Check if Post isset, else do nothing

    require_once "includes/database.php";

    $reservationId = $_GET['index'];

    $editquery = "SELECT * FROM users WHERE id = ". $reservationId;
    $editresult = mysqli_query($db, $editquery);
    $reservation = mysqli_fetch_assoc($editresult);

    $first_name = mysqli_escape_string($db, $reservation['first_name']);
    $last_name = mysqli_escape_string($db, $reservation['last_name']);
    $email = mysqli_escape_string($db, $reservation['email']);
    $reservering_data = mysqli_escape_string($db, $reservation['reservering_data']);

    if (isset($_POST['submit'])) {

    //Postback with the data showed to the user, first retrieve data from 'Super global'
    $first_name = mysqli_escape_string($db, $_POST['Voornaam']);
    $last_name  = mysqli_escape_string($db, $_POST['Achternaam']);
    $email   = mysqli_escape_string($db, $_POST['E-mail']);
    $reservering_data = mysqli_escape_string($db, $_POST['Reservering']);


    //Require the form validation handling
    require_once "includes/form-validation.php";
    if (empty($errors)){
        //Save the record to the database
        $query =
        "UPDATE users
        SET
        first_name = '$first_name',
        last_name = '$last_name',
        email = '$email',
        reservering_data = '$reservering_data'
        WHERE id = '$reservationId'";
        
        
        $result = mysqli_query($db, $query) or die('Error: '.mysqli_error($db). ' with query ' . $query);

        if ($result) {
            header('Location: index.php');
            exit;
        } else {
            $errors['db'] = 'Something went wrong in your database query: ' . mysqli_error($db);
        }

        //Close connection
        mysqli_close($db);

    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>Nieuwe Reservering</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
<h1>Afspraak aanpassen</h1>
<?php if (isset($errors['db'])) { ?>
    <div><span class="errors"><?= $errors['db']; ?></span></div>
<?php } ?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="data-field">
        <label for="Voornaam">Voornaam</label>
        <input id="Voornaam" type="text" name="Voornaam" value= <?= isset($first_name) ? htmlentities($first_name) : ''  ?>
        <span class="errors"><?= $errors['Voornaam'] ?? '' ?></span>
    </div>
    <div class="data-field">
        <label for="Achternaam">Achternaam</label>
        <input id="Achternaam" type="text" name="Achternaam" value="<?= isset($last_name) ? htmlentities($last_name) : 'x' ?>"/>
        <span class="errors"><?= $errors['Achternaam'] ?? '' ?></span>
    </div>
    <div class="data-field">
        <label for="E-mail">E-mail</label>
        <input id="E-mail" type="text" name="E-mail" value="<?= isset($email) ? htmlentities($email) : '' ?>"/>
        <span class="errors"><?= $errors['E-mail'] ?? '' ?></span>
    </div>
    <div class="data-field">
        <label for="Reservering">Reservering</label>
        <input id="Reservering" type="text" name="Reservering" value="<?= isset($reservering_data) ? htmlentities($reservering_data) : '' ?>"/>
        <span class="errors"><?= $errors['Reservering'] ?? '' ?></span>
    </div>
    <div class="data-submit">
        <input type="submit" name="submit" value="Save"/>
    </div>
</form>
<div>
    <a href="index.php">Ga terug naar de reserveringen</a>
</div>
</body>
</html>
