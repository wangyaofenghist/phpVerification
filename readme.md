一个基于PHP校验的插件
====
可以用于项目开发过程中，对controler 传输参数进行基础 校验
<br>

>例如：
<br>

>>$param = array(<br>
        'user_id'=>array(
        'type'=>'int',   //预期想要的类型
        'rules'=>'notNull;notEmpty;pregMatch',//需要校验的规则 and
        'default'=>'-1',//校验不通过的时候的默认值
        'msg'=>'error!',//校验失败的时候的返回消息
        'reg'=>"/^\d*$/",//正则校验
    )
);
$val = array('user_id'=>"6664w");

