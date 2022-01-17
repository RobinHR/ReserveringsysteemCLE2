<?php
/** @var mysqli $db */

//Check if Post isset, else do nothing
if (isset($_POST['submit'])) {
    //Require database in this file & image helpers
    require_once "includes/database.php";

    //Postback with the data showed to the user, first retrieve data from 'Super global'
    $first_name = mysqli_escape_string($db, $_POST['Voornaam']);
    $last_name  = mysqli_escape_string($db, $_POST['Achternaam']);
    $email   = mysqli_escape_string($db, $_POST['E-mail']);
    $reservering_data = mysqli_escape_string($db, $_POST['Reservering']);

    //Require the form validation handling
    require_once "includes/form-validation.php";
    if (empty($errors)){
        //Save the record to the database
        $query = "INSERT INTO users (first_name, last_name, email, reservering_data)
                  VALUES ('$first_name','$last_name', '$email','$reservering_data')";
        $result = mysqli_query($db, $query) or die('Error: '.mysqli_error($db). ' with query ' . $query);

        if ($result && $email === 'admin') {
            header('Location: index.php');
            exit;

        } else {
            header('location:bedankleerling.php');
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
<h1>Maak een nieuwe afspraak</h1>
<?php if (isset($errors['db'])) { ?>
    <div><span class="errors"><?= $errors['db']; ?></span></div>
<?php } ?>

<!-- enctype="multipart/form-data" no characters will be converted -->
<form action="" method="post" enctype="multipart/form-data">
    <div class="data-field">
        <label for="Voornaam">Voornaam</label>
        <input id="Voornaam" type="text" name="Voornaam" value="<?= isset($first_name) ? htmlentities($first_name) : '' ?>"/>
        <span class="errors"><?= $errors['Voornaam'] ?? '' ?></span>
    </div>
    <div class="data-field">
        <label for="Achternaam">Achternaam</label>
        <input id="Achternaam" type="text" name="Achternaam" value="<?= isset($last_name) ? htmlentities($last_name) : '' ?>"/>
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
