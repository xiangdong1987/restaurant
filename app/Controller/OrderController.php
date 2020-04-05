<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Dishes;
use App\Model\Orders;
use App\Model\SubOrders;
use App\Model\Tables;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Annotation\Controller as AnnoController;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\HttpServer\Contract\ResponseInterface;

/**
 * @AnnoController()
 */
class OrderController extends Controller
{
    /**
     * @GetMapping(path="list")
     */
    public function list()
    {
        $mDishes = new Orders();
        $page = $mDishes->query()->paginate(10)->toArray();
        $data['total'] = $page['total'];
        $data['items'] = $mDishes->formatList($page['data']);
        return $this->returnSuccess($data);
    }

    /**
     * @GetMapping(path="subList")
     * @param RequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function subList(RequestInterface $request)
    {
        $order_id = $request->input('order_id');
        $model = new SubOrders();
        $page = $model->query()->where('order_id', $order_id)->paginate(10)->toArray();
        $data['total'] = $page['total'];
        $data['items'] = $model->formatList($page['data']);
        $order = new Orders();
        $order = $order->query()->where('id',$order_id)->first();
        $table = new Tables();
        $table = $table->query()->where('id',$order['table_id'])->first();
        $data['table_name'] = $table['name'];
        return $this->returnSuccess($data);
    }

    /**
     * @RequestMapping(path="makeOrder", methods="get,post")
     * @param RequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function add(RequestInterface $request)
    {
        //判断是否有订单正在处理中
        $table_id = $request->input('table_id', 0);
        if ($table_id) {
            $foods = $request->input('foods', []);
            var_dump($foods);
            $model = new Orders();
            $res = $model->orderFoods($table_id, $foods);
            return $res ? $this->returnSuccess() : $this->returnError(1, '新增失败');
        } else {
            return $this->returnError(1001, '非法订单');
        }
    }

    /**
     * @RequestMapping(path="update", methods="get,post")
     * @param RequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function update(RequestInterface $request)
    {
        $res = false;
        $id = $request->input('id', 0);
        $model = new Dishes();
        $model = $model->query()->find($id);
        if ($model) {
            $data = $request->all();
            $data['imgs'] = trim($data['imgs'], ',');
            $res = $model->query()->where('id', $id)->update($data);
        }
        return $res ? $this->returnSuccess() : $this->returnError(1, '更新失败');
    }

    /**
     * @RequestMapping(path="kitchenList", methods="get,post")
     * @param RequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function kitchenList(RequestInterface $request){
        $status = $request->input('status');
        $model = new SubOrders();
        $page = $model->query()->where('status', $status)->paginate(10)->toArray();
        $data['total'] = $page['total'];
        $data['items'] = $model->formatList($page['data']);
        return $this->returnSuccess($data);
    }
}
