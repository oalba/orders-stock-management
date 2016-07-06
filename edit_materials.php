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
	<h1><u><i>Edit materials</i></u></h1>
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
    echo "<td><textarea name='description' rows='3' cols='50'>$row[description]</textarea></td>";
    echo "<td><input type='number' name='price' step='any' Style='width:60Px' value='$row[price]'> ¥</td>";
    echo "<td><input type='number' name='stock' Style='width:60Px' value='$row[stock]'></td>";
    /*echo "<td><select name=\"supplier\" style=\"white-space:pre-wrap; width: 100px;\" required><option></option>";
    $sql3 = "SELECT * FROM suppliers";
    $clis3 = mysql_query($sql3);
    while ($row3 = mysql_fetch_assoc($clis3)) {
        //$sql2 = "SELECT * FROM suppliers WHERE cod_sup=$row[cod_sup]";
    	//$clis2 = mysql_query($sql2);
    	//while ($row2 = mysql_fetch_assoc($clis2)) {
    	    
    	    
    			
    	//}
        if ($row['cod_sup'] != $row3['cod_sup']) {
            print("<option value='".$row3[cod_sup]."'>$row3[name]</option>");
        }else{
            print("<option value='".$row[cod_sup]."' selected=\"selected\">$row3[name]</option>");
        }
    }
    echo "<!--<option value=\"0\">Others</option>-->";
	
    echo"</select></td>";*/
	echo "<td><input type='submit' name='save' value='Save' class='button1'/></td>";
	echo "</tr>";
	echo "</form>";
	$num_fila++; 
};
echo "</table>";

if(isset($_POST['save'])){
//$tlf = $_POST['telephone'];
$concepto = $_POST['description'];
$price = $_POST['price'];
$stock = $_POST['stock'];
//$cod_sup = $_POST['supplier'];
$concepto = trim(preg_replace('/\s\s+/', ' ', $concepto));

//$aldatu="UPDATE materials SET description='$concepto',price='$price',cod_sup='$cod_sup' WHERE cod_mat=$data";
$aldatu="UPDATE materials SET description='$concepto',price='$price',stock='$stock' WHERE cod_mat=$data";
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