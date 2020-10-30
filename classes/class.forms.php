<?php

class Forms {
    public $errores;
    public $mensajes_error;
    public $datosRecibidos;

    // Variable para el directorio de los files
    public $dir_subida;
    public $path_media;
    public $dir_proyecto;    
    public $fotoRecibida;

    public $array_mime_types;
    public $array_extensiones_permitidas;

    // Constructor de la classe, inicializa datos importantes
    public function __construct() {
        $this->errores = false;
        $this->dir_subida = getcwd() . "/tmp/";
        $this->dir_proyecto = "./tmp/";
        $this->array_mime_types = array('image/png', 'image/jpg', 'image/JPG', 'image/jpeg', 'image/gif', 'image/webp');
        $this->array_extensiones_permitidas = array('png', 'jpg', 'JPG', 'jpeg', 'gif', 'webp');
    }

    // Función para hacer previsualizaciones de datos (administrador)
    private function showPRE($toPrint)
    {
        echo '<pre>';
        print_r($toPrint);
        echo '</pre>';
    }

    // Función que recoge los datos
    public function enviarFormulario($datos, $files = null)
    {       
        $this->datosRecibidos = $datos;
        
        if (!empty($files)){        
        $this->fotoRecibida = reset($files);
        }
    }
    
    // Función que controla los tipos de inputs del formulario
    public function showInput($type, $id, $name, $placeholder, $label, $validacion, $options = null, $multiple = null)
    {
        switch ($type) {
            case 'text':
                return $this->getTypeText($type, $id, $name, $placeholder, $label, $validacion);
                break;

            case 'checkbox':
                return $this->getTypeCheckbox($type, $id, $name, $placeholder, $label, $validacion);
                break;

            case 'select':
                return $this->getTypeSelect($type, $id, $name, $placeholder, $label, $validacion, $options, $multiple);
                break;

            case 'file':
                return $this->getTypeFile($type, $id, $name, $placeholder, $label, $validacion);
                break;
            
            case 'number':
                return $this->getTypeNumber($type, $id, $name, $placeholder, $label, $validacion);
                break;

            case 'date':
                return $this->getTypeText($type, $id, $name, $placeholder, $label, $validacion);
                break;

            default:
                # code...
                break;
        }
    }    

    // Muestra inputs tipo text
    private function getTypeText($type, $id, $name, $placeholder, $label, $validacion, $options=null)
    {
        $classes = "input input-text";
        $miDato = "";
        $esValido = null;
        $valor_seleccionado = "";

        if ($options){
            if (in_array($valor_seleccionado, array_keys($options))) {
                $classes .= " valid-input";
                $mensaje_validacion = '<p class="success small">Datos validos.</p>';
               
            } else {
                $classes .= " error-input";
                $mensaje_validacion = '<p class="error small">Esta marca ya existe</p>';                
            }
        }

        if ($validacion) {
            $miDato = $this->sanitizacion($this->datosRecibidos[$name], $type);
            $esValido = $this->validacion($miDato, $type);
            
            if ($esValido) {
                $classes .= " valid-input";
            } else {
                $classes .= " error-input";
                $this->errores = true;
            }
        }

        $textInput = '<div class="grupo">';
        $textInput .= '<label class="label" for="' . $id . '">';
        $textInput .= $label;
        $textInput .= '</label>';
        $textInput .= '<input value="' . $miDato . '" type="text" name="' . $name . '" id="' . $id . '" placeholder="' . $placeholder . '" class="' . $classes . '" />';
        if ($miDato && $esValido) {
            $textInput .= '<p class="success small">Datos validos.</p>';
        }
        if ($esValido === false) {
            $textInput .= '<p class="error small">Por favor, revisa el campo. El dato esta vacio o no es valido.</p>';
        }
        $textInput .= '</div>';
        echo $textInput;
    }

    // Muestra inputs tipo number
    private function getTypeNumber($type, $id, $name, $placeholder, $label, $validacion)
    {
        $classes = "input input-number";
        $miDato = "";
        $esValido = false;
        if ($validacion) {
            $miDato = $this->sanitizacion($this->datosRecibidos[$name], $type);
            $esValido = $this->validacion($miDato, $type);
           
            if ($esValido) {
                $classes .= " valid-input";
            } else {
                $classes .= " error-input";
                $this->errores = true;
            }
        }

        $NumberInput = '<div class="grupo">';
        $NumberInput .= '<label class="label" for="' . $id . '">';
        $NumberInput .= $label;
        $NumberInput .= '</label>';
        $NumberInput .= '<input value="' . $miDato . '" type="text" name="' . $name . '" id="' . $id . '" placeholder="' . $placeholder . '" class="' . $classes . '" />';
        if ($miDato && $esValido) {
            $NumberInput .= '<p class="success small">Datos validos.</p>';
        }
        if ($esValido === false) {
            $NumberInput .= '<p class="error small">Por favor, revisa el campo. El dato esta vacio o no es valido.</p>';
        }
        $NumberInput .= '</div>';
        echo $NumberInput;
        
    }

    // Muestra inputs tipo ckeckbox
    private function getTypeCheckbox($type, $id, $name, $placeholder, $label, $validacion)
    {
        $classes = "input input-checkbox";
        $isChecked = "";
        if ($validacion && in_array($name, array_keys($this->datosRecibidos))) {
                $isChecked = "checked";
                $classes .= " valid-input";
        }

        $checkBox = '<div class="grupo grupo-checkbox">';
        $checkBox .= '<input ' . $isChecked . ' type="checkbox" name="' . $name . '" id="' . $id . '" placeholder="' . $placeholder . '" class="' . $classes . '"/>';
        $checkBox .= '<label class="label" for="' . $id . '">';
        $checkBox .= $label;
        $checkBox .= '</label>';        
        $checkBox .= '</div>';
        echo $checkBox;
    }

    // Muestra inputs tipo select, de otras tablas
    private function getTypeSelect($type, $id, $name, $placeholder, $label, $validacion, $options, $multiple=false)
    {
        $classes = "input input-select";
        $mensaje_validacion = "";
        $isSelected = false;
        $valor_seleccionado = "";
        $miDato = "";
        $esValido = null;
        
        if ($multiple) {
            $valor_seleccionado = array();
        }

        if ($validacion && in_array(str_replace('[]', '', $name), array_keys($this->datosRecibidos))) {
            $valor_seleccionado = $this->datosRecibidos[str_replace('[]', '', $name)];

            if ($multiple) {
                $arrayValoresSeleccionados = array_values($valor_seleccionado);
                $arrayEnviado = array_keys($options);
                $resultado = array_intersect($arrayValoresSeleccionados, $arrayEnviado);
                
                if (count($resultado) === count($arrayValoresSeleccionados)) {
                    $classes .= " valid-input";
                    $mensaje_validacion = '<p class="success small">Datos validos.</p>';
                    $isSelected = true;
                } else {
                    $classes .= " error-input";
                    $mensaje_validacion = '<p class="error small">Alguno de los datos esta mal, por favor revisa los datos seleccionados.</p>';
                    $this->errores = true;
                }
            } else {
                if (in_array($valor_seleccionado, array_keys($options))) {
                    $classes .= " valid-input";
                    $mensaje_validacion = '<p class="success small">Datos validos.</p>';
                    $isSelected = true;
                } else {
                    $classes .= " error-input";
                    $mensaje_validacion = '<p class="error small">Alguno de los datos esta mal, por favor revisa los datos seleccionados.</p>';
                    $this->errores = true;
                }
            }
        }

        if ($validacion) {
            $miDato = $this->sanitizacion($this->datosRecibidos[$name], $type);
            $esValido = $this->validacion($miDato, $type);
            
            if ($esValido) {
                $classes .= " valid-input";
            } else {
                $classes .= " error-input";
                $this->errores = true;
            }
        }

        $select = '<div class="grupo grupo-select">';
        $select .= '<label class="label" for="' . $id . '">';
        $select .= $label;
        $select .= '</label>';
        $select .= '<select ' . ($multiple ? 'multiple' : '') . ' id="' . $id . '" name="' . $name . '" class="' . $classes . '">';
        $select .= '<option disabled' . ($isSelected === false ? ' selected' : "") . '>-- Por favor seleccionar una opción</option>';
        foreach ($options as $key => $value) {
            if ($multiple) {
                $select .= '<option value="' . $key . '"' . (in_array($key, array_values($valor_seleccionado)) ? ' selected' : "") . '>' . $value . '</option>';
            } else {
                $select .= '<option value="' . $key . '"' . ($valor_seleccionado === $key ? ' selected' : "") . '>' . $value . '</option>';
            }
        }
        $select .= '</select>';
        $select .= $mensaje_validacion;
        $select .= '</div>';
        echo $select;
    }

    // Muestra inputs tipo FILE (Imágenes)
    private function getTypeFile($type, $id, $name, $placeholder=null, $label, $validacion)
    {
        
        $classes = "input input-file";
        $miDato = "";
        $esValido = null;
        if ($validacion && $this->fotoRecibida) {

            $fichero_subido = $this->dir_subida . basename($this->fotoRecibida['name']);
            $this->path_media = $this->dir_proyecto . basename($this->fotoRecibida['name']);
            $fichero_extension = pathinfo($fichero_subido, PATHINFO_EXTENSION);                     

            if (
                !in_array($this->fotoRecibida['type'], $this->array_mime_types) ||
                !in_array($fichero_extension, $this->array_extensiones_permitidas)
                
            ) {
                
                $this->showPRE($this->fotoRecibida['type']);
                $this->showPRE($fichero_extension);
                $this->showPRE($this->array_mime_types);
                $this->showPRE($this->array_extensiones_permitidas);

                $classes .= " error-input";
                
                $this->errores = true;
                throw new Exception("Hay un error de validación con el fichero que has seleccionado");
                return "";
                
            }
            
            var_dump($fotoRecibida);
            var_dump($fichero_subido);
            move_uploaded_file($this->fotoRecibida['tmp_name'], $fichero_subido);
            $classes .= " valid-input";
        }

        $file = '<div class="grupo">';
        $file .= '<label class="label" for="' . $id . '">';
        $file .= $label;
        $file .= '</label>';
        $file .= '<input type="file" name="' . $name . '" id="' . $id . '" placeholder="' . $placeholder . '" class="' . $classes . '"  required accept="image/png, image/jpeg, image/gif"/>';
        if ($miDato && $esValido) {
            $file .= '<p class="success small">Datos validos.</p>';
        }
        if ($esValido === false) {
            $file .= '<p class="error small">Por favor, revisa el campo. El dato esta vacio o no es valido.</p>';
        }
        $file .= '</div>';
        echo $file;
    }
    
    // Función para limpiar los datos
    private function sanitizacion($valor, $tipo)
    {
        switch ($tipo) {
            case 'text':
                $filter = FILTER_SANITIZE_STRING;
                break;

            case 'number':
                $filter = FILTER_SANITIZE_NUMBER_INT;
                break;

            case 'select':
                $filter = FILTER_SANITIZE_STRING;
                break;

            default:
                # code...
                break;
        }
        
        return filter_var($valor, $filter);
    }

    // Validados los datos introducidos
    private function validacion($valor, $tipo)
    {
        switch ($tipo) {
            case 'text':
                return $valor !== '' ? true : false;
                break;
            
            case 'number':
                return $valor !== '' ? true : false; 
            break;

            case 'select':
                return $valor !== '' ? true : false; 
            break;

            case 'file':
                return $valor === null ? false : true;
            break;

            default:
                # code...
            break;
        }
    }

    // Controla si hay errores o no
    public function hayErrores()
    {
        return $this->errores;
    }
}