<?php
$title = "Añadir Vendedor";
include "./templates/header.php"; ?>

<div class="caja-contenedor">
    <div class="caja-encabezado">
        <h1><?php echo $title ?></h1>
          <a class="button" href="./index.php">Volver</a>
    </div>        
    <div class="caja-formulario">  
        <?php
        include "./templates/anadir_vendedor.php";
        ?>    
    </div>
        
</div>
<?php include "./templates/footer.php"; ?>