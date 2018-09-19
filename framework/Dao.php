<?php
/**
 * Created by PhpStorm.
 * User: cauchy
 * Date: 2018/9/19
 * Time: 下午2:43
 */

namespace framework;


use Medoo\Medoo;

class Dao
{
    private static $_instance = [];



    /**
     * 获取实例 单例
     * @param string $name
     * @return Medoo
     */
    public static function getInstance($name = 'default') {
        if (empty(self::$_instance[$name])) {
            $config = foo($name); // todo
            self::$_instance[$name] = new Medoo($config);
        }
        return self::$_instance[$name];
    }

}