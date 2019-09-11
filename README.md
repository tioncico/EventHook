# EventHook
hook事件组件
借鉴tp5写的hook事件

```php

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


$result = $eventHook->listen('test',false,1,2,3);
foreach ($result as  $value){
    $this->assertEquals($value,[1,2,3]);
}
```
