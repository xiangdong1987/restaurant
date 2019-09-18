<?php

declare (strict_types=1);
namespace App\Model;

use Hyperf\DbConnection\Model\Model;
/**
 * @property int $id
 * @property string $name
 * @property int $people_num
 * @property int $max_people
 * @property int $type
 * @property int $status
 * @property int $ctime
 * @property int $utime
 */
class Tables extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tables';
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
    protected $fillable = ['name','type','max_people'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'max_people' => 'integer', 'type' => 'integer', 'status' => 'integer', 'ctime' => 'integer', 'utime' => 'integer'];

    const TYPE_normal = 1, TYPE_room = 2;
    const STATUS_normal = 1, STATUS_del = 2;
    const CREATED_AT = 'ctime';
    const UPDATED_AT = 'utime';
    protected $dateFormat = 'U';

}