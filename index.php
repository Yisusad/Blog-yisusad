<?php
/*=============================================
    CONTROLADOR PLANTILLA
=============================================*/
require_once "controladores/plantilla.controlador.php";
/*=============================================
    CONTROLADORES
=============================================*/
require_once "controladores/blog.controlador.php";
/*=============================================
    MODELOS
=============================================*/
require_once "modelos/blog.modelo.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrTraerPlantilla();