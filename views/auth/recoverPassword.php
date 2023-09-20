<h1 class="name-page">Recuperar contraseña</h1>
<p class="description-page">Ingrese su nueva contraseña</p>
<?php include_once __DIR__.'/../templates/alerts.php'; ?>
<?php if($error) return; ?>
<form class="form" method="POST">
    <div class="field">
        <label for="password">Contraseña</label>
        <input type="password" id="password" placeholder="Tu nueva contraseña" name="password">
    </div>
    <input type="submit" class="button" value="Guardar nueva contraseña">
</form>

<div class="actions">
    <a href="/">¿Ya has creado una cuenta? Inicia ssesion</a>
    <a href="/createAccount">¿Aún no tienes una cuenta? Crea una</a> 
</div>