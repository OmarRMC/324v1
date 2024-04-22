
<?php 
   include_once("./db.php"); 

   var_dump($_GET); 

   if(isset($_GET['id']) && isset($_GET['edit'])){
     $lista=getPersonaData($_GET['id']); 
     var_dump($lista); 
   }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/main.css">
    <title>Registro persona</title>
</head>
<body>
    <main class="mainForm">
    <form class="formRegistro" method="POST" action="registoPersona.php">
     <label for=""> ci
        <br/>
        <input type="text"  name="ci" value="<?= (isset($lista['ci']))? $lista['ci']:"" ?>" <?php if(isset($lista['ci'])) echo 'disabled' ?> required>
        <?php if(isset($lista['ci'])) { ?>
              <input type="hidden" name="ci" id="ci"  value="<?= (isset($lista['ci']))? $lista['ci']:"" ?>"  >
        <?php } ?>
    </label>
    <label>
        nombre 
        <br/>
    <input type="text" name="nombre" id="nombre"   value="<?= (isset($lista['nombre']))? $lista['nombre']:"" ?>" required>
</label>
<label>
    ap_paterno
    <br/>
    <input type="text" name="ap_paterno" id="ap_paterno"  value="<?= (isset($lista['ap_paterno']))? $lista['ap_paterno']:"" ?>" required>
</label>
<label>
    ap_materno
    <br/>
    <input type="text" name="ap_materno" id="ap_materno"  value="<?= (isset($lista['ap_materno']))? $lista['ap_materno']:"" ?>">
</label>
<label>
    direccion 
    <br/>
    <input type="text" name="direccion" id="direccion"  value="<?= (isset($lista['direccion']))? $lista['direccion']:"" ?>" required>
</label>
<label>
    correo 
    <br/>
    <input type="text" name="correo" id="correo"  value="<?= (isset($lista['correo']))? $lista['correo']:"" ?>"  required>
</label>
<label>
    telefono
    <br/>
    <input type="text" name="telefono" id="telefono"  value="<?= (isset($lista['telefono']))? $lista['telefono']:"" ?>" required>
</label>
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