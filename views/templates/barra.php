<div class="barra">
    <p>
        Hola: <?php echo $nombre ?? '' ?>
    </p>
    <a class="boton" href="/logout"> Cerrar Sesion</a>
</div>

<?php if(isset($_SESSION['admin'])){ ?>
        <div class="barra-servicios">
            <a class="boton" href="/grafica"> Ver Cita </a>
            <a class="boton" href="/productos">Ver Productos</a>
            <a class="boton" href="/crear"> Crear Productos</a>



        </div>
   <?php } ?>