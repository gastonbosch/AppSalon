<h1 class="name-page">Modificar servicio</h1>
<p class="descripcion-page">Modificar el servicio</p>

<?php 
    //include_once __DIR__.'/../templates/bar.php';
    include_once __DIR__.'/../templates/alerts.php' 
?>

<form method="POST" class="form">
    <?php include __DIR__.'/form.php'; ?>
    <input type="submit" class="button" value="Modificar">
</form>