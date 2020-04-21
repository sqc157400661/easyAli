<?php
namespace Shiqc\AliSDK\Auth;

use Shiqc\AliSDK\BasicService\BaseClient;
use Shiqc\AliSDK\Lib\AlipaySystemOauthTokenRequest;
use Shiqc\AliSDK\Lib\AlipayUserInfoShareRequest;

class Client extends BaseClient
{
    protected $service = 'alipay_system_oauth_token_response';

    public  function execute(){
        $aop = $this->getAopClient();
        $request = new AlipaySystemOauthTokenRequest ();
        $request->setGrantType("authorization_code");
        $request->setCode($this->code);
        $result = $aop->execute ($request);
        $this->getService($request);
        $responseNode =$this->service;
        return (array)$result->$responseNode;
    }

    public  function user_info_share(){
        $aop = $this->getAopClient();
        $request = new AlipayUserInfoShareRequest();
        $result = $aop->execute($request,$this->accessToken);
        $this->getService($request);
        $responseNode =$this->service;
        return (array)$result->$responseNode;
    }

}
