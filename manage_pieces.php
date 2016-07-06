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
    <li><a class="active" href="manage_pieces.php">Pieces</a>
        <ul>
            <li><a class="active" href="manage_pieces.php">Manage</a></li>
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
	<h1><u><i>Manage pieces</i></u></h1>
<form enctype="multipart/form-data" action="" method="post">
	Add data: <br/>
	<textarea name="data" rows="3" cols="50" placeholder="Piece code, Description or Price... (Do not add anything to show all)"></textarea><br/><br/>
	Order by: 
	<select name="orden">
        <option value="cod_piece" selected>Piece code</option>
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

$sql = "SELECT * FROM pieces WHERE description LIKE '%$data%' OR price LIKE '%$data%' OR cod_piece LIKE '%$data%' OR stock LIKE '%$data%' ORDER BY $orden";
$conce = mysql_query($sql);

$conce2 = mysql_query($sql);
$zenbat = 0;
while ($row2 = mysql_fetch_assoc($conce2)) {
 $zenbat = $zenbat+1;
};
echo "NOTE: If the piece is in any order, it won't be deleted. But it's materials will be wiped out. <br/> $zenbat pieces in total.";

$num_fila = 0; 
echo "<form enctype=\"multipart/form-data\" action=\"inc/delete_pieces2.php\" method=\"post\">";
echo "<table border=1>";
echo "<tr bgcolor=\"#c1bda8\" align=center><td></td><th>Piece code</th><th>Plans</th><th>Description</th><th>Price</th><th>Stock</th><th colspan=3>Actions</th></tr>";
while ($row = mysql_fetch_assoc($conce)) {
	echo "<tr "; 
   	if ($num_fila%2==0) 
      	echo "bgcolor=#dddddd"; //si el resto de la división es 0 pongo un color 
   	else 
      	echo "bgcolor=#ddddff"; //si el resto de la división NO es 0 pongo otro color 
   	echo ">";
    echo "<td rowspan=2><input type=\"checkbox\" name=\"dele[]\" value=\"$row[cod_piece]\"/></td><td rowspan=2>$row[cod_piece]</td>";
    echo "<td>";
    if (isset($row['plans']) and $row['plans']!=""){
        echo "<a href=\"plans/$row[plans]\" style=\"text-decoration:none\"><input type=\"button\" value=\"Download plans\"></a>";
    } else {
        echo "No plans for this piece.";
    }
    echo "</td>";
    //echo "<td><input size=\"20\" type=\"file\" name=\"plans\" value=\"plans/$row[plans]\"/></td>";
	echo "<td>$row[description]</td>";
    echo "<td>$row[price] ¥</td>";
    echo "<td>$row[stock]</td>";
	//echo "<td><button onclick=\"window.location.href='edit_pieces.php?cod_piece=$row[cod_piece]'\" class='button1'>Edit</button></td>";
    echo "<td rowspan=2><a href=\"edit_pieces.php?cod_piece=$row[cod_piece]\" style=\"text-decoration:none\" class='button1'><input type=\"button\" value=\"Edit\"></a></td>";
    echo "<td rowspan=2><a href=\"add_stock_pieces.php?cod_piece=$row[cod_piece]\" style=\"text-decoration:none\" class='button1'><input type=\"button\" value=\"Add stock\"></a></td>";
	//echo "<td><button onclick=\"seguropi('$row[cod_piece]','$row[description]','$row[plans]');\">Delete</button></td>";
    echo "<td rowspan=2><a href=\"inc/delete_pieces.php?cod_piece=$row[cod_piece]&plans=$row[plans]\" style=\"text-decoration:none\" class='button1'><input type=\"button\" value=\"Delete\"></a></td>";
	//echo "<td><button onclick=\"window.location.href='edit_pieces.php?cod_piece=$row[cod_piece]'\" class='button1'>Editar</button></td>";
	//echo "<td><button onclick=\"seguro($row[cod_piece],'$row[concepto]');\" class='button1'>Eliminar</button></td>";
	echo "</tr>";
    echo "<tr><td colspan=4>
            <table border=1 width=\"100%\" bgcolor=#dddddd>
            <tr bgcolor='#d0cdbe'><th colspan=3>Materials</th></tr>
            <tr bgcolor='#d0cdbe'><th>Quantity</th><th>Material</th><th>Remarks</th></tr>";
            $sql2 = "SELECT * FROM need_p_m WHERE cod_piece=$row[cod_piece]";
            $cons2 = mysql_query($sql2);
            while ($row2 = mysql_fetch_assoc($cons2)) {
            echo "<tr>
                <td>$row2[quantity]</td>
                <td>";
                $sql3 = "SELECT * FROM materials WHERE cod_mat=$row2[cod_mat]";
                $cons3 = mysql_query($sql3);
                while ($row3 = mysql_fetch_assoc($cons3)) {
                    echo "$row3[description]";
                }
                echo "</td>
                <td>$row2[remarks]</td>
            </tr>";
            }
            echo "</table>
            </td></tr>";
	$num_fila++; 
};
echo "</table><br/>";
echo "<input type=\"submit\" name=\"delete\" value=\"Delete selected\"/></form><br/>";
echo "Is it not here? <a href='add_pieces.php' style=\"text-decoration:none\"><input type='button' value='Add'></a>";

mysql_close($dp);
}
?>
</div>
<a href="#" class="go-top" id="go-top">Go up</a>
</body>
</html>