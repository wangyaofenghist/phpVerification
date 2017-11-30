<?php

/**
 * Created by PhpStorm.
 * User: wangyaofeng
 * Date: 29/11/2017
 * Time: 16:01
 */
namespace phpVerification\lib;

 class basic
{
    const pregMatch ="pregMatch";
    const notNull = "notNull";
    const notEmpty = "notEmpty";
    const isJson = "isJson";
    const isArray = "isArray";
    const isNumber = "isNumber";
    const inArray = "inArray";
    const isFloat ='isFloat';
    const min='min';
    const max='max';
    const range = 'range';

    public static $default = NULL;
    protected static $_isOk;
    protected static $_isDefault;
    protected static $_message="param is error!";
    //接受参数
    //根据类型产生不同的回调
    public static function run(array $param,&$value){

        foreach ($value as $key=>&$val){
            //说明校验存在
            if(isset($param[$key])){
                $valParam  = $param[$key];
                //$tmpArray = explode('|',$valParam);
                $type = $valParam['type'];
                $rules = $valParam['rules'];
                $inArray = isset($valParam['inArray'])?$valParam['inArray']:array();
                self::$default = $valParam['default'];
                self::$_message = empty($valParam['msg'])?self::$_message:$valParam['msg'];
                self::$_isDefault = isset($valParam['default']) & trim($valParam['default'])!=='';
                $valReg = NULL;
                //正则
                if(isset($valParam['reg'])){
                    $valReg = $valParam['reg'];
                }
                self::verificationSwitch($type,$val,$rules,$valReg,$inArray);

            }
        }


    }
    //选择校验类，并 强制转换为期望的类型
    public static function verificationSwitch($type,&$val,$rules,$valReg,$inArray){
        switch ($type){
            case 'int':IntVerification::runStart($val,$rules,$valReg,$inArray);break;
            case 'string':StringVerification::runStart($val,$rules,$valReg,$inArray);break;
            case 'array':;break;
            case 'json':;break;
        }
    }
    public static function isDefault(&$val){
        //var_dump(self::$default,$val,self::$_isDefault);exit;
        if(self::$_isDefault==true && self::$_isOk==false){
            $val = self::$default;
            self::$_isOk = true;
        }
    }
    public static function isMsg(){
        //var_dump(self::$_isOk);exit;
        if(self::$_isOk == false)
            self::returnMessage();
    }
    public static function returnMessage(){
        //var_dump(self::$_message);exit;
        echo (self::$_message);
        exit(0);
    }
    public static function isError($errorInfo){
        echo ($errorInfo);
        exit(0);
    }
}