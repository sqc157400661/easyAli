<?php
namespace Shiqc\AliSDK\MiniProgram\Pay;

use Shiqc\AliSDK\MiniProgram\Pay\AopClient;
use Shiqc\AliSDK\MiniProgram\Pay\AlipayTradeCreateRequest;

class SdkPayment
{

    private $_gateway_new = 'https://openapi.alipay.com/gateway.do';

    private $app_version = '1.0';

    private $service = 'alipay_trade_create_response';

    private $partner;

    private $_input_charset = 'UTF-8';

    private $sign_type = 'RSA2';

    private $format = 'json';

    private $out_trade_no;

    private $app_id;

    private $private_key;

    private $public_key;

    private $notify_url;

    private $return_url;

    private $payment_type = 1;

    private $seller_id;

    private $buyer_id;

    private $total_fee;

    private $subject;

    private $body;

    private $it_b_pay;

    private $show_url;

    private $exter_invoke_ip;

    private $key;


    /**
     * 提供给外部的设置内部属性的入口
     * @param $key
     * @param $value
     * @return $this
     */
    public function set($key,$value)
    {
        $this->$key = $value;
        return $this;
    }

    public  function Pay (){
        $aop = new AopClient ();
        $aop->gatewayUrl = $this->_gateway_new;
        $aop->appId = $this->app_id;
        $aop->rsaPrivateKey = $this->private_key; // '请填写开发者私钥去头去尾去回车，一行字符串';
        $aop->alipayrsaPublicKey= $this->public_key; //'请填写支付宝公钥，一行字符串';
        $aop->apiVersion = $this->app_version;
        $aop->signType = $this->sign_type;
        $aop->postCharset= $this->_input_charset;
        $aop->format= $this->format;
        $request = new AlipayTradeCreateRequest ();
        $content = array();
        $request->setNotifyUrl($this->notify_url);
        $content['out_trade_no'] = $this->out_trade_no;
        $content['total_amount'] = $this->total_fee;
        $content['subject'] = $this->subject;
        $content['buyer_id'] = $this->buyer_id;
        $content=json_encode($content);
        $request->setBizContent($content);
        $result = $aop->execute ($request);
        $responseNode =$this->service;
        return $result->$responseNode;
//        $responseNode = str_replace(".", "_", $request->getApiMethodName()) . "_response";
//        $resultCode = $result->$responseNode->code;
//        if(!empty($resultCode)&&$resultCode == 10000){
//            echo "成功";
//        } else {
//            echo "失败";
//        }
    }

    public  function notify ($data){
        $aop = new AopClient ();
        $aop->alipayrsaPublicKey= $this->public_key; //'请填写支付宝公钥，一行字符串';
        $flag = $aop->rsaCheckV1($data , NULL, "RSA2");
        return $flag;
    }


    public function setPartner($partner)
    {
        $this->partner = $partner;
        return $this;
    }

    public function setOutTradeNo($out_trade_no)
    {
        $this->out_trade_no = $out_trade_no;
        return $this;
    }

    public function setAppId($appId)
    {
        $this->app_id = $appId;
        return $this;
    }

    public function setNotifyUrl($notify_url)
    {
        $this->notify_url = $notify_url;
        return $this;
    }

    public function setReturnUrl($return_url)
    {
        $this->return_url = $return_url;
        return $this;
    }

    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    public function setPrivateKey($private_key)
    {
        $this->private_key = $private_key;
        return $this;
    }

    public function setPublicKey($public_key)
    {
        $this->public_key = $public_key;
        return $this;
    }

    public function setSellerId($seller_id)
    {
        $this->seller_id = $seller_id;
        return $this;
    }
    public function setBuyerId($buyer_id)
    {
        $this->buyer_id = $buyer_id;
        return $this;
    }

    public function setTotalFee($total_fee)
    {
        $this->total_fee = $total_fee;
        return $this;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    public function setItBPay($it_b_pay)
    {
        $this->it_b_pay = $it_b_pay;
        return $this;
    }

    public function setShowUrl($show_url)
    {
        $this->show_url = $show_url;
        return $this;
    }

    public function setSignType($sign_type)
    {
        $this->sign_type = $sign_type;
        return $this;
    }

    public function setExterInvokeIp($exter_invoke_ip)
    {
        $this->exter_invoke_ip = $exter_invoke_ip;
        return $this;
    }

}
