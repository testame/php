<?php
session_start();
include 'libs/util.php';
$user=getArr($_SESSION,'username');

?>
<!DOCTYPE HTML>
<html>
    <head>
        <title> POLDO </title>
  
    </head>
<body>
<?php
if ($user!=""){
    print("<H3> benvenuto $user </h3>");
    print("<ul>");
    print("<li><a href=\"doLogout.php\">logout</a></li>");
}
else
{
    print("<ul>");
    print("<li><a href=\"login.php\">login</a></li>");
} 
?>

<li> <a href="visual.php">visualizza prodotti</a></li>
<?php if (isLogin()) :?>
<li> <a href="insert.php">inserimento prodotto</a></li>
<li> <a href="adduser.php">aggiunta utente</a></li>
<li> <a href="addorder.php">aggiunta ordine</a></li>
<li> <a href="vieworders.php">visualizza ordini</a></li>
<?php endif; ?>
</ul>

</body>
</html>
