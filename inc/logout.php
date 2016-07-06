<?php
session_start();
session_unset();
//unset($_SESSION["usuario"]);
session_destroy();
header("location:../index.html");
?>