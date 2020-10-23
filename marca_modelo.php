
<?php
$title = "Añadir Datos de Marca, Modelo y Tipo de motor";


include "./templates/header.php"; ?>

<div class="caja-contenedor">
    <div class="caja-encabezado">
        <h1><?php echo $title ?></h1>
          <a id="cerrar" class="button" href="./index.php">Volver</a>
    </div>        
    <div class="caja-formulario">  
        <?php
        include "./templates/anadir_modelo-marca.php";
        ?>    
    </div>
        
</div>
<?php include "./templates/footer.php"; ?>