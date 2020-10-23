
<?php
$title = "Añadir Datos de Marca, Modelo y Tipo de motor";


include "./templates/header.php"; ?>

<div class="caja-contenedor">
    <div class="caja-encabezado ">
        <h1><?php echo $title ?></h1>
        <div class="botones">
          <a id="cerrar" class="button" href="./index.php">Volver</a>
          <a id="cerrar" class="button" href="./templates/anadir_marca.php">Nueva Marca</a>
          <a id="cerrar" class="button" href="./anadir_modelo.php">Nuevo Modelo</a>
          <a id="cerrar" class="button" href="./anadir_motor">Nuevo Tipo de Motor</a>
        </div>
    </div>        
    <div class="caja-formulario">  
        <?php
        include "./templates/anadir_modelo-marca.php";
        ?>    
    </div>
        
</div>
<?php include "./templates/footer.php"; ?>