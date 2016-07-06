<?php
$data = $_GET['cod_piece'];
$plans = $_GET['plans'];
$value = "../plans/".$plans;
//dirname(__FILE__) . "/../../public_files/" . $filename);
$dp = mysql_connect("localhost", "", "" );
mysql_select_db("orders", $dp);

$eliminar2="DELETE FROM need_p_m WHERE cod_piece=$data";
mysql_query($eliminar2);

$eliminar="DELETE FROM pieces WHERE cod_piece='$data'";
mysql_query($eliminar);

if (file_exists($value)) {
    unlink($value);
}
header("Location: ../manage_pieces.php");

mysql_close($dp);
?>