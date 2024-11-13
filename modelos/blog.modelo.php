<?php

require_once "conexion.php";

Class ModeloBlog{

      /*=============================================
    MOSTRAR CONTENIDO TABLA BLOG
    =============================================*/
    static public function mdlMostrarBlog($tabla){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
        $stmt -> execute();
        return $stmt -> fetch();

        $stmt -> close();
        $stmt = null;

    }

        /*=============================================
    MOSTRAR CONTENIDO TABLA CATEGORIAS
    =============================================*/
    static public function mdlMostrarCategorias($tabla){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
        $stmt -> execute();
        return $stmt -> fetchAll();

        $stmt -> close();
        $stmt = null;

    }

    static public function mdlMostrarConInnerJoin($tabla1, $tabla2){

        $stmt = Conexion::conectar()->prepare("SELECT  $tabla1.*, $tabla2.*, DATE_FORMAT(fecha_articulo, '%d.%m.%Y') AS
         fecha_articulo FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.id_categoria = $tabla2.id_cat ORDER BY $tabla2.id_articulo DESC LiMIT 5");
      

        $stmt -> execute();
        return $stmt -> fetchAll();

        $stmt -> close();
        $stmt = null;
    }
}   