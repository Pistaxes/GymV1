<h1 class="login-title">Login</h1>

<p class="welcome">Bienvenido a X Fit Gym</p>

<?php include_once __DIR__ . '/../templates/alertas.php'; ?>

<div class="container-form">
    <form class="formulario" method="POST" action="/login">
    
    <div class="campo">
        <label for="email">Email</label>
        <input type="email" id="email" name='email' placeholder="Tu Email"/>
    </div>
    <div class="campo">
        <label for="password">Contraseña</label>
        <input type="password" id="password" name='password' placeholder="Tu Contraseña"/>
    </div>
        <input type="submit" class="boton" value="Iniciar Sesion"> 
    </form>
</div>

<div class="acciones">
    <a href="/crear-cuenta">Aun no tienes una cuenta? Crea una</a>
    <a href="/olvide"> olvidaste tu contraseña?</a>
</div>
