<h1> Creacion de Productos</h1>

<section class="login">
    <h1 class="nombre-pagina"> Nuevo Producto </h1>

<p class="descripcion-pagina"> Llena los campos para agregar un nuevo producto</p>

<?php include_once __DIR__ . '/../templates/barra.php';
        include_once __DIR__ . '/../templates/alertas.php'; 
?>

<form action="/crear" method="POST" class="formulario">
    <?php include_once __DIR__ . '/formulario.php'; ?>

<input type="submit" class="boton" value="Guardar producto">

</form>
</section>