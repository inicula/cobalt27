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

</body>
</html>
