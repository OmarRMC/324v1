<?php
 require_once("db.php"); 
 var_dump($_POST);
 if(isset($_POST["ci"]) && strlen($_POST["ci"] > 2 ))
 {
   try {
    $ci=intval($_POST["ci"]); 
    $nombre=$_POST["nombre"]; 
    $ap_paterno=$_POST["ap_paterno"]; 
    $ap_materno=$_POST["ap_materno"]; 
    $direccion=$_POST["direccion"]; 
    $correo=$_POST["correo"]; 
    $telefono=intval($_POST["telefono"]); 
    crearPersona($ci, $nombre, $ap_paterno,$ap_materno, $direccion, $correo,$telefono); 
    header("Location: index.php"); 
    exit;   
   } catch (\Throwable $th) {    
    header("Location: addPersona.php"); 
    exit;
   }
 }else {
    header("Location: addPersona.php"); 
    exit;
 }

?>
