<?php
// Conf de la configuracion de la base de datos
$_nombreServer = "localhost"; // Servidor de la base de datos
$_nombreUsuario = "root"; // Usuario de la base
$_contraseña = ""; // Constraseña de la base
$_dbNombre = "cvc_datos"; // Nombre de la base

// Crear la conexion
$_conexionDB = new mysqli($_nombreServer, $_nombreUsuario, $_contraseña, $_dbNombre);

// Verificar la conexion
if ($_conexionDB->connect_error) {
    die("Error de conexion: " . $_conexionDB->connect_error);
}

// Establecemos charset (caracteres españoles)
$_conexionDB->set_charset("utf8");
