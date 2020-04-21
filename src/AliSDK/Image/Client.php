<?php
namespace Shiqc\AliSDK\Image;

use Shiqc\AliSDK\BasicService\BaseClient;
use Shiqc\AliSDK\Lib\AntMerchantExpandIndirectImageUploadRequest;

class Client extends BaseClient
{
    public $file_path = '';
    public $file_type = '';

    public  function execute(){
        $aop = $this->getAopClient();
        $request = new AntMerchantExpandIndirectImageUploadRequest ();
        $request->setImageContent($this->file_path);
        $request->setImageType($this->file_type);
        $this->getService($request);
        $result = $aop->execute ($request);
        $responseNode =$this->service;
        return (array)$result->$responseNode;
    }
}
