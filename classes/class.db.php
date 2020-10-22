<?php

class DBforms {
    public $servername;
    public $username;
    public $password;
    public $myDB;

    // Variable para el directorio de los files
    public $dir_subida = "tmp/";    
        
    
    

    public function __construct(
        $servername = 'localhost',
        $username = 'raulbocache',
        $password = 'hRv{<=N(}>!X58r^',
        $myDB = 'raul_bocache_db'
    ) {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->myDB = $myDB;        
    }

    public function crearConexion()
    {
        return new mysqli(
            $this->servername,
            $this->username,
            $this->password,
            $this->myDB
        );
    }

    public function hayError($conexion)
    {
        if ($conexion->connect_error) {
            die("La conexion ha fallado: " . $conexion->connect_error);
        }
    }

    // Función para previsualizar datos
    private function showPRE($toPrint)
    {
        echo '<pre>';
        print_r($toPrint);
        echo '</pre>';
    }    

    public function enviarCoche($datos, $idMarca, $idMedia, $idTipoMotor, $idComprador, $idVendedor, $anio_fabricacion, $n_puertas, $precio)
    {
        $miConexion = $this->crearConexion();
        $enviarCoche = $miConexion->prepare("INSERT INTO COCHES (MARCAS_id, MEDIA_featured_id, TIPO_MOTOR_id, COMPRADORES_id, VENDEDORES_id, anio_fabricacion, n_puertas, precio ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $enviarCoche->bind_param(
            $datos,
            $idMarca,
            $idMedia,
            $idTipoMotor,
            $idComprador,
            $idVendedor,
            $anio_fabricacion,
            $n_puertas,
            $precio
        );

        // Compruebo si la conexión se establece bien
        if (!$enviarCoche) {
            throw new Exception($miConexion->error_list);
        }

        // Ejecute la query
        $enviarCoche->execute();

        // Compruebo si se envia y no hay error
        if (!$enviarCoche) {
            throw new Exception($miConexion->error_list);
        }

        // Devuelvo el último valor añadido
        $id = $enviarCoche->insert_id;

        // Cierro conexión
        $enviarCoche->close();

        // Devuevlo el ID
        return $id;
    }

    public function enviarComprador($datos, $nombre, $apellidos, $idDireccion)
    {
        $miConexion = $this->crearConexion();
        $enviarComprador = $miConexion->prepare("INSERT INTO COMPRADORES ( nombre, apellidos, DIRECCIONES_id ) VALUES (?, ?, ?)");
        /* $this->showPRE($enviarOficina); */
        $enviarComprador->bind_param(
            $datos,            
            $nombre,
            $apellidos,
            $idDireccion            
        );

        /* $this->showPRE($enviarOficina); */

        // Compruebo si la conexión se establece bien
        if (!$enviarComprador) {
            throw new Exception($miConexion->error_list);
        }

        // Ejecute la query
        $enviarComprador->execute();
        /* $this->showPRE($enviarOficina); */
        
        // Compruebo si se envia y no hay error
        if (!$enviarComprador) {
            throw new Exception($miConexion->error_list);
        }

        // Devuelvo el último valor añadido
        $id = $enviarComprador->insert_id;

        // Cierro conexión
        $enviarComprador->close();

        // Devuevlo el ID
        return $id;
    }

    public function enviarVendedor($datos, $nombre, $apellidos, $idDireccion)
    {
        $miConexion = $this->crearConexion();
        $enviarVendedor = $miConexion->prepare("INSERT INTO VENDEDORES ( nombre, apellidos, DIRECCIONES_id ) VALUES (?, ?, ?)");
        /* $this->showPRE($enviarOficina); */
        $enviarVendedor->bind_param(
            $datos,            
            $nombre,
            $apellidos,
            $idDireccion            
        );

        /* $this->showPRE($enviarOficina); */

        // Compruebo si la conexión se establece bien
        if (!$enviarVendedor) {
            throw new Exception($miConexion->error_list);
        }

        // Ejecute la query
        $enviarVendedor->execute();
        /* $this->showPRE($enviarOficina); */
        
        // Compruebo si se envia y no hay error
        if (!$enviarVendedor) {
            throw new Exception($miConexion->error_list);
        }

        // Devuelvo el último valor añadido
        $id = $enviarVendedor->insert_id;

        // Cierro conexión
        $enviarVendedor->close();

        // Devuevlo el ID
        return $id;
    }

    public function enviarDireccion($datos, $calle, $codigo_postal, $localidad, $provincia, $pais)
    {
        $miConexion = $this->crearConexion();
        $enviarDireccion = $miConexion->prepare("INSERT INTO DIRECCIONES ( calle, codigo_postal, localidad, provincia, pais ) VALUES (?, ?, ?, ?, ?)");
        /* $this->showPRE($enviarOficina); */
        $enviarDireccion->bind_param(
            $datos,            
            $calle,
            $codigo_postal,
            $localidad,
            $provincia,
            $pais            
        );

        /* $this->showPRE($enviarOficina); */

        // Compruebo si la conexión se establece bien
        if (!$enviarDireccion) {
            throw new Exception($miConexion->error_list);
        }

        // Ejecute la query
        $enviarDireccion->execute();
        /* $this->showPRE($enviarOficina); */
        
        // Compruebo si se envia y no hay error
        if (!$enviarDireccion) {
            throw new Exception($miConexion->error_list);
        }

        // Devuelvo el último valor añadido
        $id = $enviarDireccion->insert_id;

        // Cierro conexión
        $enviarDireccion->close();

        // Devuevlo el ID
        return $id;
    }

    public function enviarFile($datos, $imagen)
    {
        $path =  $this->dir_subida . $imagen;
        $miConexion = $this->crearConexion();
        $enviarFile = $miConexion->prepare("INSERT INTO MEDIAS (path) VALUES (?)");
        /* $this->showPRE($enviarFile); */
        $enviarFile->bind_param(
            $datos,
            $path
        );

        // Compruebo si la conexión se establece bien
        if (!$enviarFile) {
            throw new Exception($miConexion->error_list);
        }
        

        // Ejecute la query
        $enviarFile->execute();
        

        // Compruebo si se envia y no hay error
        if (!$enviarFile) {
            throw new Exception($miConexion->error_list);
        }

        // Devuelvo el último valor añadido
        $id = $enviarFile->insert_id;

        // Cierro conexión
        $enviarFile->close();

        // Devuevlo el ID
        return $id;
    }    

    public function enviarMarca($datos, $marca)
    {
        $miConexion = $this->crearConexion();
        $enviarMarca = $miConexion->prepare("INSERT INTO MARCAS (nombre) VALUES (?)");
        /* $this->showPRE($enviarFile); */
        $enviarMarca->bind_param(
            $datos,
            $marca
        );

        // Compruebo si la conexión se establece bien
        if (!$enviarMarca) {
            throw new Exception($miConexion->error_list);
        }
        

        // Ejecute la query
        $enviarMarca->execute();
        

        // Compruebo si se envia y no hay error
        if (!$enviarMarca) {
            throw new Exception($miConexion->error_list);
        }

        // Devuelvo el último valor añadido
        $id = $enviarMarca->insert_id;

        // Cierro conexión
        $enviarMarca->close();

        // Devuevlo el ID
        return $id;
    }

    public function enviarModelo($datos, $idMarca, $nombre)
    {
        $miConexion = $this->crearConexion();
        $enviarModelo = $miConexion->prepare("INSERT INTO MODELOS (MARCAS_id, nombre) VALUES (?,?)");
        /* $this->showPRE($enviarFile); */
        $enviarModelo->bind_param(
            $datos,
            $idMarca,
            $nombre
        );

        // Compruebo si la conexión se establece bien
        if (!$enviarModelo) {
            throw new Exception($miConexion->error_list);
        }
        

        // Ejecute la query
        $enviarModelo->execute();
        

        // Compruebo si se envia y no hay error
        if (!$enviarModelo) {
            throw new Exception($miConexion->error_list);
        }

        // Devuelvo el último valor añadido
        $id = $enviarModelo->insert_id;

        // Cierro conexión
        $enviarModelo->close();

        // Devuevlo el ID
        return $id;
    }

    public function enviarTipoMotor($datos, $tipo)
    {
        $miConexion = $this->crearConexion();
        $enviarTipoMotor = $miConexion->prepare("INSERT INTO TIPO_MOTOR ( tipo) VALUES (?)");
        /* $this->showPRE($enviarFile); */
        $enviarTipoMotor->bind_param(
            $datos,            
            $tipo
        );

        // Compruebo si la conexión se establece bien
        if (!$enviarTipoMotor) {
            throw new Exception($miConexion->error_list);
        }
        

        // Ejecute la query
        $enviarTipoMotor->execute();
        

        // Compruebo si se envia y no hay error
        if (!$enviarTipoMotor) {
            throw new Exception($miConexion->error_list);
        }

        // Devuelvo el último valor añadido
        $id = $enviarTipoMotor->insert_id;

        // Cierro conexión
        $enviarTipoMotor->close();

        // Devuevlo el ID
        return $id;
    } 

    public function obtenerMarcas()
    {

        // ESTABLECER CONEXION
        $miConexion = $this->crearConexion();

        // PREPARAR QUERY
        $prepare = $miConexion->prepare("SELECT id, nombre FROM MARCAS");

        // COMPROBAR SI HAY ERROR
        if (!$prepare) {
            var_dump($miConexion->error_list);
        }

        // EJECUTAR
        $prepare->execute();

        // BIND RESULT
        $prepare->bind_result($id, $nombre);

        // FETCH RESULT
        $miArray = array();
        while ($prepare->fetch()) {
            $miArray[$id] = $nombre;
        }
       
        // CLOSE CONNECTION
        $miConexion->close();

        return $miArray;
    }

    public function obtenerModelosMarcas()
    {

        // ESTABLECER CONEXION
        $miConexion = $this->crearConexion();

        // PREPARAR QUERY
        $prepare = $miConexion->prepare("SELECT id, nombre FROM MODELOS");

        // COMPROBAR SI HAY ERROR
        if (!$prepare) {
            var_dump($miConexion->error_list);
        }

        // EJECUTAR
        $prepare->execute();

        // BIND RESULT
        $prepare->bind_result($id, $nombre);

        // FETCH RESULT
        $miArray = array();
        while ($prepare->fetch()) {
            $miArray[$id] = $nombre;           
        }
       
        // CLOSE CONNECTION
        $miConexion->close();

        return $miArray;
    }

    public function obtenerTipoMotor()
    {

        // ESTABLECER CONEXION
        $miConexion = $this->crearConexion();

        // PREPARAR QUERY
        $prepare = $miConexion->prepare("SELECT id, tipo FROM TIPO_MOTOR");

        // COMPROBAR SI HAY ERROR
        if (!$prepare) {
            var_dump($miConexion->error_list);
        }

        // EJECUTAR
        $prepare->execute();

        // BIND RESULT
        $prepare->bind_result($id, $nombre);

        // FETCH RESULT
        $miArray = array();
        while ($prepare->fetch()) {
            $miArray[$id] = $nombre;           
        }
       
        // CLOSE CONNECTION
        $miConexion->close();

        return $miArray;
    }

    public function obtenerCompradores()
    {

        // ESTABLECER CONEXION
        $miConexion = $this->crearConexion();

        // PREPARAR QUERY
        $prepare = $miConexion->prepare("SELECT id, nombre FROM COMPRADORES");

        // COMPROBAR SI HAY ERROR
        if (!$prepare) {
            var_dump($miConexion->error_list);
        }

        // EJECUTAR
        $prepare->execute();

        // BIND RESULT
        $prepare->bind_result($id, $nombre);

        // FETCH RESULT
        $miArray = array();
        while ($prepare->fetch()) {
            $miArray[$id] = $nombre;           
        }
       
        // CLOSE CONNECTION
        $miConexion->close();

        return $miArray;
    }

    public function obtenerVendedores()
    {

        // ESTABLECER CONEXION
        $miConexion = $this->crearConexion();

        // PREPARAR QUERY
        $prepare = $miConexion->prepare("SELECT id, nombre FROM VENDEDORES");

        // COMPROBAR SI HAY ERROR
        if (!$prepare) {
            var_dump($miConexion->error_list);
        }

        // EJECUTAR
        $prepare->execute();

        // BIND RESULT
        $prepare->bind_result($id, $nombre);

        // FETCH RESULT
        $miArray = array();
        while ($prepare->fetch()) {
            $miArray[$id] = $nombre;           
        }
       
        // CLOSE CONNECTION
        $miConexion->close();

        return $miArray;
    }
    
    public function obtenerDatos()
    {

        // ESTABLECER CONEXION
        $miConexion = $this->crearConexion();

        // PREPARAR QUERY
        $resultados_array = array(); 
        
        $result = $miConexion->query("SELECT *
        FROM COCHES;");
        
        // CLOSE CONNECTION
        $miConexion->close();

        if ($result) {
                while ($row = $result->fetch_assoc())
                {
                    $resultados_array[] = $row;
                }            
            return $resultados_array;
        }
    }       
}