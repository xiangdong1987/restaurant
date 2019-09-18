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
    protected $fillable = ['role', 'username', 'password'];
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
}
