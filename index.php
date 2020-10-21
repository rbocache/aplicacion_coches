<?php
$title = "Aplicación de compra - venta de coches";

include "./classes/class.forms.php";
include "./templates/header.php"; 

error_reporting(E_ALL); 
ini_set("display_errors", 1);

?>

<div class="caja-contenedor">
    <div class="caja-encabezado">
        <h1><?php echo $title ?></h1>
        <div class="botones">
            <a class="button" href="./coche.php">Añadir Coche</a>
            <a class="button" href="./comprador.php">Añadir Comprador</a>
            <a class="button" href="./vendedor.php">Añadir Vendedor</a>           
        </div>
    </div>

    <div class="caja-propiedades">  
    <?php   
    

    ?>    
    </div>
</div>

<?php include "./templates/footer.php"; ?>
