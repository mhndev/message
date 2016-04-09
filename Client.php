<?php
/**
 * Created by PhpStorm.
 * User: majid
 * Date: 4/9/16
 * Time: 4:04 PM
 */
namespace mhndev\message;

use mhndev\message\adapters\iAdapter;

class Client implements iAdapter
{
    /**
     * @var string
     */
    protected $address;

    /**
     * @var array
     */
    protected $credentials;

    /**
     * @var array meta data
     */
    protected $meta;

    /**
     * @var iAdapter
     */
    protected $adapter;


    /**
     * Client constructor.
     *
     * @param iAdapter $adapter
     * @param array $config
     */
    public function __construct(iAdapter $adapter, $config = [])
    {
        $provider = $config['default'];
        $config   = $config[$provider];
        $class    = $config['adapter'];
        $this->adapter = new $class($config);
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        $result = call_user_func_array([$this->adapter , $name] , $arguments);

        return $result;
    }


    public function send($recipient, $message, $sender = '', array $options = [])
    {
        return $this->adapter->send($recipient, $message, $sender, $options);
    }

    public function getSmsLines()
    {
        return $this->adapter->getSmsLines();
    }
}
