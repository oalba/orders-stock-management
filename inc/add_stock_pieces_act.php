<?php
$dp = mysql_connect("localhost", "", "" );
mysql_select_db("orders", $dp);

$data = $_GET['cod_piece'];
$stock = $_POST['stocknew'];

$aldatu="UPDATE pieces SET stock = stock + '$stock' WHERE cod_piece=$data";
mysql_query($aldatu);

$sql2 = "SELECT need_p_m.quantity AS quantity, need_p_m.cod_mat AS cod_mat FROM need_p_m,materials WHERE need_p_m.cod_piece=$data AND need_p_m.cod_mat=materials.cod_mat";
$cons2 = mysql_query($sql2);
    while ($row2 = mysql_fetch_assoc($cons2)) {
        $rest = $row2['quantity'] * $stock;
        $aldatumat="UPDATE materials SET stock = stock - '$rest' WHERE cod_mat=$row2[cod_mat]";
        mysql_query($aldatumat);

        //$sql3 = "SELECT * FROM materials";
        //$cons3 = mysql_query($sql3);
        //while ($row3 = mysql_fetch_assoc($cons3)) {
        //    if ($row2['cod_mat']==$row3['cod_mat']) {
    }

header("Location: ../add_stock_pieces.php?cod_piece=$data");
mysql_close($dp);
?>