<h1 class="name-page">Services</h1>
<p class="descripcion-page">Services List</p>

<?php include __DIR__.'/../templates/bar.php' ?>

<ul class="service">
    <?php foreach($services as $service){ ?>
        <li>
            <p>Name: <span><?php echo $service->name; ?></span></p>
            <p>Price: <span>$<?php echo $service->price; ?></span></p>
            <div class="actions">
                <a class="button" href="/services/update?id=<?php echo $service->id; ?>">Update</a>
                <form action="/services/delete" method="POST">
                    <input type="hidden" name="id" value="<?php echo $service->id; ?>">
                    <input type="submit" value="Delete" class="button-delete">
                </form>
            </div>
        </li>
    <?php }; ?>
</ul>
