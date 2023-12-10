
    <div class="campo">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" placeholder="Nombre del producto" value="<?php echo $producto->nombre ?>"/>
    </div>
    <div class="campo">
        <label for="apellido">Precio</label>
        <input type="text" name="precio" id="precio" placeholder="precio" value="<?php echo $producto->precio ?>"/>
    </div>
    <div class="campo">
        <label for="imagen" class="formulario__label">Imagen</label>
        <input
            type="file"
            class="formulario__input formulario__input--file"
            id="imagen"
            name="imagen"
        >
    </div>
    <?php if(isset($producto->imagenActual)){ ?>
        <p> Imagen Actual</p>
        <div class="Imagen__formulario">
            <img src="<?php echo './build/img/'.$producto->imagen;?>.jpg" alt="Imagen Producto">
        </div>
        <?php } ?>

    <div class="campo">
        <label for="categoria">Categoria</label>
        <input type="number" name="categoriaId" id="categoriaId" placeholder="Categoria" value="<?php echo $producto->categoriaId ?>"/>
    </div>




