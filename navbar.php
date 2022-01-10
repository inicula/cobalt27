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
        printf("<li>%s</li>\n","Not logged in");
}
else
{
}
?>
</pre>
</ul>
</nav>

