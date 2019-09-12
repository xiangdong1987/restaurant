<?php

declare(strict_types=1);

/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

use Hyperf\HttpServer\Router\Router;

Router::addRoute(['GET', 'POST', 'HEAD'], '/', 'App\Controller\IndexController@index');
Router::addRoute(['GET'], '/admin/{id}', 'App\Controller\AdminController@getsAdmin');
Router::addRoute(['PUT'], '/admin/', 'App\Controller\AdminController@addAdmin');
Router::addRoute(['POST'], '/admin/', 'App\Controller\AdminController@updateAdmin');
Router::addRoute(['DELETE'], '/admin/{id}', 'App\Controller\AdminController@deleteAdmin');

