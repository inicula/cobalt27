<?php
session_start();
?>

<html>
<body>

<h1>Sign up</h1>

<form action="signup_backend.php" method="post">
  <label for="iemail">Email</label>
  <input type="text" id="iemail" name="iemail"><br><br>
  <label for="ipassword">Password</label>
  <input type="password" id="ipassword" name="ipassword"><br><br>
  <input type="submit" value="Submit">
</form>

<?php

$possible_errs = array("incomplete"=>"Nu toate campurile au fost completate", "alreadytaken"=>"Emailul este deja inregistrat pe site", "invalidemail"=>"Email-ul introdus nu este valid", "goodsignup"=>"V-ati creat contul cu succes", "toolong"=>"Parola poate fi de cel mult 70 caractere");

if(isset($_GET['error']))
{
        if(isset($possible_errs[$_GET['error']]))
        {
                printf("%s\n", $possible_errs[$_GET['error']]);
        }
}
?>

</body>
</html>
