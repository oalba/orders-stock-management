<?php
$data = $_GET['cod_piece'];
$data2 = $_GET['cod_mat'];

$dp = mysql_connect("localhost", "", "" );
mysql_select_db("orders", $dp);

$eliminar="DELETE FROM need_p_m WHERE cod_piece=$data AND cod_mat=$data2";
mysql_query($eliminar);
header("Location: ../edit_pieces.php?cod_piece=$data");

mysql_close($dp);
?>