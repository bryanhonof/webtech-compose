<?php

require_once __DIR__ . '/lib/router.php';

get('/', 'views/index.php');

get('/api/db-status', function () {
    require_once __DIR__ . '/lib/lib.php';
    $pdo = $connectToPostgres();
    $status = $pdo->getAttribute(PDO::ATTR_CONNECTION_STATUS);
    echo json_encode($status);
});

get('/api/temperature', function () {
    require_once __DIR__ . '/lib/lib.php';
    date_default_timezone_set('Europe/Brussels');
    $begin = $_GET['begin'] ?? null;
    $end = $_GET['end'] ?? date('Y-m-d H:i:s');
    $between = $begin ? ' where datetime between ? and ? ' : ' ';
    $query = 'select * from temperature' . $between . 'limit 50';
    $bindings = $begin ? [$begin, $end] : [ ];
    handleRequest($connectToPostgres, $query, $bindings, $HTTP_OK);
});

get('/api/temperature/$id', function ($id) {
    require_once __DIR__ . '/lib/lib.php';
    $query = 'select * from temperature where id = ?';
    $bindings = [$id];
    handleRequest($connectToPostgres, $query, $bindings, $HTTP_OK);
});

post('/api/temperature', function () {
    require_once __DIR__ . '/lib/lib.php';
    $query = 'insert into temperature (value) values (?) returning id';
    $value = json_decode(file_get_contents('php://input'), true)['value'];
    $bindings = [$value];
    handleRequest($connectToPostgres, $query, $bindings, $HTTP_CREATED);
});

$putAndPatchFunction = function ($id) {
    require_once __DIR__ . '/lib/lib.php';
    $query = 'update temperature set value = ? where id = ? returning *';
    $value = json_decode(file_get_contents('php://input'), true)['value'];
    $bindings = [$value, $id];
    handleRequest($connectToPostgres, $query, $bindings, $HTTP_OK);  
};
put('/api/temperature/$id', $putAndPatchFunction);
patch('/api/temperature/$id', $putAndPatchFunction);

delete('/api/temperature/$id', function ($id) {
    require_once __DIR__ . '/lib/lib.php';
    $query = 'delete from temperature where id = ? returning *';
    $bindings = [$id];
    handleRequest($connectToPostgres, $query, $bindings, $HTTP_OK);
});

any('/404', 'views/404.php');
