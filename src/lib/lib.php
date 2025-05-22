<?php

$HTTP_OK = 200;
$HTTP_CREATED = 201;

$connectToPostgres = function () {
    $dbHost = $_ENV['DB_HOST'];
    $dbPort = $_ENV['DB_PORT'];
    $dbName = $_ENV['DB_NAME'];
    $dbUser = $_ENV['DB_USER'];
    $dbPassword = $_ENV['DB_PASSWORD'];

    $dsn = "pgsql:host={$dbHost};port={$dbPort};dbname={$dbName}";
    return new PDO($dsn, $dbUser, $dbPassword);
};

function handleRequest($connectToDBFun, $query, $bindings, $httpSuccessCode = 200)
{
    $pdo = $connectToDBFun();

    $pdo->beginTransaction();
    $statement = $pdo->prepare($query);
    $statement->execute($bindings);
    $pdo->commit();
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json; charset=utf-8');
    http_response_code($httpSuccessCode);
    echo json_encode($results);
}

?>
