<h1 class="login-title">Recuperar  contraseña</h1>

<p class="welcome">Ingresa tu nueva contraseña</p>

<?php include_once __DIR__ . '/../templates/alertas.php'; ?>
<?php if($error) return; ?>
<form class="formulario" method="POST" >
    
    <div class="campo">
        <label for="password">Contraseña</label>
        <input 
        type="password" 
        name="password"
        id="password" 
        placeholder="Tu Contraseña"/>
    </div>
        <input type="submit" class="boton" value="Guardar Contraseña"> 
    </form>

<div class="acciones">
    <a href='/login'> Iniciar Sesion</a> 
    
</div>
