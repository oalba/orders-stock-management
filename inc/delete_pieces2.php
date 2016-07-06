<?php
$dp = mysql_connect("localhost", "", "" );
mysql_select_db("orders", $dp);

$checkbox = $_POST['dele'];
foreach($checkbox as $chkval){
	$sql = "SELECT * FROM pieces WHERE cod_piece='$chkval'";
	$conce = mysql_query($sql);

	while ($row = mysql_fetch_assoc($conce)) {
		$plans = $row['plans'];
		$value = "../plans/".$plans;
		//dirname(__FILE__) . "/../../public_files/" . $filename);
		
		if (file_exists($value)) {
		    unlink($value);
		}
	}
	//$eliminar="DELETE FROM pieces INNER JOIN need_p_m WHERE pieces.cod_piece=need_p_m.cod_piece and pieces.cod_piece = '$chkval'";
	//mysql_query($eliminar);
	
	$eliminar2="DELETE FROM need_p_m WHERE cod_piece='$chkval'";
	mysql_query($eliminar2);

	$eliminar="DELETE FROM pieces WHERE cod_piece='$chkval'";
	mysql_query($eliminar);
	//$eliminar2="DELETE FROM need_p_m WHERE cod_piece='$chkval'";
	
	//mysql_query($eliminar2);
}

header("Location: ../manage_pieces.php");

mysql_close($dp);
?>