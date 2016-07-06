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
            <li><a class="active" href="manage_materials.php">Manage</a></li>
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
	<h1><u><i>Manage materials</i></u></h1>
<form enctype="multipart/form-data" action="" method="post">
	Add data: <br/>
	<textarea name="data" rows="3" cols="50" placeholder="Material code, Description or Price... (Do not add anything to show all)"></textarea><br/><br/>
	Order by: 
	<select name="orden">
        <option value="cod_mat" selected>Material code</option>
		<option value="description">Description</option>
		<option value="price">Price</option>
	</select>
	<input type="submit" name="search" value="Search"/>
</form>
<?php 
session_start();
//$user = $_SESSION["usuario"];
if(!isset($_SESSION["usuario"])){
//if(!isset($_SESSION["usuario"]) || $user ==""){
    header("location:index.html");
}

if(isset($_POST['search'])){
$data = $_POST['data'];
$orden = $_POST['orden'];

$dp = mysql_connect("localhost", "", "" );
mysql_select_db("orders", $dp);

$sql = "SELECT * FROM materials WHERE description LIKE '%$data%' OR price LIKE '%$data%' OR cod_mat LIKE '%$data%' OR stock LIKE '%$data%' ORDER BY $orden";
$conce = mysql_query($sql);

$conce2 = mysql_query($sql);
$zenbat = 0;
while ($row2 = mysql_fetch_assoc($conce2)) {
 $zenbat = $zenbat+1;
};
echo "$zenbat materials in total.";

$num_fila = 0; 
echo "<table border=1>";
    echo "<tr bgcolor=\"bbbbbb\" align=center><th>Material code</th><th>Description</th><th>Price</th><th>Stock</th><th colspan=3>Actions</th><!--<th>Supplier</th>--></tr>";
while ($row = mysql_fetch_assoc($conce)) {
	echo "<tr "; 
   	if ($num_fila%2==0) 
      	echo "bgcolor=#dddddd"; //si el resto de la división es 0 pongo un color 
   	else 
      	echo "bgcolor=#ddddff"; //si el resto de la división NO es 0 pongo otro color 
   	echo ">";
    echo "<td>$row[cod_mat]</td>";
	echo "<td>$row[description]</td>";
    echo "<td>$row[price] ¥</td>";
    echo "<td>$row[stock]</td>";
    /*$sql2 = "SELECT * FROM suppliers WHERE cod_sup=$row[cod_sup]";
    $cons2 = mysql_query($sql2);
    while ($row2 = mysql_fetch_assoc($cons2)) {
    	echo "<td>$row2[name]</td>";
    }*/
	echo "<td><a href=\"edit_materials.php?cod_mat=$row[cod_mat]\" style=\"text-decoration:none\" class='button1'><input type=\"button\" value=\"Edit\"></a></td>";
    echo "<td><a href=\"add_stock_mat.php?cod_mat=$row[cod_mat]\" style=\"text-decoration:none\" class='button1'><input type=\"button\" value=\"Add stock\"></a></td>";
	echo "<td><button onclick=\"seguromat($row[cod_mat],'$row[description]');\">Delete</button></td>";
	//echo "<td><button onclick=\"window.location.href='edit_materials.php?cod_mat=$row[cod_mat]'\" class='button1'>Editar</button></td>";
	//echo "<td><button onclick=\"seguro($row[cod_mat],'$row[concepto]');\" class='button1'>Eliminar</button></td>";
	echo "</tr>";
	$num_fila++; 
};
echo "</table><br/>";
echo "Is it not here? <a href='add_materials.php' style=\"text-decoration:none\"><input type='button' value='Add'></a>";

mysql_close($dp);
}
?>
</div>
<a href="#" class="go-top" id="go-top">Go up</a>
</body>
</html>