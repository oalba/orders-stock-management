<?php
$data = $_GET['cod_ord'];
$data2 = $_GET['cod_piece'];

$dp = mysql_connect("localhost", "", "" );
mysql_select_db("orders", $dp);

$eliminar="DELETE FROM contain_o_p WHERE cod_ord=$data AND cod_piece=$data2";
mysql_query($eliminar);
header("Location: ../edit_orders.php?cod_ord=$data");

mysql_close($dp);
?>