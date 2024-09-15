<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];

if ($method == "OPTIONS") {
    die();
}
//TODO: controlador de USUARIOS
require_once('../models/usuarios.model.php');
//error_reporting(0);
$usuarios = new Usuarios;

switch ($_GET["op"]) {
        //TODO: operaciones de usuarios

    case 'todos': //TODO: Procedimiento para cargar todos los datos del cliente
        $datos = array(); // Defino un arreglo para almacenar los valores que vienen de la clase usuarios.model.php
        $datos = $usuarios->todos(); // Llamo al metodo todos de la clase usuarios.model.php
        $todos[] = null;
        while ($row = mysqli_fetch_assoc($datos)) //Ciclo de repeticon para asociar los valor almancenados en la variable $datos
        {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;
    case 'uno': //TODO: procedimiento para obtener un registro de la base de datos
        $idUsuarios = $_POST["idUsuarios"];
        $datos = array();
        $datos = $usuarios->uno($idUsuarios);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
        
    case 'insertar':  //TODO: Procedimiento para insertar un cliente en la base de datos
        $Nombre_usuario = $_POST["Nombre_usuario"];
        $Contrasenia = $_POST["Contrasenia"];
        $Estado = $_POST["Estado"];
        $Roles_idRoles = $_POST["Roles_idRoles"];
        $datos = array();
        $datos = $usuarios->insertar($Nombre_usuario, $Contrasenia, $Estado, $Roles_idRoles);
        echo json_encode($datos);
        break;
        
    case 'actualizar':  //TODO: Procedimiento para actualizar un CLiente en la base de datos
        $idUsuarios = $_POST["idUsuarios"];
        $Nombre_usuario = $_POST["Nombre_usuario"];
        $Contrasenia = $_POST["Contrasenia"];
        $Estado = $_POST["Estado"];
        $Roles_idRoles = $_POST["Roles_idRoles"];
        $datos = array();
        $datos = $usuarios->actualizar($idUsuarios, $Nombre_usuario,$Contrasenia,$Estado, $Roles_idRoles);
        echo json_encode($datos);
        break;
        
    case 'eliminar': //TODO: Procedimiento para eliminar un cliente en la base de datos
        $idUsuarios = $_POST["idUsuarios"];
        $datos = array();
        $datos = $usuarios->eliminar($idUsuarios);
        echo json_encode($datos);
        break;
    
    case 'login':
            if (!isset($_POST["Nombre_Usuario"]) || !isset($_POST["Contrasenia"])) {
                echo json_encode(["error" => "Missing required parameters."]);
                exit();
            }
            $nombreUsuario = $_POST["Nombre_Usuario"];
            $contrasenia = $_POST["Contrasenia"];
            $result = $usuarios->login($nombreUsuario, $contrasenia);
            if ($result) {
                echo json_encode($result);
            } else {
                echo json_encode(["success" => false, "error" => "Invalid credentials."]);
            }
            break;
}