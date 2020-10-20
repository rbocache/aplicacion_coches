<?php

include "./classes/class.forms.php";
include "./classes/class.db.php";

$Formulario = new Forms();
$enviarCoche = new DBforms();

// COMPRUEBO SI ESTAMOS EN METODO POST Y QUE HAYA MEDIA.

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    /* var_dump($_FILES); */
    
    if ($_FILES[key($_FILES)]['size'] === 0) {
        
        $_POST['marca'] = !empty($_POST["marca"]) ? $_POST["marca"] : "";
        $_POST['modelo'] = !empty($_POST["modelo"]) ? $_POST["modelo"] : "";
        $_POST['tipo_motor'] = !empty($_POST["tipo_motor"]) ? $_POST["tipo_motor"] : "";
        $_POST['comprador'] = !empty($_POST["comprador"]) ? $_POST["comprador"] : "";
        $_POST['vendedor'] = !empty($_POST["vendedor"]) ? $_POST["vendedor"] : "";
        $Formulario->enviarFormulario($_POST);
        
    } else {
        $_POST['marca'] = !empty($_POST["marca"]) ? $_POST["marca"] : "";
        $_POST['modelo'] = !empty($_POST["modelo"]) ? $_POST["modelo"] : "";
        $_POST['tipo_motor'] = !empty($_POST["tipo_motor"]) ? $_POST["tipo_motor"] : "";
        $_POST['comprador'] = !empty($_POST["comprador"]) ? $_POST["comprador"] : "";
        $_POST['vendedor'] = !empty($_POST["vendedor"]) ? $_POST["vendedor"] : "";
        $Formulario->enviarFormulario($_POST, $_FILES);
    }
    
}

// COMPRUEBO SI ESTAMOS EN METODO POST Y LA CLASE EXISTE

$existeValidacion = !empty($Formulario) && $_SERVER["REQUEST_METHOD"] === "POST" ? true : false;
?>
<div class="caja-contenedora"> <!-- Caja contenedora -->

<form
    action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
    method="post"
    enctype="multipart/form-data"
>
    <?php

    // Fotografia (file) -->
    $Formulario->showInput(
        $type = "file",
        $id = "imagen",
        $name = "imagen",
        $placeholder = "",
        $label = "Imagen del coche",
        $validacion = $existeValidacion
    );

    echo "<p>Selecciona Marca</p>";

    // Marcas (select)
    $Formulario->showInput(
        $type = "select",
        $id = "marca",
        $name = "marca",
        $placeholder = "",
        $label = "Todas las marcas",
        $validacion = $existeValidacion,
        $options = $enviarCoche->obtenerMarcas()                      
    );   
    
    // Añadir marca si no existe
    echo "<hr>";
    echo "<p>Si no se encuentra disponible, añade una marca</p>";
    ?>

    <div class="botones">
            <a class="button" href="./templates/anadir_marca.php">Añadir Marca</a>
    </div>

    <?php

    echo "<hr>";
    echo "<p>Selecciona Modelos</p>";

    // Modelos (select)
    $Formulario->showInput(
        $type = "select",
        $id = "modelo",
        $name = "modelo",
        $placeholder = "",
        $label = "Todos los modelos",
        $validacion = $existeValidacion,
        $options = $enviarCoche->obtenerModelosMarcas()             
    );

    // Añadir modelo si no existe
    echo "<hr>";
    echo "<p>Si no se encuentra disponible, añade un modelo</p>";
    ?>

    <div class="botones">
            <a class="button" 
    </div>
    <?php

    

    echo "<hr>";
    echo "<p>Selecciona Tipo de Motor</p>";

    // tipo_motor (select)
    $Formulario->showInput(
        $type = "select",
        $id = "tipo_motor",
        $name = "tipo_motor",
        $placeholder = "",
        $label = "Tipo de motor",
        $validacion = $existeValidacion,
        $options = $enviarCoche->obtenerTipoMotor()              
    );

    // Añadir tipo_motor si no existe
    echo "<hr>";
    echo "<p>Si no se encuentra disponible, añade un tipo de motor</p>";
    ?>

    <div class="botones">
            <a class="button" href="./templates/anadir_modelo.php">Añadir Tipo Motor</a>
    </div>
    <?php

    echo "<hr>";

    // compradores (select)
    $Formulario->showInput(
        $type = "select",
        $id = "comprador",
        $name = "comprador",
        $placeholder = "",
        $label = "Comprador",
        $validacion = $existeValidacion,
        $options = $enviarCoche->obtenerCompradores()              
    );

    echo "<hr>";
    
    // vendedores (select)
    $Formulario->showInput(
        $type = "select",
        $id = "vendedor",
        $name = "vendedor",
        $placeholder = "",
        $label = "Vendedor",
        $validacion = $existeValidacion,
        $options = $enviarCoche->obtenerVendedores()              
    );

    echo "<hr>";

    // anio_fabricacion (int) -->
    $Formulario->showInput(
        $type = "number",
        $id = "anio_fabricacion",
        $name = "anio_fabricacion",
        $placeholder = "Indica el año de fabricación del coche",
        $label = "Año fabricación",
        $validacion = $existeValidacion
    );

    // n_puertas (int) -->
    $Formulario->showInput(
        $type = "number",
        $id = "n_puertas",
        $name = "n_puertas",
        $placeholder = "¿Cuántas puertas tiene el coche",
        $label = "Número puertas",
        $validacion = $existeValidacion
    );        
    
?>
    <button type="submit" class="submit">Guardar coche</button>
</form>
</div>
<?php

// ¿Hay errores?
$errores = $Formulario->hayErrores();

// Enviar a la base de datos
if (!$errores && $existeValidacion) {
    
    // Guardar Marca
    $idMarca = $enviarCoche->enviarMarca(
        's',
        $Formulario->datosRecibidos['marca']
    );

    // Guardar Modelo
    $idModelo = $enviarCoche->enviarModelo(
        'is',
        $idMarca,
        $Formulario->datosRecibidos['modelo']
    );

    // Guardar Tipo de motor
    $idTipoMotor = $enviarCoche->enviarTipoMotor(
        's',
        $Formulario->datosRecibidos['tipo_motor']
    );

    // Guardar Imagen     
    $idMedia = $enviarCoche->enviarFile(
        's',
        $Formulario->fotoRecibida['name']
    );

    $idComprador = $Formulario->datosRecibidos['comprador'];
    $idVendedor = $Formulario->datosRecibidos['vendedor'];

        
    // Guardar coche
    $idCoche = $enviarCoche->enviarCoche(
        'iiiiiii',
        $idMarca,                
        $idMedia,
        $idTipoMotor,
        $idComprador,
        $idVendedor,
        $Formulario->datosRecibidos['anio_fabricacion'],
        $Formulario->datosRecibidos['n_puertas']               
    );
    
    if (!empty($idCoche)) {
        echo '<p>Gracias, hemos recibido y guardado sus datos</p>';
    }

    
}
?>

