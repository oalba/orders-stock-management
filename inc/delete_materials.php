<?php
$data = $_GET['cod_mat'];

$dp = mysql_connect("localhost", "", "" );
mysql_select_db("orders", $dp);

$eliminar="DELETE FROM materials WHERE cod_mat=$data";
mysql_query($eliminar);
header("Location: ../manage_materials.php");

mysql_close($dp);
?>