<?php

/**
 * Created by PhpStorm.
 * User: wangyaofeng
 * Date: 29/11/2017
 * Time: 16:37
 */
namespace phpVerification\lib;

class IntVerification extends basic
{
    public static function runStart(&$value,$rules,$valReg,$inArray){
        $valRules = explode(';',$rules);
        $param[] = $value;
        //校验类
        $verification = 'phpVerification\lib\verification';
        //按照校验规则进行判断
        foreach ($valRules as $key=>$val){
            //适配器 按照 ：(分号) 取出值
            $verVal = explode(':',$val);
            $verKey = current($verVal);
            switch ($verKey){
                case self::pregMatch: $param[] = $valReg;break;
                case self::max:
                case self::min:$param[] = end($verVal);break;
                case self::range:
                    $rangeVal = explode(',',end($verVal));
                    $param[] =isset($rangeVal[0])?$rangeVal[0]:0;
                    $param[] =isset($rangeVal[1])?$rangeVal[1]:0;
                    break;
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
            var_dump(self::$_isOk);
            //判断是否有默认值
            self::isDefault($value);

            //是否有信息需要返回
            self::isMsg();
        }
        //强制类型转换
        $value = intval($value);

    }


}