<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

namespace HyperfTest\Cases;

use HyperfTest\HttpTestCase;

/**
 * @internal
 * @coversNothing
 */
class TablesTest extends HttpTestCase
{
    public function testTablesList()
    {
        $res = $this->get('/tables/index');
        var_dump($res);
    }

    public function testAddTable()
    {
        $params = array(
            'name' => 'jay',
            'people_num' => '2',
            'max_people' => '4',
            'type' => 2,
        );
        $res = $this->get('/tables/createTable', $params);
        var_dump($res);
    }
}