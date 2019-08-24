<?php

namespace Magenest\LocationSelect\Controller\District;

use Magento\Framework\App\Action\Context;

class GetDistrictList extends \Magento\Framework\App\Action\Action
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
        $city_id = $this->_request->getParam('city_id');

        $url = "https://thongtindoanhnghiep.co/api/city/" . $city_id . "/district";
        $this->_curl->get($url);
        $response = $this->_curl->getBody();

        $result = $this->resultJsonFactory->create();
        $result = $result->setData($response);

        return $result;
    }
}