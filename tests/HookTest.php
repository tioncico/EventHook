<?php
/**
 * Created by PhpStorm.
 * User: Tioncico
 * Date: 2019/9/6 0006
 * Time: 10:27
 */

namespace EventHook\Test;

use EventHook\EventHook;
use EventHook\Test\Behavior\Test;
use EventHook\Test\Behavior\TestClass;
use PHPUnit\Framework\TestCase;

class HookTest extends TestCase
{

    function testAdd(){
        $eventHook = EventHook::getInstance();
        //闭包函数
        $result = $eventHook->add('test',function ($a,$b,$c){
            $this->assertEquals($a,1);
            $this->assertEquals($b,2);
            $this->assertEquals($c,3);
            return [$a,$b,$c];
        });
        $this->assertTrue(!!$result);

        //传入类名
        $result = $eventHook->add('test',Test::class);
        $this->assertTrue(!!$result);

        //传入类名+方法名数组
        $result = $eventHook->add('test',[Test::class,'test']);
        $this->assertTrue(!!$result);

        //传入一个类
        $result = $eventHook->add('test',new TestClass());
        $this->assertTrue(!!$result);

    }

    function testExec(){
        $eventHook = EventHook::getInstance();
        //闭包函数
        $result = $eventHook->exec(function ($a,$b,$c){
            $this->assertEquals($a,1);
            $this->assertEquals($b,2);
            $this->assertEquals($c,3);
            return [$a,$b,$c];
        },'test',1,2,3);
        $this->assertEquals($result,[1,2,3]);

        //传入类名
        $result = $eventHook->exec(Test::class,'a',1,2,3);
        $this->assertEquals($result,[1,2,3]);

        //传入类名+方法名数组
        $result = $eventHook->exec([Test::class,'test'],'',1,2,3);
        $this->assertEquals($result,[1,2,3]);

        //传入一个类
        $result = $eventHook->exec(new TestClass(),'test',1,2,3);
        $this->assertEquals($result,[1,2,3]);
    }

    /**
     * @depends testAdd
     * testListen
     * @author Tioncico
     * Time: 17:30
     */
    function testListen(){
        $eventHook = EventHook::getInstance();
        $result = $eventHook->listen('test',false,1,2,3);
        foreach ($result as  $value){
            $this->assertEquals($value,[1,2,3]);
        }
    }

    function testSetAndListen(){
        $eventHook = EventHook::getInstance();
        $result = $eventHook->add('Test1',function ($param){
            $a = $param;
            return $a;
        });
        $result = $eventHook->listen('Test1',false,1);
        $this->assertEquals(1,$this->count($result));
        $this->assertEquals(1,$result[0]);
    }

}