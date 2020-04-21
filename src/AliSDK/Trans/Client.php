<?php
namespace Shiqc\AliSDK\Trans;

use Shiqc\AliSDK\Lib\AlipayFundTransToaccountTransferRequest;
use Shiqc\AliSDK\BasicService\BaseClient;
use Shiqc\AliSDK\Lib\AlipayFundTransOrderQueryRequest;

class Client extends BaseClient
{
    protected $service = 'alipay_fund_trans_toaccount_transfer_response';
    protected $payee_type = 'ALIPAY_LOGONID';
    protected $out_biz_no;
    protected $payee_account;
    protected $amount;

    public function execute()
    {
        $aop = $this->getAopClient();
        $request = new AlipayFundTransToaccountTransferRequest();
        $content = array();
        $content['out_biz_no'] = $this->out_biz_no;
        $content['payee_type'] = $this->payee_type;
        $content['payee_account'] = $this->payee_account;
        $content['amount'] = $this->amount;
        if(!empty($this->payer_show_name)){
            $content['payer_show_name'] = $this->payer_show_name;
        }
        if(!empty($this->payee_real_name)){
            $content['payee_real_name'] = $this->payee_real_name;
        }
        if(!empty($this->remark)){
            $content['remark'] = $this->remark;
        }
        $content = json_encode($content);
        $request->setBizContent($content);
        $result = $aop->execute($request);
        $this->getService($request);
        $responseNode = $this->service;
        return (array)$result->$responseNode;
    }

    public function query()
    {
        $aop = $this->getAopClient();
        $request = new AlipayFundTransOrderQueryRequest ();
        $content = array();
        $content['out_biz_no'] = $this->out_biz_no;
        if(!empty($this->order_id)){
            $content['order_id'] = $this->order_id;
        }
        $content = json_encode($content);
        $request->setBizContent($content);
        $result = $aop->execute($request);
        $this->getService($request);
        $responseNode = $this->service;
        return (array)$result->$responseNode;
    }

}