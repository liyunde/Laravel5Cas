<?php namespace LIYunde\MultiCas;

/**
 * Class MultiCasManager
 * @package MultiCas
 */
class MultiCasManager
{
    private $config;

    /**
     * The active connection instances.
     *
     * @var array
     */
    protected $connections;

    /**
     * @param array $config
     */
    function __construct(array $config)
    {
        if (!isset($config['default'])) throw new \InvalidArgumentException('配置信息丢失');

        $this->config = $config;

        foreach ($config as $k=>$item){

            $this->connections[$k] = new CasServer($item);
        }
    }

    /**
     * @param string $conf
     * @return mixed | CasServer
     */
    public function connection($conf = 'default')
    {
        if (!isset($this->connections[$conf])) {

            throw new \InvalidArgumentException("没有配置 {$conf} 的登陆信息");
        }

        return $this->connections[$conf];
    }

    /**
     * Dynamically pass methods to the default connection.
     *
     * @param  string $method
     * @param  array $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        if(isset($this->config[$method])){

            return $this->connection($method);
        }

        return call_user_func_array([$this->connection(), $method], $parameters);
    }

}
