<!DOCTYPE html>
<html lang="en">
<head>
<title>Edit suppliers</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="shortcut icon" href="images/icon.png" type="image/png"/>
<link rel="stylesheet" type="text/css" href="css/estilo.css">
<script type="text/javascript" src="js/scripts.js" ></script>
</head>
<body>
<header>
<div class="nav">
<ul>
    <li><a href="index.php">Orders</a>
        <ul>
            <li><a href="index.php">Manage</a></li>
            <li><a href="add_orders.php">Add</a></li>
        </ul>
    </li>
    <li><a href="manage_pieces.php">Pieces</a>
        <ul>
            <li><a href="manage_pieces.php">Manage</a></li>
            <li><a href="add_pieces.php">Add</a></li>
        </ul>
    </li>
    <li><a href="manage_materials.php">Materials</a>
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
    <li><a class="active" href="manage_suppliers.php">Suppliers</a>
        <ul>
            <li><a href="manage_suppliers.php">Manage</a></li>
            <li><a href="add_suppliers.php">Add</a></li>
        </ul>
    </li>
    <li class="about"><a href="about.html">About</a></li>
</ul>
</div>
</header>
<div class="cuerpo">
	<h1><u><i>Edit suppliers</i></u></h1>
<?php
$data = $_GET['cod_sup'];

$dp = mysql_connect("localhost", "", "" );
mysql_select_db("orders", $dp);

$sql = "SELECT * FROM suppliers WHERE cod_sup='$data'";
$phones = mysql_query($sql);

$num_fila = 0; 
echo "<table border=1>";
echo "<tr bgcolor=\"bbbbbb\" align=center><th>Name</th><th>Phone</th><th>Details</th></tr>";
while ($row = mysql_fetch_assoc($phones)) {
	//echo "<form enctype='multipart/form-data' action='t_edit.php?telephone=$row[Telephone]' method='post'>";
	echo "<form enctype='multipart/form-data' action='' method='post'>";
	echo "<tr "; 
   	if ($num_fila%2==0) 
      	echo "bgcolor=#dddddd"; //si el resto de la división es 0 pongo un color 
   	else 
      	echo "bgcolor=#ddddff"; //si el resto de la división NO es 0 pongo otro color 
   	echo ">";
    echo "<td><input type='text' name='name' value='$row[name]'></td>";
    echo "<td><input type='number' name='phone' step='any' value='$row[phone]'></td>";
    echo "<td><textarea name='details' rows='3' cols='50'>$row[details]</textarea></td>";
	echo "<td><input type='submit' name='save' value='Save' class='button1'/></td>";
	echo "</tr>";
	echo "</form>";
	$num_fila++; 
};
echo "</table>";

if(isset($_POST['save'])){
//$tlf = $_POST['telephone'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$details = $_POST['details'];
//$direccion = trim(preg_replace('/\s\s+/', ' ', $direccion));

$aldatu="UPDATE suppliers SET phone='$phone',name='$name',details='$details' WHERE cod_sup='$data'";
mysql_query($aldatu);
header("Refresh:0");
}
mysql_close($dp);
?>
<br/>
<a href="manage_suppliers.php" style="text-decoration:none"><input type="button" value="Back"></a>
</div>
<a href="#" class="go-top" id="go-top">Go up</a>
</body>
</html>