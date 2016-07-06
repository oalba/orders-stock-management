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
	<h1><u><i>Edit pieces</i></u></h1>
<?php
session_start();
//$user = $_SESSION["usuario"];
if(!isset($_SESSION["usuario"])){
//if(!isset($_SESSION["usuario"]) || $user ==""){
    header("location:index.html");
}

$data = $_GET['cod_piece'];

$dp = mysql_connect("localhost", "", "" );
mysql_select_db("orders", $dp);

$sql = "SELECT * FROM pieces WHERE cod_piece=$data";
$phones = mysql_query($sql);

$num_fila = 0; 
echo "<table border=1>";
echo "<tr bgcolor=\"#c1bda8\" align=center><th>Piece code</th><th>Plans</th><th>Description</th><th>Price</th><th>Stock</th><th colspan=2>Actions</th></tr>";
while ($row = mysql_fetch_assoc($phones)) {
	//echo "<form enctype='multipart/form-data' action='t_edit.php?telephone=$row[Telephone]' method='post'>";
	echo "<form enctype='multipart/form-data' action='inc/edit_pieces_act.php?cod_piece=$row[cod_piece]&plans2=$row[plans]' method='post'>";
	echo "<tr "; 
   	if ($num_fila%2==0) 
      	echo "bgcolor=#dddddd"; //si el resto de la división es 0 pongo un color 
   	else 
      	echo "bgcolor=#ddddff"; //si el resto de la división NO es 0 pongo otro color 
   	echo ">";
    /*echo "<td>";
    if (isset($row['plans']) and $row['plans']!=""){
        echo "<a href=\"plans/$row[plans]\" style=\"text-decoration:none\"><input type=\"button\" value=\"Download plans\"></a>";
    } else {
        echo "No plans for this piece.";
    }
    echo "</td>";*/
    echo "<td rowspan=2><input type=\"number\" name=\"cod_piece\" value=\"$row[cod_piece]\" style=\"white-space:pre-wrap; width: 80px;\" disabled=\"disabled\"/></td>";
    echo "<td><input size=\"20\" type=\"file\" name=\"plans\"/><br/>";
    if (isset($row['plans']) and $row['plans']!=""){
        //echo "<input type='hidden' name='plans2' value='$row[plans]'/>";
        echo "<a href=\"plans/$row[plans]\" style=\"text-decoration:none\"><input type=\"button\" value=\"Download plans\"></a>";
    } else {
        echo "No plans for this piece yet.";
    }
    echo "</td>";
    echo "<td><textarea name='description' rows='3' cols='50'>$row[description]</textarea></td>";
    echo "<td><input type='number' name='price' step='any' Style='width:60Px' value='$row[price]'> ¥</td>";
    echo "<td><input type='number' name='stock' Style='width:60Px' value='$row[stock]'></td>";
	echo "<td><input type='submit' name='save' value='Save' class='button1'/></td>";
    echo "<td><a href=\"inc/delete_pieces.php?cod_piece=$row[cod_piece]&plans=$row[plans]\" style=\"text-decoration:none\"><input type=\"button\" value=\"Delete\" class='button1'></a></td>";

	echo "</tr></form>";
	echo "<tr><td colspan=6>
            <table border='1' width='100%' bgcolor=#dddddd>
            <tr bgcolor='#d0cdbe'><th colspan=5>Materials</th></tr>
            <tr bgcolor='#d0cdbe'><th>Quantity</th><th>Material</th><th>Remarks</th><th colspan=2>Actions</th></tr>";

    $sql2 = "SELECT * FROM need_p_m WHERE cod_piece=$row[cod_piece]";
    $cons2 = mysql_query($sql2);
    while ($row2 = mysql_fetch_assoc($cons2)) {
        echo "<tr>
        <td><input type=\"number\" name=\"quantity\" value=\"$row2[quantity]\" Style=\"width:40Px\" disabled=\"disabled\"/></td>";
        echo "<td><select name=\"cod_mat\" onchange=\"changeMat(this,1)\" style=\"white-space:pre-wrap; width: 250px;\" disabled=\"disabled\">";
                
        $sql3 = "SELECT * FROM materials";
        $cons3 = mysql_query($sql3);
        while ($row3 = mysql_fetch_assoc($cons3)) {
            if ($row2['cod_mat']==$row3['cod_mat']) {
                print("<option value='".$row3[cod_mat]."' selected='selected'>$row3[description]</option>");
            } else {
                print("<option value='".$row3[cod_mat]."'>$row3[description]</option>");                        
            }
        }
        echo "</select> Code: <input id=\"cod_mat1\" type=\"number\" name=\"cod_mat1\" Style=\"width:60Px\" value=\"$row2[cod_mat]\" disabled=\"disabled\"/></td>";
        /*$sql4 = "SELECT * FROM materials WHERE cod_mat=$row2[cod_mat]";
        $cons4 = mysql_query($sql4);
        while ($row4 = mysql_fetch_assoc($cons4)) {
            echo "<td>";
            if (isset($row4['plans']) and $row4['plans']!=""){
                echo "<a href=\"plans/$row4[plans]\" style=\"text-decoration:none\"><input type=\"button\" value=\"Download plans\" class=\"button1\"></a>";
            } else {
                echo "No plans for this piece.";
            }
            echo "</td>";
            
        }*/
        echo "<td><textarea name=\"remarks1\" rows=\"1\" cols=\"50\" disabled=\"disabled\">$row2[remarks]</textarea></td>";
        /*echo "<td>editar</td><td>eliminar</td></tr>";
        echo "<td><button onclick=\"window.location.href='edit_orders.php?cod_ord=$row5[cod_ord]'\" class=\"button1\">Edit</button></td>";
        echo "<td><button onclick=\"seguroord($row5[cod_ord]);\" class=\"button1\">Delete</button></td>";*/
        echo "<td><a href='edit_m_p.php?cod_piece=$data&cod_mat=$row2[cod_mat]' style=\"text-decoration:none\"><input type='button' value='Edit' class='button1'/></a></td>";
        echo "<td><button onclick=\"seguroPieMat('".$row2['cod_mat']."',".$data.");\" class='button1'>Delete</button></td></tr>";
    }
    echo "<tr>";
    echo "<form enctype='multipart/form-data' action='inc/add_pie_mat_act.php?cod_piece=$data' method='post'>";
    echo "<td><input type=\"number\" name=\"cant0\" value=\"1\" Style=\"width:40Px\"/></td>";
    echo "<td><select name=\"material0\" onchange=\"changeMat(this,0)\" style=\"white-space:pre-wrap; width: 250px;\">
        <option selected=\"selected\"></option>";
                    
    $sql7 = "SELECT * FROM materials WHERE cod_mat NOT IN (SELECT cod_mat FROM need_p_m WHERE cod_piece=$data)";

    //$sql = "SELECT materials.* FROM materials LEFT JOIN need_p_m ON need_p_m.cod_mat!=materials.cod_mat AND need_p_m.cod_ord=$data";
    //$sql = "SELECT * FROM materials";
    $cons7 = mysql_query($sql7);
    while ($row7 = mysql_fetch_assoc($cons7)) {
        //$con = mysql_query("SELECT * FROM need_p_m WHERE cod_mat=$row[cod_mat] AND cod_ord=$data");
       // $cone = mysql_result($con,0,0);
        //while ($row6 = mysql_fetch_assoc($con)) {
            //if (!isset($cone)) {
                print("<option value='".$row7[cod_mat]."'>$row7[description]</option>");
           // }
        //}
        
    }
    echo "</select> Code: <input id=\"cod_mat0\" type=\"number\" name=\"cod_mat0\" Style=\"width:60Px\" value=\"\" disabled=\"disabled\"/></td>";
    echo "<td><textarea name=\"remarks0\" rows=\"1\" cols=\"50\"></textarea></td><td colspan=2><input type='submit' name='save' value='Save' class='button1'/></td>";
    echo "</form></tr>";

            echo "</table>
            </td></tr>";
	
	$num_fila++; 
};
echo "</table>";

mysql_close($dp);
?>
<br/>
<a href="manage_pieces.php" style="text-decoration:none"><input type="button" value="Back"></a>
</div>
<a href="#" class="go-top" id="go-top">Go up</a>
</body>
</html>