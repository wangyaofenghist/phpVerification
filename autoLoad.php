<?php

/**
 * Created by PhpStorm.
 * User: wangyaofeng
 * Date: 29/11/2017
 * Time: 15:59
 */
namespace phpVerification;
class autoLoad
{
    private static $suffix = ".php";
    private static $baseDir = "/var/www/html/test/";

    public static function autoload($className){

        if (class_exists($className, false)) {
            return true;
        }

        $file = '';

        if(strpos($className,'\\') !== false){
            //命名空间
            $className = str_replace('\\',DS,$className);
            $className = ltrim($className,DS);
            $file = LIB_LAB_DIR.$className . self::$suffix;
        }
        //var_dump(self::$baseDir.$className);exit;
        if(file_exists(self::$baseDir.$className.self::$suffix)){
            require_once self::$baseDir.$className.self::$suffix;
            return true;
        }elseif(file_exists($file)){
            require_once $file;
            return true;
        }
        return false;
    }

    /**
     * 注册
     */
    public static function register(){
        spl_autoload_register(array('phpVerification\autoLoad','autoload'),true,true);
    }
}
defined('DS') or define('DS', DIRECTORY_SEPARATOR);
autoLoad::register();
