<?php
require_once 'header.php';
if (!$loggedin) die("</div></body></html>");
if (isset($_GET['view']))
{
$view = ($_GET['view']);
if ($view == $user) $name = "$user";
else $name = "$user's";
echo "<h3>$name Profile</h3>";


$result = queryMysqli("SELECT * FROM profiles WHERE user='$user'");
showProfile($view);
if ($result->num_rows>0)
{
    while($row = $result->fetch_assoc()) {
        echo "<br><br><br>".$row['text'];
        break;
    }
}
else echo "none";

echo "<br><br>";
echo "<a class='button' data-transition='slide' href='messages.php?view=$view'>View $name messages</a>";
die("</div></body></html>");
}
if (isset($_GET['add']))
{
$add = ($_GET['add']);
$result = queryMysqli("SELECT * FROM friends WHERE user='$add' AND friend='$user'");
if (!$result->num_rows)
queryMysqli("INSERT INTO friends VALUES ('$add', '$user')");
}
elseif (isset($_GET['remove']))
{
$remove = ($_GET['remove']);
queryMysqli("DELETE FROM friends WHERE user='$remove' AND friend='$user'");
}
$result = queryMysqli("SELECT user FROM members ORDER BY user");
$num= $result->num_rows;
echo "<h3>Other Members</h3><ul>";
for ($j = 0 ; $j < $num ; $j++)
{
$row = $result->fetch_array(MYSQLI_ASSOC);
if ($row['user'] == $user) continue;
echo "<li><a data-transition='slide' href='members.php?view=".$row['user'] . "'>" . $row['user'] . "</a>";
$follow = "follow";
$result1 = queryMysqli("SELECT * FROM friends WHERE
user='" . $row['user'] . "' AND friend='$user'");
$t1= $result1->num_rows;
$result1 = queryMysqli("SELECT * FROM friends WHERE
user='$user' AND friend='" . $row['user'] . "'");
$t2= $result1->num_rows;
if (($t1 + $t2) > 1) echo " &harr; is a mutual friend";
elseif ($t1)
echo " &larr; you are following";
elseif ($t2)
{ echo " &rarr; is following you";
$follow = "recip"; }
if (!$t1) echo " [<a data-transition='slide'href='members.php?add=" . $row['user'] . "'>$follow</a>]";
else
echo " [<a data-transition='slide'href='members.php?remove=" . $row['user'] . "'>drop</a>]";
}
?>
</ul></div>
</body>
</html>