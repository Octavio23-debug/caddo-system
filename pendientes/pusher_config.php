<?php
// pusher_config.php

require __DIR__ . '/vendor/autoload.php'; // Incluye el autoloader de Composer

// Configuración de Pusher
$options = array(
    'cluster' => 'eu', // Cambia esto al clúster correcto
    'useTLS' => true
);

$pusher = new Pusher\Pusher(
    'APP_KEY', // Reemplaza con tu APP_KEY
    'APP_SECRET', // Reemplaza con tu APP_SECRET
    'APP_ID', // Reemplaza con tu APP_ID
    $options
);
