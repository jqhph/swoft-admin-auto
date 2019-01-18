<?php
/*
 * This file is part of Swoft.
 * (c) Swoft <group@swoft.org>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [
    'debugHandler' => [
        'class' => \Swoft\Admin\Debugger\DebugHandler::class,
    ],
    'noticeHandler'      => [
        'class'     => \Swoft\Log\FileHandler::class,
        'logFile'   => '@runtime/logs/notice.log',
        'formatter' => '${lineFormatter}',
        'levels'    => [
            \Swoft\Log\Logger::NOTICE,
            \Swoft\Log\Logger::INFO,
//            \Swoft\Log\Logger::DEBUG,
            \Swoft\Log\Logger::TRACE,
        ],
    ],
    'applicationHandler' => [
        'class'     => \Swoft\Log\FileHandler::class,
        'logFile'   => '@runtime/logs/error.log',
        'formatter' => '${lineFormatter}',
        'levels'    => [
            \Swoft\Log\Logger::ERROR,
            \Swoft\Log\Logger::WARNING,
        ],
    ],
    'logger' => [
        'class' => \Swoft\Admin\Debugger\Logger::class,
        'name'          => APP_NAME,
        'enable'        => env('LOG_ENABLE', true),
        'flushInterval' => 100,
        'flushRequest'  => true,
        'handlers'      => [
            '${debugHandler}',
            '${noticeHandler}',
            '${applicationHandler}',
        ],
    ],
];
