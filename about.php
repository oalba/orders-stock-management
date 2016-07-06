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
<?php
session_start();
//$user = $_SESSION["usuario"];
if(isset($_SESSION["usuario"])){
//if(!isset($_SESSION["usuario"]) || $user ==""){
    //header("location:index.html");

    echo "<li><a href=\"index2.php\">Orders</a>
        <ul>
            <li><a href=\"index2.php\">Manage</a></li>
            <li><a href=\"add_orders.php\">Add</a></li>
        </ul>
    </li>
    <li><a href=\"manage_pieces.php\">Pieces</a>
        <ul>
            <li><a href=\"manage_pieces.php\">Manage</a></li>
            <li><a href=\"add_pieces.php\">Add</a></li>
        </ul>
    </li>
    <li><a href=\"manage_materials.php\">Materials</a>
        <ul>
            <li><a href=\"manage_materials.php\">Manage</a></li>
            <li><a href=\"add_materials.php\">Add</a></li>
        </ul>
    </li>
    <li><a href=\"manage_clients.php\">Clients</a>
        <ul>
            <li><a href=\"manage_clients.php\">Manage</a></li>
            <li><a href=\"add_clients.php\">Add</a></li>
        </ul>
    </li>
    <li><a href=\"manage_managers.php\">Managers</a>
        <ul>
            <li><a href=\"manage_managers.php\">Manage</a></li>
            <li><a href=\"add_managers.php\">Add</a></li>
        </ul>
    </li>
    <!--<li><a href=\"manage_suppliers.php\">Suppliers</a>
        <ul>
            <li><a href=\"manage_suppliers.php\">Manage</a></li>
            <li><a href=\"add_suppliers.php\">Add</a></li>
        </ul>
    </li>-->
    <li class=\"log\"><a href=\"inc/logout.php\">Log out</a></li>";
} else {
    echo "<li class=\"log\"><a href=\"index.html\">Log in</a></li>";
}
?>
    <li class="about"><a class="active" href="about.php">About</a></li>
</ul>
</div>
</header>
<div class="aboutcuerpo">
    <h1 style="font-family: 'Comic Sans MS';"><b><u>About me</u></b></h1>
    <p style="font-family: 'Comic Sans MS';font-size:20;">
        This is the place where I write something interesting about me and all the readers get amazed with how interesting I am, and they search my contact for offering me a job, etc. etc. (I wish...)<br>
        To be honest, I don't know what I can tell you about me... What do you want to know?<br>
        <ul style="font-family: 'Comic Sans MS';font-size:20;">
            <li><b>Name:</b> Odei Alba.</li>
            <li><b>Age:</b> Depends on the moment when you are reading this.</li>
            <li><b>Address:</b> I'm not going to write my address here... Furthermore, it also depends o the moment when you are reading this...</li>
            <li><b>E-mail:</b> Well... Alright... I guess that if you ae reading this silliness, you earn the privilege to know my email. My email is: <a href="mailto:odeialba@yahoo.es?Subject=App%20from%20CSMC">odeialba@yahoo.es</a></li>
            <li><b>GitHub account:</b> "oalba" <a href="https://github.com/oalba">https://github.com/oalba</a>. Did you think that after all my work I wasn't going to boast about my job?</li>
            <li><b>Curriculum Vitae:</b> Ask me for it if you are interested in contracting me.</li>
        </ul>
    </p><br>

    <h1 style="font-family: 'Arial';"><u>About the app</u></h1>
    <p style="font-family: 'Arial';font-size:20;">
        Well, it's time to be serious.<br>
        This web application has been developed by Odei Alba, intending to install an administration platform in the CSMC.
        <br>
        Using this app, it will be able to manage all the materials, pieces, clients and orders.
    </p>

</div>
<div class="aboutcuerpo">
    <h1 style="font-family: 'Comic Sans MS';"><b><u>Sobre mí</u></b></h1>
    <p style="font-family: 'Comic Sans MS';font-size:20;">
        Este es el apartado en el que escribo algo interesante sobre mí y todos los lectores se quedan asombrados de lo interesante que soy, y buscan mi contacto para ofrecerme un trabajo, etc. etc. (Ojalá...)<br>
        Pues a decir verdad, no se que contaros sobre mí... ¿Qué queréis saber?<br>
        <ul style="font-family: 'Comic Sans MS';font-size:20;">
            <li><b>Nombre:</b> Odei Alba.</li>
            <li><b>Edad:</b> Depende del momento en el que estés leyendo esto.</li>
            <li><b>Dirección:</b> No voy a ponerte mi dirección aquí... Además, también depende del momento en el que estés leyendo esto...</li>
            <li><b>E-mail:</b> Bueno... Está bien... Supongo que si estás leyendo esta chorrada, te has ganado el saber mi email. Mi email es: <a href="mailto:odeialba@yahoo.es?Subject=Aplicación%20del%20CSMC">odeialba@yahoo.es</a></li>
            <li><b>Cuenta de GitHub:</b> "oalba" <a href="https://github.com/oalba">https://github.com/oalba</a>. ¿Acaso pensabais que después de todo el curro que me he pegado no iba a fardar de mi trabajo?</li>
            <li><b>Curriculum Vitae:</b> Pídemelo si estás interesado en contratarme.</li>
        </ul>
    </p><br>

    <h1 style="font-family: 'Arial';"><u>Sobre la aplicación</u></h1>
    <p style="font-family: 'Arial';font-size:20;">
        Bueno, es hora de ponerse serios.<br>
        Esta es una aplicación web creada por Odei Alba, con la intención de instalar una plataforma de administracion en el almacén de CSMC.
        <br>
        Con esta aplicación se podrán administrar los materiales, las piezas, los clientes y los pedidos.
    </p>

</div>
<a href="#" class="go-top" id="go-top">Go up</a>
</body>
</html>