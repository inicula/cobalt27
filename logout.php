<?php
session_start();

$_SESSION['logged_in'] = 'no';

header("location: ../index.php");
exit();


?>
