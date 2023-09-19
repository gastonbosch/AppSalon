<?php foreach($alerts as $key => $messages){ ?>
    <?php foreach($messages as $message){ ?>
        <div class="alert <?php echo $key; ?>"><?php echo $message;  ?></div>
    <?php }; ?>
<?php }; ?>