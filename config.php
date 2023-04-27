<?php
#Realizando o autoload com  SPL
spl_autoload_register(function($class_name){

    $arquivo = $class_name.".php";
    if (file_exists($arquivo)) {
        # code...
        require_once($arquivo);
    }
});

?>