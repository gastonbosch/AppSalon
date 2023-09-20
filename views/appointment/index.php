<h1 class="name-page">Crear nueva cita</h1>
<p class="description-page">Elige tus servicios a continuación e introduce tus datos</p>
<?php 
    include __DIR__.'/../templates/bar.php';
?>
<div id="app">
    <!--En HTML5 uno puede crear sus atributos de etiquetas personalizados, tan solo anteponiendo
    'data-' y luego se completa el nombre y se agrega un valor, es este caso mi atrobuto se llama
    'data-step'.-->
    <nav class="tabs">
        <button class="current" type="button" data-step="1">Servicios</button>
        <button type="button" data-step="2">Información de la cita</button>
        <button type="button" data-step="3">Resumen</button>
    </nav>
    <div id="step-1" class="section">
        <h2>Servicios</h2>
        <p class="text-center">Elija su servicio a continuación</p>
        <div id="services" class="list-services"></div>
    </div>
    <div id="step-2" class="section">
        <h2>Tus datos y cita</h2>
        <p class="text-center">Ingresa tus datos y fecha de tu cita</p>

        <form class="form">
            <div class="field">
                <label for="name">Nombre</label>
                <input type="text" id="name" placeholder="Tu nombre" value="<?php echo $name; ?>" disabled>
            </div>
            <div class="field">
                <label for="date">Fecha</label>
                <!--La funcion strtotime('+1 day') suma un dia a la fecha-->
                <input type="date" id="date" min="<?php echo date('Y-m-d',strtotime('+1 day')); ?>">
            </div>
            <div class="field">
                <label for="hour">Hora</label>
                <input type="time" id="hour">
            </div>
            <input type="hidden" id="id" value="<?php echo $id; ?>">
        </form>

    </div>
    <div id="step-3" class="section content-summary">
        <h2>Resumen</h2>
        <p class="text-center">Valide que la información sea correcta</p>
        <div id="services" class="list-services"></div>
    </div>
    <div class="pagination">
        <button class="button" id="previous">&laquo; Anterior</button>
        <button class="button" id="next">Siguiente &raquo;</button>
    </div>
</div>
<?php 
    $script = "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script src='build/js/app.js'></script>";
?>