<h1 class="nombre-pagina">Servicios</h1>

<?php 
    include_once __DIR__ . "/../templates/barra.php";
?>

<?php foreach($servicios as $servicio):?>
    <ul class="servicios">
        <li>
            <p>Nombre: <span><?php echo $servicio->nombre;?></span></p>
            <p>Precio: <span>$<?php echo $servicio->precio;?></span></p>
            <div class="acciones">
                <a href="servicios/actualizar?id=<?php echo $servicio->id;?>" class="boton">Actualizar</a>
                <form action="servicios/eliminar" method="POST">
                    <input type="hidden" name="id" value="<?php echo $servicio->id?>">
                    <input type="submit" class="boton-eliminar" value="Eliminar">
                </form>
            </div>
        </li>
    </ul>
<?php endforeach;?>