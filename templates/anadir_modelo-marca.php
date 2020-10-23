<?php

include "./classes/class.forms.php";
include "./classes/class.db.php";


// Mostrar errores en tiempo de ejecución
error_reporting(E_ALL);
ini_set('display_errors', '1');

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

// Modelos (select)
$Formulario->showInput(
    $type = "select",
    $id = "modelo",
    $name = "modelo",
    $placeholder = "",
    $label = "Todas los modelos",
    $validacion = $existeValidacion,
    $options = $enviarCoche->obtenerModelos()                      
);

// Tipo_motor (select)
$Formulario->showInput(
    $type = "select",
    $id = "tipo_motor",
    $name = "tipo_motor",
    $placeholder = "",
    $label = "Todas las tipos de motor",
    $validacion = $existeValidacion,
    $options = $enviarCoche->obtenerTipoMotor()                      
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
    $idMarca = $enviarMarca->enviarMarca(
        's',
        $Formulario->datosRecibidos['marca']                     
    );
    
    if (!empty($idMarca)) {
        echo '<p>Gracias, hemos recibido y guardado sus datos</p>';
    } 
    
    
}
?>

<!-- <script language="JavaScript"> 
function cerrar_this() { 
    setInterval('cerrar' ,1000);
    function cerrar(){
        opener.window.location.href += "?actualizado=exito";
        opener.window.location.reload(); 
        self.close(); return false; 
    }
} 
</script> --> 
