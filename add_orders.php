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
            <li><a class="active" href="add_orders.php">Add</a></li>
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
    <h1><u><i>New orders</i></u></h1>
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
            var io = document.createTextNode(' Piece: ');

            var io1 = document.createElement('select');
            //io1.id = 'mySelect';
            //io1.setAttribute('id', 'show'+nu);
            io1.setAttribute('name', 'piece'+nu);
            io1.setAttribute('style', 'white-space:pre-wrap; width: 250px;');
            io1.setAttribute('onchange', 'changePie(this,'+nu+')');

            var no = document.createElement('option');
            no.value = '';
            no.text = '';
            no.setAttribute('selected', 'selected');
            io1.appendChild(no);";

            $sql = 'SELECT * FROM pieces';
            $cons = mysql_query($sql);
            while ($row = mysql_fetch_assoc($cons)) {
                echo "var abc = document.createElement('option');";
                echo "abc.value = '$row[cod_piece]';";
                echo "abc.text = '$row[description]';";
                echo "io1.appendChild(abc);";
            }

            
            echo "
            //Create array of options to be added
            //var array = ['YES','NO'];
            //Create and append the options
            /*for (var i = 0; i < array.length; i++) {
                var option = document.createElement('option');
                option.value = array[i];
                option.text = array[i];
                if (array[i] == 'NO') {
                    option.setAttribute('selected', 'selected');
                }
                io1.appendChild(option);
            }*/

            var io2 = document.createTextNode(' Code: ');

            var io3 = document.createElement('INPUT');
            io3.setAttribute('type', 'number');
            io3.setAttribute('id', 'cod_piece'+nu);
            io3.setAttribute('name', 'cod_piece'+nu);
            io3.setAttribute('value', '');
            io3.setAttribute('disabled', 'TRUE');
            io3.setAttribute('style', 'width:60Px');

            //---------------------------------------------

            var iq = document.createTextNode(' Quantity: ');

            var iq1 = document.createElement('INPUT');
            iq1.setAttribute('type', 'number');
            iq1.setAttribute('name', 'cant'+nu);
            iq1.setAttribute('value', '1');
            iq1.setAttribute('Style', 'width:40Px');

            //---------------------------------------------
            
            var it = document.createTextNode(' Remarks: ');

            var it1 = document.createElement('TEXTAREA');
            it1.setAttribute('name', 'remarks'+nu);
            it1.setAttribute('cols', '50');
            it1.setAttribute('rows', '1');

            //var hr = document.createElement('HR');
            

            /*var wrapper = document.getElementById('divWrapper');
            wrapper.appendChild(hr);
            wrapper.appendChild(ic);
            wrapper.appendChild(ic1);
            wrapper.appendChild(io);
            wrapper.appendChild(io1);
            wrapper.appendChild(io3);
            wrapper.appendChild(ip);
            wrapper.appendChild(ip3);
            wrapper.appendChild(ie);*/

            var tr = document.createElement('TR');
            var td1 = document.createElement('TD');
            var td2 = document.createElement('TD');
            var td3 = document.createElement('TD');
            td1.appendChild(io);
            td1.appendChild(io1);
            td1.appendChild(io2);
            td1.appendChild(io3);
            td2.appendChild(iq);
            td2.appendChild(iq1);
            td3.appendChild(it);
            td3.appendChild(it1);
            tr.appendChild(td1);
            tr.appendChild(td2);
            tr.appendChild(td3);
            var wrapper = document.getElementById('myTable');
            wrapper.appendChild(tr);

            nu = nu+1;
        }
    }</script>";
 
    ?>

    <style type="text/css">
        table { border: 1px solid black; border-collapse: collapse }
        td { border: 1px solid black }
    </style>


    <form enctype="multipart/form-data" action="" method="post">
        Order code: <input type="number" name="num" value="<?php 
            $orde = mysql_query('SELECT MAX(cod_ord) AS cod_ord FROM orders');
            $ordee = mysql_result($orde,0,0);
            $orden = $ordee+1; 
            echo $orden;
            ?>" required/><br><br>

        Client: 
        <select name="cli1" onchange="changeCli(this)" style="white-space:pre-wrap; width: 100px;" required>
            <option selected="selected"></option>
            <?php
            $sqlcli = "SELECT * FROM clients";
            $clis = mysql_query($sqlcli);
            while ($rowcli = mysql_fetch_assoc($clis)) {
                print("<option value='".$rowcli[cod_cli]."'>$rowcli[name]</option>");
            }
            ?>
        </select> Code: <input id="cod_cli" type="number" name="cod_cli" Style="width:60Px" value="" disabled="TRUE"/><br><br>

        Manager: 
        <select name="man1" onchange="changeMan(this)" style="white-space:pre-wrap; width: 100px;" required>
            <option selected="selected"></option>
            <?php
            $sqlman = "SELECT * FROM managers";
            $mans = mysql_query($sqlman);
            while ($rowman = mysql_fetch_assoc($mans)) {
                print("<option value='".$rowman[cod_man]."'>$rowman[name]</option>");
            }
            ?>
        </select> Code: <input id="cod_man" type="number" name="cod_man" Style="width:60Px" value="" disabled="TRUE"/><br><br>

        Order date: <input type="date" name="order_date" value="<?php echo date('Y-m-d'); ?>"/><br><br>

        Delivering day: <input type="date" name="deliver_date" value="<?php echo date('Y-m-d'); ?>"/><br><br>

        Delivered: 
        <select name="delivered" style="white-space:pre-wrap; width: 60px;">
            <option value='0' selected="selected">NO</option>
            <option value='1'>YES</option>
        </select><br><br>

        Remarks:<br/>
        <textarea name="remarks" rows="3" cols="60"></textarea><br/><br/>

        Discount: <input type="number" name="discount" step="any" Style="width:60Px" value=""/>%<br/><br/>

        Pieces: <button type="button" onclick="myFunction()">Add one more</button>
        <table id="myTable">
            <tr>
                <td><label>Piece:</label> 
                <select name="piece1" onchange="changePie(this,1)" style="white-space:pre-wrap; width: 250px;">
                    <option selected="selected"></option>
                    <?php
                    $sql = "SELECT * FROM pieces";
                    $cons = mysql_query($sql);
                    while ($row = mysql_fetch_assoc($cons)) {
                        print("<option value='".$row[cod_piece]."'>$row[description]</option>");
                    }
                    ?>
                </select> Code: <input id="cod_piece1" type="number" name="cod_piece1" Style="width:60Px" value="" disabled="TRUE"/></td>
                <td><label>Quantity:</label> <input type="number" name="cant1" value="1" Style="width:40Px"/> </td>
                <td><label>Remarks:</label> <textarea name="remarks1" rows="1" cols="50"></textarea></td>
            </tr>
        </table>
        <br>
        <input type="submit" name="save" value="Save"/>
    </form>
<?php
if(isset($_POST['save'])){

    $fecha = date_format(date_create_from_format('Y-m-d', $_POST['order_date']), 'd/m/Y');
    $insfecha = date("Y-m-d",strtotime($_POST['order_date']));
    if ($_POST['deliver_date']!="0") {
        $fechaen = date_format(date_create_from_format('Y-m-d', $_POST['deliver_date']), 'd/m/Y');
        $insfechaen = date("Y-m-d",strtotime($_POST['deliver_date']));
    } else {
        $insfechaen = "NULL";
    }
    $numero = $_POST['num'];
    $delivered = $_POST['delivered'];
    $cli1 = $_POST['cli1'];
    $man1 = $_POST['man1'];
    $remark = $_POST['remarks'];
    $remarks = trim(preg_replace('/\s\s+/', ' ', $remark));
    $discount = $_POST['discount'];

    $check = "SELECT * FROM orders WHERE cod_ord=$numero";
    $checked = mysql_query($check);
    if (mysql_num_rows($checked) != 0){
        echo "ERROR! This order already exists.";
        $num_fila = 0; 
        echo "<br/><br/><table border=1>";
        echo "<tr bgcolor=\"bbbbbb\" align=center>
        <th>Order code</th><th>Client</th><th>Manager</th><th>Order date</th><th>Deliver date</th><th>Delivered</th><th>Remarks</th><th>Price</th><th>Discount</th><th>Final price</th></tr>";
        while ($row5 = mysql_fetch_assoc($checked)) {
            echo "<tr "; 
            if ($num_fila%2==0) 
                echo "bgcolor=#dddddd"; //si el resto de la división es 0 pongo un color 
            else 
                echo "bgcolor=#ddddff"; //si el resto de la división NO es 0 pongo otro color 
            echo ">";
            echo "<td>$row5[cod_ord]</td>";
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
            echo "<td><button onclick=\"window.location.href='edit_orders.php?cod_ord=$row5[cod_ord]'\">Edit</button></td>";
            echo "</tr>";
            echo "<tr><td colspan='10'>
            <table border=1 width='100%'>
            <tr><th colspan='7'>Pieces</th></tr>
            <tr><th>Quantity</th><th>Piece code</th><th>Piece description</th><th>Plans</th><th>Remarks</th><th>Unit price</th><th>Total price</th></tr>";
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
                        echo "<a href=\"plans/$row3[plans]\" style=\"text-decoration:none\"><input type=\"button\" value=\"Download plans\"></a>";
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
    }else{
        /*$price = '0';
        for ($i=1; $i<=41; $i++){

            if (isset($_POST['cant'.$i])){

                $cant = $_POST['cant'.$i];
                $piec = $_POST['piece'.$i];

                $pric = "SELECT price FROM pieces WHERE cod_piece='$piec'";
                $pricep = mysql_query($pric);
                while ($row = mysql_fetch_assoc($pricep)) {
                    $price = $price + ($row['price'] * $cant);
                }
            }
            //$a++;
        }*/

        /*$pric = "SELECT SUM(price) FROM pieces WHERE cod_piece=(SELECT cod_piece FROM contain_o_p WHERE cod_ord=$numero)";
        $pricee = mysql_query($pric);
        $price = mysql_result($pricee,0,0);*/

        //$price = $priceee - ($priceee * ($discount / 100));


        $insertord = "INSERT INTO orders (cod_ord,cod_cli,cod_man,order_date,deliver_date,delivered,remarks,discount) VALUES ('$numero','$cli1','$man1','$insfecha','$insfechaen','$delivered','$remarks','$discount')";
        mysql_query($insertord);

        for ($e=1; $e<=41; $e++){

            if (isset($_POST['cant'.$e])){
                $remin = $_POST['remarks'.$e];
                $remarkin = trim(preg_replace('/\s\s+/', ' ', $remin));

                $canti = $_POST['cant'.$e];
                $piece = $_POST['piece'.$e];

                $insertpie = "INSERT INTO contain_o_p (cod_ord,cod_piece,quantity,remarks) VALUES ('$numero','$piece','$canti','$remarkin')";
                mysql_query($insertpie);
                $updatepie = "UPDATE pieces SET stock = stock - $canti WHERE cod_piece='$piece'";
                mysql_query($updatepie);
            }
            //$a++;
        }
        echo "Order saved correctly.";
        //header("Refresh:0;");
        //header("Location: index2.php");
    }

}

mysql_close($dp);
?>
</div>
<a href="#" class="go-top" id="go-top">Go up</a>
</body>
</html>