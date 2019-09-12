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
 * @property int $ctime
 * @property int $utime
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
    protected $fillable = [];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'price' => 'float', 'discount' => 'float', 'freq' => 'integer', 'scores' => 'integer', 'category' => 'integer', 'status' => 'integer', 'ctime' => 'integer', 'utime' => 'integer'];
}