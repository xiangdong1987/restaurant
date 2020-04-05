<?php

declare (strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id
 * @property int $order_id
 * @property int $dish_id
 * @property float $price
 * @property float $discount
 * @property int $num
 * @property int $status
 * @property int $ctime
 * @property int $utime
 */
class SubOrders extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sub_orders';
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
    protected $fillable = ['id', 'order_id', 'dish_id','table_id', 'price', 'discount', 'num', 'status'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'order_id' => 'integer', 'table_id' => 'integer','dish_id' => 'integer', 'price' => 'float', 'discount' => 'float', 'num' => 'integer', 'status' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
    const STATUS_CREATE = 0, STATUS_PAYING = 1, STATUS_END = 2;
    public static $statusMap = [
        self::STATUS_CREATE => "已下单",
        self::STATUS_PAYING => "以出餐",
        self::STATUS_END => "已结账",
    ];

    public function formatList($data)
    {
        if ($data) {
            //获取所有的菜品名称
            $dishesIds = array_column($data, 'dish_id');
            $modelTable = new Dishes();
            $dishList = $modelTable->query()->whereIn('id', $dishesIds)->select(['id', 'name'])->get()->toArray();
            $dishList = array_column($dishList, null, 'id');
            foreach ($data as &$one) {
                $one['status'] = self::$statusMap[$one['status']];
                $one['dish_name'] = $dishList[$one['dish_id']]['name'];
            }
        }
        return $data;
    }
}
