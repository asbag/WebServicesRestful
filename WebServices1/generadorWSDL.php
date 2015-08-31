<?php
require_once('GeneradorWSDL/class.phpwsdl.php'); //incluimos el archivo del paquete que utilizaremos para generar el wsdl
 
PhpWsdl::RunQuickMode("Operaciones.php"); //referenciamos el archivo (clase) a partir del cual crearemos el wsdl, registrando en él las operaciones, tipos de datos, etc
?>