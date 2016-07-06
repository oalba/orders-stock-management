<?php
$data = $_GET['cod_sup'];

$dp = mysql_connect("localhost", "", "" );
mysql_select_db("orders", $dp);

$eliminar="DELETE FROM suppliers WHERE cod_sup='$data'";
mysql_query($eliminar);
header("Location: ../manage_suppliers.php");

mysql_close($dp);
?>