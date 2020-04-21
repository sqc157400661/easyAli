<?php
namespace Shiqc\AliSDK\Store;

use Shiqc\AliSDK\BasicService\BaseClient;
use Shiqc\AliSDK\Lib\AntMerchantExpandShopCreateRequest;
use Shiqc\AliSDK\Lib\AntMerchantExpandShopQueryRequest;
use Shiqc\AliSDK\Lib\AntMerchantExpandShopModifyRequest;
use Shiqc\AliSDK\Lib\AntMerchantExpandShopCloseRequest;

class Client extends BaseClient
{
    private $request;

    
    public function create(){
        $this->request = new AntMerchantExpandShopCreateRequest();
        return $this;
    }
    public function select(){
        $this->request = new AntMerchantExpandShopQueryRequest();
        return $this;
    }
    public function update(){
        $this->request = new AntMerchantExpandShopModifyRequest();
        return $this;
    }
    public function delete(){
        $this->request = new AntMerchantExpandShopCloseRequest();
        return $this;
    }

    public  function execute(){
        $aop = $this->getAopClient();
        $this->request->setBizContent($this->bizContent);
        $this->getService($this->request);
        $result = $aop->execute ($this->request);
        $responseNode =$this->service;
        return (array)$result->$responseNode;
    }

    public  function notify ($data){
        $aop = $this->getAopClient();
//        $aop->alipayrsaPublicKey= $this->public_key; //'请填写支付宝公钥，一行字符串';
        $flag = $aop->rsaCheckV1($data , NULL, "RSA2");
        return $flag;
    }

}
