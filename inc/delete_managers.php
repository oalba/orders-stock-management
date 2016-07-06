<?php
$data = $_GET['cod_man'];

$dp = mysql_connect("localhost", "", "" );
mysql_select_db("orders", $dp);

$eliminar="DELETE FROM managers WHERE cod_man='$data'";
mysql_query($eliminar);
header("Location: ../manage_managers.php");

mysql_close($dp);
?>