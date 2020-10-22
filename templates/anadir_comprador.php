<?php
echo "";
include "./classes/class.forms.php";
include "./classes/class.db.php";

$FormularioCeina = new Forms();
$enviarComprador = new DBforms();

// COMPRUEBO SI ESTAMOS EN METODO POST Y QUE HAYA MEDIA.

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    /* var_dump($_FILES); */
    var_dump($_POST);    
    $FormularioCeina->enviarFormulario($_POST);
    
}

// COMPRUEBO SI ESTAMOS EN METODO POST Y LA CLASE EXISTE

$existeValidacion = !empty($FormularioCeina) && $_SERVER["REQUEST_METHOD"] === "POST" ? true : false;
?>
<div class="caja-contenedora"> <!-- Caja contenedora -->

<form
    action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
    method="post"
    >
<?php
    // Nombre (text) -->
    $FormularioCeina->showInput(
        $type = "text",
        $id = "nombre",
        $name = "nombre",
        $placeholder = "Escribe el nombre del comprador",
        $label = "Nombre",
        $validacion = $existeValidacion
    );
    // Apellidos (text) -->
    $FormularioCeina->showInput(
        $type = "text",
        $id = "apellidos",
        $name = "apellidos",
        $placeholder = "Introduce los apellidos del comprador",
        $label = "Apellidos",
        $validacion = $existeValidacion
    );
    
    
    echo "<hr>";
    echo "<p>Datos de Dirección</p>";        
    
    // Calle (text) -->
    $FormularioCeina->showInput(
        $type = "text",
        $id = "calle",
        $name = "calle",
        $placeholder = "Introduce la calle y el número",
        $label = "Dirección",
        $validacion = $existeValidacion
    );
    
    // codigo_postal (text) -->
    $FormularioCeina->showInput(
        $type = "text",
        $id = "codigo_postal",
        $name = "codigo_postal",
        $placeholder = "Introduce el código postal",
        $label = "Código Postal",
        $validacion = $existeValidacion
    );
    
    // localidad (text) -->
    $FormularioCeina->showInput(
        $type = "text",
        $id = "localidad",
        $name = "localidad",
        $placeholder = "Introduce el nombre de la localidad",
        $label = "Localidad",
        $validacion = $existeValidacion
    );

    // provincia (text) -->
    $FormularioCeina->showInput(
        $type = "text",
        $id = "provincia",
        $name = "provincia",
        $placeholder = "Introduce la Provincia",
        $label = "Provincia",
        $validacion = $existeValidacion
    );

    // pais (text) -->
    $FormularioCeina->showInput(
        $type = "text",
        $id = "pais",
        $name = "pais",
        $placeholder = "Introduce el pais",
        $label = "País",
        $validacion = $existeValidacion
    );
?>
    <button type="submit" class="submit">Guardar Comprador</button>
</form>
</div>
<?php

// ¿Hay errores?
$errores = $FormularioCeina->hayErrores();

// Enviar a la base de datos
if (!$errores && $existeValidacion) {
    
    // Primero guardamos la dirección
    
    $idDireccion = $enviarVendedorComprador->enviarDireccion(
        'sssss',
        $FormularioCeina->datosRecibidos['calle'],
        $FormularioCeina->datosRecibidos['codigo_postal'],
        $FormularioCeina->datosRecibidos['localidad'],
        $FormularioCeina->datosRecibidos['provincia'],
        $FormularioCeina->datosRecibidos['pais'],
    );

    // Ahora guardamos el comprador y el ID de dirección
    
    $idComprador = $enviarComprador->enviarComprador(
        'ssi',
        $FormularioCeina->datosRecibidos['nombre'],
        $FormularioCeina->datosRecibidos['apellidos'],         
        $idDireccion        
    );
    
    if (!empty($idComprador)) {
        echo '<p>Gracias, hemos recibido y guardado sus datos</p>';
    }
    
}
?>
<?php include "./templates/footer.php";