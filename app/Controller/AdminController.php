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
        if ($id) {
            $user = Admin::query()->where('uid', $id)->first();
        } else {
            $user = Admin::query()->simplePaginate();
        }

        return $user;
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

    public function updateAdmin(int $uid)
    {

    }

    public function loginAdmin()
    {
        $username = $this->request->input('username');
        $password = $this->request->input('password');
        if (!$username) {
            $result["code"] = 1000;
            $result["message"] = "用户名不能为空";
            return $result;
        }
        if (!$password) {
            $result["code"] = 1001;
            $result["message"] = "密码不能为空";
            return $result;
        }
        //判断用户名密码
        $user = Admin::query()->where('username', $username)->where('password', md5($password))->first();
        if ($user) {
            $result["code"] = 20000;
            $result["token"] = "admin-token";
        } else {
            $result["code"] = 1003;
            $result["message"] = "用户不存在";
        }
        return $result;
    }
}
