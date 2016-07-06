<?php
$dp = mysql_connect("localhost", "", "" );
mysql_select_db("orders", $dp);

$data = $_GET['cod_ord'];
$data2 = $_GET['cod_piece'];
$quantity = $_POST['quantity'];
$remark = $_POST['remarks1'];
$remarks = trim(preg_replace('/\s\s+/', ' ', $remark));

$aldatu="UPDATE contain_o_p SET quantity='$quantity',remarks='$remarks' WHERE cod_ord='$data' AND cod_piece='$data2'";
mysql_query($aldatu);
$aldatu2="UPDATE pieces SET stock = stock - '$quantity' WHERE cod_piece='$data2'";
mysql_query($aldatu2);
//f5($data);
header("Location: ../edit_p_o.php?cod_ord=$data&cod_piece=$data2");
mysql_close($dp);
?>