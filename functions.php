<?php

$dbhost ='localhost';     // host name(localhost/ip)
$dbname = 'id17312921_jagansnest';   // database name
$dbuser = 'id17312921_root';         // user name
$dbpass = '#J@g@n27022003';             // database password

$connection = new mysqli($dbhost,$dbuser,$dbpass,$dbname);
if($connection->connect_error) die('Fatal Error....!');

function createTable($name,$query)
{
    queryMysqli("CREATE TABLE IF NOT EXISTS $name($query)");
    echo "Table '$$name' created or already exists <br>";
}

function queryMysqli($query)
{
    global $connection;
    $result = $connection->query($query);
    if(!$result) die('Fatal Error.!');
    return $result;

}

function destroySession()
{
    $_SESSION = array();

    if(session_id()!="" || isset($_COOKIE[session_name()]))
    {
        setcookie(session_name(),'',time()-2592000,'/');
    }
    session_destroy();
}

function sanitiseString($var)
{
    global $connection;
    $var = strip_tags($var);
    $var = htmlentities($var);
    if(get_magic_quotes_gpc())
    {
        $var = stripslashes($var);
    }
    return $connection->real_escape_string($var);
}

function showProfile($user)
{
    if(file_exists("image/$user.jpg"))
    {
        echo "<img src='image/$user.jpg' style='float:left;'";
    }

    $result = queryMysqli("SELECT * FROM profiles WHERE user='$user'");

    if($result->num_rows)
    {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        echo stripslashes($row['text'])."<br style = 'clear:left;'><br>";
    }
    else echo "<p>Nothing to see here,yet</p><br>";
}

?>