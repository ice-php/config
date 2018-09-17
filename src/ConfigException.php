<?php
declare(strict_types=1);

namespace icePHP;

class ConfigException extends \Exception
{
    //配置文件内容必须是数组
    const CONTENT_NOT_ARRAY = 1;

    //请求配置时缺少参数
    const MISS_ARGUMENT = 2;

}