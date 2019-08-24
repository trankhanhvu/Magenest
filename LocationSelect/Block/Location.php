<?php
namespace Magenest\LocationSelect\Block;

use Magento\Framework\View\Element\Template;
use PHPUnit\Util\Log\JSON;

class Location extends Template
{
    protected $_curl;
    protected $customerFactory;
    protected $_cookieManager;

    public function __construct(Template\Context $context,
                                \Magento\Framework\HTTP\Client\Curl $curl,
                                \Magento\Customer\Model\CustomerFactory $customerFactory,
                                \Magento\Framework\Stdlib\CookieManagerInterface $cookieManager,
                                array $data = [])
    {
        $this->_curl = $curl;
        $this->customerFactory = $customerFactory;
        $this->_cookieManager = $cookieManager;
        parent::__construct($context, $data);
    }

    public function getLocation()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $customerSession = $objectManager->create('Magento\Customer\Model\Session');
        $customerID = $customerSession->getCustomer()->getId();

        $city_idCookie = $this->_cookieManager->getCookie('city_id');
        $district_idCookie = $this->_cookieManager->getCookie('district_id');
        $ward_idCookie = $this->_cookieManager->getCookie('ward_id');

        if($customerID != null)
        {
            $customer = $this->customerFactory->create();
            $customer->load($customerID);
            $city_id = $customer->getData('city_id');
            $district_id = $customer->getData('district_id');
            $ward_id = $customer->getData('ward_id');

            $this->_curl->get('https://thongtindoanhnghiep.co/api/city/' . $city_id);
            $cityInfo = json_decode($this->_curl->getBody(),true);

            $this->_curl->get('https://thongtindoanhnghiep.co/api/district/' . $district_id);
            $districtInfo = json_decode($this->_curl->getBody(),true);

            $this->_curl->get('https://thongtindoanhnghiep.co/api/ward/' . $ward_id);
            $wardInfo = json_decode($this->_curl->getBody(),true);

            $location = $cityInfo['Title'] . " . " . $districtInfo['Title'] . " . " . $wardInfo['Title'];
        }
        elseif (isset($city_idCookie) && isset($district_idCookie) && isset($ward_idCookie))
        {
            $this->_curl->get('https://thongtindoanhnghiep.co/api/city/' . $city_idCookie);
            $cityInfo = json_decode($this->_curl->getBody(),true);

            $this->_curl->get('https://thongtindoanhnghiep.co/api/district/' . $district_idCookie);
            $districtInfo = json_decode($this->_curl->getBody(),true);

            $this->_curl->get('https://thongtindoanhnghiep.co/api/ward/' . $ward_idCookie);
            $wardInfo = json_decode($this->_curl->getBody(),true);

            $location = $cityInfo['Title'] . " . " . $districtInfo['Title'] . " . " . $wardInfo['Title'];
        }
        else
        {
            $location = "Location";
        }
        return $location;
    }

    public function getCityID()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $customerSession = $objectManager->create('Magento\Customer\Model\Session');
        $customerID = $customerSession->getCustomer()->getId();

        $city_idCookie = $this->_cookieManager->getCookie('city_id');

        if($customerID != null)
        {
            $customer = $this->customerFactory->create();
            $customer->load($customerID);
            $city_id = $customer->getData('city_id');
        }
        elseif(isset($city_idCookie))
        {
            $city_id = $city_idCookie;
        }
        else
        {
            $city_id = 1;
        }
        return $city_id;
    }

    public function getCityList()
    {
        $this->_curl->get('https://thongtindoanhnghiep.co/api/city');
        $citylist = json_decode($this->_curl->getBody(),true);
        return $citylist['LtsItem'];
    }

    public function getDistrictID()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $customerSession = $objectManager->create('Magento\Customer\Model\Session');
        $customerID = $customerSession->getCustomer()->getId();

        $district_idCookie = $this->_cookieManager->getCookie('district_id');

        if($customerID != null)
        {
            $customer = $this->customerFactory->create();
            $customer->load($customerID);
            $district_id = $customer->getData('district_id');
        }
        elseif(isset($district_idCookie))
        {
            $district_id = $district_idCookie;
        }
        else
        {
            $district_id = 279;
        }
        return $district_id;
    }

    public function getDistrictList()
    {
        $this->_curl->get('https://thongtindoanhnghiep.co/api/city/'. $this->getCityID() . '/district');
        $districtlist = json_decode($this->_curl->getBody(),true);
        return $districtlist;
    }

    public function getWardID()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $customerSession = $objectManager->create('Magento\Customer\Model\Session');
        $customerID = $customerSession->getCustomer()->getId();

        $ward_idCookie = $this->_cookieManager->getCookie('ward_id');

        if($customerID != null)
        {
            $customer = $this->customerFactory->create();
            $customer->load($customerID);
            $ward_id = $customer->getData('ward_id');
        }
        elseif(isset($ward_idCookie))
        {
            $ward_id = $ward_idCookie;
        }
        else
        {
            $ward_id = 5318;
        }
        return $ward_id;
    }

    public function getWardList()
    {
        $this->_curl->get('https://thongtindoanhnghiep.co/api/district/'. $this->getDistrictID() . '/ward');
        $wardlist = json_decode($this->_curl->getBody(),true);
        return $wardlist;
    }
}