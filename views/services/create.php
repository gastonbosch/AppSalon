<h1 class="name-page">Crear servisio</h1>
<p class="descripcion-page">Crear un nuevo servicio</p>

<?php 
    //include_once __DIR__.'/../templates/bar.php';
    include_once __DIR__.'/../templates/alerts.php' 
?>

<form action="/services/create" method="POST" class="form">
    <?php include __DIR__.'/form.php'; ?>
    <input type="submit" class="button" value="Guardar">
</form>