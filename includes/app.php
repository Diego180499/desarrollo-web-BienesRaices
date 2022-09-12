<?php

require "funciones.php";
require "config/database.php";
//../includes/
require __DIR__."/../vendor/autoload.php";

//obtenemos la conexin
$db = conectar();

use Model\Vendedor;
use Model\Propiedad;

Propiedad::setDb($db);
Vendedor::setDB($db);