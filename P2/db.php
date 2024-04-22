<?php
// Datos de conexión a la base de datos
$host = "localhost";
$usuario = "root";
$contraseña = "";
$base_de_datos = "omar";

// Conexión a la base de datos
$conexion = new mysqli($host, $usuario, $contraseña, $base_de_datos);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Función para limpiar y validar datos
function validarDatos($conexion, $dato) {
    // Implementa la lógica de validación que necesites
    // En este ejemplo, simplemente se utiliza la función mysqli_real_escape_string para evitar inyecciones SQL
    return mysqli_real_escape_string($conexion, $dato);
}

function crearPersona($ci, $nombre, $ap_paterno, $ap_materno, $direccion, $correo, $telefono) {
    global $conexion;

    
    $sql_verificar = "SELECT * FROM Persona WHERE ci = $ci";
    $resultado = $conexion->query($sql_verificar);
    
    if ($resultado->num_rows > 0) {
        $sql_actualizar = "UPDATE Persona SET nombre = '$nombre', ap_paterno = '$ap_paterno', ap_materno = '$ap_materno', direccion = '$direccion', correo = '$correo', telefono = $telefono WHERE ci = $ci";

        if ($conexion->query($sql_actualizar) === TRUE) {
            return true;
        } else {
            return  false; 
        }
    } else {
        $sql_insertar = "INSERT INTO Persona (ci, nombre, ap_paterno, ap_materno, direccion, correo, telefono) VALUES ($ci, '$nombre', '$ap_paterno', '$ap_materno', '$direccion', '$correo', $telefono)";
        if ($conexion->query($sql_insertar) === TRUE) {
            return  true; 
        } else {
            return false; 
        }
    }
}

function getpersonas(){

    $listas = array();
    global $conexion; 
    $sql = "SELECT * FROM persona where borrado=0";
    $result = $conexion->query($sql);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $listas[] = $row;
        }
    }
    
    return $listas;
}

function eliminarPersona($id_persona) {
    
    $sql = "UPDATE persona SET borrado = 1 WHERE ci =$id_persona";
    global $conexion; 
    if ($conexion->query($sql) === TRUE) {
        return true; 
    } else {
        return false ; 
    }
}


function getPersonaData ($ci){
    $cuentas = array();
    global $conexion; 
    $sql = "select * from persona where ci=$ci and borrado=0";
    $result = $conexion->query($sql); 
    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return false ; 
    }  
}


// Crear una nueva cuenta bancaria
function crearCuenta($tipoCuenta, $saldo, $ci) {
    global $conexion; 
    $tipoCuenta = validarDatos($conexion, $tipoCuenta);
    $saldo = validarDatos($conexion, $saldo);
    $ci = validarDatos($conexion, $ci);
    
    $sql = "INSERT INTO Cuenta (tipo_Cuenta, saldo, ci) VALUES ('$tipoCuenta', $saldo, $ci)";
    
    if ($conexion->query($sql) === TRUE) {
        return TRUE ; 
    } else {
        return FALSE;
    }
}
function getCuentas() {
    $cuentas = array();
    global $conexion; 
    $sql = "select * from cuenta c , persona p where c.ci=p.ci";
    $result = $conexion->query($sql);    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cuentas[] = $row;
        }
    }    
    return $cuentas;
}

function getCuenta($id_persona) {
    $cuentas = array();
    global $conexion; 
    $sql = "select * from cuenta where ci=$id_persona and borrado=0";
    $result = $conexion->query($sql);    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cuentas[] = $row;
        }
    }    
    return $cuentas;
}

function getCuentaData ($nro_cuenta){
    $cuentas = array();
    global $conexion; 
    $sql = "select * from cuenta where nro_cuenta=$nro_cuenta and borrado=0";
    $result = $conexion->query($sql); 
    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {

        return false ; 
    }  
}


function eliminarCuenta($nro_cuenta) {
    
    $sql = "UPDATE cuenta SET borrado = 1 WHERE nro_cuenta =$nro_cuenta";
    global $conexion; 
    if ($conexion->query($sql) === TRUE) {
        return TRUE; 
    } else {
        return FALSE ; 
    }
}

function updateCuenta($nro_cuenta, $tipo_Cuenta, $saldo) {
    
    $sql = "UPDATE cuenta SET tipo_Cuenta = '$tipo_Cuenta' , saldo=$saldo WHERE nro_cuenta =$nro_cuenta";
    global $conexion; 
    if ($conexion->query($sql) === TRUE) {
        return TRUE;   
    } else {
        return FALSE ; 
    }
}

//$conexion->close();


?>
