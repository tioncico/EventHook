<?php
/**
 * Created by PhpStorm.
 * User: Tioncico
 * Date: 2019/9/6 0006
 * Time: 10:27
 */

namespace EventHook\Test\Behavior;

class Test
{
    public function run($a,$b,$c)
    {
        return [$a,$b,$c];
        // TODO: Implement run() method.
    }
    
    
    function test($a,$b,$c){
        return [$a,$b,$c];
    }

}