<?php echo $this->Session->flash(); ?>
<?php echo $this->Session->flash('Auth'); ?>
<?php echo $this->fetch('content'); ?>
<?php
$script = <<<JS
        alert("toasted");
JS;
$this->Js->buffer($script);
$this->Js->writeBuffer();


