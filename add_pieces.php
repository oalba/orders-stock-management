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
            <li><a class="active" href="add_pieces.php">Add</a></li>
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
<?php
session_start();
//$user = $_SESSION["usuario"];
if(!isset($_SESSION["usuario"])){
//if(!isset($_SESSION["usuario"]) || $user ==""){
    header("location:index.html");
}

	$dp = mysql_connect("localhost", "", "" );
	mysql_select_db("orders", $dp);

    echo "
    <script type=\"text/javascript\">
    var nu = 2;
    function myFunction() {
        if (nu <= '40') {
            
            //var ic = document.createTextNode('Cantidad: ');

            var iq1 = document.createElement('INPUT');
            iq1.setAttribute('type', 'number');
            iq1.setAttribute('name', 'cant'+nu);
            iq1.setAttribute('value', '1');
            iq1.setAttribute('Style', 'width:40Px');

            //---------------------------------------------

            //var io = document.createTextNode(' Concepto: ');

            var io3 = document.createElement('select');
            //io3.id = 'mySelect';
            //io3.setAttribute('id', 'show'+nu);
            io3.setAttribute('name', 'material'+nu);
            io3.setAttribute('style', 'white-space:pre-wrap; width: 250px;');
            //io3.setAttribute('onchange', 'changeCon(this,'+nu+')');

            var no = document.createElement('option');
            no.value = '';
            no.text = '';
            no.setAttribute('selected', 'selected');
            io3.appendChild(no);";

            /*var yes = document.createElement('option');
            yes.value = '1';
            yes.text = 'Otro';
            io3.appendChild(yes);*/

            $sql1 = "SELECT * FROM materials";
            $cons1 = mysql_query($sql1);
            while ($row1 = mysql_fetch_assoc($cons1)) {
                echo "var abc = document.createElement('option');";
                echo "abc.value = '$row1[cod_mat]';";
                echo "abc.text = '$row1[description]';";
                echo "io3.appendChild(abc);";
            }

            
            echo "
            var ir2 = document.createElement('TEXTAREA');
            ir2.setAttribute('name', 'remarks'+nu);
            ir2.setAttribute('cols', '50');
            ir2.setAttribute('rows', '1');

            //---------------------------------------------
            
            var tr = document.createElement('TR');
            var td1 = document.createElement('TD');
            var td2 = document.createElement('TD');
            var td3 = document.createElement('TD');
            //td1.appendChild(ic);
            td1.appendChild(iq1);
            //td2.appendChild(io);
            td2.appendChild(io3);
            td3.appendChild(ir2);
            //td3.appendChild(ip);
            //td3.appendChild(ip3);
            //td3.appendChild(ie);
            tr.appendChild(td1);
            tr.appendChild(td2);
            tr.appendChild(td3);
            var wrapper = document.getElementById('myTable');
            wrapper.appendChild(tr);

            nu = nu+1;
        }
    }</script>";
    /*unset($orde);
    unset($orde2);
    unset($ordee);
    unset($orden);
    $orde = "SELECT MAX(cod_piece) AS cod_piece FROM pieces";
    $orde2 = mysql_query($orde);
    $ordee = mysql_result($orde2,0,0);
    $orden = $ordee+1;*/
?>
<div class="cuerpo">
    <h1><u><i>New pieces</i></u></h1>
Add pieces: <br/><br/>
<form enctype='multipart/form-data' action='' method='post'>
<table border=1>
    <tr><th>Piece code</th><th>Plans</th><th>Description</th><th>Price</th><th>Stock</th></tr>
        <tr>
        	<td>
            <!--<?php
                //echo "<input type=\"number\" name=\"cod_piece\" value=\"";
                /*$orde4 = mysql_query("SELECT MAX(cod_piece) AS cod_piece FROM pieces");
                while ($row4 = mysql_fetch_assoc($orde4)) {
                    $ordee = $row4['cod_piece'];
                    $orden = $ordee+1;
                    print("<input type='number' name='cod_piece' value='".$orden."' required />");
                }*/
                //echo $orden;
                //echo "\" required/>";
            ?>-->
            <input type="number" name="cod_piece" value="<?php
            $orde = mysql_query('SELECT MAX(cod_piece) AS cod_piece FROM pieces');
            $ordee = mysql_result($orde,0,0);
            $orden = $ordee+1; 
            echo $orden;
            ?>" required/>
            </td>
            <td><input size="20" type="file" name="plans"/></td>
            <td><textarea name='description' rows="1" cols="50"></textarea></td>
            <td><input type='number' name='price' step="any" Style="width:60Px"> ¥</td>
            <td><input type='number' name='stock' Style="width:60Px"></td>
            <!--<td><input type='submit' name='save' value='Save'/></td>-->
        </tr>
        <tr>
        <table border=1 id="myTable">
            <tr><th>Materials</th><th><button type="button" onclick="myFunction()">Add more</button></th></tr>
            <tr><th>Quantity</th><th>Material</th><th>Remarks</th></tr>
            <tr>
                <td><input type="number" name="cant1" value="1" Style="width:40Px"/></td>
                <td><select name="material1" style="white-space:pre-wrap; width: 250px;" required>
                <option selected="selected"></option>
                <!--<option value="0">Others</option>-->
                <?php
                    $sql3 = "SELECT * FROM materials";
                    $clis3 = mysql_query($sql3);
                    while ($row3 = mysql_fetch_assoc($clis3)) {
                        print("<option value='$row3[cod_mat]'>$row3[description]</option>");
                    }
                ?></select></td>
                <td><textarea name="remarks1" rows="1" cols="50"></textarea></td>
            </tr>
        </table>
        </tr><br/>
</table>
<input type='submit' name='save' value='Save'/>
</form>
<?php
if(isset($_POST['save'])){
	$cod_piece = $_POST['cod_piece'];
    $plans = $_FILES['plans'];
    $conce = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $conce = trim(preg_replace('/\s\s+/', ' ', $conce));

    //move_uploaded_file($_FILES['plans']['tmp_name'], 'plans/'.$_FILES['plans']['name']);
    //$plan = $_FILES['plans']['name'];

    if(!empty($_FILES['plans']['name'])){
        $temp = explode(".", $_FILES["plans"]["name"]);
        $newfilename = round(microtime(true)) . '.' . end($temp);
        move_uploaded_file($_FILES["plans"]["tmp_name"], "plans/" . $newfilename);
        $plan = $newfilename;
    } else {
        $plan = "";
    }

    

    $sql5 = "SELECT * FROM pieces WHERE cod_piece=$cod_piece";
    $cons5 = mysql_query($sql5);
    if (mysql_num_rows($cons5) == 0){
        //header_remove(); 

        $sartu="INSERT INTO pieces (cod_piece, plans, description, price, stock) VALUES ('$cod_piece', '$plan', '$conce', '$price', '$stock')";
        mysql_query($sartu);
        for ($i=1; $i<=41; $i++){
            if (isset($_POST['cant'.$i]) && isset($_POST['material'.$i])){
                $remarks = $_POST['remarks'.$i];
                $canti = $_POST['cant'.$i];
                $cod_mat = $_POST['material'.$i];
                $remarks = trim(preg_replace('/\s\s+/', ' ', $remarks));

                $insertcon = "INSERT INTO need_p_m (cod_piece,cod_mat,quantity,remarks) VALUES ('$cod_piece','$cod_mat','$canti','$remarks')";
                mysql_query($insertcon);
            }
        }
        echo "Piece added correctly.<br/>";
        //header("Refresh:0;");
        //header("Refresh:0; url=add_pieces.php");
        //header("Location: add_pieces.php");
    } else {
        echo "ERROR! This piece already exists.";
        $num_fila = 0; 
        echo "<table border=1>";
        echo "<tr bgcolor=\"bbbbbb\" align=center><th>Piece code</th><th>Plans</th><th>Description</th><th>Price</th><th>Stock</th><th>Actions</th></tr>";
        while ($row5 = mysql_fetch_assoc($cons5)) {
            echo "<tr "; 
            if ($num_fila%2==0) 
                echo "bgcolor=#dddddd"; //si el resto de la división es 0 pongo un color 
            else 
                echo "bgcolor=#ddddff"; //si el resto de la división NO es 0 pongo otro color 
            echo ">";
            echo "<td>$row5[cod_piece]</td>";
            echo "<td>";
            if (isset($row5['plans']) and $row5['plans']!=""){
                echo "<a href=\"plans/$row5[plans]\" style=\"text-decoration:none\"><input type=\"button\" value=\"Download plans\"></a>";
            } else {
                echo "No plans for this piece.";
            }
            echo "</td>";
            echo "<td>$row5[description]</td>";
            echo "<td>$row5[price] ¥</td>";
            echo "<td>$row5[stock]</td>";
            echo "<td><button onclick=\"window.location.href='edit_pieces.php?cod_piece=$row5[cod_piece]'\">Edit</button></td>";
            echo "</tr>";
            echo "<tr><td colspan=6>
            <table border=1 width='100%'>
            <tr><th width='100%' colspan=3>Materials</th></tr>
            <tr><th>Quantity</th><th>Material</th><th>Remarks</th></tr>";
            $sql2 = "SELECT * FROM need_p_m WHERE cod_piece=$cod_piece";
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