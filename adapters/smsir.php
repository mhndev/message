<?php
/**
 * Created by PhpStorm.
 * User: majid
 * Date: 4/9/16
 * Time: 4:05 PM
 */
namespace mhndev\message\adapters;

class smsir implements iAdapter
{
    /**
     * @var
     */
    protected $address;
    /**
     * @var
     */
    protected $username;
    /**
     * @var
     */
    protected $password;

    /**
     * @var iAdapter
     */
    protected $adapter;

    /**
     * @var
     */
    protected $config;

    /**
     * @var
     */
    protected $client;



    public function __construct(array $params = [])
    {
        $config = config('sms');

        $provider = $config['sms_ir'];

        if(empty($params))
            $params = $config['sms_ir'];

        $this->config = $config['sms_ir'];



        $this->client = new SoapClient($this->config['address']);


        $this->address  = array_key_exists('address',$params) ? $params['address'] : $this->config['address'];
        $this->username = array_key_exists('username',$params) ? $params['username'] : $this->config['username'];
        $this->password = array_key_exists('password',$params) ? $params['password'] : $this->config['password'];
    }



    public function handleErrors($method , $errorCode)
    {
        foreach($this->config['methods'][$method]['errors']['reference']['message'] as $key => $value ){
            if($key == $errorCode){
                Log::error($value);
            }
        }
    }



    public function getSmsLines()
    {
        $params= array("userName"=>$this->username,"password"=>$this->password);
        return $this->client->GetSmsLines($params);
    }

    public function send($recipient, $message, $sender = '', array $options = [])
    {
        $parameters['userName'] = $this->username;
        $parameters['password'] = $this->password;
        $parameters['mobileNos'] = array(doubleval($recipient));
        $parameters['messages'] = array($message);
        $parameters['lineNumber'] = $sender ? $sender : $this->config['line'];
        $parameters['sendDateTime'] = date("Y-m-d")."T".date("H:i:s");

        $result = $this->client->SendMessageWithLineNumber($parameters);

        return $result;
    }

    public function DeleteSchedulSendSms($id)
    {
        $params= array('userName'=>$this->username,'password'=>$this->password,'schedulSendSmsID'=>$id);
        $result = $this->client->DeleteSchedulSendSms($params);

        return $result;
    }


    /**
     * @param $from  sample : 2014-05-18T11:47:25
     * @param $to    sample : 2014-06-18T11:47:25
     */
    public function GetAllMessages($from , $to)
    {
        $params= array('userName'=>$this->username,'password'=>$this->password,'fromDate'=>$from,'toDate'=>$to);
        $result = $this->client->GetAllMessages($params);

        return $result;
    }

    /**
     * @param $id
     */
    public function GetBranches($id)
    {
        $params= array('userName'=>$this->username,'password'=>$this->password,'parentBranchID'=>$id);
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
    public function GetDefualtLineNumber()
    {

    }

    /**
     *
     */
    public function GetListOfScheduleSends()
    {
        $params= array('userName'=>$this->username,'password'=>$this->password);
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
        $Params= array('userName'=>$this->username,'password'=>$this->password,'fromDate'=>$from,'toDate'=>$to);
        $result = $this->client->GetReceivedMessages($Params);

        return $result;
    }

    /**
     *
     */
    public function GetSendToBranchFilterConditions()
    {
        $params= array('userName'=>$this->username,'password'=>$this->password);
        $result = $this->client->GetSendToBranchFilterConditions($params);

        return $result;
    }

    /**
     *
     */
    public function GetSendToBranchesSendMethods()
    {
        $params= array('userName'=>$this->username,'password'=>$this->password);
        $result =$this->client->GetSendToBranchesSendMethods($params);

        return $result;
    }

    public function GetSentMessageStatus($batchKey , $requestPageNumber , $rowsPerPage , $countAll , $sendDate)
    {
        $params= array('userName'=>$this->username,'password'=>$this->password, 'batchKey'=>$batchKey,
            'requestedPageNumber'=>$requestPageNumber,'rowsPerPage'=>$rowsPerPage,'countOfAll'=>$countAll,
            'sendDateTime'=>$sendDate);
        $result = $this->client->GetSentMessageStatus($params);

        return $result;
    }

    public function GetSentMessageStatusByID()
    {

    }

    /**
     * @param $from sample : 2014-04-18T11:47:25
     * @param $to   sample : 2014-07-20T11:47:25
     */
    public function GetSentMessages($from , $to)
    {
        $params= array('userName'=>$this->username,'password'=>$this->password,'fromDate'=>$from,'toDate'=>$to);
        $result = $this->client->GetSentMessages($params);

        return $result;
    }

    /**
     * @param $from sample : 2014-04-18T11:47:25
     * @param $to   sample : 2014-07-20T11:47:25
     */
    public function GetTrashedMessages($from , $to)
    {
        $params= array('userName'=>$this->username,'password'=>$this->password,'fromDate'=>$from,'toDate'=>$to);
        $result = $this->client->GetTrashedMessages($params);

        return $result;
    }

    public function GetUserCredit()
    {

    }

    /**
     * @param $dailyScheduleSend
     */
    public function SaveNewSchedulSendSms_Daily($dailyScheduleSend)
    {
        $params= array('userName'=>$this->username,'password'=>$this->password,'dailyScheduleSend'=>$dailyScheduleSend);
        $result = $this->client->SaveNewSchedulSendSms_Daily($params);

        return $result;
    }

    public function SaveNewSchedulSendSms_Monthly($monthlyScheduleSend)
    {
        $params= array('userName'=>$this->username,'password'=>$this->password,
            'monthlyScheduleSend'=>$monthlyScheduleSend);
        $result = $this->client->SaveNewSchedulSendSms_Monthly($params);

        return $result;
    }

    public function SaveNewSchedulSendSms_Weekly($weeklyScheduleSend)
    {
        $params= array('userName'=>$this->username,'password'=>$this->password,'weeklyScheduleSend'=>$weeklyScheduleSend);
        $result =  $this->client->SaveNewSchedulSendSms_Weekly($params);

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

    public function SendToParish($line , $sendCount , $sendMethodId , $startAt , $fromNumber , $toNumber , $filterId ,
                                 $filterValue , $messageBody , $parishId , $sendSince , $isFlash)
    {
        $params= array('userName'=>$this->username,'password'=>$this->password,'smsLineID'=>$line,
            'sendCount'=>$sendCount,'sendMethodID'=>$sendMethodId,'startAt'=>$startAt,'fromNumber'=>$fromNumber,
            'toNumber'=>$toNumber,'filterID'=>$filterId,'filterValue'=>$filterValue,'messageBody'=>$messageBody,
            'parishID'=>$parishId,'sendSince'=>$sendSince,'isFlash'=>$isFlash);
        $result =  $this->client->SendToParish($params);

        return $result;
    }



}
