
    <div class="campo">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" placeholder="Nombre del producto" value="<?php echo $producto->nombre ?>"/>
    </div>
    <div class="campo">
        <label for="apellido">Precio</label>
        <input type="text" name="precio" id="precio" placeholder="precio" value="<?php echo $producto->precio ?>"/>
    </div>
    <div class="campo">
        <label for="imagen">Imagen</label>
        <input type="file" name="imagen" accept="image*" >
    </div>
    <div class="campo">
        <label for="categoria">Categoria</label>
        <input type="categoria" name="categoria" id="categoria" placeholder="Categoria" value="<?php echo $producto->categoriaId ?>"/>
    </div>




