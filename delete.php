<?php
require_once "includes/database.php";

$id = $_GET['index']; // ID pakken doormiddel van GET met query string

$delete = mysqli_query($db,"delete from users where id = '$id'"); // delete query

if($delete)
{
    header("location:index.php"); // als je op delete klikt word je teruggestuurd naar de reserveringenlijst
    exit;
}
else
{
    echo "Error deleting record"; // Error message als het delete niet is gelukt
}
mysqli_close($db); // Close connection
?>
