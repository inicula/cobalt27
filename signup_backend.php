<?php
session_start();
?>

<pre>
<?php

require_once "/var/site-data/connection.php";

function check_user($email)
{
        global $mysqli;

        $stmt = $mysqli->prepare("select c.id from customers c where c.email=?;");

        $stmt->bind_param('s', $email);

        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows == 0;
}

function insert_user($email, $phash)
{
        global $mysqli;

        $stmt = $mysqli->prepare("insert into customers (first_name, last_name, email, pass_hash) values (?,?,?,?);");

        $v1="not_set";
        $v2="not_set";
        $stmt->bind_param("ssss", $v1, $v2, $email, $phash);


        $stmt->execute();
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

$email = strtolower($email);
if(!check_user($email))
{
        header("location: ../signup.php?error=alreadytaken");
        exit();
}


if(!preg_match('/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD', $email))
{
        header("location: ../signup.php?error=invalidemail");
        exit();
}

$phash = password_hash($password, PASSWORD_DEFAULT);
insert_user($email, $phash);

header("location: ../signup.php?error=goodsignup");
exit();

?>
</pre>
