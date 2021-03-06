<?php
/**
 * Created by PhpStorm.
 * User: cauchy
 * Date: 2018/9/19
 * Time: 上午11:40
 */

namespace framework;

use Noodlehaus\Config;
use Noodlehaus\Exception\EmptyDirectoryException;
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
        $this->initConfig();
        $this->initService();
    }

    public function initPathInfo() {
        define('ROOT_PATH', dirname(dirname(__FILE__)));
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
        include_once ROOT_PATH . '/vendor/autoload.php';
    }

    /**
     * 初始化config
     * init config module
     * @param  void
     * @return void
     */
    public function initConfig() {
        try{
            $this->config = new Config(ROOT_PATH . '/config');
        }catch (EmptyDirectoryException $exception) {
            echo $exception->getTrace();
            die;
        }
    }

    /**
     * 初始化服务
     * init server
     * @param  void
     * @return void
     */
    public function initService() {
        $http = new SwooleServer($this->config['server'], 9001);

        $http->on("request", function (Request $request, Response $response) {
            $response->header("Content-Type", "text/plain");
            $response->end("Hello World\n");
        });

        $http->start();
    }


}