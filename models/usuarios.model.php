<?php
//TODO: Clase de Usuarios
require_once('../config/config.php');
class Usuarios
{
    //TODO: Implementar los metodos de la clase

    public function todos() //select * from usuarios
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `usuarios`";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function uno($idUsuarios) //select * from usuarios where id = $idUsuarios
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `usuarios` WHERE `idUsuarios`=$idUsuarios";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function insertar($Nombre_usuario, $Contrasenia, $Estado, $Roles_idRoles) //Insert Usuarios
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO `usuarios`(`Nombre_usuario`, `Contrasenia`, `Estado`, `Roles_idRoles`) 
            VALUES ('$Nombre_usuario', '$Contrasenia', '$Estado', '$Roles_idRoles')";  
            if (mysqli_query($con, $cadena)) {
                return $con->insert_id;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }
    public function actualizar($idUsuarios, $Nombre_usuario, $Contrasenia, $Estado, $Roles_idRoles) //update Usuarios
    {
        try {
            $con = new ClaseConectar($idUsuarios);
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `usuarios` 
            SET `Nombre_usuario`='$Nombre_usuario',`Contrasenia`='$Contrasenia',`Estado`='$Estado',`Roles_idRoles`='$Roles_idRoles'
             WHERE `idUsuarios` = $idUsuarios";
            if (mysqli_query($con, $cadena)) {
                return $idUsuarios;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }
    public function eliminar($idUsuarios) //delete from usuarios where id = $id
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM `usuarios` WHERE `idUsuarios`= $idUsuarios";
            if (mysqli_query($con, $cadena)) {
                return 1;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    public function login($Nombre_Usuario, $Contrasenia)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM usuarios WHERE Nombre_Usuario = '$Nombre_Usuario' and estado = 1"; // ' or 1=1 -- 
        $datos = mysqli_query($con, $cadena);
        if ($datos && mysqli_num_rows($datos) > 0) {
            $usuario = mysqli_fetch_assoc($datos);
            if ((md5($Contrasenia) == $usuario['Contrasenia'])) {
                return $usuario;
            } else {
                return false;
            }
        }
    }
}