一个基于PHP校验的插件
====
可以用于项目开发过程中，对controler 传输参数进行基础 校验

##使用方法

**例如：**

````
<?php
/**
 * Created by PhpStorm.
 * User: wangyaofeng
 * Date: 29/11/2017
 * Time: 19:25
 */

namespace phpVerification;
use phpVerification\lib\basic;
include_once "autoLoad.php";
class test
{
    public static function testA($param,$val){
        //返回数据会被改变
        basic::run($param,$val);
    }
}
$param = array(
    'user_id'=>array(
        "type"=>'int',   //预期想要的类型
        "rules"=>'notNull;notEmpty;pregMatch',//需要校验的规则 and
        'default'=>'-1',//校验不通过的时候的默认值
        'msg'=>'error!',//校验失败的时候的返回消息
        'reg'=>"/^\d*$/",//正则校验
    )
);
$val = array('user_id'=>"6664w");
$tmp = test::testA($param,$val);
var_dump($val,$tmp);exit;
````



