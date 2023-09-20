<h1 class="name-page">Servicios</h1>
<p class="descripcion-page">Lista de servicios</p>

<?php include __DIR__.'/../templates/bar.php' ?>

<ul class="service">
    <?php foreach($services as $service){ ?>
        <li>
            <p>Nombre: <span><?php echo $service->name; ?></span></p>
            <p>Precio: <span>$<?php echo $service->price; ?></span></p>
            <div class="actions">
                <a class="button" href="/services/update?id=<?php echo $service->id; ?>">Modificar</a>
                <form action="/services/delete" method="POST">
                    <input type="hidden" name="id" value="<?php echo $service->id; ?>">
                    <input type="submit" value="Borrar" class="button-delete">
                </form>
            </div>
        </li>
    <?php }; ?>
</ul>
