<?php
/**
 * Created by PhpStorm.
 * User: Tioncico
 * Date: 2019/9/6 0006
 * Time: 10:27
 */

namespace EventHook\Test\Behavior;

use EventHook\Behavior\BehaviorInterface;

class Test implements BehaviorInterface
{
    public function run($tag, $param)
    {
        var_dump($tag,$param);
        // TODO: Implement run() method.
    }

}