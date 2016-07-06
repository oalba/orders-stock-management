<!DOCTYPE html>
<html lang="en">
<head>
<title>Add suppliers</title>
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
            <li><a class="active" href="add_suppliers.php">Add</a></li>
        </ul>
    </li>
    <li class="about"><a href="about.html">About</a></li>
</ul>
</div>
</header>
<div class="cuerpo">
    <h1><u><i>New suppliers</i></u></h1>
    <?php 
    	$dp = mysql_connect("localhost", "", "" );
		mysql_select_db("orders", $dp);
	?>
Add suppliers: <br/><br/>
<form enctype='multipart/form-data' action='' method='post'>
Supplier code: <input type="number" name="cod_sup" value="<?php 
            $orde = mysql_query('SELECT MAX(cod_sup) AS cod_sup FROM suppliers');
            $ordee = mysql_result($orde,0,0);
            $orden = $ordee+1; 
            echo $orden ?>" required/><br/><br/>
Name: <input id="name" type="text" name="name" value="" required/><br/><br/>
Phone: <input type="number" name="phone" value=""/><br/><br/>
Details: <br/><textarea name="details" rows="5"></textarea><br/><br/>
<input type='submit' name='save' value='Save'/><br/>
</form>

<?php
if(isset($_POST['save'])){
    $cod_sup = $_POST['cod_sup'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $details = $_POST['details'];

	$sql = "SELECT * FROM suppliers WHERE cod_sup='$cod_sup'";
	$clis = mysql_query($sql);
	if (mysql_num_rows($clis) == 0){
        $anadir="INSERT INTO suppliers(cod_sup,name,phone,details) VALUES ('$cod_sup','$name','$phone','$details')";
		mysql_query($anadir);
        echo "Supplier added correctly.<br/>";
        header("Refresh:0");
    } else {
		echo "ERROR! This supplier already exists.";
        $num_fila = 0; 
        echo "<table border=1>";
        echo "<tr bgcolor=\"bbbbbb\" align=center><th>Supplier code</th><th>Name</th><th>Phone</th><th>Details</th></tr>";
        while ($row = mysql_fetch_assoc($clis)) {
            echo "<tr "; 
            if ($num_fila%2==0) 
                echo "bgcolor=#dddddd"; //si el resto de la división es 0 pongo un color 
            else 
                echo "bgcolor=#ddddff"; //si el resto de la división NO es 0 pongo otro color 
            echo ">";
            echo "<td>$row[cod_sup]</td>";
            echo "<td>$row[name]</td>";
            echo "<td>$row[phone]</td>";
            echo "<td>$row[details]</td>";
            echo "<td><a href=\"edit_suppliers.php?cod_sup=$row[cod_sup]\" style=\"text-decoration:none\"><input type=\"button\" value=\"Edit\"></a></td>";
            //echo "<td><button onclick=\"seguro($row[cod_con]);\">Delete</button></td>";
            echo "</tr>";
            $num_fila++;
        }
        echo "</table><br/>";
    }
}
mysql_close($dp);
?>
</div>
<a href="#" class="go-top" id="go-top">Go up</a>
</body>
</html>