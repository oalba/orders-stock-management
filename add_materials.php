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
            <li><a class="active" href="add_materials.php">Add</a></li>
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
<?php
session_start();
//$user = $_SESSION["usuario"];
if(!isset($_SESSION["usuario"])){
//if(!isset($_SESSION["usuario"]) || $user ==""){
    header("location:index.html");
}

	$dp = mysql_connect("localhost", "", "" );
	mysql_select_db("orders", $dp);
?>
<div class="cuerpo">
    <h1><u><i>New materials</i></u></h1>
Add materials: <br/><br/>
<table border=0>
    <tr><th>Material code</th><th>Description</th><th>Price</th><th>Stock</th><!--<th>Supplier</th>--></tr>
    <form enctype='multipart/form-data' action='' method='post'>
        <tr>
        	<td><input type="number" name="cod_mat" value="<?php 
            $orde = mysql_query('SELECT MAX(cod_mat) AS cod_mat FROM materials');
            $ordee = mysql_result($orde,0,0);
            $orden = $ordee+1; 
            echo $orden ?>" required/></td>
            <td><textarea name='description' rows="1" cols="50"></textarea></td>
            <td><input type='number' name='price' step="any" Style="width:60Px"/> ¥</td>
            <td><input type='number' name='stock' Style="width:60Px" value="0" /></td>
            <!--<td><select name="supplier" style="white-space:pre-wrap; width: 100px;" required>
            <option selected="selected"></option>
            <?php
	            $sql = "SELECT * FROM suppliers";
	            $clis = mysql_query($sql);
	            while ($row = mysql_fetch_assoc($clis)) {
	                print("<option value='".$row[cod_sup]."'>$row[name]</option>");
	            }
        	?></select></td>-->
            <td><input type='submit' name='save' value='Save'/></td>
        </tr>
    </form>
</table>

<?php
if(isset($_POST['save'])){
	$cod_mat = $_POST['cod_mat'];
    $conce = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    //$cod_sup = $_POST['supplier'];
    $conce = trim(preg_replace('/\s\s+/', ' ', $conce));
    /*if ($cod_sup=="0") {
    	$cod_sup = "";
    }*/

    

    $sql = "SELECT * FROM materials WHERE cod_mat=$cod_mat";
    $cons = mysql_query($sql);
    if (mysql_num_rows($cons) == 0){
        //$sartu="INSERT INTO materials (cod_mat, description, price, cod_sup) VALUES ('$cod_mat', '$conce', '$price', '$cod_sup')";
        $sartu="INSERT INTO materials (cod_mat, description, price, stock) VALUES ('$cod_mat', '$conce', '$price', '$stock')";
        mysql_query($sartu);
        echo "Material added correctly.<br/>";
        header("Refresh:0");
    } else {
        echo "ERROR! This material already exists.";
        $num_fila = 0; 
        echo "<table border=1>";
        echo "<tr bgcolor=\"bbbbbb\" align=center><th>Material code</th><th>Description</th><th>Price</th><th>Sock</th><th>Actions</th><!--<th>Supplier</th>--></tr>";
        while ($row = mysql_fetch_assoc($cons)) {
            echo "<tr "; 
            if ($num_fila%2==0) 
                echo "bgcolor=#dddddd"; //si el resto de la división es 0 pongo un color 
            else 
                echo "bgcolor=#ddddff"; //si el resto de la división NO es 0 pongo otro color 
            echo ">";
            echo "<td>$row[cod_mat]</td>";
            echo "<td>$row[description]</td>";
            echo "<td>$row[price]¥</td>";
            echo "<td>$row[stock]</td>";
            /*if ($row['cod_sup']=="") {
            	echo "<td>Supplier not saved.</td>";
            }else{*/
            	/*$sql2 = "SELECT * FROM suppliers WHERE cod_sup=$row[cod_sup]";
            	$cons2 = mysql_query($sql2);
            	while ($row2 = mysql_fetch_assoc($cons2)) {
            		echo "<td>$row2[name]</td>";
            	}*/
            //}
            
            echo "<td><button onclick=\"window.location.href='edit_materials.php?cod_mat=$row[cod_mat]'\">Edit</button></td>";
            echo "</tr>";
            $num_fila++;
        }
        echo "</table><br/>";
    }

    mysql_close($dp);
}
?>
</div>
<a href="#" class="go-top" id="go-top">Go up</a>
</body>
</html>