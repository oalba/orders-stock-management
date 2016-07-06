<?php
$data = $_GET['cod_ord'];

$dp = mysql_connect("localhost", "", "" );
mysql_select_db("orders", $dp);

$eliminar2="DELETE FROM contain_o_p WHERE cod_ord=$data";
mysql_query($eliminar2);
$eliminar="DELETE FROM orders WHERE cod_ord=$data";
mysql_query($eliminar);

header("Location: ../index2.php");

mysql_close($dp);
?>