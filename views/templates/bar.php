<div class="bar">
    <p>Hola <?php echo $name ?? ''; ?></p>
    <a class="button" href="/logout">Logout</a>
</div>

<?php if(isset($_SESSION['admin'])){ ?>
    <div class="bar-services">
        <a class="button" href="/admin">See appointment</a>
        <a class="button" href="/services">See services</a>
        <a class="button" href="/services/create">New service</a>
    </div>
<?php } ?>