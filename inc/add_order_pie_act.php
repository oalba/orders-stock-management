<?php
$dp = mysql_connect("localhost", "", "" );
mysql_select_db("orders", $dp);

$data = $_GET['cod_ord'];
$quantity = $_POST['cant0'];
$cod_piece = $_POST['piece0'];
$remark = $_POST['remarks0'];
$remarks = trim(preg_replace('/\s\s+/', ' ', $remark));

$gehitu="INSERT INTO contain_o_p (cod_ord,quantity,cod_piece,remarks) VALUES ($data,$quantity,$cod_piece,'$remarks')";
mysql_query($gehitu);
$aldatu="UPDATE pieces SET stock = stock - '$quantity' WHERE cod_piece='$cod_piece'";
mysql_query($aldatu);

header("Location: ../edit_orders.php?cod_ord=$data");
mysql_close($dp);
?>