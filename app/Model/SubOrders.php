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
    protected $fillable = [];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'order_id' => 'integer', 'dish_id' => 'integer', 'price' => 'float', 'discount' => 'float', 'num' => 'integer', 'status' => 'integer', 'ctime' => 'integer', 'utime' => 'integer'];
}
