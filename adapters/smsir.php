<?php
/**
 * Created by PhpStorm.
 * User: majid
 * Date: 4/9/16
 * Time: 4:05 PM
 */
namespace mhndev\message\adapters;

use SoapClient;

class smsir implements iAdapter
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
     * @var SoapClient
     */
    protected $client;


    /**
     * smsir constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->address     = $config['address'];
        $this->credentials = $config['credentials'];
        $this->meta        = $config['meta'];

        $this->client = new SoapClient($this->address);
    }


    /**
     * @return mixed
     */
    public function getSmsLines()
    {
        $params= [
            'userName'=>$this->credentials['username'],
            'password'=>$this->credentials['password']
        ];

        return $this->client->GetSmsLines($params);
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
        $parameters = [];
        $parameters['userName'] = $this->credentials['username'];
        $parameters['password'] = $this->credentials['password'];

        $parameters['mobileNos']    = array(doubleval($recipient));
        $parameters['messages']     = array($message);
        $parameters['lineNumber']   = $sender ? $sender : $this->meta['baseLine'];
        $parameters['sendDateTime'] = date("Y-m-d")."T".date("H:i:s");

        $result = $this->client->SendMessageWithLineNumber($parameters);

        return $result;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function DeleteScheduleSendSms($id)
    {
        $params= [
            'userName'=>$this->credentials['username'],
            'password'=>$this->credentials['password'],
            'schedulSendSmsID'=>$id
        ];

        $result = $this->client->DeleteScheduleSendSms($params);

        return $result;
    }


    /**
     * @param string $from  sample : 2014-05-18T11:47:25
     * @param string $to    sample : 2014-06-18T11:47:25
     */
    public function GetAllMessages($from , $to)
    {
        $params= [
            'userName'=>$this->credentials['username'],
            'password'=>$this->credentials['password'],
            'fromDate'=>$from,
            'toDate'=>$to
        ];

        $result = $this->client->GetAllMessages($params);

        return $result;
    }

    /**
     * @param integer $id
     */
    public function GetBranches($id)
    {
        $params= [
            'userName'=>$this->credentials['username'],
            'password'=>$this->credentials['password'],
            'parentBranchID'=>$id
        ];

        $result = $this->client->GetBranches($params);

        return $result;
    }


    /**
     *
     */
    public function GetCurrentDate()
    {

    }

    /**
     *
     */
    public function GetDefaultLineNumber()
    {

    }

    /**
     *
     */
    public function GetListOfScheduleSends()
    {
        $params= [
            'userName'=>$this->credentials['username'],
            'password'=>$this->credentials['password']
        ];

        $result = $this->client->GetListOfScheduleSends($params);

        return $result;
    }

    /**
     *
     */
    public function GetReceivedMessageByLastMessageID()
    {

    }

    /**
     *'fromDate'=>'2014-05-18T11:47:25','toDate'=>'2014-06-18T11:47:25'
     * @param $from
     * @param $to
     */
    public function GetReceivedMessages($from , $to)
    {
        $Params= [
            'userName'=>$this->credentials['username'],
            'password'=>$this->credentials['password'],
            'fromDate'=>$from,
            'toDate'=>$to
        ];
        $result = $this->client->GetReceivedMessages($Params);

        return $result;
    }

    /**
     *
     */
    public function GetSendToBranchFilterConditions()
    {
        $params= [
            'userName'=>$this->credentials['username'],
            'password'=>$this->credentials['password']
        ];
        $result = $this->client->GetSendToBranchFilterConditions($params);

        return $result;
    }

    /**
     *
     */
    public function GetSendToBranchesSendMethods()
    {
        $params= [
            'userName'=>$this->credentials['username'],
            'password'=>$this->credentials['password']
        ];
        $result =$this->client->GetSendToBranchesSendMethods($params);

        return $result;
    }

    /**
     * @param $batchKey
     * @param $requestPageNumber
     * @param $rowsPerPage
     * @param $countAll
     * @param $sendDate
     * @return mixed
     */
    public function GetSentMessageStatus($batchKey , $requestPageNumber , $rowsPerPage , $countAll , $sendDate)
    {
        $params= [
            'userName'=>$this->credentials['username'],
            'password'=>$this->credentials['password'],
            'batchKey'=>$batchKey,
            'requestedPageNumber'=>$requestPageNumber,
            'rowsPerPage'=>$rowsPerPage,
            'countOfAll'=>$countAll,
            'sendDateTime'=>$sendDate
        ];

        $result = $this->client->GetSentMessageStatus($params);

        return $result;
    }

    public function GetSentMessageStatusByID()
    {

    }

    /**
     * @param string $from sample : 2014-04-18T11:47:25
     * @param string $to   sample : 2014-07-20T11:47:25
     */
    public function GetSentMessages($from , $to)
    {
        $params= [
            'userName'=>$this->credentials['username'],
            'password'=>$this->credentials['password'],
            'fromDate'=>$from,
            'toDate'=>$to
        ];
        $result = $this->client->GetSentMessages($params);

        return $result;
    }

    /**
     * @param string $from sample : 2014-04-18T11:47:25
     * @param string $to   sample : 2014-07-20T11:47:25
     */
    public function GetTrashedMessages($from , $to)
    {
        $params= [
            'userName'=>$this->credentials['username'],
            'password'=>$this->credentials['password'],
            'fromDate'=>$from,
            'toDate'=>$to
        ];

        $result = $this->client->GetTrashedMessages($params);

        return $result;
    }

    public function GetUserCredit()
    {

    }

    /**
     * @param $dailyScheduleSend
     */
    public function SaveNewScheduleSendSms_Daily($dailyScheduleSend)
    {
        $params= [
            'userName'=>$this->credentials['username'],
            'password'=>$this->credentials['password'],
            'dailyScheduleSend'=>$dailyScheduleSend
        ];

        $result = $this->client->SaveNewSchedulSendSms_Daily($params);

        return $result;
    }

    public function SaveNewScheduleSendSms_Monthly($monthlyScheduleSend)
    {
        $params= [
            'userName'=>$this->credentials['username'],
            'password'=>$this->credentials['password'],
            'monthlyScheduleSend'=>$monthlyScheduleSend
        ];

        $result = $this->client->SaveNewScheduleSendSms_Monthly($params);

        return $result;
    }

    /**
     * @param $weeklyScheduleSend
     * @return mixed
     */
    public function SaveNewScheduleSendSms_Weekly($weeklyScheduleSend)
    {
        $params= [
            'userName'=>$this->credentials['username'],
            'password'=>$this->credentials['password'],
            'weeklyScheduleSend'=>$weeklyScheduleSend
        ];

        $result =  $this->client->SaveNewScheduleSendSms_Weekly($params);

        return $result;
    }

    public function SaveVIP_SendCorespondentMessage()
    {

    }

    public function SendMessage()
    {

    }

    public function SendMessageCustomerClub()
    {

    }

    public function SendMessageWithBachKey()
    {

    }

    public function SendMessageWithLineNumber()
    {

    }

    public function SendMessageWithLineNumberAndBatchKey()
    {

    }

    public function SendSmart()
    {

    }

    public function SendSmartMadiran()
    {

    }

    /**
     * @param $line
     * @param $sendCount
     * @param $sendMethodId
     * @param $startAt
     * @param $fromNumber
     * @param $toNumber
     * @param $filterId
     * @param $filterValue
     * @param $messageBody
     * @param $parishId
     * @param $sendSince
     * @param $isFlash
     * @return mixed
     */
    public function SendToParish($line , $sendCount , $sendMethodId , $startAt , $fromNumber , $toNumber , $filterId ,
                                 $filterValue , $messageBody , $parishId , $sendSince , $isFlash)
    {
        $params= [
            'userName'=>$this->credentials['username'],
            'password'=>$this->credentials['password'],
            'smsLineID'=>$line,
            'sendCount'=>$sendCount,
            'sendMethodID'=>$sendMethodId,
            'startAt'=>$startAt,
            'fromNumber'=>$fromNumber,
            'toNumber'=>$toNumber,
            'filterID'=>$filterId,
            'filterValue'=>$filterValue,
            'messageBody'=>$messageBody,
            'parishID'=>$parishId,
            'sendSince'=>$sendSince,
            'isFlash'=>$isFlash
        ];

        $result =  $this->client->SendToParish($params);

        return $result;
    }



}
