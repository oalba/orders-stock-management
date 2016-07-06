<?php
$dp = mysql_connect("localhost", "", "" );
mysql_select_db("orders", $dp);

$data = $_GET['cod_ord'];
$cli = $_POST['cli1'];
$man = $_POST['man1'];
$order_date = date("Y-m-d",strtotime($_POST['order_date']));
if ($_POST['deliver_date']!=NULL) {
        $fechaen = date_format(date_create_from_format('Y-m-d', $_POST['deliver_date']), 'd/m/Y');
        $deliver_date = date("Y-m-d",strtotime($_POST['deliver_date']));
    } else {
        $deliver_date = NULL;
    }
$delivered = $_POST['delivered'];
$remark = $_POST['remarks'];
$remarks = trim(preg_replace('/\s\s+/', ' ', $remark));
$discount = $_POST['discount'];

$aldatu="UPDATE orders SET cod_cli='$cli',cod_man='$man',order_date='$order_date',deliver_date='$deliver_date',delivered='$delivered',remarks='$remarks',discount='$discount' WHERE cod_ord='$data'";
mysql_query($aldatu);
//f5($data);
header("Location: ../edit_orders.php?cod_ord=$data");
mysql_close($dp);
?>