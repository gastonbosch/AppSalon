<h1 class="name-page">Update Service</h1>
<p class="descripcion-page">Update the service</p>

<?php 
    //include_once __DIR__.'/../templates/bar.php';
    include_once __DIR__.'/../templates/alerts.php' 
?>

<form method="POST" class="form">
    <?php include __DIR__.'/form.php'; ?>
    <input type="submit" class="button" value="Update">
</form>