<h1 class="login-title">Olvidaste tu contraseña</h1>

<p class="welcome">Ingresa tu correo </p>
<?php include_once __DIR__ . '/../templates/alertas.php'; ?>
    <form class="formulario" method="POST" action="/olvide">
    
    <div class="campo">
        <label for="email">Email</label>
        <input 
        type="email"
        name="email" 
        id="email"
        placeholder="Tu Correo"
    />
    </div>
        <input type="submit" class="boton" value="Enviar Instrucciones"> 
    </form>


<div class="acciones">
    <a href="/crear-cuenta">Aun no tienes una cuenta? Crea una</a>
    <a href="/login"> Ya tienes una cuenta? Inicia Sesion</a>
</div>
