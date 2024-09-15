<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];

if ($method == "OPTIONS") {
    die();
}
//TODO: controlador de UNIDAD_MEDIDA
require_once('../models/unidadmedida.model.php');
//error_reporting(0);
$unidad_medida = new Unidad_Medida;

switch ($_GET["op"]) {
        //TODO: operaciones de unidad_medida

    case 'todos': //TODO: Procedimiento para cargar todos los datos de la unidad_medida
        $datos = array(); // Defino un arreglo para almacenar los valores que vienen de la clase unidad_medida.model.php
        $datos = $unidad_medida->todos(); // Llamo al metodo todos de la clase unidad_medida.model.php
        while ($row = mysqli_fetch_assoc($datos)) //Ciclo de repeticon para asociar los valor almancenados en la variable $datos
        {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;
    case 'uno': //TODO: procedimiento para obtener un registro de la base de datos
        $idUnidad_Medida = $_POST["idUnidad_Medida"];
        $datos = array();
        $datos = $unidad_medida->uno($idUnidad_Medida);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
        
    case 'insertar':  //TODO: Procedimiento para insertar una unidad_medida en la base de datos
        $Detalle = $_POST["Detalle"];
        $Tipo = $_POST["Tipo"];
        $datos = array();
        $datos = $unidad_medida->insertar($Detalle, $Tipo);
        echo json_encode($datos);
        break;
        
    case 'actualizar':  //TODO: Procedimiento para actualizar una unidad_medida en la base de datos
        $idUnidad_Medida = $_POST["idUnidad_Medida"];
        $Detalle = $_POST["Detalle"];
        $Tipo = $_POST["Tipo"];
        $datos = array();
        $datos = $unidad_medida->actualizar($idUnidad_Medida, $Detalle, $Tipo);
        echo json_encode($datos);
        break;
        //TODO: Procedimiento para eliminar un unidad_medida en la base de datos
    case 'eliminar':
        $idUnidad_Medida = $_POST["idUnidad_Medida"];
        $datos = array();
        $datos = $unidad_medida->eliminar($idUnidad_Medida);
        echo json_encode($datos);
        break;
}