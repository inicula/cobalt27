<?php
session_start();
?>

<?php
require_once "../navbar.php"
?>


<pre>
<?php

require_once "../include/common.php";
require_once "/var/site-data/connection.php";

$q = "select a.id, a.title, g.name, a.release_date, cat.title
      from albums a
      inner join groups g on a.group_id = g.id
      inner join categories cat on cat.id = a.category_id;";
$result = $mysqli->query($q);

printf("%-3s %-50s %-20s %-15s %-10s\n", "ID", "ALBUM NAME", "GROUP NAME", "RELEASE DATE", "CATEGORY");
for ($row_no = 0; $row_no < $result->num_rows; $row_no++) {
    $result->data_seek($row_no);
    $row = array_values($result->fetch_array(MYSQLI_NUM));
    array_unshift($row, $row_no + 1);
    printf_array("<a href=\"https://cobalt27.xyz/product_page.php?aid=%s\">%-3s %-50s %-20s %-15s %-10s</a>\n", $row);
}

?>
</pre>
