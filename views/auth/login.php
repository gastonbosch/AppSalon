<h1 class="name-page">Inicia sesion</h1>
<p class="description-page">Inicia sesión con tus datos</p>
<?php include_once __DIR__.'/../templates/alerts.php'; ?>
<form class="form" method="POST" action="/">
    <div class="field">
        <label for="email">Email</label>
        <input type="email" id="email" placeholder="Tu e-mail" name="email">
    </div>

    <div class="field">
        <label for="password">Contraseña</label>
        <input type="password" id="password" placeholder="Tu contraseña" name="password">
    </div>

    <input type="submit" class="button" value="Inicia sesion">
</form>

<div class="actions">
    <a href="/createAccount">¿Aún no tienes una cuenta? Crea una</a>
    <a href="/forgetPassword">¿Olvidaste tu contraseña?</a>
</div>