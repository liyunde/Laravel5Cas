<?php
/**
 * Created by PhpStorm.
 * User: liyunde
 * Date: 2016/12/9
 * Time: 18:40
 */

namespace MultiCas;

/**
 * @project laravel5-multi-cas
 * @package MultiCas
 * @author liyunde
 */
class CasServer
{
    private $conf;

    private $connect;

    /**
     * CasServer constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->conf = $config;

        $this->connect = new Sso($this->conf);
    }

    /**
     * @param $method
     * @param $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return call_user_func_array([$this->connect, $method], $parameters);
    }

}