<?php
$dp = mysql_connect("localhost", "", "" );
mysql_select_db("orders", $dp);

$data = $_GET['cod_piece'];
$quantity = $_POST['cant0'];
$cod_mat = $_POST['material0'];
$remark = $_POST['remarks0'];
$remarks = trim(preg_replace('/\s\s+/', ' ', $remark));

$gehitu="INSERT INTO need_p_m (cod_piece,quantity,cod_mat,remarks) VALUES ($data,$quantity,$cod_mat,'$remarks')";
mysql_query($gehitu);

header("Location: ../edit_pieces.php?cod_piece=$data");
mysql_close($dp);
?>