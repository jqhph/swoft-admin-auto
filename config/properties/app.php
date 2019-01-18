<?php

/*
 * This file is part of Swoft.
 * (c) Swoft <group@swoft.org>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [
    'env'          => env('APP_ENV', 'test'),
    'debug'        => env('APP_DEBUG', true),
    'version'      => '1.0',
    'autoInitBean' => true,
    'bootScan'     => [
        'App\Commands',
        'App\Boot',

        'Swoft\Admin\Controllers',
        'Swoft\Admin\Bootstrap',
        'Swoft\Admin\Console',

        'Swoft\Admin\Menu\Controllers',
        'Swoft\Admin\Menu\Models',
        'Swoft\Admin\Menu\Repositories',
    ],
    'excludeScan'  => [

    ],
    'I18n'         => [
        'sourceLanguage' => '@root/resources/messages/',
    ],
    'db'           => require __DIR__ . DS . 'db.php',
    'cache'        => require __DIR__ . DS . 'cache.php',
    'service'      => require __DIR__ . DS . 'service.php',
    'breaker'      => require __DIR__ . DS . 'breaker.php',
    'provider'     => require __DIR__ . DS . 'provider.php',
    'components' => [
        'custom' => [
            'Swoft\\Admin\\',
            'Swoft\\Blade\\',
        ],
    ],        
    /*
     | 静态资源帮助工具配置
     |
     */
    'assets' => [
        // 静态资源域名配置
        'resource-server' => '',

        // js文件请求后缀
        'js-version' => '',

        // css文件请求后缀
        'css-version' => '',

        // 静态资源别名配置
        'alias' => [

        ],
    ],

    /*
     | blade 模板引擎配置
     */
    'blade-view'   => [
        'path'     => '@root/resources/views',
        'compiled' => '@root/runtime/views',
        // 视图命名空间
        'namespaces' => [

        ],
    ],
    
    'admin' => require __DIR__ . '/admin.php',
];
