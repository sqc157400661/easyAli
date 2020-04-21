<?php
namespace Shiqc\AliSDK\MiniProgram\Pay;

use Shiqc\AliSDK\Lib\AlipayTradeCreateRequest;
use Shiqc\AliSDK\BasicService\BaseClient;
use Shiqc\AliSDK\Lib\AlipayTradeQueryRequest;

class Client extends BaseClient
{
    protected $service = 'alipay_trade_create_response';



    public  function execute (){
        $aop = $this->getAopClient();
        $request = new AlipayTradeCreateRequest ();
        $content = array();
        $request->setNotifyUrl($this->getNotifyUrl());
        $content['out_trade_no'] = $this->out_trade_no;
        $content['total_amount'] = $this->total_fee;
        $content['subject'] = $this->subject;
        $content['buyer_id'] = $this->buyer_id;
        if(!empty($this->business_params)){
            $content['business_params'] = $this->business_params;
        }
        if(!empty($this->extend_params)){
            $content['extend_params'] = $this->extend_params;
        }
        $content=json_encode($content);
        $request->setBizContent($content);
        $result = $aop->execute ($request);
        $responseNode =$this->service;
        return $result->$responseNode;
    }

    public  function notify ($data){
        $aop = $this->getAopClient();;
//        $aop->alipayrsaPublicKey= $this->public_key; //'请填写支付宝公钥，一行字符串';
        $flag = $aop->rsaCheckV1($data , NULL, "RSA2");
        return $flag;
    }

    public function query()
    {
        $aop = $this->getAopClient();
        $request = new AlipayTradeQueryRequest ();
        $content = array();
        $content['out_trade_no'] = $this->out_trade_no;
        if(!empty($this->trade_no)){
            $content['trade_no'] = $this->trade_no;
        }
        $content = json_encode($content);
        $request->setBizContent($content);
        $result = $aop->execute($request);
        $this->service = str_replace(".", "_", $request->getApiMethodName()) . "_response";
        $responseNode = $this->service;
        return $result->$responseNode;
    }

}
