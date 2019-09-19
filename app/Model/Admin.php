<?php

declare (strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $uid
 * @property string $username
 * @property string $password
 * @property int $role
 * @property int $ctime
 * @property int $utime
 */
class Admin extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admin';
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
    protected $fillable = ['role', 'username', 'password','name'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['uid' => 'integer'];

    public static $roleMap = [
        1 => "admin",
        2 => "editor",
    ];

    public function handleRole($roleIds)
    {
        $data = [];
        if ($roleIds) {
            foreach ($roleIds as $id) {
                $data[] = self::$roleMap[$id];
            }
        }
        return $data;
    }

    public function getOne($uid)
    {
        $info = $this->query()->where('uid', $uid)->first();
        $data = $info->getAttributes();
        //去除密码
        unset($data['password']);
        return $data;
    }

    public function getByPage($page, $limit)
    {
        $result = [];
        $list = $this->query()->offset(($page - 1) * $limit)->limit($limit)->get();
        if ($list) {
            foreach ($list as $one) {
                $tmp = $one->getAttributes();
                unset($tmp['password']);
                $result[] = $tmp;
            }
        }
        return $result;
    }

}
