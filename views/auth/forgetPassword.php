<h1 class="name-page">Olvide mi contraseña</h1>
<p class="description-page">Restablece tu contraseña escribiendo tu correo a continuación</p>
<?php include_once __DIR__.'/../templates/alerts.php'; ?>
<form class="form" method="POST" action="/forgetPassword">
    <div class="field">
        <label for="email">Email</label>
        <input type="email" id="email" placeholder="Tu e-mail" name="email">
    </div>

    <input type="submit" class="button" value="Enviar">
</form>

<div class="actions">
    <a href="/">¿Ya has creado una cuenta? Inicia sesion</a>
    <a href="/createAccount">¿Aún no tienes una cuenta? Crea una</a>
</div>