<?php
/**
 * Created by PhpStorm.
 * User: majid
 * Date: 4/11/16
 * Time: 9:10 AM
 */
namespace mhndev\message\providers\smsir\adapters;

use mhndev\message\providers\iAdapter;

class RestAdapter implements iAdapter
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
     * smsir constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->address     = $config['address'];
        $this->credentials = $config['credentials'];
        $this->meta        = $config['meta'];
    }


    /**
     * @param $recipient
     * @param $message
     * @param string $sender
     * @param array $options
     * @return string
     */
    public function send($recipient, $message, $sender = '', array $options = [])
    {
        $sender   = $sender ? $sender : $this->meta['baseLine'];
        $udh      = $options['udh'] ? $options['udh'] : '';
        $encoding = $options['encoding'] ? $options['encoding'] : '';
        $checkingMessageId = '';

        $url = $this->generateUrl('‫‪Enqueue‬‬')."&from=" . $sender . "&to=" . $recipient . "&message=" . urlencode($message) . "&coding=" . $encoding . "&udh=" . $udh . "&chkmessageid=" . $checkingMessageId;


        return $this->call($url);
    }

    /**
     * @return mixed
     */
    public function getSmsLines()
    {
        return $this->meta['lines'];
    }

    /**
     * @return string
     */
    public function getCredit()
    {
        $url = $this->generateUrl('getCredit');
        return $this->call($url);

    }

    /**
     * @param $messageId
     * @return string
     */
    public function getMessageStatus($messageId)
    {
        $url = $this->generateUrl('getMessageStatus'). '&messageid=' . $messageId;
        return $this->call($url);
    }

    /**
     * @param $messageId
     * @return string
     */
    public function getRealMessageStatus($messageId)
    {
        $url = $this->generateUrl('getRealMessageStatus').'&messageid=' . $messageId;

        return $this->call($url);
    }


    /**
     * @param $checkingMessageId
     * @return string
     */
    public function getMessageId($checkingMessageId)
    {
        $url = $this->generateUrl('getMessageId').'&chkmessageid=' . $checkingMessageId;

        return $this->call($url);
    }


    /**
     * method : call
     * this method provides a simple way of calling a url
     * you can also use the curl-based implementation of this method (which has been commented below)
     * @param  String $url the input url
     * @return string      the response
     */
    protected function call($url)
    {
        return file_get_contents($url);
    }



    /**
     * @param string $method
     * @return string
     */
    protected function generateUrl($method)
    {

        $url = $this->address.
            '?service='.$method.
            '&domain=' .$this->credentials['domain'].
            '&username='.$this->credentials['username'].
            '&password='.$this->credentials['password'];

        return $url;
    }

}
