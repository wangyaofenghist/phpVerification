<?php
/**
 * Created by PhpStorm.
 * User: wangyaofeng
 * Date: 29/11/2017
 * Time: 16:41
 */

namespace phpVerification\lib;

//基础校验类
class verification
{
    //不能为NULL
    public static function notNull($val){
        $isOk = !is_null($val);
        return self::returnTrueOrFalse($isOk);
    }
    //不能为空
    public static function notEmpty($val){
        $isOk = !empty($val);
        return self::returnTrueOrFalse($isOk);
    }
    //是否是json
    public static function isJson($val){
        $isOk = !is_null(json_decode($val));
        return self::returnTrueOrFalse($isOk);
    }
    //是否是数组
    public static function isArray($val){
        $isOk = is_array($val);
        return self::returnTrueOrFalse($isOk);
    }
    //是否是数字
    public static function isNumber($val){
        $isOk = is_numeric($val);
        return self::returnTrueOrFalse($isOk);
    }
    //正则
    public static function pregMatch($val,$preg){
        $isOk = preg_match($preg,$val);
        return self::returnTrueOrFalse($isOk);
    }
    //是否为浮点型
    public static function  isFloat($val){
        $isOk = is_float($val);
        self::returnTrueOrFalse($isOk);
    }
    //校验是否存在于数组中
    public static function inArray($val,$array){
        $isOk = in_array($val,$array);
        return self::returnTrueOrFalse($isOk);
    }
    //最小值
    public static function  min($val,$min){
        $isOk = $val>=$min;
        self::returnTrueOrFalse($isOk);
    }
    //最小值
    public static function  max($val,$min){
        $isOk = $val<=$min;
        self::returnTrueOrFalse($isOk);
    }
    //取范围
    public static function range($val,$min,$max){
        $isOk = $val<=$min & $val>=$max;
        self::returnTrueOrFalse($isOk);
    }
    //判断最大长度
    public static function maxLen($val,$len){
        $isOk = (strlen($val)<=$len);
        self::returnTrueOrFalse($isOk);
    }
    //判断最小长度
    public static function minLen($val,$len){
        $isOk = (strlen($val)>=$len);
        self::returnTrueOrFalse($isOk);
    }
    //返回true/false
    public static function returnTrueOrFalse($check){
        if($check==false){
            return false;
        }
        return true;
    }
}