<?php
session_start();
?>

<html>
<body>

<h1>Log in</h1>

<form action="login_backend.php" method="post">
  <label for="iemail">Email</label>
  <input type="text" id="iemail" name="iemail"><br><br>
  <label for="ipassword">Password</label>
  <input type="password" id="ipassword" name="ipassword"><br><br>
  <input type="submit" value="Submit">
</form>

<?php

$possible_errs = array("incomplete"=>"Nu toate campurile au fost completate", "invalidemail"=>"Email-ul introdus nu este valid", "doesnotexist"=>"Nu exista un cont cu combinatia de mail+parola introduse");

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
