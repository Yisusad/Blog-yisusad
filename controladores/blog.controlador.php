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

    static public function ctrMostrarConInnerJoin($cantidad){

        $tabla1 = "categorias";
        $tabla2 = "articulos";

        $respuesta = ModeloBlog::mdlMostrarConInnerJoin($tabla1, $tabla2, $cantidad);

        return $respuesta;
    }

}    