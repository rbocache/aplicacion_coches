<?php

include "./classes/class.forms.php";
include "./classes/class.db.php";


// Mostrar errores en tiempo de ejecución
error_reporting(E_ALL);
ini_set('display_errors', '1');

$Formulario = new Forms();
$enviarDatos = new DBforms();

// COMPRUEBO SI ESTAMOS EN METODO POST Y QUE HAYA MEDIA.

if ($_SERVER["REQUEST_METHOD"] === "POST") {          
    
    $_POST['marca'] = !empty($_POST["marca"]) ? $_POST["marca"] : "";
    $_POST['modelo'] = !empty($_POST["modelo"]) ? $_POST["modelo"] : "";
    $_POST['tipo_motor'] = !empty($_POST["tipo_motor"]) ? $_POST["tipo_motor"] : "";
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
    
// Marcas (select)
$Formulario->showInput(
    $type = "select",
    $id = "marca",
    $name = "marca",
    $placeholder = "",
    $label = "Todas las marcas",
    $validacion = $existeValidacion,
    $options = $enviarDatos->obtenerMarcas()                      
);

// Modelos (select)
$Formulario->showInput(
    $type = "select",
    $id = "modelo",
    $name = "modelo",
    $placeholder = "",
    $label = "Todas los modelos",
    $validacion = $existeValidacion,
    $options = $enviarDatos->obtenerModelos()                      
);

// Tipo_motor (select)
$Formulario->showInput(
    $type = "select",
    $id = "tipo_motor",
    $name = "tipo_motor",
    $placeholder = "",
    $label = "Todas las tipos de motor",
    $validacion = $existeValidacion,
    $options = $enviarDatos->obtenerTipoMotor()                      
);
    
?>
    <button type="submit" class="submit">Guardar Datos</button>
</form>
</div>
<?php

// ¿Hay errores?
$errores = $Formulario->hayErrores();

// Enviar a la base de datos
if (!$errores && $existeValidacion) {    
    
    // Guardar Marca
    $idMarca = $enviarDatos->enviarMarca(
        's',
        $Formulario->datosRecibidos['marca']                             
    );

    // Guardar Modelo
    $idModelo = $enviarDatos->enviarModelo(
        'si',
        $Formulario->datosRecibidos['modelo'],
        $idMarca                     
    );

    // Guardar tipo_motor
    $idTipoMotor = $enviarDatos->enviarTipoMotor(
        's',
        $Formulario->datosRecibidos['tipo_motor']                            
    );
    
    // Mensajes de confirmación
    
    if (!empty($idMarca) && !empty($idModelo) && !empty($idTipoMotor)) {
        echo '<p>Muchas gracias, se han guardados todos los datos</p>';
    }

    if (empty($idMarca)) {
        echo '<p>Marca no se ha guardado</p>';
    }

    if (empty($idModelo)) {
        echo '<p>Modelo no se ha guardado</p>';
    } 

    if (empty($idTipoMotor)) {
        echo '<p>Tipo Motor no se ha guardado</p>';
    } 
    
    
}
?>
