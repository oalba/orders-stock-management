<?php
$dp = mysql_connect("localhost", "", "" );
mysql_select_db("orders", $dp);

$data = $_GET['cod_piece'];
$plans2 = $_GET['plans2'];

$plans = $_FILES['plans'];

$price = $_POST['price'];
$stock = $_POST['stock'];
$concepto = $_POST['description'];
$concepto = trim(preg_replace('/\s\s+/', ' ', $concepto));


/*$sql = "SELECT * FROM pieces WHERE cod_piece=$data";
$cons = mysql_query($sql);
while ($row = mysql_fetch_assoc($cons)) {*/

if(!empty($_FILES['plans']['name'])){
    $value = "../plans/".$plans2;
    if (file_exists($value)) {
        unlink($value);
    }
    $temp = explode(".", $_FILES["plans"]["name"]);
    $newfilename = round(microtime(true)) . '.' . end($temp);
    move_uploaded_file($_FILES["plans"]["tmp_name"], "../plans/" . $newfilename);
    $plans2 = $newfilename;
}
    $aldatu="UPDATE pieces SET plans='$plans2',description='$concepto',price='$price',stock='$stock' WHERE cod_piece=$data";
    mysql_query($aldatu);
//} else {
    //$aldatu="UPDATE pieces SET description='$concepto',price='$price' WHERE cod_piece=$data";
    //mysql_query($aldatu);
//}
//}

header("Location: ../edit_pieces.php?cod_piece=$data");
mysql_close($dp);
?>