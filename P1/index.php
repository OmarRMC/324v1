<?php include_once("./includes/header.php") ?>

<?php include_once("./pages/nav.php") ?>

<main class="main">

<?php
if(isset($_GET['page'])) {
    $componente = $_GET['page'];
    
    switch($componente) {
        case 'ahoro':
            include 'pages/Ahoro.php';
            break;
        case 'corriente':
            include 'pages/Corriente.php';
            break;
    
        default:
    
            include 'pages/404.php';
            break;
    }
}
?>

</main>
<?php include_once("./includes/footer.php") ?>
