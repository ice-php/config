<?php
declare(strict_types=1);

namespace icePHP;

/**
 * 取指定配置信息,如果不传递参数,则获取配置类的单例实例
 * 这是Config的一个快捷入口
 * 所有参数原样传递
 * @param $items string[] 配置文件名称以及配置项名称列表
 * @return string|array|bool
 * @throws ConfigException
 */
function config(string ...$items)
{
    return Config::get(...$items);
}