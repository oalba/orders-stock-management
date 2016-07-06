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
    <li><a class="active" href="index2.php">Orders</a>
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
	<h1><u><i>Edit order</i></u></h1>
<?php
session_start();
//$user = $_SESSION["usuario"];
if(!isset($_SESSION["usuario"])){
//if(!isset($_SESSION["usuario"]) || $user ==""){
    header("location:index.html");
}

$data = $_GET['cod_ord'];

$dp = mysql_connect("localhost", "", "" );
mysql_select_db("orders", $dp);

$sql = "SELECT * FROM orders WHERE cod_ord=$data";
$selec = mysql_query($sql);



echo "<table border=1>";
while ($row5 = mysql_fetch_assoc($selec)) {
    echo "<tr bgcolor=\"#c1bda8\" align=center><th>Order code</th><th>Client</th><th>Manager</th><th>Order date</th><th>Deliver date</th><th>Delivered</th><th>Remarks</th><th>Discount</th><th colspan=2>Actions</th></tr>";
    echo "<form enctype='multipart/form-data' action='inc/edit_order_act.php?cod_ord=$row5[cod_ord]' method='post'><tr bgcolor=#dddddd>";
    echo "<td rowspan=2><input type=\"number\" name=\"cod_ord\" value=\"$row5[cod_ord]\" style=\"white-space:pre-wrap; width: 80px;\" disabled=\"disabled\"/></td>";
    echo "<td><select name=\"cli1\" onchange=\"changeCli(this)\" style=\"white-space:pre-wrap; width: 100px;\" required>";
    $sqlcli = "SELECT * FROM clients";
    $clis = mysql_query($sqlcli);
    while ($rowcli = mysql_fetch_assoc($clis)) {
        if ($rowcli['cod_cli'] != $row5['cod_cli']) {
            print("<option value='".$rowcli[cod_cli]."'>$rowcli[name]</option>");
        } else {
            print("<option value='".$rowcli[cod_cli]."' selected='selected'>$rowcli[name]</option>");
        }
    }                        
    echo "</select> <br/>Code: <input id=\"cod_cli\" type=\"number\" name=\"cod_cli\" Style=\"width:60Px\" value=\"$row5[cod_cli]\" disabled=\"TRUE\"/></td>";
    echo "<td><select name=\"man1\" onchange=\"changeMan(this)\" style=\"white-space:pre-wrap; width: 100px;\">";
    $sqlman = "SELECT * FROM managers";
    $mans = mysql_query($sqlman);
    while ($rowman = mysql_fetch_assoc($mans)) {
        if ($rowman['cod_man'] != $row5['cod_man']) {
            print("<option value='".$rowman[cod_man]."'>$rowman[name]</option>");
        } else {
            print("<option value='".$rowman[cod_man]."' selected='selected'>$rowman[name]</option>");
        }
    }                        
    echo "</select> <br/>Code: <input id=\"cod_man\" type=\"number\" name=\"cod_man\" Style=\"width:60Px\" value=\"$row5[cod_man]\" disabled=\"TRUE\"/></td>";

    echo "<td><input type=\"date\" name=\"order_date\" value=\"$row5[order_date]\"/></td>";
    echo "<td>";
    if ($row5['deliver_date'] != NULL) {
        echo "<input type=\"date\" name=\"deliver_date\" value=\"$row5[deliver_date]\"/>";
    } else {
        echo "<input type=\"date\" name=\"deliver_date\" value=\"\"/>";
    }
    echo "</td>";
    echo "<td><select name=\"delivered\" style=\"white-space:pre-wrap; width: 60px;\">";
    if ($row5['delivered']=='0') {
        echo "<option value='0' selected=\"selected\">NO</option>
        <option value='1'>YES</option>";
    } else {
        echo "<option value='0'>NO</option>
        <option value='1' selected=\"selected\">YES</option>";
    }
    echo "</select></td>";
    echo "<td><textarea name=\"remarks\" rows=\"3\" cols=\"50\">$row5[remarks]</textarea></td>";
    echo "<td><input type=\"number\" name=\"discount\" step=\"any\" Style=\"width:60Px\" value=\"$row5[discount]\"/>%</td>";
    echo "<td><input type='submit' name='save' value='Save' class='button1'/></td>";
    echo "<td><button onclick=\"seguroord($row5[cod_ord]);\" class=\"button1\">Delete</button></td>";
    echo "</tr></form>";
    echo "<tr>
    <td colspan='9'>";
    echo "<table border='1' width='100%' bgcolor=#dddddd>
    <tr bgcolor='#d0cdbe'>
        <th colspan='9'>Pieces</th>
    </tr>
    <tr bgcolor='#d0cdbe'>
        <th>Quantity</th>
        <th>Piece</th>
        <th>Plans</th>
        <th>Remarks</th>
        <th colspan='2'>Actions</th>
    </tr>";
    $sql2 = "SELECT * FROM contain_o_p WHERE cod_ord=$row5[cod_ord]";
    $cons2 = mysql_query($sql2);
    while ($row2 = mysql_fetch_assoc($cons2)) {
        echo "<tr>
        <td><input type=\"number\" name=\"quantity\" value=\"$row2[quantity]\" Style=\"width:40Px\" disabled=\"disabled\"/></td>";
        echo "<td><select name=\"cod_piece\" onchange=\"changePie(this,1)\" style=\"white-space:pre-wrap; width: 250px;\" disabled=\"disabled\">";
                
        $sql = "SELECT * FROM pieces";
        $cons = mysql_query($sql);
        while ($row = mysql_fetch_assoc($cons)) {
            if ($row2['cod_piece']==$row['cod_piece']) {
                print("<option value='".$row[cod_piece]."' selected='selected'>$row[description]</option>");
            } else {
                print("<option value='".$row[cod_piece]."'>$row[description]</option>");                        
            }
        }
        echo "</select> Code: <input id=\"cod_piece1\" type=\"number\" name=\"cod_piece1\" Style=\"width:60Px\" value=\"$row2[cod_piece]\" disabled=\"disabled\"/></td>";
        $sql3 = "SELECT * FROM pieces WHERE cod_piece=$row2[cod_piece]";
        $cons3 = mysql_query($sql3);
        while ($row3 = mysql_fetch_assoc($cons3)) {
            echo "<td>";
            if (isset($row3['plans']) and $row3['plans']!=""){
                echo "<a href=\"plans/$row3[plans]\" style=\"text-decoration:none\"><input type=\"button\" value=\"Download plans\" class=\"button1\"></a>";
            } else {
                echo "No plans for this piece.";
            }
            echo "</td>";
            
        }
        echo "<td><textarea name=\"remarks1\" rows=\"1\" cols=\"50\" disabled=\"disabled\">$row2[remarks]</textarea></td>";
        /*echo "<td>editar</td><td>eliminar</td></tr>";
        echo "<td><button onclick=\"window.location.href='edit_orders.php?cod_ord=$row5[cod_ord]'\" class=\"button1\">Edit</button></td>";
        echo "<td><button onclick=\"seguroord($row5[cod_ord]);\" class=\"button1\">Delete</button></td>";*/
        echo "<td><a href='edit_p_o.php?cod_ord=$data&cod_piece=$row2[cod_piece]' style=\"text-decoration:none\"><input type='button' value='Edit' class='button1'/></a></td>";
        echo "<td><button onclick=\"seguroOrdPie('".$row2['cod_piece']."',".$data.");\" class='button1'>Delete</button></td></tr>";
    }
    echo "<tr>";
    echo "<form enctype='multipart/form-data' action='inc/add_order_pie_act.php?cod_ord=$data' method='post'>";
    echo "<td><input type=\"number\" name=\"cant0\" value=\"1\" Style=\"width:40Px\"/></td>";
    echo "<td><select name=\"piece0\" onchange=\"changePie(this,0)\" style=\"white-space:pre-wrap; width: 250px;\">
        <option selected=\"selected\"></option>";
                    
    $sql = "SELECT * FROM pieces WHERE cod_piece NOT IN (SELECT cod_piece FROM contain_o_p WHERE cod_ord=$data)";

    //$sql = "SELECT pieces.* FROM pieces LEFT JOIN contain_o_p ON contain_o_p.cod_piece!=pieces.cod_piece AND contain_o_p.cod_ord=$data";
    //$sql = "SELECT * FROM pieces";
    $cons = mysql_query($sql);
    while ($row = mysql_fetch_assoc($cons)) {
        //$con = mysql_query("SELECT * FROM contain_o_p WHERE cod_piece=$row[cod_piece] AND cod_ord=$data");
       // $cone = mysql_result($con,0,0);
        //while ($row6 = mysql_fetch_assoc($con)) {
            //if (!isset($cone)) {
                print("<option value='".$row[cod_piece]."'>$row[description]</option>");
           // }
        //}
        
    }
    echo "</select> Code: <input id=\"cod_piece0\" type=\"number\" name=\"cod_piece0\" Style=\"width:60Px\" value=\"\" disabled=\"disabled\"/></td>";
    echo "<td></td><td><textarea name=\"remarks0\" rows=\"1\" cols=\"50\"></textarea></td><td colspan=2><input type='submit' name='save' value='Save' class='button1'/></td>";
    echo "</form></tr></table></td></tr>";
}
echo "</table><br/>";

//header("Refresh:0");
mysql_close($dp);
?>
<br/>
<!--<a href="manage_conce.php"><input type="button" value="Atrás"></a>-->
</div>
<a href="#" class="go-top" id="go-top">Go up</a>
</body>
</html>