<?php
session_start();
?>

<?php
require_once "navbar.php";
?>

<pre>
<?php

require_once "/var/site-data/connection.php";
require_once "include/common.php";

function set_err()
{
        header('Location: index.html');
        exit;
}

function get_album_by_id($id)
{
        global $mysqli;

        $stmt = $mysqli->prepare("select a.id, a.title, g.name, a.release_date, cat.title
                                  from albums a
                                  inner join groups g on a.group_id = g.id
                                  inner join categories cat on cat.id = a.category_id
                                  where a.id=?;");

        $id = intval($id, 10);
        $stmt->bind_param('i', $id);

        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows <= 0)
        {
                header('Location: index.html');
                exit;
        }

        $row = array_values($result->fetch_array(MYSQLI_NUM));

        return $row;
}

function get_stock($id)
{
        global $mysqli;

        $stmt = $mysqli->prepare("select count(c.id) from copies c
                                  where c.customer_id is null and c.album_id=?");

        $id = intval($id, 10);
        $stmt->bind_param('i', $id);

        $stmt->execute();
        $result = $stmt->get_result();

        $row = array_values($result->fetch_array(MYSQLI_NUM));

        return $row[0];
}

if(!isset($_GET['aid']))
{
        set_err();
}

$arg = $_GET['aid'];

if(strlen($arg) > 3 || !is_numeric($arg))
{
        set_err();
}

$row = get_album_by_id($arg);
printf("Information:\n\n");
printf("%-3s %-50s %-20s %-15s %-10s\n", "ID", "ALBUM NAME", "GROUP NAME", "RELEASE DATE", "CATEGORY");
printf_array("%-3s %-50s %-20s %-15s %-10s\n", $row);

printf("\nCopies remaining is: %s\n", get_stock($arg));

?>
</pre>
