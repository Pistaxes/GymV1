<div class="contenedor-carrito">
<h1> Tu carrito de la tienda</h1>
<h2> Bienvenido <span><?php echo $nombre; ?></span></h2>
<div class="productos" id='productos'>
    


</div>
<div class="resumen" id="resumen">

</div>

<form action="/pagar" method="post" id="payment-form" class="">
        <div>
            <label for="card-element">
                Introduce los detalles de tu tarjeta de crédito:
            </label>
            <div id="card-element" class="tarjeta">
                <!-- Elemento de tarjeta de Stripe -->
            </div>
            <!-- Se mostrarán errores aquí -->
            <div id="card-errors" role="alert"></div>
        </div>
        <br>
        <input type="text" name="monto" id="monto" class="monto"/>
        <button type="submit" class="boton">Pagar</button>
    </form>
                <?php 
    $script="
    <script src='build/js/carrito.js'></script>";
    
?>

</div>