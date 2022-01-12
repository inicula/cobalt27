<?php
session_start();
?>

<pre>
<?php

function check_user_exists($email)
{
        global
}

if(!isset($_POST['ipassword']) || !isset($_POST['iemail']))
{
    header("location: ../signup.php?error=incomplete");
    exit();
}

$email = $_POST['iemail'];
$password = $_POST['ipassword'];

if(empty($email) || empty($password))
{
    header("location: ../signup.php?error=incomplete");
    exit();
}

printf("good\n");

?>
</pre>
