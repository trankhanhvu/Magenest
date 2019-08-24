<?php

namespace Magenest\LocationSelect\Controller\City;

use Magento\Framework\App\Action\Context;

class GetCityList extends \Magento\Framework\App\Action\Action
{
    protected $_curl;
    protected $resultJsonFactory;

    public function __construct(Context $context,
                                \Magento\Framework\HTTP\Client\Curl $curl,
                                \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory)
    {
        $this->_curl = $curl;
        $this->resultJsonFactory = $resultJsonFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $this->_curl->get('https://thongtindoanhnghiep.co/api/city');
        $response = $this->_curl->getBody();

        $result = $this->resultJsonFactory->create();
        $result = $result->setData($response);

        return $result;
    }
}