<?php

declare (strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id
 * @property int $table_id
 * @property int $status
 * @property int $dish_num
 * @property float $total_amount
 * @property int $ctime
 * @property int $utime
 */
class Orders extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';
    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'default';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'table_id' => 'integer', 'people_num' => 'integer', 'status' => 'integer', 'dish_num' => 'integer', 'total_amount' => 'float', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
    const STATUS_CREATE = 0, STATUS_PAYING = 1, STATUS_END = 2;
    public static $statusMap = [
        self::STATUS_CREATE => "已下单",
        self::STATUS_PAYING => "支付中",
        self::STATUS_END => "已完成",
    ];

    public function orderFoods($table_id, $foods)
    {
        //判断订单是否存在
        $order = $this->query()->where('table_id', '=', $table_id)->where('status', self::STATUS_CREATE)->first();
        if ($order) {
            //新建新食物
            $order_id = $order['id'];
            $this->insertSubOrder($order_id, $table_id, $foods);
        } else {
            //创建订单
            $order = [];
            $order['table_id'] = $table_id;
            $order['status'] = self::STATUS_CREATE;
            $order['created_at'] = date('Y-m-d H:i:s');
            $order['updated_at'] = date('Y-m-d H:i:s');
            $order_id = $this->query()->insertGetId($order);
            $this->insertSubOrder($order_id, $table_id, $foods);
        }
        return true;
    }

    public function insertSubOrder($order_id, $table_id, $foods)
    {
        //创建所有子订单
        $modelSubOrder = new SubOrders();
        if ($foods) {
            //获取所有菜品数据
            $dishIds = array_column($foods, 'dish_id');
            $modelDishes = new Dishes();
            $dishList = $modelDishes->query()->whereIn('id', $dishIds)->get()->toArray();
            $dishList = array_column($dishList, null, 'id');
            foreach ($foods as $food) {
                $food['order_id'] = $order_id;
                $food['table_id'] = $table_id;
                $food['price'] = $dishList[$food['dish_id']]['price'];
                $food['discount'] = $dishList[$food['dish_id']]['discount'];
                $food['status'] = 0;
                $modelSubOrder->fill($food)->save();
            }
        }
        $this->updateOrder($order_id);
    }

    public function updateOrder($order_id)
    {
        //获取所有子订单统计
        $moderSubOrder = new SubOrders();
        $subOrderList = $moderSubOrder->query()->where('order_id', $order_id)->get()->toArray();
        $dish_num = 0;
        $total_amount = 0;
        if ($subOrderList) {
            foreach ($subOrderList as $subOrder) {
                $dish_num += $subOrder['num'];
                $total_amount += $subOrder['num'] * $subOrder['price'];
            }
            $data = [];
            $data['dish_num'] = $dish_num;
            $data['total_amount'] = $total_amount;
            $data['updated_at'] = date('Y-m-d H:i:s');
            $this->query()->where('id', $order_id)->update($data);
        }
    }

    public function formatList($data)
    {
        if ($data) {
            //获取餐桌名称
            $tableIds = array_column($data, 'table_id');
            $modelTable = new Tables();
            $tableList = $modelTable->query()->whereIn('id', $tableIds)->select(['id', 'name'])->get()->toArray();
            $tableList = array_column($tableList, null, 'id');
            foreach ($data as &$one) {
                $one['status'] = self::$statusMap[$one['status']];
                $one['table_name'] = $tableList[$one['table_id']]['name'];
            }
        }
        return $data;
    }
}