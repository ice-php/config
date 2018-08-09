<?php
/**
 * icePHP框架的一部分,独立使用
 */
namespace icePHP;

//文件包含,不区分大小写
//同一命名空间,不用引入
//use icePHP\RequireInsensitivity;


/**
 * 在多个目录下读取配置文件
 * Class Config
 * @package icePHP
 */
class Config
{
    //全部配置目录
    private static $dirs = [];

    /**
     * 设置一个优先的配置目录
     * @param string $dir
     */
    public static function insert(string $dir)
    {
        array_unshift(self::$dirs, $dir);
    }

    /**
     * 设置一个低优先的配置目录
     * @param string $dir
     */
    public static function append(string $dir)
    {
        self::$dirs[] = $dir;
    }


    /**
     * 获取配置文件内容(从文件中获取)
     *
     * @param string $fileName 配置文件名
     * @return array|null 配置内容
     */
    private static function readFile(string $fileName)
    {
        //配置文件名
        $fullName = $fileName . '.config.php';

        //逐个配置文件目录查找
        foreach (self::$dirs as $dir) {
            $content = RequireInsensitivity::read($dir . DIRECTORY_SEPARATOR . $fullName);
            if ($content) return $content;
        }

        //未找到
        return null;
    }

    /**
     * 获取其它配置文件的内容
     * 来源于配置文件路径下的指定 文件
     * 使用可变参数, 文件名,配置项,子项,...
     * 开发人员通常使用 全局函数 config 来调用本功能
     * @param string[] $argv
     * @return   string|array|bool
     * @throws
     */
    public static function get(string ... $argv)
    {
        // 动态参数列表
        $args = count($argv);

        // 缓存
        static $all = [];

        // 一个参数都未给出
        if ($args < 1) {
            throw new \Exception('call config without parameters.');
        }

        // 第一个参数是配置文件名
        $file = $argv[0];

        // 如果尚未获取,则获取
        if (!isset($all[$file])) {
            $all[$file] = self::readFile($file);
        }

        // 根据请求参数,获取子项
        $config = $all[$file];

        // 根据函数参数,获取继续的子项
        for ($i = 1; $i < $args; $i++) {
            $itemName = $argv[$i];

            // 没有指定的配置项
            if (!isset($config[$itemName])) {
                return null;
            }

            // 不应该到达这里
            if (!is_array($config)) {
                throw new \Exception('specified config item don\'t exist:' . implode(':', $argv));
            }

            $config = $config[$itemName];
        }

        return $config;
    }
}