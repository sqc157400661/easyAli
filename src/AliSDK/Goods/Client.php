<?php
namespace Shiqc\AliSDK\Goods;

use Shiqc\AliSDK\BasicService\BaseClient;
use Shiqc\AliSDK\Lib\AntMerchantExpandItemCreateRequest;
use Shiqc\AliSDK\Lib\AntMerchantExpandItemQueryRequest;
use Shiqc\AliSDK\Lib\AntMerchantExpandItemModifyRequest;
use Shiqc\AliSDK\Lib\AntMerchantExpandItemDeleteRequest;
use Shiqc\AliSDK\Lib\AntMerchantExpandItemStatusModifyRequest;

class Client extends BaseClient
{
    private $request;

    public function create(){
        $this->request = new AntMerchantExpandItemCreateRequest();
        return $this;
    }
    public function select(){
        $this->request = new AntMerchantExpandItemQueryRequest();
        return $this;
    }
    public function update(){
        $this->request = new AntMerchantExpandItemModifyRequest();
        return $this;
    }
    public function modify(){
        $this->request = new AntMerchantExpandItemStatusModifyRequest();
        return $this;
    }
    public function delete(){
        $this->request = new AntMerchantExpandItemDeleteRequest();
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

}
