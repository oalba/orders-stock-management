<!DOCTYPE html>
<html lang="en">
<head>
<title>Manage suppliers</title>
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
            <li><a class="active" href="manage_suppliers.php">Manage</a></li>
            <li><a href="add_suppliers.php">Add</a></li>
        </ul>
    </li>
    <li class="about"><a href="about.html">About</a></li>
</ul>
</div>
</header>
<div class="cuerpo">
	<h1><u><i>Manage suppliers</i></u></h1>
<form enctype="multipart/form-data" action="" method="post">
	Add data: <br/>
	<textarea name="data" rows="3" cols="50" placeholder="Supplier code, Name, Phone or Details... (Do not add anything to show all)"></textarea><br/><br/>
	Order by: 
	<select name="orden">
		<option value="cod_sup" selected>Supplier code</option>
		<option value="name">Name</option>
		<option value="phone">Phone</option>
		<option value="details">Details</option>		
	</select>
	<input type="submit" name="search" value="Search"/>
</form>
<?php 
if(isset($_POST['search'])){
$data = $_POST['data'];
$orden = $_POST['orden'];

$dp = mysql_connect("localhost", "", "" );
mysql_select_db("orders", $dp);

$sql = "SELECT * FROM suppliers WHERE cod_sup LIKE '%$data%' OR name LIKE '%$data%' OR details LIKE '%$data%' OR phone LIKE '%$data%' ORDER BY $orden";
$conce = mysql_query($sql);

$conce2 = mysql_query($sql);
$zenbat = 0;
while ($row2 = mysql_fetch_assoc($conce2)) {
 $zenbat = $zenbat+1;
};
echo "NOTE: If the supplier still supplies any material, it won't be deleted. <br/> $zenbat suppliers in total.";

$num_fila = 0; 
echo "<table border=1>";
echo "<tr bgcolor=\"bbbbbb\" align=center><th>Supplier code</th><th>Name</th><th>Phone</th><th>Details</th></tr>";
while ($row = mysql_fetch_assoc($conce)) {
	echo "<tr "; 
   	if ($num_fila%2==0) 
      	echo "bgcolor=#dddddd"; //si el resto de la división es 0 pongo un color 
   	else 
      	echo "bgcolor=#ddddff"; //si el resto de la división NO es 0 pongo otro color 
   	echo ">";
	echo "<td>$row[cod_sup]</td>";
	echo "<td>$row[name]</td>";
	echo "<td>$row[phone]</td>";
    echo "<td>".nl2br($row['details'])."</td>";    
	echo "<td><button onclick=\"window.location.href='edit_suppliers.php?cod_sup=$row[cod_sup]'\" class='button1'>Edit</button></td>";
	echo "<td><button onclick=\"segurosup('$row[cod_sup]');\" class='button1'>Delete</button></td>";
	echo "</tr>";
	$num_fila++; 
};
echo "</table><br/>";
echo "Is it not here? <a href='add_suppliers.php' style=\"text-decoration:none\"><input type='button' value='Add'></a>";

mysql_close($dp);
}
?>
</div>
<a href="#" class="go-top" id="go-top">Go up</a>
</body>
</html>