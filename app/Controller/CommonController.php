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

use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\HttpServer\Contract\RequestInterface;

class CommonController extends Controller
{
    public function upload()
    {
        $url = "http://localhost:9501";
        if ($this->request->hasFile('file')) {
            $file = $this->request->file('file');
            if ($file->isValid()) {
                $now = date("YmdHis");
                $path = $file->getPath();
                $ext = $extension = $file->getExtension();
                $name = $now . "_" . md5($path) . "." . $ext;
                $file->moveTo("/data/restaurant/static/" . $name);
                if ($file->isMoved()) {
                    return $this->returnSuccess(['url' => $url . "/" . $name]);
                } else {
                    $this->returnError(1009, "移动文件失败");
                }
            } else {
                $this->returnError(1008, "无效文件");
            }
        } else {
            $this->returnError(1007, "文件不存在");
        }
    }
}
