<?php

namespace Shiqc\AliSDK\Lib;
/**
 * ALIPAY API: alipay.lifeassistant.prod.gateway.access request
 *
 * @author auto create
 * @since 1.0, 2019-03-08 15:29:11
 */
class AlipayLifeassistantProdGatewayAccessRequest
{
	/** 
	 * 业务类型
1-手机充值
2-公共事业缴费
3-信用卡还款
	 **/
	private $bizType;
	
	/** 
	 * json格式字符串
	 **/
	private $extParams;
	
	/** 
	 * 商户类型
10001-新浪微博
	 **/
	private $mType;
	
	/** 
	 * 外部用户ID
	 **/
	private $uid;

	private $apiParas = array();
	private $terminalType;
	private $terminalInfo;
	private $prodCode;
	private $apiVersion="1.0";
	private $notifyUrl;
	private $returnUrl;
    private $needEncrypt=false;

	
	public function setBizType($bizType)
	{
		$this->bizType = $bizType;
		$this->apiParas["biz_type"] = $bizType;
	}

	public function getBizType()
	{
		return $this->bizType;
	}

	public function setExtParams($extParams)
	{
		$this->extParams = $extParams;
		$this->apiParas["ext_params"] = $extParams;
	}

	public function getExtParams()
	{
		return $this->extParams;
	}

	public function setmType($mType)
	{
		$this->mType = $mType;
		$this->apiParas["m_type"] = $mType;
	}

	public function getmType()
	{
		return $this->mType;
	}

	public function setUid($uid)
	{
		$this->uid = $uid;
		$this->apiParas["uid"] = $uid;
	}

	public function getUid()
	{
		return $this->uid;
	}

	public function getApiMethodName()
	{
		return "alipay.lifeassistant.prod.gateway.access";
	}

	public function setNotifyUrl($notifyUrl)
	{
		$this->notifyUrl=$notifyUrl;
	}

	public function getNotifyUrl()
	{
		return $this->notifyUrl;
	}

	public function setReturnUrl($returnUrl)
	{
		$this->returnUrl=$returnUrl;
	}

	public function getReturnUrl()
	{
		return $this->returnUrl;
	}

	public function getApiParas()
	{
		return $this->apiParas;
	}

	public function getTerminalType()
	{
		return $this->terminalType;
	}

	public function setTerminalType($terminalType)
	{
		$this->terminalType = $terminalType;
	}

	public function getTerminalInfo()
	{
		return $this->terminalInfo;
	}

	public function setTerminalInfo($terminalInfo)
	{
		$this->terminalInfo = $terminalInfo;
	}

	public function getProdCode()
	{
		return $this->prodCode;
	}

	public function setProdCode($prodCode)
	{
		$this->prodCode = $prodCode;
	}

	public function setApiVersion($apiVersion)
	{
		$this->apiVersion=$apiVersion;
	}

	public function getApiVersion()
	{
		return $this->apiVersion;
	}

  public function setNeedEncrypt($needEncrypt)
  {

     $this->needEncrypt=$needEncrypt;

  }

  public function getNeedEncrypt()
  {
    return $this->needEncrypt;
  }

}
