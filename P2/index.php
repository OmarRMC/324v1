<?php   
    include_once 'db.php';   
    //var_dump($_GET); 
    if(isset($_GET["removeP"]) && isset($_GET["id"]) && $_GET["removeP"]=="1"){
        $res=eliminarPersona(intval($_GET["id"]));  
        if($res){
            header("Location: index.php"); 
            exit; 
        }
    }

    if(isset($_GET['id'])&& isset($_GET["removeC"]) && isset($_GET['nro']) && $_GET["removeC"]=="1"){
        eliminarCuenta(intval($_GET["nro"]));  
        header("Location: index.php?id=".$_GET['id']); 
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./fontawesome/css/fontawesome.css">
    <link rel="stylesheet" href="./fontawesome/css/brands.css">    
    <link rel="stylesheet" href="./fontawesome/css/solid.css">
    <link rel="stylesheet" href="./fontawesome/css/regular.min.css">    
    <title>GRUD EN PHP </title>
</head>
<body>
    <main class="main">
<table> 
    <caption>Lista de personas</caption>
    <thead> 
        <tr>
         <th>Nombre</th>
         <th colspan="2">Apellidos</th>
         <th>Correo</th>            
         <th>Acciones</th>   
        </tr>
    </thead>
    <tbody>
        <?php 
         $datosSQL=getpersonas();    
         //var_dump($datosSQL);          
        foreach($datosSQL as $item){?>
         <tr class="fila">
            <td><?=$item['nombre']?></td>
            <td><?=$item['ap_paterno']?></td>
            <td><?=$item['ap_materno']?></td>
            <td><?=$item['correo']?></td>  
            <td> 
               <a href="./?id=<?=$item['ci']?>&removeP=1"> <span class="icon" ><i class="fa-solid fa-trash"></i> </span>  </a>
               <a href="./addPersona.php?id=<?=$item['ci']?>&edit"> <span class="icon" ><i class="fa-solid fa-pen-to-square"></i> </span> </a>
               <a  href="./?id=<?=$item['ci']?>"> <span class="icon" ><i class="fa-solid fa-money-check-dollar"></i></span> </a>
            </td>
        </tr>        
        <?php } ?>
    </tbody>
    <tfoot>
        <td colspan="5" style="text-align: center; " >          
             <span class="icon"> 
                   <a href="./addPersona.php"> <i class="fa-solid fa-circle-plus"></i></a>
             </span >
        </td>
     </tfoot>
</table>    

<table> 
<caption>Lista de cuentas correspondiente</caption>
    <thead> 
        <tr>
         <th>Nro Cuenta</th>
         <th>Tipo Cuenta</th>
         <th>Saldo</th>
         <th>Acciones</th>   
        </tr>
    </thead>
    <tbody>
        <?php 
         if(isset($_GET['id'])){
            $datosSQL=getCuenta($_GET['id']);    
         }else {
            $datosSQL=array();  
         }         
         //var_dump($datosSQL);          
        foreach($datosSQL as $item){?>
         <tr class="fila">
            <td><?=$item['nro_cuenta']?></td>
            <td><?=$item['tipo_Cuenta']?></td>
            <td><?=$item['saldo']?></td>
            <td> 
               <a href="./?id=<?=$_GET['id']?>&nro=<?=$item['nro_cuenta']?>&removeC=1"> <i class="fa-solid fa-trash"></i>   </a>
               <a href="./formCuenta.php?nro=<?=$item['nro_cuenta']?>&edit"> <i class="fa-solid fa-pen-to-square"></i></a>               
            </td>
        </tr>        
        <?php } ?>
    </tbody>
    <tfoot>
        <td colspan="4" style="text-align: center; " > 
         <?php 
            if(isset($_GET['id'])){?>
          <a href="./formCuenta.php?ci=<?=$_GET['id']?>" >
             <span class="icon"> 
                   <i class="fa-solid fa-circle-plus"></i>
             </span >
          </a>
          <?php }?>
        </td>
     </tfoot>
</table>    
</main>
<?php
$conexion->close(); 
?>
</body>
</html>