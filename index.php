<?php
$title = "Aplicación de compra - venta de coches";

include "./classes/class.forms.php";
include "./classes/class.db.php";
include "./templates/header.php"; 
$Coches = new DBforms();
$ultimosCoches = $Coches->obtenerDatos();
$Compradores = $Coches->obtenerCompradores();
$Vendedores = $Coches->obtenerVendedores();
$Marcas = $Coches->obtenerMarcas();
$Modelos = $Coches->obtenerModelos();
?>

<div class="caja-contenedor">
    <div class="caja-encabezado">
        <h1><?php echo $title ?></h1>
        <div class="botones">
            <?php 
            if(!empty($Compradores)&&!empty($Vendedores)&&!empty($Marcas)&&!empty($Modelos)){
            echo '<a class="button" href="./coche.php">Añadir Coche</a>';
            } ?>
            <a class="button" href="./comprador.php">Añadir Comprador</a>
            <a class="button" href="./vendedor.php">Añadir Vendedor</a>
            <a class="button" href="./marca_modelo.php">Añadir Marca y Modelo</a>                       
        </div>
    </div>

    <div class="caja-propiedades">  
    <?php   
    
    var_dump($ultimosCoches);
    
    foreach ($ultimosCoches as $coche) {
        $coche = $coche;
        
        include "./templates/listado_coches.php";
    } 

    ?>    
    </div>
</div>

<?php include "./templates/footer.php"; ?>