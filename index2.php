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
            <li><a class="active" href="index2.php">Manage</a></li>
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
    <li class="about"><a href="about.php">About</a></li>
</ul>
</div>
</header>
<div class="cuerpo">
<h1><u><i>Manage orders</i></u> | <a href='inc/backup.php' style="text-decoration:none"><input type='button' value='Create DB backup'></a></h1>
<?php
$dp = mysql_connect("localhost", "", "" );
mysql_select_db("orders", $dp);
session_start();
//$user = $_SESSION["usuario"];
if(!isset($_SESSION["usuario"])){
//if(!isset($_SESSION["usuario"]) || $user ==""){
    header("location:index.html");
}
//echo "$user";
?>

<!--<style type="text/css">
    table { border: 1px solid black; border-collapse: collapse }
    td { border: 1px solid black }
</style>-->

<form enctype="multipart/form-data" action="" method="post">
    <input type="checkbox" name="buscar[]" value="cod_ord"><label>Order code:</label> <input type="number" name="cod_ord"/><br><br>

    <input type="checkbox" name="buscar[]" value="order_date"><label>Order date:</label> <input type="date" name="order_date" value="<?php echo date('Y-m-d'); ?>"/><br><br>
    
    <input type="checkbox" name="buscar[]" value="deliver_date"><label>Deliver date:</label> <input type="date" name="deliver_date" value="<?php echo date('Y-m-d'); ?>"/><br><br>

    <input type="checkbox" name="buscar[]" value="cod_cli"><label>Client:</label> 
    <select name="cli1" style="white-space:pre-wrap; width: 100px;" >
        <option selected="selected"></option>
        <?php
        $sql = "SELECT clients.name AS name,orders.cod_cli AS cod_cli FROM clients,orders WHERE clients.cod_cli = orders.cod_cli GROUP BY orders.cod_cli";
        $clis = mysql_query($sql);
        while ($row = mysql_fetch_assoc($clis)) {
            print("<option value='".$row[cod_cli]."'>$row[name]</option>");
        }
        ?>
        <!--<?php
        /*$sql = "SELECT * FROM clientes";
        $clis = mysql_query($sql);
        while ($row = mysql_fetch_assoc($clis)) {
            print("<option value='".$row[direccion]."|".$row[cif]."'>$row[direccion]</option>");
        }*/
        ?>-->
    </select><br><br>

    <input type="checkbox" name="buscar[]" value="cod_man"><label>Manager:</label> 
    <select name="cod_man" style="white-space:pre-wrap; width: 100px;" >
        <option selected="selected"></option>
        <?php
        $sql = "SELECT managers.name AS name,orders.cod_man AS cod_man FROM managers,orders WHERE managers.cod_man = orders.cod_man GROUP BY orders.cod_man";
        $mans = mysql_query($sql);
        while ($row = mysql_fetch_assoc($mans)) {
            print("<option value='".$row[cod_man]."'>$row[name]</option>");
        }
        ?>
        <!--<?php
        /*$sql = "SELECT * FROM clientes";
        $clis = mysql_query($sql);
        while ($row = mysql_fetch_assoc($clis)) {
            print("<option value='".$row[direccion]."|".$row[cif]."'>$row[direccion]</option>");
        }*/
        ?>-->
    </select><br><br>

    <input type="checkbox" name="buscar[]" value="delivered"><label>Delivered:</label> 
    <select name="delivered" style="white-space:pre-wrap; width: 60px;">
        <option value='0' selected="selected">NO</option>
        <option value='1'>YES</option>
    </select><br><br>

    <input type="checkbox" name="buscar[]" value="cod_piece"><label>Piece:</label> 
    <select name="cod_piece" onchange="changePie(this,1)" style="white-space:pre-wrap; width: 250px;">
        <option selected="selected"></option>
        <?php
        $sql = "SELECT pieces.cod_piece AS cod_piece, pieces.description AS description FROM pieces,contain_o_p WHERE pieces.cod_piece = contain_o_p.cod_piece GROUP BY contain_o_p.cod_piece";
        $cons = mysql_query($sql);
        while ($row = mysql_fetch_assoc($cons)) {
            print("<option value='".$row[cod_piece]."'>$row[description]</option>");
        }
        ?>
    </select> Code: <input id="cod_piece1" type="number" name="cod_piece1" Style="width:60Px" value="" disabled="TRUE"/>
    <br><br>
    <input type="submit" name="search" value="Search"/>
</form>



<!--<form enctype="multipart/form-data" action="" method="post">
    Add data: <br/>
    <textarea name="data" rows="3" cols="50" placeholder="Order code, Description or Price... (Do not add anything to show all)"></textarea><br/><br/>
    Order by: 
    <select name="orden">
        <option value="cod_piece" selected>Piece code</option>
        <option value="description">Description</option>
        <option value="price">Price</option>
    </select>
    <input type="submit" name="search" value="Search"/>
</form>-->
<?php 
if(isset($_POST['search'])){

    $sele = "";

    function IsChecked($chkname,$value){
        if(!empty($_POST[$chkname])){
            foreach($_POST[$chkname] as $chkval){
                if($chkval == $value){
                    return true;
                }
            }
        }
        return false;
    }

    if (IsChecked('buscar','order_date')){
        $order_date = $_POST['order_date'];
        if($sele == ""){
            $sele = "SELECT orders.cod_ord as cod_ord,orders.cod_cli as cod_cli, orders.cod_man as cod_man, orders.order_date as order_date, orders.deliver_date as deliver_date, orders.delivered as delivered, orders.remarks as remarks, orders.discount as discount, contain_o_p.quantity as quantity, contain_o_p.cod_piece as cod_piece, contain_o_p.remarks as premarks FROM orders LEFT JOIN contain_o_p ON orders.cod_ord=contain_o_p.cod_ord AND orders.order_date='$order_date'";
        } else {
            $sele = $sele." AND orders.order_date='$order_date'";
        }
    }

    if (IsChecked('buscar','deliver_date')){
        $deliver_date = $_POST['deliver_date'];
        if($sele == ""){
            $sele = "SELECT orders.cod_ord as cod_ord,orders.cod_cli as cod_cli, orders.cod_man as cod_man, orders.order_date as order_date, orders.deliver_date as deliver_date, orders.delivered as delivered, orders.remarks as remarks, orders.discount as discount, contain_o_p.quantity as quantity, contain_o_p.cod_piece as cod_piece, contain_o_p.remarks as premarks FROM orders LEFT JOIN contain_o_p ON orders.cod_ord=contain_o_p.cod_ord AND orders.deliver_date='$deliver_date'";
        } else {
            $sele = $sele." AND orders.deliver_date='$deliver_date'";
        }
    }

    if (IsChecked('buscar','cod_ord')){
        $cod_ord = $_POST['cod_ord'];
        if($sele == ""){
            $sele = "SELECT orders.cod_ord as cod_ord,orders.cod_cli as cod_cli, orders.cod_man as cod_man, orders.order_date as order_date, orders.deliver_date as deliver_date, orders.delivered as delivered, orders.remarks as remarks, orders.discount as discount, contain_o_p.quantity as quantity, contain_o_p.cod_piece as cod_piece, contain_o_p.remarks as premarks FROM orders LEFT JOIN contain_o_p ON orders.cod_ord=contain_o_p.cod_ord AND orders.cod_ord='$cod_ord'";
        } else {
            $sele = $sele." AND orders.cod_ord='$cod_ord'";
        }
    }

    if (IsChecked('buscar','cod_cli')){
        $cod_cli = $_POST['cod_cli'];
        if($sele == ""){
            $sele = "SELECT orders.cod_ord as cod_ord,orders.cod_cli as cod_cli, orders.cod_man as cod_man, orders.order_date as order_date, orders.deliver_date as deliver_date, orders.delivered as delivered, orders.remarks as remarks, orders.discount as discount, contain_o_p.quantity as quantity, contain_o_p.cod_piece as cod_piece, contain_o_p.remarks as premarks FROM orders LEFT JOIN contain_o_p ON orders.cod_ord=contain_o_p.cod_ord AND orders.cod_cli='$cod_cli'";
        } else {
            $sele = $sele." AND orders.cod_cli='$cod_cli'";
        }
    }

    if (IsChecked('buscar','cod_man')){
        $cod_man = $_POST['cod_man'];
        if($sele == ""){
            $sele = "SELECT orders.cod_ord as cod_ord,orders.cod_cli as cod_cli, orders.cod_man as cod_man, orders.order_date as order_date, orders.deliver_date as deliver_date, orders.delivered as delivered, orders.remarks as remarks, orders.discount as discount, contain_o_p.quantity as quantity, contain_o_p.cod_piece as cod_piece, contain_o_p.remarks as premarks FROM orders LEFT JOIN contain_o_p ON orders.cod_ord=contain_o_p.cod_ord AND orders.cod_man='$cod_man'";
        } else {
            $sele = $sele." AND orders.cod_man='$cod_man'";
        }
    }

    if (IsChecked('buscar','delivered')){
        $delivered = $_POST['delivered'];
        if($sele == ""){
            $sele = "SELECT orders.cod_ord as cod_ord,orders.cod_cli as cod_cli, orders.cod_man as cod_man, orders.order_date as order_date, orders.deliver_date as deliver_date, orders.delivered as delivered, orders.remarks as remarks, orders.discount as discount, contain_o_p.quantity as quantity, contain_o_p.cod_piece as cod_piece, contain_o_p.remarks as premarks FROM orders LEFT JOIN contain_o_p ON orders.cod_ord=contain_o_p.cod_ord AND orders.delivered='$delivered'";
        } else {
            $sele = $sele." AND orders.delivered='$delivered'";
        }
    }

    if (IsChecked('buscar','cod_piece')){
        $cod_piece = $_POST['cod_piece'];
        if($sele == ""){
            $sele = "SELECT orders.cod_ord as cod_ord,orders.cod_cli as cod_cli, orders.cod_man as cod_man, orders.order_date as order_date, orders.deliver_date as deliver_date, orders.delivered as delivered, orders.remarks as remarks, orders.discount as discount, contain_o_p.quantity as quantity, contain_o_p.cod_piece as cod_piece, contain_o_p.remarks as premarks FROM orders LEFT JOIN contain_o_p ON orders.cod_ord=contain_o_p.cod_ord AND contain_o_p.cod_piece='$cod_piece'";
        } else {
            $sele = $sele." AND contain_o_p.cod_piece='$cod_piece'";
        }
    }

    if (!IsChecked('buscar','order_date') && !IsChecked('buscar','deliver_date') && !IsChecked('buscar','cod_ord') && !IsChecked('buscar','cod_cli') && !IsChecked('buscar','cod_man') && !IsChecked('buscar','delivered') && !IsChecked('buscar','cod_piece')) {
        $sele = "SELECT orders.cod_ord as cod_ord,orders.cod_cli as cod_cli, orders.cod_man as cod_man, orders.order_date as order_date, orders.deliver_date as deliver_date, orders.delivered as delivered, orders.remarks as remarks, orders.discount as discount, contain_o_p.quantity as quantity, contain_o_p.cod_piece as cod_piece, contain_o_p.remarks as premarks FROM orders LEFT JOIN contain_o_p ON orders.cod_ord=contain_o_p.cod_ord";
        echo "CAUTION! You might forgot to check the checkboxes.<br/><br/>";
    }
    $sele = $sele." GROUP BY orders.cod_ord ORDER BY orders.cod_ord";
    //echo $sele;
    $selec = mysql_query($sele);
    $selec2 = mysql_query($sele);
    $selec3 = mysql_query($sele);

    /*
        if (IsChecked('buscar','order_date')){
            $order_date = $_POST['order_date'];
            if($sele == ""){
                $sele = "SELECT orders.cod_ord as cod_ord,orders.cod_cli as cod_cli, orders.cod_man as cod_man, orders.order_date as order_date, orders.deliver_date as deliver_date, orders.delivered as delivered, orders.remarks as remarks, orders.discount as discount, contain_o_p.quantity as quantity, contain_o_p.cod_piece as cod_piece, contain_o_p.remarks as premarks FROM orders, contain_o_p WHERE orders.cod_ord=contain_o_p.cod_ord AND orders.order_date='$order_date'";
            } else {
                $sele = $sele." AND orders.order_date='$order_date'";
            }
        }

        if (IsChecked('buscar','deliver_date')){
            $deliver_date = $_POST['deliver_date'];
            if($sele == ""){
                $sele = "SELECT orders.cod_ord as cod_ord,orders.cod_cli as cod_cli, orders.cod_man as cod_man, orders.order_date as order_date, orders.deliver_date as deliver_date, orders.delivered as delivered, orders.remarks as remarks, orders.discount as discount, contain_o_p.quantity as quantity, contain_o_p.cod_piece as cod_piece, contain_o_p.remarks as premarks FROM orders, contain_o_p WHERE orders.cod_ord=contain_o_p.cod_ord AND orders.deliver_date='$deliver_date'";
            } else {
                $sele = $sele." AND orders.deliver_date='$deliver_date'";
            }
        }

        if (IsChecked('buscar','cod_ord')){
            $cod_ord = $_POST['cod_ord'];
            if($sele == ""){
                $sele = "SELECT orders.cod_ord as cod_ord,orders.cod_cli as cod_cli, orders.cod_man as cod_man, orders.order_date as order_date, orders.deliver_date as deliver_date, orders.delivered as delivered, orders.remarks as remarks, orders.discount as discount, contain_o_p.quantity as quantity, contain_o_p.cod_piece as cod_piece, contain_o_p.remarks as premarks FROM orders, contain_o_p WHERE orders.cod_ord=contain_o_p.cod_ord AND orders.cod_ord='$cod_ord'";
            } else {
                $sele = $sele." AND orders.cod_ord='$cod_ord'";
            }
        }

        if (IsChecked('buscar','cod_cli')){
            $cod_cli = $_POST['cod_cli'];
            if($sele == ""){
                $sele = "SELECT orders.cod_ord as cod_ord,orders.cod_cli as cod_cli, orders.cod_man as cod_man, orders.order_date as order_date, orders.deliver_date as deliver_date, orders.delivered as delivered, orders.remarks as remarks, orders.discount as discount, contain_o_p.quantity as quantity, contain_o_p.cod_piece as cod_piece, contain_o_p.remarks as premarks FROM orders, contain_o_p WHERE orders.cod_ord=contain_o_p.cod_ord AND orders.cod_cli='$cod_cli'";
            } else {
                $sele = $sele." AND orders.cod_cli='$cod_cli'";
            }
        }

        if (IsChecked('buscar','cod_man')){
            $cod_man = $_POST['cod_man'];
            if($sele == ""){
                $sele = "SELECT orders.cod_ord as cod_ord,orders.cod_cli as cod_cli, orders.cod_man as cod_man, orders.order_date as order_date, orders.deliver_date as deliver_date, orders.delivered as delivered, orders.remarks as remarks, orders.discount as discount, contain_o_p.quantity as quantity, contain_o_p.cod_piece as cod_piece, contain_o_p.remarks as premarks FROM orders, contain_o_p WHERE orders.cod_ord=contain_o_p.cod_ord AND orders.cod_man='$cod_man'";
            } else {
                $sele = $sele." AND orders.cod_man='$cod_man'";
            }
        }

        if (IsChecked('buscar','delivered')){
            $delivered = $_POST['delivered'];
            if($sele == ""){
                $sele = "SELECT orders.cod_ord as cod_ord,orders.cod_cli as cod_cli, orders.cod_man as cod_man, orders.order_date as order_date, orders.deliver_date as deliver_date, orders.delivered as delivered, orders.remarks as remarks, orders.discount as discount, contain_o_p.quantity as quantity, contain_o_p.cod_piece as cod_piece, contain_o_p.remarks as premarks FROM orders, contain_o_p WHERE orders.cod_ord=contain_o_p.cod_ord AND orders.delivered='$delivered'";
            } else {
                $sele = $sele." AND orders.delivered='$delivered'";
            }
        }

        if (IsChecked('buscar','cod_piece')){
            $cod_piece = $_POST['cod_piece'];
            if($sele == ""){
                $sele = "SELECT orders.cod_ord as cod_ord,orders.cod_cli as cod_cli, orders.cod_man as cod_man, orders.order_date as order_date, orders.deliver_date as deliver_date, orders.delivered as delivered, orders.remarks as remarks, orders.discount as discount, contain_o_p.quantity as quantity, contain_o_p.cod_piece as cod_piece, contain_o_p.remarks as premarks FROM orders, contain_o_p WHERE orders.cod_ord=contain_o_p.cod_ord AND contain_o_p.cod_piece='$cod_piece'";
            } else {
                $sele = $sele." AND contain_o_p.cod_piece='$cod_piece'";
            }
        }

        if (!IsChecked('buscar','order_date') && !IsChecked('buscar','deliver_date') && !IsChecked('buscar','cod_ord') && !IsChecked('buscar','cod_cli') && !IsChecked('buscar','cod_man') && !IsChecked('buscar','delivered') && !IsChecked('buscar','cod_piece')) {
            $sele = "SELECT orders.cod_ord as cod_ord,orders.cod_cli as cod_cli, orders.cod_man as cod_man, orders.order_date as order_date, orders.deliver_date as deliver_date, orders.delivered as delivered, orders.remarks as remarks, orders.discount as discount, contain_o_p.quantity as quantity, contain_o_p.cod_piece as cod_piece, contain_o_p.remarks as premarks FROM orders, contain_o_p WHERE orders.cod_ord=contain_o_p.cod_ord";
            echo "CAUTION! You might forgot to check the checkboxes.<br/><br/>";
        }
        $sele = $sele." GROUP BY orders.cod_ord ORDER BY orders.cod_ord";
        //echo $sele;
        $selec = mysql_query($sele);
        $selec2 = mysql_query($sele);
        $selec3 = mysql_query($sele);
    */

    if (mysql_num_rows($selec2) == 0){
        echo "<br/>ERROR! No orders with that specifications.";
    }else{

        //$selec = mysql_query($selec);

        //$selec = mysql_query($selec);
        $zenbat = 0;
        while ($row2 = mysql_fetch_assoc($selec3)) {
            $zenbat = $zenbat+1;
        };
        echo "$zenbat orders in total.";
        $num_fila = 0; 
        echo "<br/><br/><table border=1>";
        
        while ($row5 = mysql_fetch_assoc($selec)) {
            echo "<tr bgcolor=\"#c1bda8\" align=center><th>Order code</th><th>Client</th><th>Manager</th><th>Order date</th><th>Deliver date</th><th>Delivered</th><th>Remarks</th><th>Price</th><th>Discount</th><th>Final price</th><th colspan=2>Actions</th></tr>";
            echo "<tr "; 
            if ($num_fila%2==0) 
                echo "bgcolor=#dddddd"; //si el resto de la división es 0 pongo un color 
            else 
                echo "bgcolor=#ddddff"; //si el resto de la división NO es 0 pongo otro color 
            echo ">";
            echo "<td rowspan=2>$row5[cod_ord]</td>";
            echo "<td>";
            $sql3 = "SELECT * FROM clients WHERE cod_cli=$row5[cod_cli]";
            $cons3 = mysql_query($sql3);
            while ($row3 = mysql_fetch_assoc($cons3)) {
                echo "$row3[name]<br/>$row5[cod_cli]";
            }
                        
            echo "</td>";
            echo "<td>";
            $sql4 = "SELECT * FROM managers WHERE cod_man=$row5[cod_man]";
            $cons4 = mysql_query($sql4);
            while ($row4 = mysql_fetch_assoc($cons4)) {
                echo "$row4[name]<br/>$row5[cod_man]";
            }
            echo "</td>";
            echo "<td>$row5[order_date]</td>";
            echo "<td>";
            if ($row5['deliver_date']==NULL) {
                echo "This order does not have any delivering day.";
            } else {
                echo "$row5[deliver_date]";
            }
            echo "</td>";
            echo "<td>";
            if ($row5['delivered']=='0') {
                echo "NO.";
            } else {
                echo "YES.";
            }
            echo "</td>";
            echo "<td>$row5[remarks]</td>";
            
            $sql0 = "SELECT contain_o_p.quantity AS quantity, pieces.price AS price FROM contain_o_p INNER JOIN pieces ON contain_o_p.cod_ord=$row5[cod_ord] AND contain_o_p.cod_piece=pieces.cod_piece";
            $cons0 = mysql_query($sql0);
            $price = 0;
            while ($row0 = mysql_fetch_assoc($cons0)) {
                $price = $price + ($row0['price'] * $row0['quantity']);
                
                /*$sql00 = "SELECT * FROM pieces WHERE cod_piece=$row0[cod_piece]";
                $cons00 = mysql_query($sql00);
                while ($row00 = mysql_fetch_assoc($cons00)) {

                }*/
            }
            $pricef = $price - ($price * ($row5['discount'] / 100));
            echo "<td>$price ¥</td>";
            echo "<td>$row5[discount] %</td>";
            echo "<td>$pricef ¥</td>";
            
            echo "<td rowspan=2><button onclick=\"window.location.href='edit_orders.php?cod_ord=$row5[cod_ord]'\" class=\"button1\">Edit</button></td>";
            echo "<td rowspan=2><button onclick=\"seguroord($row5[cod_ord]);\" class=\"button1\">Delete</button></td>";
            echo "</tr>";
            echo "<tr><td colspan='9'>";
            echo "<table border=1 width='100%' ";
            if ($num_fila%2==0) 
                echo "bgcolor=#dddddd"; //si el resto de la división es 0 pongo un color 
            else 
                echo "bgcolor=#ddddff"; //si el resto de la división NO es 0 pongo otro color 

            echo ">
            <tr bgcolor=#d0cdbe><th colspan='7'>Pieces</th></tr>
            <tr bgcolor=#d0cdbe><th>Quantity</th><th>Piece code</th><th>Piece description</th><th>Plans</th><th>Remarks</th><th>Unit price</th><th>Total price</th></tr>";
            $sql2 = "SELECT * FROM contain_o_p WHERE cod_ord=$row5[cod_ord]";
            $cons2 = mysql_query($sql2);
            while ($row2 = mysql_fetch_assoc($cons2)) {
            echo "<tr>
                <td>$row2[quantity]</td>
                <td>$row2[cod_piece]</td>";
                $sql3 = "SELECT * FROM pieces WHERE cod_piece=$row2[cod_piece]";
                $cons3 = mysql_query($sql3);
                while ($row3 = mysql_fetch_assoc($cons3)) {
                    echo "<td>$row3[description]</td>";
                    echo "<td>";
                    if (isset($row3['plans']) and $row3['plans']!=""){
                        echo "<a href=\"plans/$row3[plans]\" style=\"text-decoration:none\"><input type=\"button\" value=\"Download plans\" class=\"button1\"></a>";
                    } else {
                        echo "No plans for this piece.";
                    }
                    echo "</td>";
                    echo "<td>$row2[remarks]</td>";
                    echo "<td>$row3[price] ¥</td>";
                    $totalp = $row3['price'] * $row2['quantity'];
                    echo "<td>$totalp ¥</td>";
                }
                echo "</tr>";                
            }
            echo "</table>
            </td></tr>";
            $num_fila++;
        }
        echo "</table><br/>";

        echo "Is it not here? <a href='add_orders.php' style=\"text-decoration:none\"><input type='button' value='Add'></a>";
    }

    mysql_close($dp);
}
?>
</div>
<a href="#" class="go-top" id="go-top">Go up</a>
</body>
</html>