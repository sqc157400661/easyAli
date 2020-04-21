<?php
namespace Shiqc\AliSDK\BasicService;

use Shiqc\AliSDK\Lib\AlipaySystemOauthTokenRequest;
use Shiqc\AliSDK\BasicService\AopClient;
use Shiqc\AliSDK\BasicService\AopCertClient;

class BaseClient
{

    protected $_gateway_new = 'https://openapi.alipay.com/gateway.do';

    protected $app_version = '1.0';

    protected $service;

    protected $partner;

    protected $_input_charset = 'UTF-8';

    protected $sign_type = 'RSA2';

    protected $format = 'json';

    protected $out_trade_no;

    protected $app_id;

    protected $protected_key;

    protected $public_key;

    protected $notify_url;

    protected $return_url;

    protected $payment_type = 1;

    protected $seller_id;

    protected $buyer_id;

    protected $total_fee;

    protected $subject;

    protected $body;

    protected $it_b_pay;

    protected $show_url;

    protected $exter_invoke_ip;

    protected $key;

//    protected $is_cert = 0;
    protected $is_open = 0;

    /**
     * @var
     * 应用APP_ID  $appId
     */
    protected static $config;
    public function __construct()
    {
        self::$config = array_merge(config('shiqc-alisdk'),config('shiqc-alisdk-miniProgram'));
    }


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

    protected function getAopClient(){
        if($this->isCert()){
            $aop = new AopCertClient ();
            $aop->alipayrsaPublicKey = $aop->getPublicKey($this->getAlipayCertPath());
            //是否校验自动下载的支付宝公钥证书，如果开启校验要保证支付宝根证书在有效期内
            $aop->isCheckAlipayPublicCert = true;
            $aop->appCertSN = $aop->getCertSN($this->getAppCertPath());
            $aop->alipayRootCertSN = $aop->getRootCertSN($this->getRootCertPath());
        }else{
            $aop = new AopClient ();
            $aop->alipayrsaPublicKey= $this->getAlipayRsaPublicKey(); //'请填写支付宝公钥，一行字符串';
        }
        $aop->gatewayUrl = $this->_gateway_new;
        $aop->appId = $this->getAppId();
        $aop->rsaPrivateKey = $this->getRsaPrivateKey(); // '请填写去头去尾去回车，一行字符串';
        $aop->apiVersion = $this->app_version;
        $aop->signType = $this->sign_type;
        $aop->postCharset= $this->_input_charset;
        $aop->format= $this->format;
        return $aop;
    }

    protected function getPrx(){
        $prx = '';
        if($this->is_open){
            $prx = 'open_';
        }
        return $prx;
    }

    // 获取appid
    protected function getAppId(){
        if(empty($this->app_id)){
            return self::$config[$this->getPrx().'app_id'];
        }
        return $this->app_id;
    }
    // 获取开发者私钥
    protected function getRsaPrivateKey(){
        if(empty($this->private_key)){
            return self::$config['private_key'];
        }
        return $this->private_key;
    }

    // 获取支付宝公钥
    protected function getAlipayRsaPublicKey(){
        if(empty($this->public_key)){
            return self::$config['public_key'];
        }
        return $this->public_key;
    }

    //调用getPublicKey从支付宝公钥证书中提取公钥  支付宝公钥证书路径 （要确保证书文件可读）
    protected function getAlipayCertPath(){
        if(empty($this->alipay_cert_path)){
            return self::$config[$this->getPrx().'alipay_cert_path'];
        }
        return $this->alipay_cert_path;
    }

    //调用getCertSN获取证书序列号 应用证书路径 （要确保证书文件可读）
    protected function getAppCertPath(){
        if(empty($this->app_cert_path)){
            return self::$config[$this->getPrx().'app_cert_path'];
        }
        return $this->app_cert_path;
    }

    //调用getRootCertSN获取支付宝根证书序列号 支付宝根证书路径 （要确保证书文件可读）
    protected function getRootCertPath(){
        if(empty($this->root_cert_path)){
            return self::$config[$this->getPrx().'root_cert_path'];
        }
        return $this->root_cert_path;
    }

    // 获取回调地址
    protected function getNotifyUrl(){
        if(empty($this->notify_url)){
            return self::$config['notify_url'];
        }
        return $this->notify_url;
    }

    // 获取回调地址
    protected function isCert(){
        if(!isset($this->is_cert)){
            return self::$config['is_cert'];
        }
        return $this->is_cert;
    }


    protected function getService($request){
        $this->service =  str_replace(".", "_", $request->getApiMethodName()) . "_response";
        return $this->service;
    }
    public function getMyService(){
        return $this->service;
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

    public function setPrivateKey($protected_key)
    {
        $this->protected_key = $protected_key;
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
