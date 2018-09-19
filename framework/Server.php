<?php
/**
 * Created by PhpStorm.
 * User: cauchy
 * Date: 2018/9/19
 * Time: 上午11:40
 */

namespace framework;

use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\Http\Server as SwooleServer;

class Server
{
    public function __construct()
    {

    }

    public function init()
    {
        $this->registerAutoload();
    }

    /**
     * 注册命名空间及composer
     * @param  void
     * @return void
     */
    public function registerAutoload()
    {
        spl_autoload_register(function ($className) {

        });
        include_once '../vendor/autoload.php';
    }

    /**
     * 初始化服务
     * @param  void
     * @return void
     */
    public function initService() {
        $http = new SwooleServer('127.0.0.1', 9001);

        $http->on("request", function (Request $request, Response $response) {
            $response->header("Content-Type", "text/plain");
            $response->end("Hello World\n");
        });

        $http->start();
    }
}