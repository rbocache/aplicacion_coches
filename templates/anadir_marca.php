<?php

include "./classes/class.forms.php";
include "./classes/class.db.php";

$Formulario = new Forms();
$enviarMarca = new DBforms();

// COMPRUEBO SI ESTAMOS EN METODO POST Y QUE HAYA MEDIA.

if ($_SERVER["REQUEST_METHOD"] === "POST") {          
        
    $Formulario->enviarFormulario($_POST);   
}

// COMPRUEBO SI ESTAMOS EN METODO POST Y LA CLASE EXISTE

$existeValidacion = !empty($Formulario) && $_SERVER["REQUEST_METHOD"] === "POST" ? true : false;
?>
<div class="caja-contenedora"> <!-- Caja contenedora -->

<form
    action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
    method="post"    
>
    <?php
    
    // marca (text) -->
    $Formulario->showInput(
        $type = "text",
        $id = "marca",
        $name = "marca",
        $placeholder = "Escribe la marca del coche",
        $label = "Marca del coche",
        $validacion = $existeValidacion
    );           
    
?>
    <button type="submit" class="submit">Guardar Marca</button>
</form>
</div>
<?php

// ¿Hay errores?
$errores = $Formulario->hayErrores();

// Enviar a la base de datos
if (!$errores && $existeValidacion) {
    
    // Guardar Marca
    $idMarca = $enviarMarca->enviarMarca(
        's',
        $Formulario->datosRecibidos['marca']                     
    );
    
    if (!empty($idMarca)) {
        echo '<p>Gracias, hemos recibido y guardado sus datos</p>';
    } 
    
    
}
?>

