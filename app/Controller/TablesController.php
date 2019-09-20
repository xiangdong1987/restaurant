<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Tables;
use Hyperf\HttpServer\Annotation\Controller as AnnoController;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

/**
 * @AnnoController()
 */
class TablesController extends Controller
{
    /**
     * @GetMapping(path="index")
     */
    public function index(RequestInterface $request, ResponseInterface $response)
    {
        $mTable = new Tables();
        $page = $mTable->query()->where('status', Tables::STATUS_normal)->paginate(10)->toArray();
        $data['total'] = $page['total'];
        $data['items'] = $mTable->formatList($page['data']);
        return $this->returnSuccess($data);
    }

    public function get(int $id)
    {
        $mTable = new Tables();
        $info = $mTable->query()->where('id', $id)->first()->toArray();
        $data = $info;
        return $this->returnSuccess($data);

    }

    /**
     * @RequestMapping(path="createTable", methods="get,post")
     */
    public function addTable(RequestInterface $request, ResponseInterface $response)
    {
        $data = $request->all();
        $table = new Tables();
        $table->fill($data);
        $table->status = Tables::STATUS_normal;
        $res = $table->save();
        return $res ? $this->returnSuccess() : $this->returnError(1, '新增失败');
    }

    /**
     * @RequestMapping(path="updateTable", methods="get,post")
     */
    public function updateTable(RequestInterface $request, ResponseInterface $response)
    {
        $res = false;
        $id = $request->input('id', 0);
        $table = Tables::query()->find($id);
        if ($table) {
            $data = $request->all();
            $table->fill($data);
            $res = $table->save();
        }
        return $res ? $this->returnSuccess() : $this->returnError(1, '更新失败');
    }

    /**
     * @RequestMapping(path="deleteTable", methods="get,post")
     */
    public function deleteTable(RequestInterface $request, ResponseInterface $response)
    {
        $res = false;
        $id = $request->input('id', 0);
        $table = Tables::query()->find($id);
        if ($table) {
            $table->status = Tables::STATUS_del;
            $res = $table->save();
        }
        return $res ? $this->returnSuccess() : $this->returnError(1, '删除失败');
    }
}
