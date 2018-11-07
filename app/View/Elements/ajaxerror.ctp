<?php
$script = <<<JS
        toastr.info("test");
JS;
        
$this->Js->buffer($script);       