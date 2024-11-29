<?php

Class ControladorBlog{

    /*=============================================
    MOSTRAR BLOG
    =============================================*/

    static public function ctrMostrarBlog(){

        $tabla = "blog";

        $respuesta = ModeloBlog::mdlMostrarBlog($tabla);

        return $respuesta;
    }

    /*=============================================
    MOSTRAR CATEGORIAS
    =============================================*/

    static public function ctrMostrarCategorias(){

        $tabla = "categorias";

        $respuesta = ModeloBlog::mdlMostrarCategorias($tabla);

        return $respuesta;
    }

        /*=============================================
    MOSTRAR ARTICULOS
    =============================================*/

    static public function ctrMostrarConInnerJoin($desde, $cantidad, $item, $valor){

        $tabla1 = "categorias";
        $tabla2 = "articulos";

        $respuesta = ModeloBlog::mdlMostrarConInnerJoin($tabla1, $tabla2, $desde, $cantidad, $item, $valor);

        return $respuesta;
    }

    /*=============================================
    MOSTRAR TOTAL ARTICULOS
    =============================================*/
    static public function ctrMostrarTotalArticulos($item, $valor){

        $tabla = "articulos";

        $respuesta = ModeloBlog::mdlMostrarTotalArticulos($tabla, $item, $valor);

        return $respuesta;
    } 

     /*=============================================
    MOSTRAR OPINIONES
    =============================================*/

    static public function ctrMostrarOpiniones($item, $valor){

        $tabla1 = "opiniones";
        $tabla2 = "administradores";

        $respuesta = ModeloBlog::mdlMostrarOpiniones($tabla1, $tabla2, $item, $valor);

        return $respuesta;
    }

     /*=============================================
    ENVIAR OPINIONE
    =============================================*/

    static public function ctrEnviarOpinion(){

        if (isset($_POST["nombre_opinion"])) {
            if(preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $_POST["nombre_opinion"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["correo_opinion"]) &&
			   preg_match('/^[=\\$\\;\\*\\"\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/',  $_POST["contenido_opinion"])){

                $tabla = "opiniones";

                $datos = array("id_art" => $_POST["id_art"],
                               "nombre_opinion" => $_POST["nombre_opinion"],
                               "correo_opinion" => $_POST["correo_opinion"],
                               "contenido_opinion" => $_POST["contenido_opinion"],
                               "foto_opinion" => "vistas/img/usuarios/default.png",
                               "fecha_opinion" => date("Y-m-d"),
                               "id_adm" => 1);

                $respuesta = ModeloBlog::mdlEnviarOpinion($tabla, $datos);
            
            }else{

                $respuesta = "error";

            }
                        
        }
    }
}    