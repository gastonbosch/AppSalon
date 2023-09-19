<h1 class="name-page">Create Service</h1>
<p class="descripcion-page">Create a new service</p>

<?php 
    //include_once __DIR__.'/../templates/bar.php';
    include_once __DIR__.'/../templates/alerts.php' 
?>

<form action="/services/create" method="POST" class="form">
    <?php include __DIR__.'/form.php'; ?>
    <input type="submit" class="button" value="Save">
</form>