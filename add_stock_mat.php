<!DOCTYPE html>
<html lang="en">
<head>
<title>CSMC - Sino-Spanish Orders</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="shortcut icon" href="images/icon.png" type="image/png"/>
<link rel="stylesheet" type="text/css" href="css/estilo.css">
<script type="text/javascript" src="js/scripts.js" ></script>
</head>
<body>
<header>
<div class="nav">
<ul>
    <li><a href="index2.php">Orders</a>
        <ul>
            <li><a href="index2.php">Manage</a></li>
            <li><a href="add_orders.php">Add</a></li>
        </ul>
    </li>
    <li><a href="manage_pieces.php">Pieces</a>
        <ul>
            <li><a href="manage_pieces.php">Manage</a></li>
            <li><a href="add_pieces.php">Add</a></li>
        </ul>
    </li>
    <li><a class="active" href="manage_materials.php">Materials</a>
        <ul>
            <li><a href="manage_materials.php">Manage</a></li>
            <li><a href="add_materials.php">Add</a></li>
        </ul>
    </li>
    <li><a href="manage_clients.php">Clients</a>
        <ul>
            <li><a href="manage_clients.php">Manage</a></li>
            <li><a href="add_clients.php">Add</a></li>
        </ul>
    </li>
    <li><a href="manage_managers.php">Managers</a>
        <ul>
            <li><a href="manage_managers.php">Manage</a></li>
            <li><a href="add_managers.php">Add</a></li>
        </ul>
    </li>
    <!--<li><a href="manage_suppliers.php">Suppliers</a>
        <ul>
            <li><a href="manage_suppliers.php">Manage</a></li>
            <li><a href="add_suppliers.php">Add</a></li>
        </ul>
    </li>-->
    <li class="log"><a href="inc/logout.php">Log out</a></li>
    <li class="about"><a href="about.html">About</a></li>
</ul>
</div>
</header>
<div class="cuerpo">
	<h1><u><i>Add stock of materials</i></u></h1>
<?php
session_start();
//$user = $_SESSION["usuario"];
if(!isset($_SESSION["usuario"])){
//if(!isset($_SESSION["usuario"]) || $user ==""){
    header("location:index.html");
}

$data = $_GET['cod_mat'];

$dp = mysql_connect("localhost", "", "" );
mysql_select_db("orders", $dp);

$sql = "SELECT * FROM materials WHERE cod_mat=$data";
$phones = mysql_query($sql);

$num_fila = 0; 
echo "<table border=1>";
    echo "<tr bgcolor=\"bbbbbb\" align=center><th>Material code</th><th>Description</th><th>Price</th><th>Stock</th><th>Actions</th><!--<th>Supplier</th>--></tr>";
while ($row = mysql_fetch_assoc($phones)) {
	//echo "<form enctype='multipart/form-data' action='t_edit.php?telephone=$row[Telephone]' method='post'>";
	echo "<form enctype='multipart/form-data' action='' method='post'>";
	echo "<tr "; 
   	if ($num_fila%2==0) 
      	echo "bgcolor=#dddddd"; //si el resto de la división es 0 pongo un color 
   	else 
      	echo "bgcolor=#ddddff"; //si el resto de la división NO es 0 pongo otro color 
   	echo ">";
    echo "<td><input type=\"number\" name=\"cod_mat\" value=\"$row[cod_mat]\" style=\"white-space:pre-wrap; width: 80px;\" disabled=\"disabled\"/></td>";
    echo "<td><textarea name='description' rows='2' cols='10' disabled=\"disabled\">$row[description]</textarea></td>";
    echo "<td><input type='number' name='price' step='any' Style='width:60Px' value='$row[price]' disabled=\"disabled\"> ¥</td>";
    echo "<td><input type='number' name='stock' Style='width:60Px' value='$row[stock]' disabled=\"disabled\"> + <input type='number' name='stocknew' Style='width:60Px' value='0'></td>";
	echo "<td><input type='submit' name='save' value='Save' class='button1'/></td>";
	echo "</tr>";
	echo "</form>";
	$num_fila++; 
};
echo "</table>";

if(isset($_POST['save'])){
    $stocknew = $_POST['stocknew'];
    $aldatu="UPDATE materials SET stock = stock + '$stocknew' WHERE cod_mat=$data";
    mysql_query($aldatu);
    header("Refresh:0");
}
mysql_close($dp);
?>
<br/>
<a href="manage_materials.php" style="text-decoration:none"><input type="button" value="Back"></a>
</div>
<a href="#" class="go-top" id="go-top">Go up</a>
</body>
</html>