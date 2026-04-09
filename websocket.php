<?php
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use React\EventLoop\Factory;
use React\Socket\Server as ReactSocket;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

require 'vendor/autoload.php';

class WebSocketServer implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
        echo "Cliente conectado ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        // Aquí puedes manejar mensajes recibidos desde clientes WebSocket si quieres
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
        echo "Cliente desconectado ({$conn->resourceId})\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "Error: {$e->getMessage()}\n";
        $conn->close();
    }

    // Método público para enviar datos a todos los clientes
    public function broadcast($data) {
        foreach ($this->clients as $client) {
            $client->send($data);
        }
    }

    // Enviar actualizaciones automáticas periódicas
    public function enviarActualizacion() {
        if ($this->clients->count() > 0) {
            $data = json_encode([
                "hora" => date("H:i:s"),
                "mensaje" => "Actualización automática"
            ]);
            $this->broadcast($data);
        }
    }
}

// Crear loop ReactPHP
$loop = Factory::create();

// Instancia del servidor WebSocket
$server = new WebSocketServer();

// Crear socket WebSocket para clientes externos en puerto 8080
$socket = new ReactSocket('0.0.0.0:8080', $loop);

$ioServer = new IoServer(
    new HttpServer(
        new WsServer($server)
    ),
    $socket,
    $loop
);

// Crear socket TCP interno para recibir mensajes de PHP en 127.0.0.1:8090
$internalSocket = new ReactSocket('127.0.0.1:8090', $loop);

$internalSocket->on('connection', function ($conn) use ($server) {
    $conn->on('data', function ($data) use ($server, $conn) {
        // Reenviar mensaje recibido a todos los clientes WebSocket
        $server->broadcast($data);
        $conn->end(); // Cierra la conexión TCP interna
    });
});

// Temporizador para enviar actualizaciones automáticas cada 5 segundos
$loop->addPeriodicTimer(5, function () use ($server) {
    $server->enviarActualizacion();
});

echo "Servidor WebSocket en ejecución en ws://0.0.0.0:8080\n";
echo "Socket interno TCP en ejecución en tcp://127.0.0.1:8090\n";

$loop->run();