<?php
$data = $_GET['cod_cli'];

$dp = mysql_connect("localhost", "", "" );
mysql_select_db("orders", $dp);

$eliminar="DELETE FROM clients WHERE cod_cli='$data'";
mysql_query($eliminar);
header("Location: ../manage_clients.php");

mysql_close($dp);
?>