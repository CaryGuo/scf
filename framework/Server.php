<?php
/**
 * Created by PhpStorm.
 * User: cauchy
 * Date: 2018/9/19
 * Time: 上午11:40
 */

namespace framework;

use Noodlehaus\Config;
use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\Http\Server as SwooleServer;

class Server
{
    protected $config;

    public function __construct()
    {

    }

    public function init()
    {
        $this->initPathInfo();
        $this->initAutoload();
        $this->initService();
        $this->initConfig();
        var_dump(dirname(__FILE__)); die;
    }

    public function initPathInfo() {
//        defined('ROOT_PATH', );
    }


    /**
     * 注册命名空间及composer
     * register framework and composer namespace
     * @param  void
     * @return void
     */
    public function initAutoload()
    {
        spl_autoload_register(function ($className) {
            if (false != ($lastNsPos = strripos($className, '\\'))) { // 0 is same for false
                $namespace = substr($className, 0, $lastNsPos);
                $className = substr($className, $lastNsPos + 1);
                $fileName = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR . $className . '.php';
                include $fileName;
            }
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

    public function initConfig() {
        // $this->config = Config::load();
    }
}