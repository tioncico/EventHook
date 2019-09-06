<?php
/**
 * Created by PhpStorm.
 * User: Tioncico
 * Date: 2019/9/6 0006
 * Time: 9:40
 */

namespace EventHook;

use EasySwoole\Component\Container;
use EasySwoole\Component\Singleton;
use EventHook\Behavior\BehaviorInterface;

class EventHook extends Container
{
    use Singleton;

    public function add($tag, $behavior, $callback)
    {
        $callbackArray = parent::get($tag);
        if (is_callable($callback)) {
            $callbackArray[$behavior] = $callback;
            return parent::set($tag, $callbackArray);
        } elseif ($callback instanceof BehaviorInterface) {
            $callbackArray[$behavior] = $callback;
            return parent::set($tag, $callbackArray);
        } else {
            return false;
        }
    }

    public function set($tag, $callback)
    {
        $callbackArray = [];
        if (is_callable($callback)) {
            $callbackArray[] = $callback;
            return parent::set($tag, $callbackArray);
        } elseif ($callback instanceof BehaviorInterface) {
            $callbackArray[] = $callback;
            return parent::set($tag, $callbackArray);
        } else {
            return false;
        }
    }

    public function listen($tag, $params = null, $once = false)
    {
        $callbackArray = parent::get($tag);

        $results = [];

        foreach ($callbackArray as $key => $name) {
            $results[$key] = $this->exec($name, $tag, $params);

            // 如果返回 false，或者仅获取一个有效返回则中断行为执行
            if (false === $results[$key] || (!is_null($results[$key]) && $once)) {
                break;
            }
        }
        return $once ? end($results) : $results;
    }

    public function exec($callback, $tag, $params)
    {
        if ($callback instanceof \Closure) {
            $result = call_user_func_array($callback, $params);
        } elseif (is_array($callback)) {
            list($class, $method) = $callback;
            $result = (new $class())->$method($params);
        } elseif (is_object($callback)) {
            $result = $callback->$tag($params);
        } else {
            $obj = new $callback();
            $method = ($tag && is_callable([$obj, $tag])) ? $tag : 'run';
            $result = $obj->$method($params);
        }
        return $result;
    }

}