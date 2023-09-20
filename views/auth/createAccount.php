<h1 class="name-page">Crear cuenta</h1>
<p class="description-page">Complete el siguiente formulario para crear una cuenta</p>
<?php include_once __DIR__.'/../templates/alerts.php'; ?>
<form class="form" method="POST" action="/createAccount">
    <div class="field">
        <label for="name">Nombre</label>
        <input type="text" id="name" placeholder="Tu nombre" name="name" value="<?php echo s($user->name); ?>">
    </div>
    <div class="field">
        <label for="surname">Apellido</label>
        <input type="text" id="surname" placeholder="Tu apellido" name="surname" value="<?php echo s($user->surname); ?>">
    </div>
    <div class="field">
        <label for="telephone">Telefono</label>
        <input type="tel" id="telephone" placeholder="Tu telefono" name="telephone" value="<?php echo s($user->telephone); ?>">
    </div>
    <div class="field">
        <label for="email">Email</label>
        <input type="email" id="email" placeholder="Tu e-mail" name="email" value="<?php echo s($user->email); ?>">
    </div>

    <div class="field">
        <label for="password">Contraseña</label>
        <input type="password" id="password" placeholder="Tu contraseña" name="password">
    </div>
    <input type="submit" class="button" value="Crear cuenta">
</form>

<div class="actions">
    <a href="/">¿Ya has creado una cuenta? Inicia sesion</a>
    <a href="/forgetPassword">¿Olvidaste tu contraseña?</a>
</div>