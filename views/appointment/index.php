<h1 class="name-page">Create new Appointment</h1>
<p class="description-page">Choose your services below and entre your data</p>
<?php 
    include __DIR__.'/../templates/bar.php';
?>
<div id="app">
    <!--En HTML5 uno puede crear sus atributos de etiquetas personalizados, tan solo anteponiendo
    'data-' y luego se completa el nombre y se agrega un valor, es este caso mi atrobuto se llama
    'data-step'.-->
    <nav class="tabs">
        <button class="current" type="button" data-step="1">Services</button>
        <button type="button" data-step="2">Appointment Information</button>
        <button type="button" data-step="3">Summary</button>
    </nav>
    <div id="step-1" class="section">
        <h2>Services</h2>
        <p class="text-center">Choose your service below</p>
        <div id="services" class="list-services"></div>
    </div>
    <div id="step-2" class="section">
        <h2>Your data and appointment</h2>
        <p class="text-center">Enter your data and date of yout appointment</p>

        <form class="form">
            <div class="field">
                <label for="name">Name</label>
                <input type="text" id="name" placeholder="Your name" value="<?php echo $name; ?>" disabled>
            </div>
            <div class="field">
                <label for="date">Date</label>
                <!--La funcion strtotime('+1 day') suma un dia a la fecha-->
                <input type="date" id="date" min="<?php echo date('Y-m-d',strtotime('+1 day')); ?>">
            </div>
            <div class="field">
                <label for="hour">Hour</label>
                <input type="time" id="hour">
            </div>
            <input type="hidden" id="id" value="<?php echo $id; ?>">
        </form>

    </div>
    <div id="step-3" class="section content-summary">
        <h2>Summary</h2>
        <p class="text-center">Verify that the information is correct</p>
        <div id="services" class="list-services"></div>
    </div>
    <div class="pagination">
        <button class="button" id="previous">&laquo; Previous</button>
        <button class="button" id="next">Next &raquo;</button>
    </div>
</div>
<?php 
    $script = "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script src='build/js/app.js'></script>";
?>