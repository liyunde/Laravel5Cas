<?php namespace MultiCas;

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
    }

    /**
     * @param string $conf
     * @return Sso|void
     */
    public function connection($conf = 'default')
    {
        if (!isset($this->connections[$conf])) {
            $this->connections[$conf] = $this->createConnection($conf);
        }

        return $this->connections[$conf];
    }

    /**
     * @param string $conf
     *
     * @return Sso
     */
    protected function createConnection($conf = 'default')
    {
        if (!isset($this->config[$conf])) throw new \Exception("配置信息丢失");

        $connection = new Sso($this->config[$conf]);

        return $connection;
    }

    /**
     * @param $name
     * @return mixed
     * @throws \Exception
     */
    public function __get($name)
    {
        if (isset($this->config[$name])) return $this->connection($name);

        throw new \Exception('无效的配置');
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
        return call_user_func_array([$this->connection(), $method], $parameters);
    }

}
