<?php

set_time_limit(0);

$http = new swoole_http_server("127.0.0.1", 9001);



$http->on("start", function ($server) {
    echo "Swoole http framework is started at http://127.0.0.1:9001\n";
});

$http->on("request", function ($request, \Swoole\Http\Response $response) {
    $response->header("Content-Type", "text/plain");
    $response->end("Hello World\n");
});

$http->start();
