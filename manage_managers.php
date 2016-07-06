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
    <li><a class="active" href="manage_managers.php">Managers</a>
        <ul>
            <li><a class="active" href="manage_managers.php">Manage</a></li>
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
	<h1><u><i>Manage managers</i></u></h1>
<form enctype="multipart/form-data" action="" method="post">
	Add data: <br/>
	<textarea name="data" rows="3" cols="50" placeholder="Manager code, Name, Phone or Details... (Do not add anything to show all)"></textarea><br/><br/>
	Order by: 
	<select name="orden">
		<option value="cod_man" selected>Manager code</option>
		<option value="name">Name</option>
		<option value="phone">Phone</option>
		<option value="details">Details</option>		
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

$sql = "SELECT * FROM managers WHERE cod_man LIKE '%$data%' OR name LIKE '%$data%' OR details LIKE '%$data%' OR phone LIKE '%$data%' ORDER BY $orden";
$conce = mysql_query($sql);

$conce2 = mysql_query($sql);
$zenbat = 0;
while ($row2 = mysql_fetch_assoc($conce2)) {
 $zenbat = $zenbat+1;
};
echo "NOTE: If the manager has orders, it won't be deleted. <br/> $zenbat managers in total.";

$num_fila = 0; 
echo "<table border=1>";
echo "<tr bgcolor=\"bbbbbb\" align=center><th>Manager code</th><th>Name</th><th>Phone</th><th>Details</th></tr>";
while ($row = mysql_fetch_assoc($conce)) {
	echo "<tr "; 
   	if ($num_fila%2==0) 
      	echo "bgcolor=#dddddd"; //si el resto de la división es 0 pongo un color 
   	else 
      	echo "bgcolor=#ddddff"; //si el resto de la división NO es 0 pongo otro color 
   	echo ">";
	echo "<td>$row[cod_man]</td>";
	echo "<td>$row[name]</td>";
	echo "<td>$row[phone]</td>";
    echo "<td>".nl2br($row['details'])."</td>";    
	echo "<td><button onclick=\"window.location.href='edit_managers.php?cod_man=$row[cod_man]'\" class='button1'>Edit</button></td>";
	echo "<td><button onclick=\"seguroman('$row[cod_man]');\" class='button1'>Delete</button></td>";
	echo "</tr>";
	$num_fila++; 
};
echo "</table><br/>";
echo "Is it not here? <a href='add_managers.php' style=\"text-decoration:none\"><input type='button' value='Add'></a>";

mysql_close($dp);
}
?>
</div>
<a href="#" class="go-top" id="go-top">Go up</a>
</body>
</html>