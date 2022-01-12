<?php
session_start();
?>

<nav>
<ul>
<pre>
<?php
printf("<li>%s</li>\n",'<a href="https://cobalt27.xyz">Home</a>');
if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] != 'yes')
{
        printf("<li><a href='%s'>%s</a></li>\n", "/login.php", "Log in");
        printf("<li><a href='%s'>%s</a></li>\n", "/signup.php", "Sign up");
}
else
{
        printf("<li>Logged in as: %s</li>\n", $_SESSION['logged_in_as']);
        printf("<li><a href='%s'>%s</a></li>\n", "/logout.php", "Log out");
}
?>
</pre>
</ul>
</nav>
