<?php
/**
 * Created by PhpStorm.
 * User: Tioncico
 * Date: 2019/9/6 0006
 * Time: 9:53
 */
namespace EventHook\Behavior;
interface BehaviorInterface
{
    /**
     * run
     * @param $tag
     * @param $param
     * @return mixed
     * @author Tioncico
     * Time: 9:55
     */
    public function run($tag,$param);
}