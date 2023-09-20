<div class="bar">
    <p>Hola <?php echo $name ?? ''; ?></p>
    <a class="button" href="/logout">Cerrar sesion</a>
</div>

<?php if(isset($_SESSION['admin'])){ ?>
    <div class="bar-services">
        <a class="button" href="/admin">Ver citas</a>
        <a class="button" href="/services">Ver servicios</a>
        <a class="button" href="/services/create">Nuevo servicio</a>
    </div>
<?php } ?>