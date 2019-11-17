<?php
namespace Shiqc\AliSDK\MiniProgram\Pay;

use Shiqc\AliSDK\MiniProgram\Pay\AopClient;
use Shiqc\AliSDK\MiniProgram\Pay\AlipayTradeCreateRequest;

class SdkPayment
{

    private $_gateway_new = 'https://openapi.alipay.com/gateway.do';

    private $app_version = '1.0';

    private $partner;

    private $_input_charset = 'GBK';

    private $sign_type = 'RSA2';

    private $format = 'json';

    private $app_id;

    private $private_key;

    private $public_key;

    private $notify_url;

    private $return_url;

    private $out_trade_no;

    private $payment_type = 1;

    private $seller_id;

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
        $request->setBizContent("{" .
            "\"out_trade_no\":\"20150320010101001\"," .
            "\"seller_id\":\"2088102146225135\"," .
            "\"total_amount\":88.88," .
            "\"discountable_amount\":8.88," .
            "\"subject\":\"Iphone6 16G\"," .
            "\"body\":\"Iphone6 16G\"," .
            "\"buyer_id\":\"2088102146225135\"," .
            "      \"goods_detail\":[{" .
            "        \"goods_id\":\"apple-01\"," .
            "\"goods_name\":\"ipad\"," .
            "\"quantity\":1," .
            "\"price\":2000," .
            "\"goods_category\":\"34543238\"," .
            "\"categories_tree\":\"124868003|126232002|126252004\"," .
            "\"body\":\"特价手机\"," .
            "\"show_url\":\"http://www.alipay.com/xxx.jpg\"" .
            "        }]," .
            "\"product_code\":\"FACE_TO_FACE_PAYMENT\"," .
            "\"operator_id\":\"Yx_001\"," .
            "\"store_id\":\"NJ_001\"," .
            "\"terminal_id\":\"NJ_T_001\"," .
            "\"extend_params\":{" .
            "\"sys_service_provider_id\":\"2088511833207846\"," .
            "\"industry_reflux_info\":\"{\\\\\\\"scene_code\\\\\\\":\\\\\\\"metro_tradeorder\\\\\\\",\\\\\\\"channel\\\\\\\":\\\\\\\"xxxx\\\\\\\",\\\\\\\"scene_data\\\\\\\":{\\\\\\\"asset_name\\\\\\\":\\\\\\\"ALIPAY\\\\\\\"}}\"," .
            "\"card_type\":\"S0JP0000\"" .
            "    }," .
            "\"timeout_express\":\"90m\"," .
            "\"settle_info\":{" .
            "        \"settle_detail_infos\":[{" .
            "          \"trans_in_type\":\"cardAliasNo\"," .
            "\"trans_in\":\"A0001\"," .
            "\"summary_dimension\":\"A0001\"," .
            "\"settle_entity_id\":\"2088xxxxx;ST_0001\"," .
            "\"settle_entity_type\":\"SecondMerchant、Store\"," .
            "\"amount\":0.1" .
            "          }]" .
            "    }," .
            "\"logistics_detail\":{" .
            "\"logistics_type\":\"EXPRESS\"" .
            "    }," .
            "\"business_params\":{" .
            "\"campus_card\":\"0000306634\"" .
            "    }," .
            "\"receiver_address_info\":{" .
            "\"name\":\"张三\"," .
            "\"address\":\"上海市浦东新区陆家嘴银城中路501号\"," .
            "\"mobile\":\"13120180615\"," .
            "\"zip\":\"200120\"," .
            "\"division_code\":\"310115\"" .
            "    }" .
            "  }");
        $result = $aop->execute ( $request);

        $responseNode = str_replace(".", "_", $request->getApiMethodName()) . "_response";
        $resultCode = $result->$responseNode->code;
        if(!empty($resultCode)&&$resultCode == 10000){
            echo "成功";
        } else {
            echo "失败";
        }
    }


    public function setPartner($partner)
    {
        $this->partner = $partner;
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

    public function setOutTradeNo($out_trade_no)
    {
        $this->out_trade_no = $out_trade_no;
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
