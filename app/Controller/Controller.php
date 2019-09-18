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

namespace App\Controller;

use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Psr\Container\ContainerInterface;

abstract class Controller
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var ResponseInterface
     */
    protected $response;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->request = $container->get(RequestInterface::class);
        $this->response = $container->get(ResponseInterface::class);
    }

    public function returnSuccess($data = null){
        $response = array(
            'code' => 0
        );
        !is_null($data) && $response['data'] = $data;
        return $this->response->json($response);
    }

    public function returnError($code = 400, $msg = null, $data = null){
        $response = array(
            'code' => $code
        );
        !is_null($msg) && $response['msg'] = $msg;
        !is_null($data) && $response['data'] = $data;
        return $this->response->json($response);
    }
}
