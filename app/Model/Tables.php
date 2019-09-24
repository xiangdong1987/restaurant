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
    protected $fillable = ['name', 'type', 'max_people'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'max_people' => 'integer', 'type' => 'integer', 'status' => 'integer', 'ctime' => 'integer', 'utime' => 'integer'];

    const TYPE_normal = 1, TYPE_room = 2;
    const STATUS_normal = 1, STATUS_del = 2;

    public static $typeMap = [
        1 => "餐桌",
        2 => "包间"
    ];

    public static $statusMap = [
        1 => "正常",
        2 => "废除",
        3 => "预定",
        4 => "就餐中",
        5 => "空闲",
    ];

    public function getTypeOption()
    {
        return $this->handleOption(self::$typeMap);
    }

    public function getStatusOption()
    {
        return $this->handleOption(self::$statusMap);
    }

    public function handleOption($data)
    {
        $result = [];
        if ($data) {
            foreach ($data as $key => $text) {
                $tmp["key"] = $key;
                $tmp["text"] = $text;
                $result[] = $tmp;
            }
        }
        return $result;
    }

    public function formatList($data)
    {
        foreach ($data as &$one) {
            $one['type'] = self::$typeMap[$one['type']];
            $one['status'] = self::$statusMap[$one['status']];
        }
        return $data;
    }

}
