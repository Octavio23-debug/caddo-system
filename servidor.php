<?php
require 'vendor/autoload.php';

$options = [
    'cluster' => 'eu',
    'useTLS' => true
];
$pusher = new Pusher\Pusher(
    'APP_KEY', 
    'APP_SECRET', 
    'APP_ID', 
    $options
);

$data = ['pendiente' => 'Nuevo pendiente asignado'];
$pusher->trigger('my-channel', 'my-event', $data);
?>
