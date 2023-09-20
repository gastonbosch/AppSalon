<h1 class="name-page">Panel de administrador</h1>

<?php

    use Model\Appointment;

    include __DIR__.'/../templates/bar.php';
?>

<h2>Buscar cita</h2>

<div class="search">
    <form class="form">
        <div class="field">
            <label for="date">Fecha</label>
            <input type="date" id="date" name="date" value="<?php echo $date; ?>">
        </div>
    </form>
</div>
<?php if(count($appointments) === 0){
    echo '<h2>Citas no encontradas para esta fecha</h2>';
} ?>
<div class="appointment-admin">
    <?php 
        $idAppointment = 0;
        foreach($appointments as $key => $appointment){ 
            if($idAppointment !== $appointment->id){
                $total = 0;
    ?>
                <ul class="appointment">
                    <li>
                        <p>ID: <span><?php echo $appointment->id; ?></span></p>
                        <p>Nombre: <span><?php echo $appointment->client; ?></span></p>
                        <p>Hora: <span><?php echo $appointment->time; ?></span></p>
                        <p>Email: <span><?php echo $appointment->email; ?></span></p>
                        <p>Telefono: <span><?php echo $appointment->telephone; ?></span></p>
                    </li> 
                </ul>
                <h3>Servicios</h3>
    <?php   };
            $idAppointment = $appointment->id; 
            $total += $appointment->price;
            ?>
            <p class="service"><?php echo $appointment->service." ".$appointment->price; ?></p>  
<?php 
    $current = $appointment->id;
    $next = $appointments[$key + 1]->id ?? 0;
    if($current <> $next){ ?>
        <p class="total">Total: <span><?php echo $total; ?></span></p> 
        <form action="/api/delete" method="POST">
            <input type="hidden" name="id" value="<?php echo $appointment->id; ?>">
            <input type="submit" class="button-delete" value="Borrar">
        </form>    
    <?php }; };?> 
</div>
<?php 
    $script = "<script src='build/js/searching.js'></script>";
?>