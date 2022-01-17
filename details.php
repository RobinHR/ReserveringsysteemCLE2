<?php
require_once "includes/database.php";

if(!isset($_GET['index']) || $_GET['index'] === ''){
    header('location: index.php');
}

$index = $_GET['index'];

$query = "SELECT * FROM users WHERE id = $index";
$result = mysqli_query($db, $query)
or die('Error '.mysqli_error($db).' with query '.$query);

if(mysqli_num_rows($result) == 0) {
    header('location: index.php');
}

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
    <title>Extra informatie</title>
    <meta charset="utf-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
<section>
    <h1></h1>
    <ul>
        <li>Toelichting:
            <?php
            foreach ($users as $reserveringen) { ?>
            <tr>
                <td><?= $reserveringen['extra_informatie'] ?></td>
                <?php } ?>
    </ul>
</section>
<div>
    <a href="index.php">Ga terug naar de reserveringen</a>
</div>
</body>
</html>

