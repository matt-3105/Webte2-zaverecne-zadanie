<?php

use Workerman\Worker;

require_once __DIR__ . '/vendor/autoload.php';

$context = [
    'ssl' => [
        'local_cert' => "/home/xminarikt1/webte.fei.stuba.sk-chain-cert.pem",
        'local_pk' => "/home/xminarikt1/webte.fei.stuba.sk.key",
        'verify_peer' => false
    ]
];

$GLOBALS['currentID'] = 0;
$GLOBALS['users'] = [];
$GLOBALS['data'] = [];

// Create a Websocket server
$ws_worker = new Worker('websocket://0.0.0.0:9001', $context);

$GLOBALS['worker'] = $ws_worker;

$ws_worker->transport = 'ssl';

// Emitted when new connection come
$ws_worker->onConnect = function ($connection) {
    $connection->send(json_encode(['type' => 'connected', 'users' => $GLOBALS['users']]));
    echo 'connected ';
};

$ws_worker->onMessage = function($connection, $msg){
    $data = json_decode($msg, true);
    switch ($data['type']){
        case 'create':
            $newUser = ['name' => $data['name'], 'id' => $GLOBALS['currentID']];
            $GLOBALS['data'][$GLOBALS['currentID']] = ['t' => [], 'x' => [], 'r' => [], 'joined' => []];
            array_push($GLOBALS['users'], $newUser);
            $connection->send(json_encode(['type' => 'created', 'id' => $GLOBALS['currentID']]));
            foreach($GLOBALS['worker']->connections as $connection)
            {
                $connection->send(json_encode(['type' => 'newUser', 'user' => $newUser]));
            }
            $GLOBALS['currentID']++;
            break;
        case 'append':
            $GLOBALS['data'][$data['id']]['t'] = array_merge($GLOBALS['data'][$data['id']]['t'], $data['t']);
            $GLOBALS['data'][$data['id']]['x'] = array_merge($GLOBALS['data'][$data['id']]['x'], $data['x']);
            $GLOBALS['data'][$data['id']]['r'] = array_merge($GLOBALS['data'][$data['id']]['r'], $data['r']);
            foreach ($GLOBALS['data'][$data['id']]['joined'] as $joined){
                $joined->send(json_encode(['type' => 'append', 'data' => ['t' => $data['t'], 'x' => $data['x'], 'r' => $data['r']]]));
            }
            break;
        case 'join':
            array_push($GLOBALS['data'][$data['id']]['joined'], $connection);
            $connection->send(json_encode(['type' => 'joined', 'data' => ['t' => $GLOBALS['data'][$data['id']]['t'], 'x' => $GLOBALS['data'][$data['id']]['x'], 'r' => $GLOBALS['data'][$data['id']]['r']]]));
            break;
        case 'play':
            foreach ($GLOBALS['data'][$data['id']]['joined'] as $joined){
                $joined->send(json_encode(['type' => 'play']));
                echo 'send';
            }
            break;
    }
};

// Run worker
Worker::runAll();
