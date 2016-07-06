<?php
$dp = mysql_connect("localhost", "", "" );
mysql_select_db("orders", $dp);

$data = $_GET['cod_piece'];
$data2 = $_GET['cod_mat'];
$quantity = $_POST['quantity'];
$remark = $_POST['remarks1'];
$remarks = trim(preg_replace('/\s\s+/', ' ', $remark));

$aldatu="UPDATE need_p_m SET quantity='$quantity',remarks='$remarks' WHERE cod_piece='$data' AND cod_mat='$data2'";
mysql_query($aldatu);
//f5($data);
header("Location: ../edit_m_p.php?cod_piece=$data&cod_mat=$data2");
mysql_close($dp);
?>