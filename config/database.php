<?php
/**
 * 数据库配置
 * User: cauchy
 * Date: 2018/9/19
 * Time: 下午7:42
 */
return [
    'mysql' => [
        'clusterOne' => [
            'database' => 'test_db',
            'username' => 'root',
            'password' => 'root',
            'charset'  => 'utf8mb4',
            'collation'=> 'utf8mb4_unicode_ci',
            'prefix'   => '',
            'strict'   => true,
            'hosts'    => [
                [
                    'host' => '127.0.0.1',
                    'port' => '3306',
                ],
            ],
        ],
    ],

    'redis' => [
        'clusterOne' => [
            'database' => 'test_redis',
            'password' => '12345678',
            'hosts' => [
                [
                    'host' => '127.0.0.1',
                    'port' => '6379',
                ],
            ],
        ],
    ],
];