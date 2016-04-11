<?php
/**
 * Created by PhpStorm.
 * User: majid
 * Date: 4/9/16
 * Time: 4:04 PM
 */
namespace mhndev\message;

use mhndev\message\providers\iAdapter;

class Client implements iAdapter
{
    /**
     * @var iAdapter
     */
    protected $adapter;


    /**
     * Client constructor.
     *
     * @param array $config
     * @param iAdapter $adapter
     * @throws \Exception
     */
    public function __construct(array $config, iAdapter $adapter = null)
    {
        if(empty($config) || !is_array($config)){
            throw new \Exception('Invalid Argument');
        }

        $provider = $config['default'];
        $config   = $config['providers'][$provider];
        $class    = $config['adapter'];


        if(!$adapter){
            $this->adapter = new $class($config);
        }else{
            $this->adapter = $adapter;
        }

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


    /**
     * @param $recipient
     * @param $message
     * @param string $sender
     * @param array $options
     * @return mixed
     */
    public function send($recipient, $message, $sender = '', array $options = [])
    {
        return $this->adapter->send($recipient, $message, $sender, $options);
    }

    /**
     * @return mixed
     */
    public function getSmsLines()
    {
        return $this->adapter->getSmsLines();
    }
}
