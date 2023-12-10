<header>
        <div class="logo">
            <img src="../../build/img/Logo completo (letras negras).png"></img>
        </div>
        <nav class="menu">
            <li class="<?php ?>"><a href="/">Inicio</a></li>
            <li class="<?php ?>" ><a href="/producto">Productos</a></li>
            <li class="<?php ?>"><a href="/nosotros">Nosotros</a></li>
            <li class="<?php ?>"><a href="/contacto">Contacto</a></li>
            <?php 
            if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
    // Si el usuario está autenticado, muestra el enlace "Desconectarse"
    echo '<a href="/logout">Desconectarse</a>';
    } else {
    // Si el usuario no está autenticado, muestra el enlace "Iniciar sesión"
    echo '<a href="/login">Iniciar sesión</a>';
        }?>
        </nav>
</header>