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
    protected $casts = ['id' => 'integer', 'table_id' => 'integer', 'people_num' => 'integer', 'status' => 'integer', 'dish_num' => 'integer', 'total_amount' => 'float', 'ctime' => 'integer', 'utime' => 'integer'];
}