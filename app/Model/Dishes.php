<?php

declare (strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $name_it
 * @property float $price
 * @property float $discount
 * @property int $freq
 * @property int $scores
 * @property int $category
 * @property int $status
 * @property string $imgs
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Dishes extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dishes';
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
    protected $fillable = ['id', 'name', 'name_it', 'price', 'discount', 'freq', 'scores', 'category', 'status', 'imgs'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'price' => 'float', 'discount' => 'float', 'freq' => 'integer', 'scores' => 'integer', 'category' => 'integer', 'status' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
    const TYPE_normal = 1, TYPE_room = 2;
    const STATUS_online = 1, STATUS_offline = 0;
    public static $statusMap = [self::STATUS_online => "上架", self::STATUS_offline => "下架"];

    public function formatList($data)
    {
        foreach ($data as &$one) {
            $one['status'] = self::$statusMap[$one['status']];
        }
        return $data;
    }
}
