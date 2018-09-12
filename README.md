实现读取多个配置目录下多个配置文件的功能
=
 

* 获取配置的值

    Config::get(<配置文件名>,<配置键>,<下一级配置键>,...)

* 设置一个优先的配置目录

    Config::insert(string $dir)

* 设置一个低优先的配置目录

    Config::append(string $dir)

* 获取当前设置的运行配置
    
    Config::mode():string

* 判断当前是否设置为调试模式

    Config::isDebug():bool

#### 本类会自动依优先级对配置目录进行搜索,直到找到指定的配置文件

 
