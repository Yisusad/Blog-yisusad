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
    ENVIAR OPINIONEs
    =============================================*/

    static public function ctrEnviarOpinion(){

        if (isset($_POST["nombre_opinion"])) {
            if(preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $_POST["nombre_opinion"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["correo_opinion"]) &&
			   preg_match('/^[=\\$\\;\\*\\"\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/',  $_POST["contenido_opinion"])){

                /*=============================================
                 validar foto
                =============================================*/

                if (isset($_FILES["fotoOpinion"]["tmp_name"]) && !empty($_FILES["fotoOpinion"]["tmp_name"])){

                    /*=============================================
                    capturar ancho y alto de la imagen y definir nuevos valores
                    =============================================*/

                    list($ancho, $alto) = getimagesize($_FILES["fotoOpinion"]["tmp_name"]);

                    $nuevoAncho = 128;
                    $nuevoAlto = 128;

                    /*=============================================
                    creamos el directorio donde guardaremos la imagen
                    =============================================*/

                    $directorio = "vistas/img/usuarios/";

                    if($_FILES["fotoOpinion"]["type"] == "image/jpeg"){

                        $aleatorio = mt_rand(100,9999);
                        $ruta = $directorio.$aleatorio.".jpg";
                        $origen = imagecreatefromjpeg($_FILES["fotoOpinion"]["tmp_name"]);
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                        imagejpeg($destino, $ruta);
                        
                    } elseif($_FILES["fotoOpinion"]["type"] == "image/png"){
                        
                        $aleatorio = mt_rand(100,9999);
                        $ruta = $directorio.$aleatorio.".png";
                        $origen = imagecreatefrompng($_FILES["fotoOpinion"]["tmp_name"]);
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                        imagealphablending($destino, false);
                        imagesavealpha($destino, true);
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                        imagepng($destino, $ruta);

                    }else{
                        return "error-formato";
                    }

                    
                } else {

                    $ruta = "vistas/img/usuarios/default.png";
                }    

                $tabla = "opiniones";

                $datos = array("id_art" => $_POST["id_art"],
                               "nombre_opinion" => $_POST["nombre_opinion"],
                               "correo_opinion" => $_POST["correo_opinion"],
                               "contenido_opinion" => $_POST["contenido_opinion"],
                               "foto_opinion" => $ruta,
                               "fecha_opinion" => date("Y-m-d"),
                               "id_adm" => 1);

                $respuesta = ModeloBlog::mdlEnviarOpinion($tabla, $datos);
            
            }else{

                $respuesta = "error";

            }
                        
        }
    }
}    