<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Tables;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

/**
 * @Controller()
 */
class TablesController
{
    /**
     * @GetMapping(path="index")
     */
    public function index(RequestInterface $request, ResponseInterface $response)
    {
        return Tables::where('status', Tables::STATUS_normal)->paginate(10);
    }

    /**
     * @RequestMapping(path="createTable", methods="get,post")
     */
    public function addTable(RequestInterface $request, ResponseInterface $response){
        $tables = new Tables();
        $tables->name = $request->input('name', '');
        $tables->people_num = $request->input('people_num', 1);
        $tables->max_people = $request->input('max_people', 1);
        $tables->type = $request->input('type', Tables::TYPE_normal);
        $tables->status = Tables::STATUS_normal;
        $res = $tables->save();
        return $res;
    }
}
