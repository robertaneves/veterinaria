<?php 
    spl_autoload_register(function ($nomeClasses) {
        $baseDir = __DIR__ .'/src/';

        $paths = [
            'controller/',
            'model/',
            'view/',
        ];

        foreach ($paths as $path) {
            $file = $baseDir . $path . $nomeClasses . '.php';
            if (file_exists($file)) {
                require_once $file;
                return;
                
        }
        
    } 
    });
?>