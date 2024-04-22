
<?php
  require_once("db.php"); 
  var_dump($_POST); 
  if(isset($_POST['nro_cuenta'])){

    $sol=updateCuenta($_POST['nro_cuenta'], $_POST['tipo_Cuenta'],$_POST['saldo']); 
    if($sol){
        header("Location: index.php?id=".$_POST['ci']); 
        exit;
    }
  }else{
    if(isset($_GET['nro']) && isset($_GET['edit'])){
        $lista=getCuentaData($_GET['nro']);       
     }      
    if(isset($_POST["ci"]) && strlen($_POST["ci"] > 2 )){
       try {
        $tipo_Cuenta = $_POST['tipo_Cuenta']; 
        $saldo =$_POST['saldo']; 
        $ci=$_POST['ci']; 
        crearCuenta($tipo_Cuenta, $saldo, $ci); 
        header("Location: index.php?id=".$_POST['ci']); 
        exit;
       } catch (\Throwable $th) {
        header("Location: formCuenta.php"); 
        exit; 
       }
      }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/main.css">
    <title>Registro de cuenta</title>
</head>
<body>
    <main class="mainForm">
    <form class="formRegistro" method="POST" action="#">

    <?php if(isset($lista['nro_cuenta']) ) {?>
       <label>Numero de cuenta <br/>
      <input   value="<?= $lista['nro_cuenta']?>" disabled>
      <input  type="hidden" name="nro_cuenta" value="<?= $lista['nro_cuenta']?>">
    </label>
    <?php }?>
  <label>Tipo de cuenta
    <br/>
    <select name="tipo_Cuenta" required>
    <?php if (isset($lista['tipo_Cuenta'])) { ?>

    <option value="ahorro" <?php if ($lista['tipo_Cuenta'] == 'ahorro') echo 'selected'; ?> >Ahoro</option>
    <option value="ahorro" <?php if ($lista['tipo_Cuenta'] == 'corriente') echo 'selected'; ?> >corriente</option>
    <option value="ahorro" <?php if ($lista['tipo_Cuenta'] == 'otro') echo 'selected'; ?>>Otro</option>
    <?php } else { ?> 
     <option value="ahorro" >Ahoro</option>
    <option value="corriente">Corriente</option>
    <option value="otro">otro</option>
    <?php } ?>
  </select>
</label>
    <label>
        saldo
        <br/>
        <?php if(isset($lista['saldo'])){ ?>
            <input type="text" name="saldo" id="saldo"  value="<?=$lista['saldo']?>" required/>
        <?php } else { ?>
            <input type="text" name="saldo" id="saldo"  required>
         <?php } ?>
</label>
<?php if(isset($_GET['ci'])) { ?> 
    <input type="hidden" name="ci" id="ci" value="<?= $_GET['ci']?>">
<?php } else { ?>
    <input type="hidden" name="ci" id="ci" value="<?= $lista['ci']?>">
    <?php  } ?>
    
   <div class="acciones">
    <input type="submit" value="Enviar">
    <span>
    <a href="index.php">Cancelar </a>
  </span>

</div>
    </form>
</main>

</body>
</html>