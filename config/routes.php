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
//管理员
Router::addRoute(['GET'], '/admin/{id}', 'App\Controller\AdminController@getsAdmin');
Router::addRoute(['PUT'], '/admin/', 'App\Controller\AdminController@addAdmin');
Router::addRoute(['DELETE'], '/admin/{id}', 'App\Controller\AdminController@deleteAdmin');
Router::addRoute(['POST','SAVE'], '/admin/', 'App\Controller\AdminController@updateAdmin');
//登陆
Router::addRoute(['POST', 'GET'], '/user/login', 'App\Controller\AdminController@loginAdmin');
Router::addRoute(['GET'], '/user/info', 'App\Controller\AdminController@userInfo');
Router::addRoute(['POST'], '/user/logout', 'App\Controller\AdminController@logout');
//普通上传
Router::addRoute(['POST'], '/common/upload', 'App\Controller\CommonController@upload');


