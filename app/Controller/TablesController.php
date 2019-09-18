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
        return $this->returnSuccess(Tables::where('status', Tables::STATUS_normal)->paginate(10));
    }

    /**
     * @RequestMapping(path="createTable", methods="get,post")
     */
    public function addTable(RequestInterface $request, ResponseInterface $response){
        $tables = new Tables();
        $tables->name = $request->input('name', '');
        $tables->max_people = $request->input('max_people', 1);
        $tables->type = $request->input('type', Tables::TYPE_normal);
        $tables->status = Tables::STATUS_normal;
        $res = $tables->save();
        return $res ? $this->returnSuccess() : $this->returnError(1, '新增失败');
    }

    /**
     * @RequestMapping(path="updateTable", methods="get,post")
     */
    public function updateTable(RequestInterface $request, ResponseInterface $response){
        $res = false;
        $id         = $request->input('id', 0);
        $name       = $request->input('name', '');
        $type       = $request->input('type');
        $max_people = $request->input('max_people', 1);
        $table = Tables::query()->find($id);
        if($table){
            !is_null($name)         && $table->name = $name;
            !is_null($max_people)   && $table->max_people = $max_people;
            !is_null($type)         && $table->type = $type;
            $res = $table->save();
        }
        return $res ? $this->returnSuccess() : $this->returnError(1, '更新失败');
    }

    /**
     * @RequestMapping(path="deleteTable", methods="get,post")
     */
    public function deleteTable(RequestInterface $request, ResponseInterface $response){
        $res    = false;
        $id     = $request->input('id', 0);
        $table  = Tables::query()->find($id);
        if($table) {
            $table->status = Tables::STATUS_del;
            $res = $table->save();
        }
        return $res ? $this->returnSuccess() : $this->returnError(1, '删除失败');
    }
}
