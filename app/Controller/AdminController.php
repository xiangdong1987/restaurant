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

use App\Model\Admin;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\HttpServer\Contract\RequestInterface;

class AdminController extends Controller
{
    public function index()
    {
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();

        return [
            'method' => $method,
            'message' => "Hello {$user}.",
        ];
    }

    public function getsAdmin(int $id, ResponseInterface $response)
    {
        $user = [];
        if ($id) {
            $user = Admin::query()->where('uid', $id)->first();
        } else {
            $user = Admin::query()->simplePaginate();
        }

        return $response->json($user);
    }

    public function addAdmin(RequestInterface $request, ResponseInterface $response)
    {
        $admin = new Admin();
        $data = $request->all();
        $data['password'] = md5($data['password']);
        if ($admin->fill($data)->save()) {
            $result['code'] = 0;
            return $response->json($result);
        } else {
            $result['code'] = 1;
            return $response->json($result);
        }
    }

    public function deleteAdmin(int $id, ResponseInterface $response)
    {
        if ($id) {
            if (Admin::query()->where('uid', $id)->delete()) {
                $result['code'] = 0;
            } else {
                $result['code'] = 1;
            }
        }
        return $response->json($result);
    }
    public function updateAdmin(int $uid){

    }
}
