<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];

if ($method == "OPTIONS") {
    die();
}
//TODO: controlador de PRODUCTOS
require_once('../models/productos.model.php');
//error_reporting(0);
$productos = new Productos;

switch ($_GET["op"]) {
        //TODO: operaciones de productos

    case 'todos': //TODO: Procedimiento para cargar todos los datos del producto
        $datos = array(); // Defino un arreglo para almacenar los valores que vienen de la clase productos.model.php
        $datos = $productos->todos(); // Llamo al metodo todos de la clase productos.model.php
        $todos = null;
        while ($row = mysqli_fetch_assoc($datos)) //Ciclo de repeticon para asociar los valor almancenados en la variable $datos
        {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;
    case 'uno': //TODO: procedimiento para obtener un registro de la base de datos
        $idProductos = $_POST["idProductos"];
        $datos = array();
        $datos = $productos->uno($idProductos);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
        
    case 'insertar':  //TODO: Procedimiento para insertar un producto en la base de datos
        $Codigo_Barras = $_POST["Codigo_Barras"];
        $Nombre_Producto = $_POST["Nombre_Producto"];
        $Graba_IVA = $_POST["Graba_IVA"];
        $datos = array();
        $datos = $productos->insertar($Codigo_Barras, $Nombre_Producto, $Graba_IVA);
        echo json_encode($datos);
        break;
        
    case 'actualizar':  //TODO: Procedimiento para actualizar un productos en la base de datos
        $idProductos = $_POST["idProductos"];
        $Codigo_Barras = $_POST["Codigo_Barras"];
        $Nombre_Producto = $_POST["Nombre_Producto"];
        $Graba_IVA = $_POST["Graba_IVA"];
        $datos = array();
        $datos = $productos->actualizar($idProductos, $Codigo_Barras, $Nombre_Producto, $Graba_IVA);
        echo json_encode($datos);
        break;
        //TODO: Procedimiento para eliminar un productos en la base de datos
    case 'eliminar':
        $idProductos = $_POST["idProductos"];
        $datos = array();
        $datos = $productos->eliminar($idProductos);
        echo json_encode($datos);
        break;
}