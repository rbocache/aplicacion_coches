<div class="caja-coche">
            <div class="caja-iz">
                <img src="<?php echo $propiedad["path"]; ?>" alt="imagen Coche">
            </div>
            <div class="caja-dcha">
                <div class="caja-contenido">
                        <div class="datos-comp-vent">
                        <p>Vendedor: <?php echo $coche['anio_fabricacion'] ?> </p>
                        <p>Comprador: <?php echo $coche['comprador'] ?> </p>
                        <p>Fecha de compra: <?php echo $coche['fecha_compra'] ?> </p>
                        </div>
                        <div class="caja-marca">
                        <p>Marca: <?php echo $coche['marca'] ?> </p>
                        <p>Modelo: <?php echo $coche['modelo'] ?> </p>
                        <p>Motor: <?php echo $coche['tipo_motor'] ?> </p>
                        </div>
                        <div class="caja-vehiculo">
                        <p>Fabricación: <?php echo $coche['anio_fabricacion'] ?> </p>
                        <p>Puertas: <?php echo $coche['n_puertas'] ?> </p>
                        <p>Precio: <?php echo $coche['precio'] ?> </p>
                        </div>
                </div>                
            </div>
</div> <!-- coches -->