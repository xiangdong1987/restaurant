<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Dishes;
use App\Model\Tables;
use Hyperf\HttpServer\Annotation\Controller as AnnoController;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

/**
 * @AnnoController()
 */
class DishesController extends Controller
{
    /**
     * @GetMapping(path="list")
     */
    public function list()
    {
        $mDishes = new Dishes();
        $page = $mDishes->query()->paginate(10)->toArray();
        $data['total'] = $page['total'];
        $data['items'] = $mDishes->formatList($page['data']);
        return $this->returnSuccess($data);
    }

    public function get(int $id)
    {
        $model = new Dishes();
        $info = $model->query()->where('id', $id)->first()->toArray();
        $data = $info;
        return $this->returnSuccess($data);

    }

    /**
     * @RequestMapping(path="create", methods="get,post")
     * @param RequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function add(RequestInterface $request)
    {
        $data = $request->all();
        $model = new Dishes();
        $model->fill($data);
        $res = $model->save();
        return $res ? $this->returnSuccess() : $this->returnError(1, '新增失败');
    }

    /**
     * @RequestMapping(path="update", methods="get,post")
     * @param RequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updateTable(RequestInterface $request)
    {
        $res = false;
        $id = $request->input('id', 0);
        $model = new Dishes();
        $model = $model->query()->find($id);
        if ($model) {
            $data = $request->all();
            $res = $model->query()->where('id', $id)->update($data);
        }
        return $res ? $this->returnSuccess() : $this->returnError(1, '更新失败');
    }

    /**
     * @RequestMapping(path="delete", methods="get,post")
     * @param RequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function deleteTable(RequestInterface $request)
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
