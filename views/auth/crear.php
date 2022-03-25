<div class="contenedor crear">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Crea tu cuenta en UpTask</p>

        <form action="/crear" method="post" class="formulario">
            <div class="campo">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" placeholder="Tu Nombre">
            </div>
            
            <div class="campo">
                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" placeholder="Tu E-mail">
            </div>

            <div class="campo">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" placeholder="Tu Password">
            </div>

            <div class="campo">
                <label for="password2">Repetir Password:</label>
                <input type="password" name="password2" id="password2" placeholder="Repite tu Password">
            </div>

            <input type="submit" value="Crear Cuenta" class="boton">
        </form>

        <div class="acciones">
            <a href="/">¿Ya tienes una cuenta? Iniciar Sesión</a>
            <a href="/olvide">¿Olvidaste tu Contraseña?</a>
        </div>

    </div>
</div>