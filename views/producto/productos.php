<section class="login">
<h1 class="nombre-pagina"> Productos </h1>

<p class="descripcion-pagina"> Administracion de productos</p>

<?php include_once __DIR__ . '/../templates/barra.php'; ?>

<ul class="servicios">
    
    <?php foreach($productos as $producto){ ?>
        
        <li>
        <h2> Productos</h2>
            <p>Nombre: <span> <?php echo $producto->nombre; ?></span></p>
            <p>Precio: <span> <?php echo $producto->precio; ?></span></p>
            <p>Imagen: <span> <?php echo $producto->imagen; ?></span></p>

            <div class="acciones">
                <a class="boton" href="/producto/actualizar?id=<?php echo $producto->id;?>">Actualizar</a>
            
            <form action="/producto/eliminar" method="POST">
                <input type="hidden" name="id" value="<?php echo $producto->id; ?>">
                <input type="submit" value="Borrar" class="boton-eliminar">
            </form>
            </div>
        </li>
   <?php } ?>
</ul>
    </section >