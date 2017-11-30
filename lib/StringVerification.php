<?php

/**
 * Created by PhpStorm.
 * User: wangyaofeng
 * Date: 29/11/2017
 * Time: 16:38
 */
namespace phpVerification\lib;
//string 数据 规则校验
class StringVerification extends basic
{
    public static function runStart(&$value,$rules,$valReg,$inArray){
        $valRules = explode(';',$rules);
        $param[] = $value;
        //校验类
        $verification = 'phpVerification\lib\verification';
        //按照校验规则进行判断
        foreach ($valRules as $key=>$val){
            $verVal = explode(':',$val);
            $verKey = current($verVal);
            //适配器
            switch ($verKey){
                case self::pregMatch:$param[] = $valReg;break;
                case self::inArray:$param[] = $inArray;break;
                default:
            }
            //判断方法是否存在
            $exists = method_exists($verification,$verKey);
            if($exists==false){
                self::isError("error class ：$verification，function:$verKey no found!");
            }
            //回调检验函数
            self::$_isOk = call_user_func_array(array($verification,$verKey),$param);
            //判断是否有默认值
            self::isDefault($value);
            $value = strval($value);
            //是否有信息需要返回
            self::isMsg();
        }

    }


}