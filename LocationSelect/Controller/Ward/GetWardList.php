<?php

namespace Magenest\LocationSelect\Controller\Ward;

use Magento\Framework\App\Action\Context;

class GetWardList extends \Magento\Framework\App\Action\Action
{
    protected $_curl;
    protected $resultJsonFactory;
    protected $_request;

    public function __construct(Context $context,
                                \Magento\Framework\HTTP\Client\Curl $curl,
                                \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
                                \Magento\Framework\App\RequestInterface $request)
    {
        $this->_curl = $curl;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->_request = $request;
        parent::__construct($context);
    }

    public function execute()
    {
        $district_id = $this->_request->getParam('district_id');

        $url = "https://thongtindoanhnghiep.co/api/district/" . $district_id . "/ward";
        $this->_curl->get($url);
        $response = $this->_curl->getBody();

        $result = $this->resultJsonFactory->create();
        $result = $result->setData($response);

        return $result;
    }
}